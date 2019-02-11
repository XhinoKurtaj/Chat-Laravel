<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Conversation;
use App\Events\UserNotification;
use Yajra\Datatables\Datatables;
class SearchController extends Controller
{
    public function index()
    {
        $users = User::select([DB::raw("CONCAT(id,' ',first_name,' ',last_name) AS name"),'email',]);
        return Datatables::of($users)->make();
    }

    public function inviteUser(Request $request, $id)
    {
        $member = $request->get('member');
        if($member != null)
        {
            $search = DB::table('users')->where('email', 'like', '%' . $member . '%')->pluck('id');
            if ($search[0] == null) {
                return response()->json("We couldn't find any user with that email",404);
            }else{
                $user = User::find($search[0]);
                $exist = $user->conversations()->where('id', $id)->exists();
                if ($exist)
                {
                    return response()->json("user already exist in this conversation",303);
                }
                $conversation = Conversation::find($id);
                $conversation->users()->attach($user->id);

                event(new UserNotification($id, $user->fullName, 'join'));
                return response()->json("$member added succesfully",201);
            }
        }
    }
}
