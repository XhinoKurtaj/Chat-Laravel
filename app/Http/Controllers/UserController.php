<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use App\User;
use App\Conversation;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('profile', array('user' => Auth::user()) );
    }

    public function delete()
    {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        if ($user->delete())
        {
            return redirect()->route('login');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);
        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name'));

        return redirect()->back();
    }

    public function admin()
    {
        return view('admin');
    }

    public function index()
    {
        $conversationList = Conversation::all();
        $userList = User::all();
        return View("admin", compact('userList','conversationList'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('userProfile',compact('$user'));
    }

}
