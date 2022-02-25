<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $idBlog = $request->idBlog;
        $idUser = Auth::user()->id;
        $comment = $request->comment;
        $nameUser = Auth::user()->name;
        $avatarUser = Auth::user()->avatar;
        $level = 0;
        try {
            Comment::create([
                'content' => $comment,
                'blog_id' => $idBlog,
                'user_id' => $idUser,
                'avatar' => $avatarUser,
                'name' => $nameUser,
                'level' => $level,
            ]);

            return back()->with('success', 'Add comment success');
        } catch (\Exception $err) {

            return back()->with('error', 'Add comment fail');
        }
    }

    public function postCommentChild(Request $request)
    {
        $idComment = $request->idComment;
        $idBlog = $request->idBlog;
        $comment = $request->comment;
        $idUser = Auth::user() ? Auth::user()->id : '';
        $nameUser = Auth::user() ? Auth::user()->name : '';
        $avatarUser = Auth::user() ? Auth::user()->avatar : '';
        if ($idUser != '') {
            try {
                Comment::create([
                    'content' => $comment,
                    'blog_id' => $idBlog,
                    'user_id' => $idUser,
                    'avatar' => $avatarUser,
                    'name' => $nameUser,
                    'level' => $idComment,
                ]);
    
                return back()->with('success', 'Add comment child success');
            } catch (\Exception $err) {
    
                return back()->with('error', 'Add comment child fail');
            }
        }else{
            return back()->with('error', 'Vui lòng đăng nhập');
        }
        
    }
}
