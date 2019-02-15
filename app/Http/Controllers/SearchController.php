<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Events\UserNotification;
use Yajra\Datatables\Datatables;
use DB;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select([DB::raw("CONCAT(id,' ',first_name,' ',last_name) AS name"),'email',]);
        return Datatables::of($users)->make();
    }
    
    public function create()
    {
        return view('data');
    }

    public function inviteUser(Request $request, $id)
    {
        $member = $request->get('member');
        if($member != null)
        {
            $search = DB::table('users')->where('email',$member)->pluck('id');
            if(empty($search[0])){
                return response()->json("we couldn't find $member");
            }else {
                $user = User::find($search[0]);
                $exist = $user->conversations()->where('id', $id)->exists();
                if ($exist) {
                    return response()->json("$member already exist in this conversation");
                }
                $conversation = Conversation::find($id);
                $conversation->users()->attach($user->id);

                event(new UserNotification($id, $user->fullName, 'join'));
                return response()->json("User <strong>$member </strong> added successfully");
            }
        }
    }
}
