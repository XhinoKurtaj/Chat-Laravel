<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Events\UserNotification;
use Datatables;
class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Datatables::of(User::query())->make(true);
    }
    
    public function create()
    {
        return view('displaydata');
    }
}
