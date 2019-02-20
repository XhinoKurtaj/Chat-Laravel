<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Message;
class CommentController extends Controller
{
    public function store($id,Request $request,$commentableId)
    {
        $authorId = auth()->user()->id;
        $message = Message::find($commentableId);
        $comment = $message->comments()->create([
            'body' => $request->get('comment'),
            'user_id' => $authorId
        ]);
    }

    public function messageComments($conversationID,$messageId)
    {
        $commentList = Comment::where('commentable_id',$messageId)
                        ->with('user')
                        ->get();
        return response()->json($commentList);
    }
}
