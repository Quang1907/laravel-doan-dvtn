<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver( 'google' )->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended( '/' );

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => hash( "sha256" , 1111111 ),
                    'birthday' => Carbon::now()->toDateString(),
                    'address' => "null",
                    'phonenumber' => "null",
                    'google_id'=> $user->id,
                ]);

                Auth::login($newUser);

                return redirect()->intended( '/' );
            }

        } catch ( Exception $e ) {
            dd($e->getMessage());
        }
    }
}
