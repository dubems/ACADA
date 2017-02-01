@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <link rel="canonical"
          :href="currentSlug">

    <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default" style="height:400px">
            <ul class="sidebar">
                <li class="sidebar-title"><a href="">My Account</a></li>
                <li @click.prevent="getDashboard"><a href="">Dashboard</a></li>
                <li @click.prevent="getCreateVideo"><a href="">Post Video</a></li>
                <li @click.prevent="getEditProfile"><a href="">Edit Profile</a></li>
                <li></li>
                <li></li>
            </ul>

            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">@{{currentView}}
                    <div class=" col-sm-4 col-sm-offset-4" style="float:right">
                        <select name="" id="" v-show="views.dashboard" v-model="category"
                                @change.prevent="getVideoUnderCategory">
                            <option value="" selected disabled>Video Category</option>
                            <option value="web">Web Development</option>
                            <option value="mobile">Mobile</option>
                            {{--<option value="game">Game Development</option>--}}
                            <option value="pc">PC</option>
                            <option value="android">Android Development</option>
                            {{--<option value="testing">Testing</option>--}}
                            {{--<option value="dev-ops">Dev Ops</option>--}}
                        </select>
                    </div>

                </div>

                <div class="panel-body">
                    <div v-show="views.dashboard" class="row">

                        <div v-for="video in userVideos" class="col-sm-4 video-listing"
                             :class="video.category.categories" @click.prevent="playVideo(video)">

                            {{--<iframe :src="video.url" frameborder="0"  width="300" height="150"></iframe>--}}
                            {{--<span>@{{video.name}}</span>--}}

                            <img src="" alt="">
                            <div>
                                <span> Name : @{{video.name}}</span><br>
                                <span> Category: @{{video.category.categories}}</span><br>
                                <span> url: @{{video.slug}}</span>
                            </div>

                            <a @click.prevent="setCurrentSlug(video.slug)" class="twitter-share-button"
                               href="https://twitter.com/intent/tweet">
                                Tweet</a>

                        </div>

                    </div>


                   <div v-show="views.createVideo">

                       <form action="" @submit.prevent="createVideo">
                           <div class="form-group col-sm-5 col-sm-offset-1 ">
                               <input class="form-control"  type="text"
                                      placeholder="name of video"  required v-model="newVideo.name">
                               <label for="">Video Name</label>
                           </div>

                           <div class="form-group col-sm-5 col-sm-offset-1 ">
                               <input  type="url" class="form-control"
                                       placeholder="eg. http://youtube/embed/..." required v-model="newVideo.url">
                               <label for="">Video Link</label>
                           </div>

                           <div class="form-group col-sm-5 col-sm-offset-1 ">
                               <select name="" id="" class="form-control" required v-model="newVideo.category">
                                   <option value="" selected disabled>Video Category</option>
                                   <option value="web">Web Development</option>
                                   <option value="mobile">Mobile</option>
                                   {{--<option value="game">Game Development</option>--}}
                                   <option value="pc">PC</option>
                                   <option value="android">Android Development</option>
                                   {{--<option value="testing">Testing</option>--}}
                                   {{--<option value="dev-ops">Dev Ops</option>--}}
                               </select>
                               <label for="">Video Category</label>
                           </div>

                           <div clas="row">
                               <div class="col-sm-3">
                                   <button  type="submit" class="pull-right btn btn-success">Submit</button>
                               </div>
                           </div>
                       </form>

                   </div>

                    <div v-show="views.editProfile">
                        <div class="form-group col-sm-5 col-sm-offset-1">
                            <input type="text" class="form-control" v-model="user.name" placeholder="Username">
                            <label for="">Name</label>
                        </div>
                            <div class="form-group col-sm-5">
                            <input type="email" class="form-control" v-model="user.email" placeholder="email">
                            <label for="">Email</label>
                        </div>

                        {{--<div class="form-group col-sm-5 col-sm-offset-1">--}}
                            {{--<input type="file" class="form-control" placeholder="avatar">--}}
                            {{--<label for="">Avatar</label>--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-9">
                                <button class=" btn btn-success" @click.prevent="editProfile">Submit</button>

                            </div>
                        </div>
                    </div>

                    <div v-show="views.changeAvatar">

                        <div class="col-sm-4 col-sm-offset-4 form-group">
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <button  @click.prevent="uploadAvatar" class="btn btn-primary"> Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <iframe :src="currentVideo.url" frameborder="0" class="play-video"></iframe>
            </div>
            <div class="modal-footer">
                <span class="video-name">@{{currentVideo.name}}</span>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
