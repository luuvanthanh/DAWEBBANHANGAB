<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\Country;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    public function getCheckout()
    {
        $countries = Country::all();

        return view('frontend.checkout.checkout', compact('countries'));
    }

    public function sendMail(Request $request)
    {
        $total = 0;
        $data = array_values(session()->get('cart'));
        foreach ($data as $key => $item) {
            $total += $item['price'];
        }
        $id = Auth::user()->id;
        $user = User::find($id);
        $history = History::create([
            'email' => $user->email,
            'phone' => $user->phone,
            'name' => $user->name,
            'user_id' => $id,
            'price' => $total,
        ]);
        if ($history) {
            SendMail::dispatch();

            return response()->json([
                'success' => 'Bạn đã đặt hàng thành công',
            ]);
        }else {
            return response()->json([
                'error' => 'Bạn đã đặt hàng thất bại',
            ]);
        }
    }
}
