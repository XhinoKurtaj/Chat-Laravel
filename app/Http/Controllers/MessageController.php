<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Conversation;
use Illuminate\Http\Request;
use App\Attachment;
use App\User;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read($id)
    {
        $messageList = Message::where('conversation_id',$id)
            ->with('attachment', 'sender.photos')
            ->orderBy('id', 'asc')
            ->paginate();
        return response()->json($messageList);
    }

    public function store(Request $request, $id)
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
    }

    public function show($id)
    {
        $user = auth()->user()->id;
        $type = auth()->user()->type;
        $conversation = Conversation::findOrFail($id);
        $belongs = $conversation->users->contains($user);
        if($belongs || $type == "admin")
            return view('chatBoard');
        else
           return redirect()->back();
    }

    public function delete($conversationId,$messageId)
    {
        $message = Message::find($messageId)
                   ->delete();
        return back();
    }
}
