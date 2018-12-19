<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        /////////////////////////////////////
        $x = new Conversation;
        $x->roles();
        dd($x);
        ///////////////////////////////////////////
        return view('CreateConversation');
    }

    public function store(Request $request)
    {
        $conv = new Conversation([
            'custom_name' => $request->post('conv')
            ]);
        $conv->save();
         return redirect('test')->with('success', 'Conv added successfuly');
    }
}
