<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;

class SearchController extends Controller
{
    public function addMember(Request $request, $id)
    {
        $name = $request->get('search');
        if($name != '')
        {
            $user = User::get();
            $length = count($user);
            $last = count($user) - 1;
            for ($i = 0; $i < $length; $i++)
            {
                if ($name == $user[$i]->fullName)
                {
                    $userId = $user[$i]->id;
                        break;
                } else if ($i == $last)
                {
                    return back()->with('error', "no user was found with name:<strong> $name </strong>");
                }
            }
            $conversation = Conversation::find($id);
            $conversation->users()->attach($userId);
            return back()->with('success', "User <strong>$name </strong> added successfully");
        }else
            {
            return back();
        }
    }
}
