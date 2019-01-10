<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Conversation;
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
            'custom_name' => $request->post('conv')
        ]);
        $user = User::find($userId);
        $user->conversations()->attach($conversationId);

        return response()->json($user, 201);
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

        return response()->json($conversation, 200);
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id)->delete();
        return response()->json("Deleted Successfully", 204);
    }
}
