<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use User;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile', array('user' => Auth::user()) );
    }

    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
//            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            Image::make($avatar)->resize(300, 300)->save( storage_path('app/public/images/'.$filename) );
            $user = Auth::user();
            $user->photo = $filename;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()) );
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' =>  $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/profile')->with('success','User updated successfully');
    }
}
