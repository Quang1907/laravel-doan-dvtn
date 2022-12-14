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

            if( $finduser ){

                Auth::login($finduser);

                return redirect()->intended( '/' );

            }else{
                $newUser = User::where("email", $user->email)->first();
                if ( $newUser ) {
                    $newUser->update( ["google_id" => $user->id]);
                }else{
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        "is_active" => true,
                        "email_verified_at" => now()->toDateTimeString(),
                    ]);
                }

                Auth::login($newUser);

                if ( !empty( $newUser->address ) && !empty( $newUser->phonenumber ) && !empty( $newUser->password ) ) {
                    return redirect("/");
                }

                return redirect()->intended( 'account/confirm' );
            }

        } catch ( Exception $e ) {
            dd($e->getMessage());
        }
    }
}
