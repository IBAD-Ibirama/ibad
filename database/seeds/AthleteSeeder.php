<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAthlete('2020-08-27', 'M', '5.555.555', '(65)65656-5655', 'M', '7 série', 'Não possui', 'Não precisa', 'GG', 'A+', 'UDESC', '1');
        $this->createAthlete('2020-08-27', 'F', '6.666.666', '(65)55555-5556', 'V', '5 série', 'Não possui', 'Rivotril', 'PP', 'O-', 'Eliseu', '2');
        $this->createAthlete('2020-08-27', 'F', '6.666.666', '(65)55555-5556', 'V', '6 série', 'Não possui', 'Não precisa', 'PP', 'O-', 'Eliseu', '4');
    }

    private function createAthlete($birthdate, $gender, $rg, $telephone, $shift, $grade, $health_problem, $medication, $cloth_size, $blood_type, $school, $user_id)
    {
        DB::table('athletes')->insert([
            'birthdate' => $birthdate,
            'gender' => $gender,
            'rg' => $rg,
            'telephone' => $telephone,
            'shift' => $shift,
            'grade' => $grade,
            'health_problem' => $health_problem,
            'medication' => $medication,
            'cloth_size' => $cloth_size,
            'blood_type' => $blood_type,
            'school' => $school,
            'user_id' => $user_id,
        ]);
    }
}
