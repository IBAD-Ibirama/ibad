<?php

namespace Tests\Feature;

use App\Athlete;
use Carbon\Carbon;
use Tests\TestCase;

class AthleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    function it_should_authenticated()
    {
        $this->post(route('atletas.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    function it_should_store_in_database()
    {
        Carbon::setTestNow(now());

        $athlete = factory(Athlete::class)->make();

        $response =  $this->actingAs($this->user()->create())
            ->post(route('atletas.store'), $athlete->toArray());

        $this->assertDatabaseHas('athletes', [
            'birthdate' => $athlete->birthdate,
            'gender' => $athlete->gender,
            'rg' => $athlete->rg,
            'telephone' => $athlete->telephone,
            'shift' => $athlete->shift,
            'grade' => $athlete->grade,
            'health_problem' => $athlete->health_problem,
            'medication' => $athlete->medication,
            'cloth_size' => $athlete->cloth_size,
            'blood_type' => $athlete->blood_type,
            'school' => $athlete->school,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /** @test */
    function it_should_show_a_athlete_search()
    {

        $athlete = factory(Athlete::class)->make();

        $response =  $this->actingAs($this->user()->create())
            ->post(route('atletas.store'), $athlete->toArray());

        $this->assertEquals($athlete->rg, Athlete::first()->rg);
    }

    /** @test */
    function it_should_list_allAthletes()
    {
        Carbon::setTestNow(now());

        $athlete = factory(Athlete::class)->make();

        $this->actingAs($this->user()->create())
            ->post(route('atletas.store'), $athlete->toArray());

        $response = $this->get('/atletas')
            ->assertOk();
    }

    /** @test */
    function sponsor_can_be_updated()
    {
        $athlete = factory(Athlete::class)->make();

        $this->actingAs($this->user()->create())
            ->post(route('atletas.store'), $athlete->toArray());

        $athlete = Athlete::first();

        $newAthlete = [
            'birthdate' => "2007-03-10",
            "gender" => "m",
            "rg" => "989688219",
            "telephone" => "5164778040404925",
            "shift" => "m",
            "grade" => "est",
            "health_problem" => "molestias",
            "medication" => "cumque",
            "cloth_size" => "mm",
            "blood_type" => "o+pmm",
            "school" => "quia",
        ];

        $response = $this->put('atletas/' . $athlete->id, $newAthlete);

        $this->assertEquals("2007-03-10", Athlete::first()->birthdate);
        $this->assertEquals("989688219", Athlete::first()->rg);
        $this->assertEquals("5164778040404925", Athlete::first()->telephone);
        $this->assertEquals("molestias", Athlete::first()->health_problem);
        $this->assertEquals("cumque", Athlete::first()->medication);
    }

    /** @test */
    function sponsor_can_be_deleted()
    {
        $athlete = factory(Athlete::class)->make();

        $this->actingAs($this->user()->create())
            ->post(route('atletas.store'), $athlete->toArray());

        $athlete = Athlete::first();

        $response = $this->delete('atletas/' . $athlete->id);

        $this->assertCount(0, Athlete::all());
    }
}
