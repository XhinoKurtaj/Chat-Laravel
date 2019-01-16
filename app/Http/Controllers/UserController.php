<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use App\User;

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

//    public function update_avatar(Request $request)
//    {
//        if($request->hasFile('avatar'))
//        {
//            $avatar = $request->file('avatar');
//            $filename = time() . '.' . $avatar->getClientOriginalExtension();
////            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
//            Image::make($avatar)->resize(300, 300)->save( storage_path('app/public/images/'.$filename) );
//            $user = Auth::user();
//            $user->photo = $filename;
//            $user->save();
//        }
//        return view('profile', array('user' => Auth::user()) );
//    }

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


}
