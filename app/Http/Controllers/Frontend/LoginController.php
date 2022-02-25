<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\postLoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index() {
        return view('frontend.user.login');
    }

    public function postLogin(postLoginRequest $request)
    {
       $remember = false; 
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];
        if ($request->remember) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {

           return redirect('/')->with('success', 'Login success');
        }else{

           return redirect()->back()->with('error', 'Login fail');
        }
    }


}
