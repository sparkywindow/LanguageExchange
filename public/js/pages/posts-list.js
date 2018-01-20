
$('.like').css('cursor', 'pointer');

$('.save').css('cursor', 'pointer');

Vue.component('like', {

    template:   '<div class="likeComponentGroup">' +
    '               <div> Likes : {{ numberoflikes }} </div>' +
    '               <div align="center" v-on:click="like" v-bind:class="computedClass"> 좋아요 </div>' +
    '           </div>',
    props: ['postid', 'pressed', 'user', 'numberoflikes'],
    computed: {
      computedClass: function () {
          return {
              likeButton: true,
              pressed: this.pressed,
          };
      }
    },
    methods: {
        test: function () {
            console.log(this.postid);
            console.log(this.pressed);
            this.pressed = !this.pressed;
            console.log(this.user.name);
        },
        like: function() {

            //toggle like button
            this.pressed = !this.pressed;

            this.numberoflikes++;

            if (this.user.name === 'Guest') {

                window.location.replace('/login');
                return;
            }

            postId = this.postid;

            //@todo depending on press or unpress, we need to send different request

            //like the post
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
                    console.log(data);
                }
            });
        }
    }
})

var app = new Vue({
    el: '#postlist',
    mounted: function() {
        this.loadData();
        console.log("mounted");
    },
    data: {
        sparkyData:'sparkyverysparky',
        likeButton:'',
        posts: [],
        numberOfLikes: [],
        user: [],
        numberOfComments: [],
        firstComments: [],
        profilePictureUrls: [],
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
                    this.profilePictureUrls = data.profilePictureUrls;
                    this.getNumberOfLikes(data.likes);
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
        testorr: function(fromChild) {
            console.log(fromChild);
        }
    }
})