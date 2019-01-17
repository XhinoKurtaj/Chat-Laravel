<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Socialite;

class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
    }
//    public function handleProviderCallback(Request $request)
//    {
//        try {
//            $user = Socialite::driver('facebook')->user();
//        } catch (Exception $e) {
//            echo ($e);
//            return redirect('login/facebook');
//        }
//
//        $authUser = $this->findOrCreateUser($user);
//
//        Auth::login($authUser, true);
//
//        return redirect()->route('home');
//    }
//
//    private function findOrCreateUser($facebookUser)
//    {
//        $authUser = User::where('facebook_id', $facebookUser->id)->first();
//
//        if ($authUser){
//            return $authUser;
//        }
//
//        return User::create([
//            'first_name' => $facebookUser->name,
//            'email' => $facebookUser->email,
//            'facebook_id' => $facebookUser->id,
//            'avatar' => $facebookUser->avatar
//        ]);
//    }
}
