<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;

class rateController extends Controller
{
    public function postScore(Request $request) 
    {
        $blogId = $request->idBlog;
        $scores = $request->Values;
        $userId = $request->idUser;
        $checkUser = Rate::where('user_id', $userId)->first();
        $checkBlog = Rate::where('blog_id', $blogId)->first();
        if ($checkUser == null) {
            Rate::create([
                'scores' => $scores,
                'blog_id' => $blogId,
                'user_id' => $userId,
            ]);
            
            return response()->json([
                'success' => 'Add Rate success',
            ]);
        }else {
            if ($checkBlog == null) {
                Rate::create([
                    'scores' => $scores,
                    'blog_id' => $blogId,
                    'user_id' => $userId,
                ]);
                
                return response()->json([
                    'success' => 'Add Rate success',
                ]);
            }else {
                return response()->json([
                    'mesage' => 'Bạn đã đánh giá',
                ]);
            }
        }
        
    }
}
