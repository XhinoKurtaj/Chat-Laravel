<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Photo;
use App\Message;
use App\Events\UserNotification;
use Yajra\Datatables\Datatables;
use DB;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select([DB::raw("CONCAT(id,'/',first_name,' ',last_name) AS name"),'email',]);
        return Datatables::of($users)->make();
    }
    
    public function create()
    {
        return view('data');
    }

    public function conversationData()
    {
        return view('ConversationsData');
    }

    public function indexConversationData()
    {
        $conversation = Conversation::select([DB::raw("CONCAT(id,'/',custom_name) AS name")]);
        return Datatables::of($conversation)->make();
    }

    public function photoData()
    {
        return view('PhotosData');
    }

    public function indexPhotoData()
    {
        $photo = Photo::select([DB::raw("CONCAT(id,'/',photo) AS photo")]);
        return Datatables::of($photo)->make();
    }

    public function messageData()
    {
        return view('MessagesData');
    }

    public function indexMessageData()
    {
        $message = Message::select([DB::raw("CONCAT(id,'/',message) AS message")]);
        return Datatables::of($message)->make();
    }

    public function attachmentData()
    {
        return view('AttachmentData');
    }

    public function indexAttachmentsData()
    {
        $attachment = Attachment::select([DB::raw("CONCAT(id,'/',attachment) AS attachment")]);
        return Datatables::of($attachment)->make();
    }

    public function inviteUser(Request $request, $id)
    {
        $member = $request->get('member');
        if($member != null)
        {
            $search = DB::table('users')->where('email',$member)->pluck('id');
            if(empty($search[0])){
                return response()->json("we couldn't find $member");
            }else {
                $user = User::find($search[0]);
                $exist = $user->conversations()->where('id', $id)->exists();
                if ($exist) {
                    return response()->json("$member already exist in this conversation");
                }
                $conversation = Conversation::find($id);
                $conversation->users()->attach($user->id);

                event(new UserNotification($id, $user->fullName, 'join'));
                return response()->json("User <strong>$member </strong> added successfully");
            }
        }
    }
}
