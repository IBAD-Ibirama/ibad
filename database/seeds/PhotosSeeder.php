<?php

use App\Model\Photo;
use Illuminate\Database\Seeder;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Photo::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
