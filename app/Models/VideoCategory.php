<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 2/1/17
 * Time: 6:29 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{

    protected $guarded = ['id'];

    protected $table = 'video_category';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video()
    {
        return $this->hasMany(Video::class);
    }
    
}