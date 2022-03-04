<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('frontend.layouts.master')
@section('content')
<div class="col-sm-9">
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
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
                <img src="../../../upload/blog/{{ $blog->image }}" alt="">
            </a>
            <p>
                {{ $blog->description }}
            <div class="pager-area">
                <ul class="pager pull-right">
                    @if ($previous)
                    <li><a href="{{ route('blogSingle', $previous) }}">Pre</a></li>
                    @endif
                    @if ($next)
                    <li><a href="{{ route('blogSingle', $next) }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div><!--/blog-post-area-->

    <div class="rating-area">
        <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li>
                <div class="rate">
                    <div class="vote">
                        @for($i = 1; $i<= 5; $i++)
                            <div class="star_{{$i}} ratings_stars {{ $i <= $rateTBC ? "ratings_over" : "" }}"><input value="{{ $i }}" type="hidden"></div>
                        @endfor
                        {{-- <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div> --}}
                        <span class="rate-np">{{ $rateTBC }}</span>
                    </div> 
                </div>
                {{-- <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star color"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i> --}}
            </li>
            {{-- <li class="color">(6 votes)</li> --}}
        </ul>
        <ul class="tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    <p style="color: red;font-size: 20px;width: 200px;heigth: 200px;padding: 3px;" id="notification"></p>
    </div><!--/rating-area-->
    <div id="successMessage"> </div>


    <!-- Comment -->
    <div class="media commnets">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{ asset('frontend/images/blog/man-one.jpg') }}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Annie Davis</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="blog-socials">
                <ul>
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                </ul>
                <a class="btn btn-primary" href="">Other Posts</a>
            </div>
        </div>
    </div><!--Comments-->
    <div class="response-area">
        <h2>3 RESPONSES</h2>
        <ul class="media-list">
            @if (!empty($getBlogDetail['comment']))
                @foreach ($getBlogDetail['comment'] as $cmt)
                    <li class="media display-child-comment">
                        <a class="pull-left" href="#">
                            <img style="width: 100px; height: 100px" class="media-object" src="../../../upload/avatar/{{ $cmt['avatar'] }}" alt="avatar">
                        </a>
                        <div class="media-body">
                            <ul class="sinlge-post-meta">
                                <li><i class="fa fa-user"></i>{{ $cmt['name'] }}</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <p>{{ $cmt['content'] }}</p>
                            <a id="comment-child" class="btn btn-primary"><i class="fa fa-reply"></i>Replay</a>
                        </div>
                        <div style="margin: 30px;" class="row comment-child">
                            <form action="{{ route('commentchild') }}" method="POST">
                                @csrf
                                <div class="col-sm-8">
                                    <input type="hidden" name="idComment" value="{{ $cmt['id'] }}">
                                    <input type="hidden" name="idBlog" value="{{ $blog->id }}">
                                    <textarea id="content-comment-child" name="comment" rows="5"></textarea>
                                    <div id="message-child"> </div>
                                    <button type="submit" id="post-comment-child" class="btn btn-primary">post comment child</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    @if (!empty($getCommentChild['comment']))
                    @foreach ($getCommentChild['comment'] as $cmtChild)
                        @if ($cmtChild['level'] == $cmt['id'])
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img style="width: 100px; height: 100px" class="media-object" src="../../../upload/avatar/{{ $cmtChild['avatar'] }}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>{{ $cmtChild['name'] }}</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <input type="hidden" name="idComment" value="{{ $cmtChild['id'] }}">
                                    <input type="hidden" name="idBlog" value="{{ $blog->id }}">
                                    <p>{{ $cmtChild['content'] }}</p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li> 
                        @endif
                    @endforeach
                @endif   
                @endforeach
            @endif
            {{-- <li class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{ asset('frontend/images/blog/man-four.jpg') }}" alt="">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                </div>
            </li> --}}
        </ul>					
    </div><!--/Response-area-->
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-8">
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <form action="{{ route('postComment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="idBlog" value="{{ $blog->id }}">
                        <textarea id="content-comment" class="content-cmt" name="comment" rows="11"></textarea>
                        <p style="color: red;font-size: 20px;width: 200px;heigth: 200px;padding: 3px;" id="notification-cmt"></p>
                        <button type="submit" id="post-comment" class="btn btn-primary">post comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/Repaly Box-->
