<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Conversation;
use Illuminate\Http\Request;
use App\Attachment;
use App\User;
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

        if($message){
            event(new MessageSent(1,$id));
        }
    }

    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);
        $belongsTo = $conversation->users;
        if($belongsTo)
            return view('chatBoard');
        else
            return back();

    }
}



