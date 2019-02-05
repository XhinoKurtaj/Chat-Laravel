<?php

namespace App\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Request;
use App\Conversation;
use App\User;
use App\Events\UserNotification;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $conversationList = $user->conversations;
        return View("home", compact('conversationList'));
    }

    public function show()
    {
        return view('conversation');
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $request->get('conv')
            ]);
        $user = User::find($userId);
        $user->conversations()->attach($conversationId);

         return redirect('home');
    }

    public function conversationMembers($id)
    {
        $conversation = Conversation::findOrFail($id);
        $memberList = $conversation->users;
        return response()->json($memberList);
    }

    public function updateConversation(Request $request,$id)
    {
        $this->validate($request, [
            'custom_name'   => 'required|min:1|max:191'
        ]);
        $custom_name = $request->get('custom_name');
        $conversation = Conversation::findOrFail($id);
        $conversation->custom_name = $custom_name;
        if($request->hasFile('custom_photo')) {
            $image = $request->file('custom_photo');
            $custom_photo = $image->store('images/conversation-images', ['disk' => 'public']);
            $conversation->custom_photo = $custom_photo;
        }
            $conversation->save();

        return redirect()->route('conversation.list')->with('success', "Conversation was updated successfully");
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id)->delete();
        return back()->with('success-delete',"Conversation was deleted successfully");
    }

    public function leaveConversation($id)
    {
        $userId = auth()->user()->id;
        $name = auth()->user()->fullName;
        $conversation = Conversation::findOrFail($id);
        $conversation->users()->detach($userId);
        event(new UserNotification($id,$name,'left'));

        return redirect('home');
    }

    public function messageUser($guestId)
    {
        $authUser = auth()->user();
        $userGuest = User::find($guestId);
        $fullNameAuth = $authUser->first_name." ".$authUser->last_name;
        $fullNameGuest = $userGuest->first_name." ".$userGuest->last_name;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $fullNameAuth." ".$fullNameGuest,
        ]);
        $authUser->conversations()->attach($conversationId);
        $userGuest->conversations()->attach($conversationId);

        return redirect('/home/conversation/'.$conversationId);
    }
}

