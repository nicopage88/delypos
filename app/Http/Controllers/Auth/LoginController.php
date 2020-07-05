<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;


class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['only'=>'showLogin']);
    }

    public function showLoginForm(){
        
                if (auth::check()) {
                    return redirect()->to('dashboard');
                }else{
                    return view('auth.login');
                }
    }

    public function login(){

        $credentials = $this->validate(request(), [
            'email'=>'required|email|string',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard'); 
        }
        return back()->withErrors(['email'=>'Estas credenciales no concuerdan con nuestra Base de Datos'])
        ->withInput(request(['email']));
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
