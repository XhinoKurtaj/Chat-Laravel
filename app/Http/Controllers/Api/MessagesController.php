<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
class MessagesController extends Controller
{
    public function show($id)
    {
        $sender = array();
        $messageList = Message::where('conversation_id',$id)->get();
        foreach ($messageList as $messages)
        {
            $messages->sender;
            $sender[]=$messages;
        }
        return response()->json($sender);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message'   => 'required|min:1|max:191'
        ]);
        $conversation = Conversation::findOrFail($id);
        $user = auth()->user();
        $message = Message::create([
            'message' => $request->get('message'),
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
        ]);
        if($message){
            event(new MessageSent(1,$id));
        }
    }
}
