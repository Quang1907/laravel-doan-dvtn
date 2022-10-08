<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        try {

            $user = Socialite::driver( 'github' )->user();

            $searchUser = User::where( 'github_id', $user->id )->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect( '/' );

            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    "is_active" => true,
                    "email_verified_at" => now()->toDateTimeString(),
                ]);

                Auth::login($gitUser);

                return redirect( 'account/confirm' );
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
