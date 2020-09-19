<?php

use App\FaultLimit;
use Illuminate\Database\Seeder;

class FaultLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(FaultLimit::class)->create();
    }
}
