<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
         // get previous user id
        $previous = Blog::where('id', '<', $blog->id)->max('id');
        // get next user id
        $next = Blog::where('id', '>', $blog->id)->min('id');
        
        return view('frontend.blog.single', compact('blog', 'previous', 'next'));
    }
}
