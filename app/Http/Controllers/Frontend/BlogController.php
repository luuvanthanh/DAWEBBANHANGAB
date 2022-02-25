<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
// use App\Models\Comment;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(config('app.paginate_blog'));

        return view('frontend.blog.list', compact('blogs'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::find($id);
        $rateTBC = Rate::where('blog_id', $id)->avg('scores');
        $rateTBC = round($rateTBC);

        // get comment with id blog theo bình luận mới nhất.
        $getBlogDetail = Blog::with(['comment' => function ($q) {
            $q->where('level', 0)->orderBy('id', 'desc');
        }])->find($id)->toArray();
 
        
        // Viết cách này có thể kiểm tra điều kiện cho comment
        $getCommentChild = Blog::with(['comment' => function ($q) {
            $q->where('level', '<>', 0)->orderBy('id', 'desc');
        }])->find($id)->toArray();

        // get previous user id
        $previous = Blog::where('id', '<', $blog->id)->max('id');
        // get next user id
        $next = Blog::where('id', '>', $blog->id)->min('id');
        
        return view('frontend.blog.single', compact('blog', 'previous', 'next', 'rateTBC', 'getBlogDetail', 'getCommentChild'));
    }
}
