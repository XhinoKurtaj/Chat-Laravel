<?php

namespace App\Http\Controllers;

use App\Message;
use App\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
    }

    public function read($id)
    {
        $messageList = Message::where('conversation_id',$id)->get();
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
        return redirect()->back();
//        return response()->json($message);
    }

    public function show()
    {
        return view('chatBoard');
    }

}
