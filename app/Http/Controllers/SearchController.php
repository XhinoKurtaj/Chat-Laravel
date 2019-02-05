<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Events\UserNotification;
use Yajra\Datatables\Datatables;
use DB;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::select([DB::raw("CONCAT(id,' ',first_name,' ',last_name) AS name"),'email',]);
        return Datatables::of($users)->make();
//        return Datatables::of(User::query())->make(true);
    }
    
    public function create()
    {
        return view('data');
    }
}
