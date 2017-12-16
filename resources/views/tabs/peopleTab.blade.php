
@extends('layouts.app')

@section('content')

<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#">People</a></li>
    <li><a href="/postsTab">Speak your mind!</a></li>
    <li><a href="/preferenceTab">Preference</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h3>List of People</h3>
        @foreach ($userList as $anotherUser)
                <img src= {{ $anotherUser->getProfilePictureUrl() }} class="img-thumbnail" alt="Cinque Terre" height="200" width="200"> <br>
                <a href={{ $anotherUser->facebookPageUrl() }}> Name : {{ $anotherUser->name }} <br> </a>
                Native Language : {{ $anotherUser->nativeLanguage }} <br> 
                Learning Language : {{ $anotherUser->learningLanguage }} <br> 
                City : {{ $anotherUser->city }} <br> 
                
        @endforeach
    </div>
</div>
@endsection


