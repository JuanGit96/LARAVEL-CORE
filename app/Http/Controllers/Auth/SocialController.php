<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {  
        try{
            $user = Socialite::driver($provider)->user();
            //dd($user->email);
            /*Crea usuario si no existe */
            $createUser = User::firstOrCreate([
               'email' =>$user->getEmail()
            ],
            [
                'name' =>$user->getName(),
                'password' => bcrypt('null123456*')
            ]);

        }catch(\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
        }

        /*Inicio sesion */
        auth()->login($createUser);
        
        //return $user->getAvatar();
        //return $user->name;

        return redirect('/home')->with('alert', "Bienvenido $createUser->name");
        //return redirect('/home')->with('status', "Bienvenido $createUser->name");
    }
}
