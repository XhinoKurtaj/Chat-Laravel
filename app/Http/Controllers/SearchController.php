<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Events\UserNotification;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addMember(Request $request, $id)
    {
        $member = $request->get('member');
        if($member != '')
        {
            $user = User::get();
            $length = count($user);
            $last = count($user) - 1;
            for ($i = 0; $i < $length; $i++)
            {
                if ($member == $user[$i]->fullName)
                {
                    $userId = $user[$i]->id;
                    $fullName =$user[$i]->fullName;
                    $checkUser = User::find($userId);
                    $exist = $checkUser->conversations()->where('id', $id)->exists();
                    if($exist){
                        return back()-with('error', "user already exist in this conversation");
                    }
                    break;
                } else if ($i == $last)
                {
                    return back()->with('error', "no user was found with name:<strong> $member </strong>");
                }
            }
            $conversation = Conversation::find($id);
            $conversation->users()->attach($userId);

            event(new UserNotification($id,$fullName, 'join'));

            return back()->with('success', "User <strong>$member </strong> added successfully");
        }else
        {
            return back();
        }
    }
}
