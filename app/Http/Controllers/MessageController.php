<?php

namespace App\Http\Controllers;

use App\Events\conversationMessages;
use App\Message;
use App\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function read($id)
    {
        $sender = array();
        $messageList = Message::where('conversation_id',$id)->get();
        foreach ($messageList as $messages){
            $messages->sender;
            $sender[]=$messages;
        }
         return event(new conversationMessages($sender,$id));
//        return response()->json($sender);
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
//        return ['status' => 'Message Sent!'];
        return redirect()->back();
    }

    public function show()
    {
        return view('chatBoard');
    }
}



//public function store(Request $request, $id)
//{
//    $this->validate($request, [
//        'message'   => 'required|min:1|max:191'
//    ]);
//    $conversation = Conversation::findOrFail($id);
//    $user = auth()->user();
//    $message = Message::create([
//        'message' => $request->get('message'),
//        'conversation_id' => $conversation->id,
//        'sender_id' => $user->id,
//        'attachment' => $request->file('attachment'),
//    ]);
//    if($request->hasFile('attachment'))
//    {
//        $attatch = $request->file('attachment');
//        $attachment = Attachment::create([
//            'attachment' => $attatch->store('attachments', ['disk' => 'public']),
//            'conversation_id' => $conversation->id,
//            'message_id' => $message->id,
//        ]);
//    }
//    return redirect()->back();
//}
