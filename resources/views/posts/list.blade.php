
@extends('layouts.app')

@section('content')
        
<!-- Tab menus -->
<ul class="nav nav-tabs">
    <li><a href="/users/list"> 사람들 </a></li>
    <li class="active"><a href="#"> 공부합시다 </a></li>
    <li><a href="/users/profile/me"> 개인설정 </a></li>
</ul>

<div class="tab-content" align="center">
    <div id="menu1" class="tab-pane fade in active">

        {!! Form::open(['route' => 'posts.create']) !!}

            Message: {!! Form::text('msg') !!}
            {!! Form::submit('update') !!}

        {!! Form::close() !!}

        <div id="app">
            <div v-for="(post, index) in posts">
                <div align="left" style="max-width: 400px; overflow:auto;  word-wrap: break-word; background-color: #fcfdfd; margin-left:10px; margin-right:10px; margin-top:10px; border-radius:10px; border:3px; border-style:solid; border-color: #d4d4d4; padding:5px;">
                    <img src="https://graph.facebook.com/10155879106934254/picture?width=50&height=50" style="border-radius:30px">
                    @{{ user.name }}
                    <a v-bind:href="postDetailsUrl(post.id)">
                        <p1><h3> @{{ post.msg }} </h3></p1>
                    </a>
                    <span> Likes : @{{ numberOfLikes[index] }} </span>
                    <span style="float: right;"> @{{ numberOfComments[index] }} Comments </span> <br>

                    <div align="center" v-on:click="like(post.id)" style="float: left; background-color: gainsboro; width:50%; height:30px;"> 좋아요 </div>
                    <div align="center" style="float: left; background-color: darkgray; width:50%; height:30px;"> 저장하기 </div> <br>

                    <h4> <div style="float:left; background-color:lightgray; width:100%;"> @{{ firstComments[index] }} </div> </h4>
                </div>
            </div>
        </div>

        <script>
            var app = new Vue({
                el: '#app',
                mounted: function() {
                    this.loadData();
                    console.log("mounted");
                },
                data: {
                    posts: [],
                    numberOfLikes: [],
                    user: [],
                    numberOfComments: [],
                    firstComments: [],
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
                                this.user =  data.user;
                                this.numberOfComments = data.numberOfComments;
                                this.firstComments = data.firstComments;
                                this.getNumberOfLikes(data.likes);
                            }.bind(this)
                        });
                    },
                    like: function(postId) {
                        $.ajax({
                            url: '/likes/like',
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                likeType: 'post',
                                targetId: postId,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                
                                numberOfLikesHolder = this.numberOfLikes.slice(0);
                                numberOfLikesHolder[data.like.target_id - 1] = JSON.parse(data.like.user_names_json).length;
                                this.numberOfLikes = numberOfLikesHolder;
                            }.bind(this)
                        });
                    },
                    getNumberOfLikes: function(likes) {
                        var numberOfLikes = [];
                        likes.forEach(function(like) {

                            if (like !== undefined && like !== null)
                                numberOfLikes.push(JSON.parse(like.user_names_json).length);
                            else
                                numberOfLikes.push(0);
                        })
                        this.numberOfLikes = numberOfLikes;
                    },
                }

            })
        </script>

    </div>
</div>
@endsection

