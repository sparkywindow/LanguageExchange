
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/">People</a></li>
    <li class="active"><a href="#">Speak your mind!</a></li>
    <li><a href="/preferenceTab">Preference</a></li>
</ul>

<div class="tab-content">
    <div id="menu1" class="tab-pane fade in active">
        <h3>Speak your mind!</h3>

        {!! Form::open(['route' => 'Post.post']) !!}

            Title: {!! Form::text('title') !!}
            Content: {!! Form::text('detail') !!}
            {!! Form::submit('update') !!}

        {!! Form::close() !!}

        @foreach($posts as $post)
            ID : {{ $post->user_id }} <br>
            Title : {{ $post->title }} <br>
            Detail: {{ $post->detail }} <br>
        @endforeach
    </div>
</div>
@endsection

