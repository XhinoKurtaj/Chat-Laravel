<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

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
}
