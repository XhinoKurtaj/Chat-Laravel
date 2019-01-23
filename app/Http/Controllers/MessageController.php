<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Conversation;
use Illuminate\Http\Request;
use App\Attachment;
use App\User;
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
            ->orderBy('id', 'desc')
            ->paginate();
        return response()->json($messageList);
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
            $attach = $request->file('attachment');
            $attachment = Attachment::create([
                'attachment' => $attach->store('attachments', ['disk' => 'public']),
                'conversation_id' => $conversation->id,
                'message_id' => $message->id,
            ]);
        }

        if($message){
            event(new MessageSent(1,$id));
        }
        return redirect()->back();
    }

    public function show($id)
    {
        return view('chatBoard');
    }
}



