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

    public function handleProviderCallback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('login/facebook');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect()->route('conversation.list');
    }

    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        $user = new User();
        $user->fill([
            'first_name' => $facebookUser->name,
            'last_name' => ' ',
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'photo' => $facebookUser->avatar
        ]);
        $user->password =' ' ;
        $user->save();
        return $user;
    }
}
