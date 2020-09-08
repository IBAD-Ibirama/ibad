<?php

namespace Tests\Feature;

use App\Sponsor;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class SponsorTest extends TestCase
{
    /** @test */
    public function it_should_authenticated()
    {
        $this->post(route('patrocinadores.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_store_in_database()
    {
        Carbon::setTestNow(now());
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        /** @var Sponsor $sponsor */

        $sponsor = factory(Sponsor::class)->make();

        $response =  $this->actingAs($user)
            ->post(route('patrocinadores.store'), $sponsor->toArray());

        $this->assertDatabaseHas('sponsors', [
            'cnpj' => $sponsor->cnpj,
            'name' => $sponsor->name,
            'email' => $sponsor->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /** @test */
    public function cnpj_field_is_unique_and_is_required()
    {
        $sponsor = $this->sponsor()->setCnpj(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('patrocinadores.store'), $sponsor->toArray())
            ->assertSessionHasErrors([
                'cnpj'
            ]);

        // $this->sponsor()->setCnpj('68.250.251/0001-68')->create();
        // $sponsor = $this->sponsor()->setCnpj('68.250.251/0001-68')->make();

        // $this->actingAs($this->user()->create())
        //     ->post(route('sponsors.store'), $sponsor->toArray())
        //     ->assertSessionHasErrors([
        //         'cnpj' => trans('validation.unique', ['attribute' => 'cnpj'])
        //     ]);
    }

    /** @test */
    public function it_should_show_a_move_search()
    {
        $this->withoutExceptionHandling();
        $sponsor = $this->sponsor()->make();

        $this->actingAs($this->user()->create())
            ->post(route('patrocinadores.store'), $sponsor->toArray());

        $sponsor = Sponsor::first();

        $this->assertEquals($sponsor->id, Sponsor::first()->id);
    }

    /** @test */
    public function it_should_list_allSponsors()
    {
        Carbon::setTestNow(now());

        $this->actingAs($this->user()->create());

        $response = $this->get('/patrocinadores')
            ->assertOk();
    }

    /** @test */
    public function sponsor_can_be_updated()
    {
        $sponsor = $this->sponsor()->make();

        $this->actingAs($this->user()->create())
            ->post(route('patrocinadores.store'), $sponsor->toArray());

        $sponsor = Sponsor::first();

        $newSponsor = [
            'cnpj' => '32.185.346/0001-06',
            'name' => 'New Sponsor',
            'email' => 'outro@email.com'
        ];

        $response = $this->put('patrocinadores/' . $sponsor->id, $newSponsor);

        $this->assertEquals('32.185.346/0001-06', Sponsor::first()->cnpj);
        $this->assertEquals('New Sponsor', Sponsor::first()->name);
        $this->assertEquals('outro@email.com', Sponsor::first()->email);
    }

    /** @test */
    public function sponsor_can_be_deleted()
    {
        $sponsor = $this->sponsor()->make();

        $this->actingAs($this->user()->create())
            ->post(route('patrocinadores.store'), $sponsor->toArray());

        $sponsor = Sponsor::first();

        $response = $this->delete('patrocinadores/' . $sponsor->id);

        $this->assertCount(0, Sponsor::all());
    }



    // public function check_if_sponsor_dbcolumns_is_correct()
    // {
    //     $user = factory(User::class)->create();
    //     $sponsor = factory(Sponsor::class)->make();

    //     $expected =[
    //         'id',
    //         'name',
    //         'email',
    //         'cnpj'
    //     ];

    //     $arrayCompared =  $this->actingAs($user)
    //         ->post(route('patrocinadores.store'), $sponsor->toArray());

    //     $arrayCompared = array_diff($expected, $sponsor -> getFillable());

    //     $this -> assertEquals(0, count($arrayCompared));
    // }


    /** @test */
    // public function email_field_is_optional()
    // {
    //     $this->withoutExceptionHandling();
    //     $sponsor = $this->sponsor()->setEmail(null)->make();
    //     $this->actingAs($this->user()->create())
    //         ->post(route('patrocinadores.store'), $sponsor->toArray())
    //         ->assertRedirect();

    //     $this->assertDatabaseHas($sponsor->getTable(), [
    //         'email' => null
    //     ]);
    // }

}
