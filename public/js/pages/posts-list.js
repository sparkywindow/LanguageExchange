
$('.like').css('cursor', 'pointer');

$('.save').css('cursor', 'pointer');

Vue.component('like', {

    template:   '<div class="likeComponentGroup">' +
    '               <div> Likes : {{ numberoflikes }} </div>' +
    '               <div align="center" v-on:click="buttonPressed" v-bind:class="computedClass"> 좋아요 </div>' +
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
        buttonPressed: function() {

            if (this.user.name === 'Guest') {

                window.location.replace('/login');
                return;
            }

            //toggle like button
            this.pressed = !this.pressed;

            //depending on press or unpress, we need to send different request
            if(this.pressed === true)
                this.like();
            else
                this.unlike();

        },
        like: function() {

            this.numberoflikes++;
            //like the post
            $.ajax({
                url: '/likes/like',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    likeType: 'post',
                    targetId: this.postid,
                },
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                }
            });
        },
        unlike: function () {

            this.numberoflikes--;

            //unlike the post
            $.ajax({
                url: '/likes/unlike',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    likeType: 'post',
                    targetId: this.postid,
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
    },
    data: {
        sparkyData:'sparkyverysparky',
        posts: [],
        numberOfLikes: [],
        currentUserLikes: [],
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
                    this.setLikes(data.likes, this);
                }.bind(this)
            });
        },
        setLikes: function(likes, that) {

            //number of likes for each post
            var numberOfLikes = [];

            //Whether the current user liked each post
            var currentUserLikes = [];

            likes.forEach(function(like) {

                currentUserLikes.push(Number(JSON.parse(like.user_names_json).includes(that.user.id) === true));

                if (like !== undefined && like !== null)
                    numberOfLikes.push(JSON.parse(like.user_names_json).length);
                else
                    numberOfLikes.push(0);
            })
            this.numberOfLikes = numberOfLikes;
            this.currentUserLikes = currentUserLikes;
        },
        testorr: function(fromChild) {
            console.log(fromChild);
        }
    }
})