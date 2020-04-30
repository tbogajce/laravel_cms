@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>

    <hr>

    {{--display flash message if there is one in session--}}
    @if(\Illuminate\Support\Facades\Session::has('comment_message'))
        {{session('comment_message')}}
    @endif

    <!-- Blog Comments -->
    @if(\Illuminate\Support\Facades\Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
        {{--add hidden input because we need to send post_id to the controller via request--}}
        <input type="hidden" name="post_id" value="{{$post->id}}">

        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    @endif



    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="">
                    <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>

                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                    @if(count($comment->replies) > 0)
                        @foreach($comment->replies as $reply)
                            @if($reply->is_active == 1)
                                <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        <p>{{$reply->body}}</p>
                                    </div>
                                </div>
                                <!-- End Nested Comment -->
                            @endif
                        @endforeach
                    @endif

                    <div class="comment-reply-container">

                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                        {{--add hidden input because we need to send post_id to the controller via request--}}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                        <div class="form-group">
                            {!! Form::label('body', 'Body:') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Reply to comment', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('sidebar')

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

@endsection

@section('scripts')
    <script>
        $(".toggle-reply").click(function () {
            $(".comment-reply-container").slideToggle("slow");
        });
    </script>
@endsection
