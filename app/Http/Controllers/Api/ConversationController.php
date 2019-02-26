<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use App\User;
use App\Events\UserNotification;
class ConversationController extends Controller
{
    public function index()
    {
        return Conversation::all();
    }

    public function show()
    {
        $user = auth()->user();
        $conversationList = $user->conversations;
        return $conversationList;
    }

    public function conversationMembers($id)
    {
        $conversation = Conversation::findOrFail($id);
        $memberList = $conversation->users;
        return response()->json($memberList);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $request->get('custom_name'),
            'type' => Conversation::GROUP_TYPE,
        ]);
        $user = User::find($userId);
        $user->conversations()->attach($conversationId);

        return response()->json('Conversation was created successfully!', 201);
    }

    public function update(Request $request,$id)
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

        return response()->json("Conversation updated successfully!", 201);
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id);
        $conversation->delete();
        return response()->json(['Conversation deleted successfully!'], 204);
    }

    public function leaveConversation($id)
    {
        $userId = auth()->user()->id;
        $name = auth()->user()->fullName;
        $conversation = Conversation::findOrFail($id);
        $conversation->users()->detach($userId);
        event(new UserNotification($id,$name,'left'));

        return response()->json("success", 200);
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
        if ($conversation != null && $conversation[0]['type'] == 'default') {
            return response()->json("Conversation already exist", 303);
        } else {
            $conversationId = Conversation::insertGetId([
                'custom_name' => $authUserName . ' ' . $fullNameGuest,
                'type' => Conversation::DEFAULT_TYPE,
            ]);
            $authUser->conversations()->attach($conversationId);
            $userGuest->conversations()->attach($conversationId);

            return response()->json("Conversation created successfully", 200);
        }
    }
}
