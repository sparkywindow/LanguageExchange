
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/">People</a></li>
    <li class="active"><a href="/posts/list">Speak your mind!</a></li>
    <li><a href="/users/profile/me">Preference</a></li>
</ul>

<div class="tab-content" align="left" style="overflow-wrap: break-word; margin:20px; ">
    <div id="menu1" class="tab-pane fade in active">
        <h1>
            {{ $post->msg }} <br><br>
        </h1>
    </div>

    @foreach($comments as $index => $comment)
        <h2>
            <img src="{{ Helper::getProfilePictureUrlWithId($comment->owner_id, array('width' => 50, 'height' => 50)) }}" style="float:left;">
            {{ $comment->msg }}
        </h2>
        <br>
    @endforeach

</div>
<div style="position: fixed; bottom: 0px; clear:both; background-color:Gray; width:100%;">
    {!! Form::open(['route' => 'comments.create']) !!}

    Post Id {!! Form::hidden('post_id', $post->id) !!}
    Msg: {!! Form::text('msg') !!}
    {!! Form::submit('Comment') !!}

    {!! Form::close() !!}
</div>
@endsection

