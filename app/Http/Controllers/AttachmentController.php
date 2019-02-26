<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class AttachmentController extends Controller
{
    public function index($id)
    {
        $attachments = Attachment::where('conversation_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($attachments);
    }

    public function download($id, $attachmentId)
    {
        $attachment = Attachment::findOrFail($attachmentId);
        $name = $attachment->attachment;
        $attach = str_replace("attachments/", "", $name);
        return response()->download(public_path("/storage/attachments/$attach"));
    }

    public function store($conversationId, $messageId, $request)
    {
        $attach = $request->file('attachment');
        $attachment = Attachment::create([
            'attachment' => $attach->store('attachments', ['disk' => 'public']),
            'conversation_id' => $conversationId,
            'message_id' => $messageId,
        ]);
    }

    public function attachmentDetails($id)
    {
        $check = Attachment::find($id);
        if ($check) {
            $attachmentDetails = Attachment::where('id', $id)
                ->with('conversation', 'message', 'message.sender')
                ->get();
            return view('AttachmentView', compact('attachmentDetails'));
        } else {
            return back();
        }
    }
}
