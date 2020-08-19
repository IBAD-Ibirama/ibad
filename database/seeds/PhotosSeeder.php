<?php

use App\Model\Photos;
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
        factory(Photos::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
