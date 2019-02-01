<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Events\UserNotification;
use Yajra\Datatables\Datatables;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return Datatables::of(User::query())->make(true);
    }
    
    public function create()
    {
        return view('data');
    }
}
