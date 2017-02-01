require('./bootstrap');

const homepage = new Vue({
    el:'#homepage',
    data:{

        returnedData:false,
        category:'',
        allVideos:'',
        currentVideo:''
    },

    methods:{

        getAllVideos()
        {
            this.$http.get('/videos')
                .then(response=>{

                    if(response.body.status == 'error')
                    {
                        return;
                    }

                    this.allVideos = response.body.data;
                    console.log(this.allVideos);

                },response=>{

                    return toastr.error('Whoops!, something went wrong')
                })
        },

        /**
         * Return videos under specific category
         */
        getVideoUnderCategory()
        {
            this.returnedData = false;
            this.$http.get('/all-videos/'+this.category)
                .then(response=>{

                    if(response.body.data == 'error')
                    {
                        this.returnedData = true;

                        return toastr.error('Whoops!, Something went wrong. PLease try again')
                    }
                    this.returnedData = true;

                    this.allVideos = response.body.data;

                },response=>{

                })
        },

        playVideo(video)
        {
            this.currentVideo = video;

            $('#myModal').modal('show');
        }
    },

    mounted(){
        this.getAllVideos();
        this.returnedData = true;
    }
});