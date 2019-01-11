<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
use App\User;
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

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $request->get('custom_name')
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

        return response()->json("Conversation updated successfully!", 200);
    }

    public function delete($id)
    {
        if ($conversation = Conversation::find($id)) {
            $conversation->delete();
            return response()->json('Conversation deleted successfully!', 204);
        }else{
            return response()->json('Conversation doesnt exist!', 404);
        }
    }
}
