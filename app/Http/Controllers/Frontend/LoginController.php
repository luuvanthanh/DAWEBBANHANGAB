<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('frontend.user.login');
    }

    public function postLogin(Request $request)
    {
       $email = $request->email;
       $password = $request->password;
       $remember = $request->remember; 
       dd($email, $password, $remember);
    }
}
