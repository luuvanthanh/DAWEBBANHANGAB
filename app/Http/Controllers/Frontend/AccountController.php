<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    public function getAccount()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $id = Auth::user()->id;
        $user = User::find($id);
        // dd($user);
        return view('frontend.user.update', compact('user', 'countries'));
    }

    public function postAccount(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $data = $request->all();
        $file = $request->avatar;
        $thumbnailOld = $user->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }else{
            $data['avatar'] = Auth::user()->avatar;
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']); // mã hóa pass nếu nhập mới
        }else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/avatar', $file->getClientOriginalName());
            }
            if (File::exists(public_path($thumbnailOld))) {
                File::delete(public_path($thumbnailOld));
                
            }
            $user->update([
                $user->name = $data['name'],
                $user->email = $data['email'],
                $user->level = 0,
                $user->password = $data['password'],
                $user->phone = $data['phone'],
                $user->address = $data['address'],
                $user->country_id = $data['country_id'],
                $user->avatar = $data['avatar'],
            ]);

            return redirect()->back()->with('success', 'upload profile success');
        }else {

            return redirect()->back()->with('error', 'upload profile error');
        }
        

    }
}
