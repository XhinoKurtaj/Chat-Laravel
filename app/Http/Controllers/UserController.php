<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use App\User;
use App\Conversation;
use App\Message;
use App\Photo;
use App\Attachment;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile', array('user' => Auth::user()) );
    }

    public function delete($id)
    {

        $user = User::findOrFail($id);
        if ($user->delete())
        {
            if(auth()->user()->type == "admin")
            {
                return redirect('admin/users');
            }else{
                return redirect()->route('login');
            }

        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);

        $userId = $request->user_id;
        if($userId == null || $userId == auth()->user()->id)
        {
            $user = Auth::user();
            $user->update($request->only('first_name','last_name'));
            return redirect()->back();
        }else{
            $targetUser = User::find($userId);
            $targetUser->update($request->only('first_name', 'last_name'));
            return redirect()->back();
        }
    }

    public function admin()
    {
        return view('admin');
    }

    public function index()
    {
        $userList = User::all();
        $conversationList = Conversation::all();
        $photoList = Photo::all();
        $messageList = Message::all();
        $attachmentList = Attachment::all();
        return View("admin", compact('userList','conversationList','photoList','messageList','attachmentList'));
    }

    public function show($id)
    {
        $check = User::findOrFail($id);
        if($check)
        {
            $user = User::where("id",$id)
                ->with('photos')
                ->get();
            return view('userProfile',compact('user'));
        }

    }

    public function userDetails($id)
    {
        $check = User::find($id);
        if($check){
            $userDetails = User::where('id',$id)
                ->with('photos','conversations','messages')
                ->get();
            return view('UserView', compact('userDetails'));
        }else{
            return back();
        }
    }
}
