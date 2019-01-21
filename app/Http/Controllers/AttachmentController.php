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
        $attachments = Attachment::where('conversation_id',$id)->get();
        return response()->json($attachments);
    }

    public function download($id,$attachmentId)
    {
        $attachment = Attachment::findOrFail($attachmentId);
        $name = $attachment->attachment;
        $attach = str_replace("attachments/","",$name);
        $path = storage_path($attach);
        Storage::download('public\attachments',$attach);

       return redirect()->back();

//        $attachment = Attachment::findOrFail($attachmentId);
//        $name = $attachment->attachment;
//        $attach = str_replace("attachments/"," ",$name);
//        $path = storage_path($attach);
//        Storage::download('public\attachments',$attach);
//
//       return redirect()->back();
//
//        $file_path = storage_path("attachments\.$attach");
//        return Response::download($file_path);
//        Storage::download($file_path);
//        return redirect()->back();
    }
}
