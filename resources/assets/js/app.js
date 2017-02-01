
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));



const app = new Vue({
    el: '#app',
    data:{

        category:'',
        currentSlug:'',

        views:{
            createVideo:false,
            editProfile:false,
            dashboard:true
        },
        currentVideo:'',

        newVideo :{
            name:'',
            category:'',
            url:''
        },

        userVideos:'',
        user:{},
        currentView:'Dashboard'
    },
    methods:{

        getCreateVideo:function()
        {
            this.views.createVideo = true;
            this.views.editProfile    = false;
            this.views.dashboard    = false;
            this.currentView = 'Create Video'
        },

        getEditProfile:function()
        {
            this.views.createVideo   = false;
            this.views.dashboard   = false;
            this.views.editProfile    = true;
            this.currentView = 'Edit Profile'

        },
        getDashboard:function()
        {
            this.views.createVideo   = false;
            this.views.dashboard   = true;
            this.views.editProfile    = false;
            this.currentView = 'Dashboard'

        },


        getAuthenticatedUser:function () {
            var $url = '/user';
            this.$http.get($url)
                .then(response =>{
                    // this.$set('user',response.body);
                    this.user = response.body.data;
                    console.log(this.user);
                }, response=> {
                    toastr.error('Whoops! Something went wrong. Please refresh the page');
                });
        },

        /**
         * Edit user profile
         */
        editProfile:function()
        {
            var $url = '/users/'+this.user.id;

            this.$http.put($url,this.user)
                .then(response =>{

                    if(response.body.status != 'success')
                    {
                        return toastr.error('Profile update was not successful, please try again');
                    }

                    console.log(response.body.data);
                    this.user = response.body.data;

                     return toastr.success('Profile has been updated successfully');

                })
        },
        /**
         * create video
         */
        createVideo:function () {
            this.$http.post('/videos',this.newVideo)
                .then(response=>{

                    if(response.body.status == 'error')
                    {
                        return toastr.error('Whoops! there was an error, please try again');
                    }

                    this.userVideos.push(response.body.data);
                    this.newVideo = {};

                    return toastr.success('Video was created  successfully');

                })
        },

        /**
         * Return user videos
         */
        getUserVideos:function () {
        this.$http.get('/videos')
            .then(response=>{

                if(response.body.status == 'error')
                {
                    return toastr.error('Whoops! there was an error, please try again');
                }

                this.userVideos = response.body.data;

                console.log(this.userVideos);
            })

        },

        setCurrentSlug:function (slug) {
            this.currentSlug = slug;
            // window.twttr = (function(d, s, id) {
            //     var js, fjs = d.getElementsByTagName(s)[0],
            //         t = window.twttr || {};
            //     if (d.getElementById(id)) return t;
            //     js = d.createElement(s);
            //     js.id = id;
            //     js.src = "https://platform.twitter.com/widgets.js";
            //     fjs.parentNode.insertBefore(js, fjs);
            //
            //     t._e = [];
            //     t.ready = function(f) {
            //         t._e.push(f);
            //     };
            //
            //     return t;
            // }(document, "script", "twitter-wjs"));
        },
        /**
         * Return videos under specific category
         */
        getVideoUnderCategory()
        {
            this.$http.get('/all-videos/'+this.category)
                .then(response=>{

                    if(response.body.data == 'error')
                    {
                        return toastr.error('Whoops!, Something went wrong. PLease try again')
                    }

                    this.userVideos = response.body.data;

                },response=>{

                })
        },

        playVideo(video)
        {
            this.currentVideo = video;

            $('#ourModal').modal('show')
        }

    },

    mounted(){

        this.getAuthenticatedUser();
        this.getUserVideos();

    }
});
