<?php
/**
 * Created by PhpStorm.
 * User: proteux3
 * Date: 2/1/17
 * Time: 7:20 AM
 */

namespace App\Services;


class SlugGenerator
{

    /**Generate video slug
     *
     * @return mixed
     */
    public function generateSlug()
    {
        $pool = array_merge(range('a','z'),range(0,9));

        shuffle($pool);
        $sliced = array_slice($pool,0,16);
        $slug = implode('',$sliced);

        return $slug;

    }
}