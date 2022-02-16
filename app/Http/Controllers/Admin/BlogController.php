<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\storeBlogRequest;
use App\Http\Requests\Blog\updateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(config('app.paginate_blog'));

        return view('admin.blog.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeBlogRequest $request)
    {
        $file = $request->image;
        $blog = Blog::create([
            'title' => $request->title,
            'image' => $file->getClientOriginalName(),
            'description' => $request->description,
            'content' => $request->content,
        ]);
        if (!empty($file)) {
            $file->move('upload/blog', $file->getClientOriginalName());
        }
        
        return redirect()->route('blog.index')->with('success', 'Add blog success');
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
        $blog = Blog::find($id);

        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateBlogRequest $request, $id)
    {
        $file = $request->image;
        $data = $request->all();
        $blog = Blog::findOrFail($id);
        $thumbnailOld = $blog->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName(); // lấy tên file
        }else{
            $data['image'] = $blog->image;
        }
        $updateBlog = $blog->update([
            $blog->title = $data['title'],
            $blog->image = $data['image'],
            $blog->description = $data['description'],
            $blog->content = $data['content'],
        ]);
        if (!empty($file)) {
            $file->move('upload/blog', $file->getClientOriginalName());
        }
        if (File::exists(public_path($thumbnailOld))) {
            File::delete(public_path($thumbnailOld));
            
        }
        
        return redirect()->route('blog.index')->with('success', 'Update blog success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Delete blog success');
    }
}
