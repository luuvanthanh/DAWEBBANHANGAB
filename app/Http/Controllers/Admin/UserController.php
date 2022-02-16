<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateUserRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $countries = Country::all();

        return view('admin.user.update-user', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRequest $request, $id)
    {
        
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $data = $request->all();
        $file = $request->avatar;
        $thumbnailOld = $user->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName(); // lấy tên file
        }else{
            $data['avatar'] = $user->avatar;
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']); // mã hóa pass nếu nhập mới
        }else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user', $file->getClientOriginalName());
            }
            if (File::exists(public_path($thumbnailOld))) {
                File::delete(public_path($thumbnailOld));
                
            }
            $user->update([
                $user->name = $data['name'],
                $user->email  = $data['email'],
                $user->password = $data['password'],
                $user->phone = $data['phone'],
                $user->address = $data['address'],
                $user->country_id = $data['id_country'],
                $user->avatar = $data['avatar'],
            ]);

            return redirect()->back()->with('success', 'upload profile success');
        }else {

            return redirect()->back()->with('error', 'upload profile error');
        }
        // câu hỏi
        // tại sao khi em bỏ trống ô phone thì nó ko update được
        // nếu người ta ko nhập password thì nó sẽ lấy cái pass bị mã hóa thì sao người dùng 
        // biết mà nhập vô.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
