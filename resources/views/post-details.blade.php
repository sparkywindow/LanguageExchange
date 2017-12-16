
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/">People</a></li>
    <li class="active"><a href="/postsTab">Speak your mind!</a></li>
    <li><a href="/preferenceTab">Preference</a></li>
</ul>

<div class="tab-content" align="center">
    <div id="menu1" class="tab-pane fade in active">
        <h3>Speak your mind!</h3>
        <h1>Details Page</h1>
            Title: {{ $post->title }} <br>
            Detail: {{ $post->detail }} <br>
    </div>
    <div>
        Replies:

    </div>
</div>
@endsection

