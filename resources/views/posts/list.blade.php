
@extends('layouts.app')

@section('styles')

    <link href="{{ asset('css/pages/posts-list.css') }}" rel="stylesheet">
@endsection


@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/users/list"> 사람들 </a></li>
    <li class="active"><a href="#"> 공부합시다 </a></li>
    <li><a href="/users/profile/me"> 개인설정 </a></li>
</ul>

<div class="tab-content" align="center">
    <div id="menu1" class="tab-pane fade in active">

        {{-- form to add new post --}}
        {!! Form::open(['route' => 'posts.create']) !!}
            Message: {!! Form::text('msg') !!}
            {!! Form::submit('update') !!}
        {!! Form::close() !!}

        <div id="postlist">
            <div v-cloak>
                <div v-for="(post, index) in posts">
                    <div align="left" class="post">
                        <img v-bind:src="profilePictureUrls[index]" style="border-radius:30px">
                        @{{ user.name }}

                        {{-- link to the post and msg from the post --}}
                        <a v-bind:href="postDetailsUrl(post.id)">
                            <p1><h3> @{{ post.msg }} </h3></p1>
                        </a>

                        {{-- like # and button group --}}
                        <like :postid="post.id" v-on:test="testorr" :pressed="currentUserLikes[index]" :user="user" :numberoflikes="numberOfLikes[index]"></like>

                        {{-- comment # and save button group --}}
                        <div class="commentAndSaveGroup">
                            <span> @{{ numberOfComments[index] }} Comments </span> <br>
                            <div align="center" class="saveButton"> 저장하기 </div>
                        </div>

                        {{-- first comment of the post --}}
                        <h4> <div class="firstCommentOfThePost"> @{{ firstComments[index] }} </div> </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('scripts')

    {{--<script src="https://hammerjs.github.io/dist/hammer.min.js"></script>--}}
    <script src="{{ asset('js/pages/posts-list.js') }}"></script>
@endsection
