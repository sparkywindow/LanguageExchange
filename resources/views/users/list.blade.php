
@extends('layouts.app')

@section('content')

<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#">사람들</a></li>
    <li><a href="/posts/list">공부합시다</a></li>
    <li><a href="/users/profile/me">개인설정</a></li>
</ul>

<div class="tab-content" align="center">
    <div id="home" class="tab-pane fade in active">
        <h3>List of People</h3>
        @foreach ($userList as $anotherUser)
            <div style="background-color: #ebeeef; margin:30px">
                <img src= {{ $anotherUser->getProfilePictureUrl() }} class="img-thumbnail" alt="Cinque Terre"> <br>
                <a href={{ $anotherUser->facebookPageUrl() }}> Name : {{ $anotherUser->name }} <br> </a>
                Native Language : {{ $anotherUser->nativeLanguage }} <br>
                Learning Language : {{ $anotherUser->learningLanguage }} <br>
                City : {{ $anotherUser->city }} <br>
            </div>
        @endforeach
    </div>
</div>
@endsection


