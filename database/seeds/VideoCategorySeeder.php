<?php

use App\Models\VideoCategory;
use Illuminate\Database\Seeder;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['#2196f3'=>'web','#7e57c2'=>'mobile','#43a047'=>'game',
            '#90a4ae'=>'pc','#689f38'=>'android','#f06292'=>'testing','#9fa8da'=>'dev-ops'];

        foreach ($categories as $color => $category)
        {
//            VideoCategory::create(['categories'=> $category,'color'=>$color]);
            DB::table('video_category')->insert([
                'categories'=> $category,'color'=>$color
            ]);
        }


    }
}
