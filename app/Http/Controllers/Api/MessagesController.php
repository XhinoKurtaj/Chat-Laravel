<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\Conversation;
use App\Events\MessageSent;
class MessagesController extends Controller
{
    public function index($id)
    {
        $messageList = Message::where('conversation_id',$id)
            ->with('attachment', 'sender.photos')
            ->orderBy('id', 'desc')
            ->paginate();
        return response()->json($messageList);
    }

    public function store(Request $request,$id)
    {
        $this->validate($request, [
            'message'   => 'required|min:1|max:255'
        ]);
        $conversation = Conversation::findOrFail($id);
        $user = auth()->user();
        $message = Message::create([
            'message' => $request->get('message'),
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
        ]);
        if($request->hasFile('attachment')) {
            $attachment = new AttachmentController();
            $attachment->store($conversation->id,$message->id,$request);
        }
            event(new MessageSent(1,$id));
        return response(200);
    }

    public function delete($conversationId,$messageId)
    {
        $message = Message::find($messageId)
            ->delete();
        return response()->json(['Message deleted successfully!'], 204);
    }
}
