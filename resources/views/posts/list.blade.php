
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

        <div id="app">
            <div v-for="(post, index) in posts">
                <div align="left" style="max-width: 400px; word-wrap: break-word; background-color: #fcfdfd; margin-left:10px; margin-right:10px; margin-top:30px; border-radius:10px; border:3px; border-style:solid; border-color: #d4d4d4; padding:15px;">
                    <a v-bind:href="postDetailsUrl(post.id)">
                        <img src="https://graph.facebook.com/10155879106934254/picture?width=50&height=50" style="border-radius:30px">
                        @{{ user.name }}
                        <p1><h1> @{{ post.msg }} </h1></p1> <br>
                    </a>
                    Likes : @{{ JSON.parse(likes[index].user_names_json).length }}

                </div>
            </div>
            <button v-on:click="printstuff">printstuff</button>
        </div>
        s
        <script>
            var app = new Vue({
                el: '#app',
                mounted: function() {
                    this.loadData();
                    console.log("mounted");
                },
                data: {
                    posts:[],
                    likes:[],
                    user:[],
                    postDetailsUrl: function(postId) {
                        return '/posts/details/' + postId;
                    },
                },
                methods: {
                    printstuff: function() {
                        JSON.parse(this.likes[0].user_names_json);
                    },
                    loadData: function() {
                        $.ajax({
                            url: '/posts/list/json',
                            type: 'GET',
                            data: {_token: $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'JSON',
                            success: function (data) {
                                this.posts = data.posts;
                                this.likes = data.likes;
                                this.user =  data.user;
                            }.bind(this)
                        });
                    },
                }

            })
        </script>

    </div>
</div>
@endsection

