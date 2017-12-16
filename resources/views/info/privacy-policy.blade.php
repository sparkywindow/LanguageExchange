
@extends('layouts.app')

@section('content')

<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#">People</a></li>
    <li><a href="/posts/list">Speak your mind!</a></li>
    <li><a href="/users/profile/me">Preference</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h3>Privacy Policy</h3>

        1. The site exposes the URL of your public facebook profile page. <br>
        2. The site does not have access to anything other than your facebook ID and email address. <br>
        3. Thus this site stores no other information than your facebook ID and email address. <br>
        4. The posts that you create on the site will have a matching facebook ID so that users of the site know who posted it. <br>
    </div>
</div>
@endsection


