<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 2/1/17
 * Time: 6:40 AM
 */

namespace App\Repository;


use App\Models\Video;
use App\Models\VideoCategory;
use App\Services\SlugGenerator;

class VideoRepository
{
    /**
     * @var Video
     */
    private $video;
    /**
     * @var SlugGenerator
     */
    private $generator;

    /**
     * VideoRepository constructor.
     * @param Video $video
     * @param SlugGenerator $generator
     */
    public function __construct(Video $video,SlugGenerator $generator)
    {
        $this->video = $video;
        $this->generator = $generator;
    }

    /**
     * Create a new video
     *
     * @param $video
     * @return mixed
     */
    public function createVideo($video)
    {
        $category_id =  VideoCategory::where('categories',$video['category'])->first()->id;
        
        $newVideo = [
            'name'=>$video['name'],
            'user_id'=>\Auth::user()->id,
            'url'=>$video['url'],
            'slug'=>$this->generator->generateSlug(),
            'category_id'=>$category_id
        ];

        $video = $this->video->create($newVideo);

        $video = $this->video->where('slug',$video->slug)
             ->with('category')
             ->first();

        $video->slug = config('app.url').'/videos/'.$video->slug;

        return $video;
    }

    /**
     * @param $loggedIn
     * @return mixed
     */
    public function getAll($loggedIn)
    {
        if($loggedIn) {
            $videos =  $this->video->where('user_id',\Auth::user()->id)
                ->with('category')
                ->get();

            foreach ($videos as $video) {
                $video->slug = config('app.url').'/videos/'.$video->slug;
            }

            return $videos;
        }

        $videos =  $this->video->whereNotNull('id')
            ->with('category')
            ->get();

        foreach ($videos as $video) {
            $video->slug = config('app.url').'/videos/'.$video->slug;
        }

        return $videos;
    }

    /**
     * Return videos by there category
     *
     * @param $category
     * @return mixed
     */
    public function getVideoBy($category)
    {
        if(\Auth::check())
        {
             $videos = $this->video
                ->where('category_id',$this->getCategoryId($category))
                ->where('user_id',\Auth::user()->id)
                ->with('category')
                ->get();

            foreach ($videos as $video) {
                $video->slug = config('app.url').'/videos/'.$video->slug;
            }

            return $videos;

        }
            $videos =  $this->video
            ->where('category_id',$this->getCategoryId($category))
            ->with('category')
            ->get();

        foreach ($videos as $video) {
            $video->slug = config('app.url').'/videos/'.$video->slug;
        }

        return $videos;
    }

    /**
     * Get Category Identifier
     *
     * @param $category
     * @return mixed
     */
    public function getCategoryId($category)
    {
        return VideoCategory::where('categories',$category)->first()->id;
    }

    /**
     * @param $slug
     * @return array
     */
    public function getVideo($slug)
    {
        $video = $this->video->where('slug',$slug)->first();
        if( ! $video)  return abort(404);

        $category_id     = $video->category_id;

        $related_videos  = $this->video->where('category_id',$category_id)
            ->where('id','!=',$video->id)
            ->with('category')
            ->inRandomOrder()
            ->take(5);



        return ['video'=>$video,'related'=>$related_videos];



    }
}