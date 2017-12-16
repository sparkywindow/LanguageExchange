
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
            <img src="{{ $user->getProfilePictureUrl() }}">
            {{ Helper::aloha() }}
            Title: {{ $post->title }}
            Detail: {{ $post->detail }} <br>
        </h1>
    </div>

        {!! Form::open(['route' => 'replies.create']) !!}

            <br><br>
            Post Id {!! Form::hidden('post_id', $post->id) !!}
            Msg: {!! Form::text('msg') !!}
            {!! Form::submit('Leave a Reply') !!}

        {!! Form::close() !!}

    <br><br>

    @foreach($replies as $index => $reply)

        <h2> Message : {{ $reply->msg }} </h2> <br>
        {{ var_dump($reply->repliesToThis) }}

        {!! Form::open(['route' => 'replies.create-reply-to-reply']) !!}

            {!! Form::hidden('post_id', $post->id) !!}
            {!! Form::hidden('replySequence', $index) !!}
            Msg: {!! Form::text('msg') !!}

            {!! Form::submit('Reply to Reply') !!}

        {!! Form::close() !!}
        <br><br><br>
    @endforeach

</div>
@endsection

