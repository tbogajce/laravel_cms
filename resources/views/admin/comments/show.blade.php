@extends('layouts.admin')

@section('content')

    <h1>Comments</h1>

    @if($comments)
    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
        </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            {{--add hidden input because we need to send is_active value to the controller via request--}}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-approve Comment', ['class'=>'btn btn-warning']) !!}
                            </div>

                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            {{--add hidden input because we need to send is_active value to the controller via request--}}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve Comment', ['class'=>'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection
