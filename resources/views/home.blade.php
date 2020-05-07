@extends('layouts.blog-home')

@section('content')
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- First Blog Post -->

            @if($posts)
                @foreach($posts as $post)
                    <h2>
                        {{$post->title}}
                    </h2>
                    <p class="lead">
                        by <a href="#">{{$post->user->name}}</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
                    <hr>
                    <img class="img-responsive" src="{{$post->photo->file}}" alt="">
                    <hr>
                    <p>{{ \Illuminate\Support\Str::limit($post->body, 150, $end='...') }}</p>
                    <a class="btn btn-primary" href="/post/{{$post->slug}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                @endforeach
            @endif

            <!-- Pagination -->
            {{$posts->render()}}

        </div>

        <!-- Blog Sidebar Widgets Column -->
        @include('includes/home_sidebar')

    </div>
@endsection
