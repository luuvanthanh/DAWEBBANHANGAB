<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.user.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        dd($data);
    }
}
