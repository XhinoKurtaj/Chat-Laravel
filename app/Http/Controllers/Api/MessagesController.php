<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\Conversation;
use App\Attachment;
use App\Events\MessageSent;
class MessagesController extends Controller
{
    public function show($id)
    {
        $sender = array();
        $messageList = Message::where('conversation_id',$id)->get();
        foreach ($messageList as $messages)
        {
            $id = $messages->id;
            $x = Attachment::where('message_id',$id)->get();
            $messages->sender;
            $messages->attachment = $x;
            $sender[]=$messages;
        }
        return response()->json($sender);
    }

    public function store(Request $request,$id)
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
            return response("Message was sent successfully",200);
        }
    }
}
