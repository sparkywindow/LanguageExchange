
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

        @foreach($posts as $post)
            <div align="left" style="max-width: 400px; background-color: #fcfdfd; margin:30px; border-radius:20px; border:3px; border-style:solid; border-color: #d4d4d4; padding:15px;">
                <a href="/posts/details/{{$post->id}}">
                    <img src="{{ Helper::getProfilePictureUrlWithId($post->user_id, array('width' => 50, 'height' => 50)) }}" style="border-radius:30px"> {{ Helper::getUserNameWithId($post->user_id) }}
                    <h1> {{ $post->msg }} </h1> <br>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection

