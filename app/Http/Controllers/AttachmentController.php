<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function index($id)
    {
        $attachments = Attachment::where('conversation_id',$id)->get();
        return response()->json($attachments);
    }

    public function download($name)
    {
        return Storage::download('attachments', $name);
    }


    public function store(Request $request,$id)
    {
        if($request->hasFile('file')) {
            $attatch = $request->file('file');
            $attachment = Attachment::create([
                'attachment' => $attatch->store('attachments', ['disk' => 'public']),
                'conversation_id' => $conversation->id,
            ]);
        }
    }
}
