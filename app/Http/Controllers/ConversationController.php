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
        $this->validate($request, [
            'custom_name' => 'required|string|max:255',
        ]);
        $userId = auth()->user()->id;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $request->get('custom_name'),
            'type' => Conversation::GROUP_TYPE,
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
        if($request->hasFile('custom_photo'))
        {
            $image = $request->file('custom_photo');
            $custom_photo = $image->store('images/conversation-images', ['disk' => 'public']);
            $conversation->custom_photo = $custom_photo;
        }
            $conversation->save();
        return redirect()->back();
//        return redirect()->route('conversation.list')->with('success', "Conversation was updated successfully");
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id)->delete();
        if(auth()->user()->type == "admin"){
            return redirect()->route('conversation.table');
        }else {
            return back()->with('success-delete', "Conversation was deleted successfully");
        }
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

    public function conversationDetails($id)
    {
        $check = Conversation::find($id);
        if($check){
            $conversationDetails = Conversation::where('id',$id)
                ->with('users','message','attachment','message.sender')
                ->get();
            return view('ConversationView', compact('conversationDetails'));
        }else{
            return back();
        }
    }

    public function messageSingleUser($guestId)
    {
        $authUser = auth()->user();
        $userGuest = User::findOrFail($guestId);
        $fullNameGuest = $userGuest->first_name . " " . $userGuest->last_name;
        $authUserName = $authUser->first_name . " " . $authUser->last_name;
        $conversationObj = Conversation::where('custom_name', $authUserName . ' ' . $fullNameGuest)
            ->orWhere('custom_name', $fullNameGuest . ' ' . $authUserName)
            ->get();
        $conversation = $conversationObj->toArray();
        if($conversation != null && $conversation[0]['type'] == 'default')
        {
            return redirect('/home/conversation/'.$conversation[0]['id']);
        }else{
            $conversationId = Conversation::insertGetId([
                'custom_name' => $authUserName.' '.$fullNameGuest,
                'type' => Conversation::DEFAULT_TYPE,
            ]);
            $authUser->conversations()->attach($conversationId);
            $userGuest->conversations()->attach($conversationId);

            return redirect('/home/conversation/'.$conversationId);
        }
    }
}
