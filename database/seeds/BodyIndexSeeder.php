<?php

use Illuminate\Database\Seeder;

class BodyIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('body_indexes')->insert([
            [
                'name' => 'Bíceps (BC)'
            ],
            [
                'name' => 'Tríceps (TC)'
            ],
            [
                'name' => 'Subescapular (SE)'
            ],
            [
                'name' => 'Abdominal (AB)'
            ],
            [
                'name' => 'Suprailíaca (SI)'
            ],
            [
                'name' => 'Coxa (CX)'
            ],
            [
                'name' => 'Panturrilha (PT)'
            ]
        ]);
    }
}
