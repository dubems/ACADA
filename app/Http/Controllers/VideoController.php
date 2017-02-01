<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Repository\VideoRepository;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * VideoController constructor.
     * @param VideoRepository $videoRepository
     * @internal param Video $video
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check())
        {
            $videos = $this->videoRepository->getAll(true);

            return $videos
                ? response()->json(['data'=>$videos,'status'=>'success'])
                : response()->json(['status'=>'error']);
        }

        $videos = $this->videoRepository->getAll(false);

        return $videos
            ? response()->json(['data'=>$videos,'status'=>'success'])
            : response()->json(['status'=>'error']);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $video = $this->videoRepository->createVideo($request->all()) ;
        return $video
            ?   response()->json(['data'=> $video,'status'=>'success','statusCode'=>200])
            :   response()->json(['status'=>'error','statusC0de'=>500])
            ;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getByCategory($category)
    {

        $videos = $this->videoRepository->getVideoBy($category);

        return $videos
            ?   response()->json(['data'=> $videos,'status'=>'success','statusCode'=>200])
            :   response()->json(['status'=>'error','statusCdde'=>500]);

    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($slug)
    {
        $video = $this->videoRepository->getVideo($slug);
        
        return view('showVideos')->with('video',$video['video'],'related',$video['related']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
