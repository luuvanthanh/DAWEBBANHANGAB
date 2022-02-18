@extends('frontend.layouts.master')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        @if (!empty($blogs))
        @foreach ($blogs as $blog)
        <div class="single-blog-post">
            <h3>{{ $blog->title }}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
                <img src="../../upload/blog/{{ $blog->image }}" alt="">
            </a>
            <p>{{ $blog->description }}</p>
            <a  class="btn btn-primary" href="{{ route('blogSingle', $blog->id) }}">Read More</a>
        </div>
        @endforeach
        @endif
        <div class="pagination-area">
            {!! $blogs->links() !!}
        </div>
    </div>
</div>    
@endsection