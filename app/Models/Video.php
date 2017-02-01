<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 2/1/17
 * Time: 6:29 AM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $guarded = ['id'];

    protected $table = 'videos';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(VideoCategory::class,'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}