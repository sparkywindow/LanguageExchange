
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/">People</a></li>
    <li class="active"><a href="/posts/list">Speak your mind!</a></li>
    <li><a href="/users/profile/me">Preference</a></li>
</ul>

<div class="tab-content" align="center">
    <div id="menu1" class="tab-pane fade in active">
        <h1>
            <img src="{{ Helper::getProfilePictureUrlWithId($post->user_id, array('width' => 200, 'height' => 200)) }}">
            {{ $post->msg }} <br>
        </h1>
    </div>

        {!! Form::open(['route' => 'comments.create']) !!}

            <br><br>
            Post Id {!! Form::hidden('post_id', $post->id) !!}
            Msg: {!! Form::text('msg') !!}
            {!! Form::submit('Comment') !!}

        {!! Form::close() !!}

    <br><br>

    @foreach($comments as $index => $comment)

        @if($comment->reply_parent_id === -1)

            <h2> <img src="{{ Helper::getProfilePictureUrlWithId($comment->owner_id, array('width' => 50, 'height' => 50)) }}"> {{ $comment->msg }} </h2> <br>

            {!! Form::open(['route' => 'comments.reply-to-comment']) !!}

            {!! Form::hidden('post_id', $post->id) !!}
            {!! Form::hidden('reply_parent_id', $comment->id) !!}

                Msg: {!! Form::text('msg') !!}

            {!! Form::submit('Comment') !!}

            {!! Form::close() !!}
            <br>

            @foreach($repliesToComments as $reply)

                @if($reply->reply_parent_id === $comment->id)
                    <h3> <img src="{{ Helper::getProfilePictureUrlWithId($reply->owner_id, array('width' => 30, 'height' => 30)) }}"> {{ $reply->msg }} </h3> <br>
                @endif
            @endforeach

        @endif

    @endforeach

</div>
@endsection

