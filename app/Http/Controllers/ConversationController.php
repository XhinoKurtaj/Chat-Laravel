<?php

namespace App\Http\Controllers;


use DemeterChain\C;
use Illuminate\Http\Request;
use App\Conversation;
use App\User;
class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $conversationId = Conversation::insertGetId([
            'custom_name' => $request->post('conv')
            ]);
        $user = User::find($userId);
        $user->conversations()->attach($conversationId);

         return redirect('home');
    }

    public function read()
    {
        $user = auth()->user();
        $conversationList = $user->conversations;
        return View("home", compact('conversationList'));
    }

    public function conversationMembers($id)
    {
        $conversation = Conversation::findOrFail($id);
        $memberList = $conversation->users;
        return response()->json($memberList);
    }

    public function delete($id)
    {
        $conversation = Conversation::find($id)->delete();
        return back();
    }
}
