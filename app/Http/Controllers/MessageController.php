<?php

namespace App\Http\Controllers;

use App\Events\conversationMessages;
use App\Events\MessageSent;
use App\Message;
use App\Conversation;
use Illuminate\Http\Request;
use App\Attachment;
class MessageController extends Controller
{
    public function read($id)
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

    public function store(Request $request, $id)
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

        if($request->hasFile('attachment')) {
                $attatch = $request->file('attachment');
                $attachment = Attachment::create([
                'attachment' => $attatch->store('attachments', ['disk' => 'public']),
                'conversation_id' => $conversation->id,
                'message_id' => $message->id,
            ]);
        }
        if($message){
            event(new MessageSent(1,$id));
        }
    }

    public function show()
    {
        return view('chatBoard');
    }
}



