
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

            Title: {!! Form::text('title') !!}
            Detail: {!! Form::text('detail') !!}
            {!! Form::submit('update') !!}

        {!! Form::close() !!}

        @foreach($posts as $post)
            <a href="/posts/details/{{$post->id}}">
                ID : {{ $post->user_id }} <br>
                Title : {{ $post->title }} <br>
                Detail: {{ $post->detail }} <br>
            </a>
        @endforeach
    </div>
</div>
@endsection

