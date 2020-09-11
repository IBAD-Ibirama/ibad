<?php

use App\User;
use App\Athlete;
use App\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamAthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::find(1);

        $userMarcos = $this->createUser('Marcos', 'marcos@email.com', 'marcos123');
        $athleteMarcos = $this->createAthlete('2010-08-27', 'M', '5.555.555', '(65)65656-5655', 'M', '7 série', 'Não possui', 'Não precisa', 'GG', 'A+', 'UDESC', $userMarcos->id, $team->id);

        $userJorge = $this->createUser('Jorge', 'jorge@email.com', 'jorge123');
        $athleteJorge = $this->createAthlete('2010-08-27', 'M', '5.555.555', '(65)65656-5655', 'M', '7 série', 'Não possui', 'Não precisa', 'GG', 'A+', 'UDESC', $userJorge->id, $team->id);

        $userAna = $this->createUser('Ana', 'ana@email.com', 'ana123');
        $athleteAna = $this->createAthlete('2010-08-27', 'F', '5.555.555', '(65)65656-5655', 'M', '7 série', 'Não possui', 'Não precisa', 'GG', 'A+', 'UDESC', $userAna->id, $team->id);

    }

    private function createUser($name, $email, $password)
    {
        return Factory(User::class)->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'remember_token' => null,
        ]);
    }

    private function createAthlete($birthdate, $gender, $rg, $telephone, $shift, $grade, $health_problem, $medication, $cloth_size, $blood_type, $school, $user_id, $team_id)
    {
      Athlete::create([
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
        'team_id' => $team_id
      ]);
    }
}
