
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/users/list">People</a></li>
    <li class="active"><a href="#">Speak your mind!</a></li>
    <li><a href="/users/profile/me">Preference</a></li>
</ul>

<div class="tab-content" align="center">
    <div id="menu1" class="tab-pane fade in active">
        <h3>Speak your mind!</h3>

        {!! Form::open(['route' => 'posts.create']) !!}

            Message: {!! Form::text('msg') !!}
            {!! Form::submit('update') !!}

        {!! Form::close() !!}

        @foreach($posts as $key => $post)
            <div align="left" style="max-width: 400px; word-wrap: break-word; background-color: #fcfdfd; margin-left:10px; margin-right:10px; margin-top:30px; border-radius:10px; border:3px; border-style:solid; border-color: #d4d4d4; padding:15px;">
                <a href="/posts/details/{{$post->id}}">
                    <img src="{{ Helper::getProfilePictureUrlWithId($post->user_id, array('width' => 50, 'height' => 50)) }}" style="border-radius:30px">
                    {{ Helper::getUserNameWithId($post->user_id) }}
                    <p1><h1> {{ $post->msg }} </h1></p1> <br>
                </a>
            </div>
            @foreach($comments as $comment)
                <div align="left" style="max-width: 400px; word-wrap: break-word; margin-left:10px; margin-right:10px; background-color: #f9f2f4;  border-radius:3px; border:3px; border-style:solid; border-color: #d4d4d4; padding:15px;">
                    <img src="{{ Helper::getProfilePictureUrlWithId($comment->user_id, array('width' => 30, 'height' => 30)) }}" style="border-radius:30px">
                    {{ Helper::getUserNameWithId($comment->user_id) }}
                    {{ $comment->msg }} <br>

                    {{--@foreach($reply->repliesToThis as $replyToReply)--}}
                        {{--<div style="height:20px">--}}
                            {{--<img src="{{ Helper::getProfilePictureUrlWithId($reply->user_id, array('width' => 30, 'height' => 30)) }}" width="20" style="border-radius:30px; margin-left:50px">--}}
                            {{--{{ $replyToReply->msg }}--}}
                        {{--</div><br>--}}
                    {{--@endforeach--}}
                </div>
            @endforeach

            {{--@todo Write a reply to reply --}}
        @endforeach
    </div>
</div>
@endsection

