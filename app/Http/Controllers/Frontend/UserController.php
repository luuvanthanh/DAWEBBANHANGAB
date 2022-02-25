<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\storeUserRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('frontend.user.register', compact('countries'));
    }

    public function register(storeUserRequest $request)
    {
        $avatar = null;
        $file = $request->avatar;
        if (!empty($file)) {
            $avatar = $file->getClientOriginalName();
        }else{
            $avatar = null;
        }
        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'level' => 0,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'avatar' => $avatar
        ];
        if ($request->password == $request->password_confirmation) {
            $user = User::create($dataInsert);
            if (!empty($file)) {
                $file->move('upload/avatar', $file->getClientOriginalName());
            }
            // session(['email' => $request->email, 'password' => $request->password]);

            return redirect()->route('getLogin')->with('success', 'Register user success');
        } else {

            return redirect()->back()->with('error', 'Register user fail');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('getLogin')->with('success', 'Logout success');
    }
}