</div>
<div id="message"> </div>
{{-- @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
@endif --}}
@endsection
<script>
$(document).ready(function(){
    //vote
    $('.ratings_stars').hover(
        // Handles the mouseover
        function() {
            $(this).prevAll().andSelf().addClass('ratings_hover');
            // $(this).nextAll().removeClass('ratings_vote'); 
        },
        function() {
            $(this).prevAll().andSelf().removeClass('ratings_hover');
            // set_votes($(this).parent());
        }
    );

    $('.ratings_stars').click(function(){
        var Values =  $(this).find("input").val();
        var checkLogin = "{{ Auth::check() }}";
        var idBlog = "{{ $blog->id }}";
        var idUser = "{{ Auth::user() ? Auth::user()->id : null }}";
        if (checkLogin) {
            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
                $(".rate-np").text(Values);
            } else {
                $(this).prevAll().andSelf().addClass('ratings_over');
                $(".rate-np").text(Values);
            }
            $.ajax({
                url:"{{ route('checkLogin') }}",    
                method:"POST", 
                data: {
                    idBlog: idBlog,
                    Values: Values,
                    idUser: idUser
                },
                success:function(response){
                    if (response.success) {
                        $("#successMessage").html(response.success);
                    }else {
                        $("#successMessage").html(response.mesage);
                    }
                },
            })
        }else{
            $('.ratings_stars').removeClass('ratings_over');
            $("#notification").text('Vui lòng đăng nhập');
            window.location = "{{ route('getLogin') }}";
        }
    });

    // Xử lý login khi comment
    $("#content-comment").click(function(){
        let checkLogin = "{{ Auth::check() }}";
        if (!checkLogin) {
            $("#notification-cmt").text('Vui lòng đăng nhập');
        }
    });

    // xử lý comment
    $("#post-comment").click(function(){
        if (!checkLogin) {
            $("#notification-cmt").text('Vui lòng đăng nhập');
        }
    });
    // $("#post-comment").click(function(){
    //     let idBlog = "{{ $blog->id }}";
    //     let idUser = "{{ Auth::user() ? Auth::user()->id : null }}";
    //     let comment = $(".content-cmt").val();
    //     let nameUser = "{{ Auth::user() ? Auth::user()->name : null }}";
    //     let avatarUser = "{{ Auth::user() ? Auth::user()->avatar : null }}";
    //     let checkLogin = "{{ Auth::check() }}";
    //     if (checkLogin) {
            // $.ajax({
            // url: "{{ route('postComment') }}",
            // method: "POST",
            // data: {
            //     idBlog: idBlog,
            //     idUser: idUser,
            //     comment: comment,
            //     nameUser: nameUser,
            //     avatarUser: avatarUser,
            // },
            // success:function(response){
            //     if (response.success) {
            //         $("#message").html(response.success);
            //         location.reload();
            //     }else {
            //         $("#message").html(response.mesage);
            //     }
            // },
            // });
    //     }else {
    //         $("#notification-cmt").text('Vui lòng đăng nhập');
    //     }
    // });

    // comment child
    $("textarea#content-comment-child").hide();
    $("button#post-comment-child").hide();
    $("a#comment-child").click(function(){
        $(this).closest("li.display-child-comment").find("#content-comment-child").show();
        $(this).closest("li.display-child-comment").find("#post-comment-child").show();
        let checkLogin = "{{ Auth::check() }}";
        if (!checkLogin) {
            $("#notification-cmt").text('Vui lòng đăng nhập');
        }
    });

    $("textarea#content-comment-child").click(function(){
        let checkLogin = "{{ Auth::check() }}";
        if (!checkLogin) {
            $("#message-child").text('Vui lòng đăng nhập');
        }
    })
    $("button#post-comment-child").click(function(e){
        let checkLogin = "{{ Auth::check() }}";
        if (!checkLogin) {
            e.preventdefault();
            $("#message-child").text('Vui lòng đăng nhập');
        }
    })
    // $("a#comment-child").click(function(){
    //     let idComment = $(this).closest("li .media-body").find("input").val();
    //     $(this).closest("li.display-child-comment").find("#content-comment-child").show();
    //     $(this).closest("li.display-child-comment").find("#post-comment-child").show();
    //     let idUser = "{{ Auth::user() ? Auth::user()->id : null }}";
    //     let comment = $(this).closest("li.display-child-comment").find("textarea#content-comment-child").val();
    //     let nameUser = "{{ Auth::user() ? Auth::user()->name : null }}";
    //     let avatarUser = "{{ Auth::user() ? Auth::user()->avatar : null }}";
    //     let idBlog = "{{ $blog->id }}";
    //     let checkLogin = "{{ Auth::check() }}";
    //     if (checkLogin) {
    //         $(this).closest("li.display-child-comment").find("#post-comment-child").click(function(){
    //             alert(comment);
    //             $.ajax({
    //                 url: "{{ route('commentchild') }}",
    //                 method: "POST",
    //                 data: {
    //                     idComment: idComment,
    //                     idUser: idUser,
    //                     comment: comment,
    //                     avatarUser: avatarUser,
    //                     nameUser: nameUser,
    //                     idBlog: idBlog
    //                 },
    //                 success:function(response){
                    
    //                 },
    //             })
    //         });
    //     }else {
    //         $("#notification-cmt").text('Vui lòng đăng nhập');
    //     }
    // });
});
</script>