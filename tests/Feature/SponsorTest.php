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
        $this->post(route('sponsors.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_store_in_database_and_redirect_to_show_page()
    {
        Carbon::setTestNow(now());
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        /** @var Sponsor $sponsor */

        $sponsor = factory(Sponsor::class)->make();

        $response =  $this->actingAs($user)
            ->post(route('sponsors.store'), $sponsor->toArray());

        $sponsor = Sponsor::first();
        $response->assertRedirect(route('sponsors.show', $sponsor));

        $this->assertDatabaseHas('sponsors', [
            'cnpj' => $sponsor->cnpj,
            'value' => $sponsor->value,
            'email' => $sponsor->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /** @test */
    public function value_field_is_positive_integer_and_is_required()
    { //required pronto
        /** @var Sponsor $sponsor */
        $sponsor = factory(Sponsor::class)->make(['value' => null]);
        $user = factory(User::class)->create();

        //required
        $this->actingAs($user)
            ->post(route('sponsors.store'), $sponsor->toArray())
            ->assertSessionHasErrors([
                'value' => trans('validation.required', ['attribute' => 'value'])
            ]);
        //positive
        $sponsor = $this->sponsor()->setValue(-1)->make();
        $this->actingAs($user)
            ->post(route('sponsors.store'), $sponsor->toArray())
            ->assertSessionHasErrors([
                'value' => trans(
                    'validation.min.numeric',
                    ['attribute' => 'value', 'min' => 0]
                )
            ]);

        $sponsor = $this->sponsor()->setValue(0.5)->make();
        $this->actingAs($user)
            ->post(route('sponsors.store'), $sponsor->toArray())
            ->assertSessionHasErrors([
                'value' => trans('validation.integer', ['attribute' => 'value'])
            ]);
    }

    /** @test */
    public function cnpj_field_is_unique_and_is_required()
    {
        $this->withoutExceptionHandling();
        $sponsor = $this->sponsor()->setCnpj(null)->make();
        //  $this->actingAs($this->user()->create())
        //     ->post(route('sponsors.store'), $sponsor->toArray())
        //     ->assertSessionHasErrors([
        //         'cnpj' => trans('validation.required', ['attribute' => 'cnpj'])
        //     ]);


        $this->sponsor()->setCnpj('68.250.251/0001-68')->create();
        $sponsor = $this->sponsor()->setCnpj('68.250.251/0001-68')->make();

        // $this->actingAs($this->user()->create())
        //     ->post(route('sponsors.store'), $sponsor->toArray())
        //     ->assertSessionHasErrors([
        //         'cnpj' => trans('validation.unique', ['attribute' => 'cnpj'])
        //     ]);
    }

    /** @test */
    public function email_field_is_optional()
    {
        $this->withoutExceptionHandling();
        $sponsor = $this->sponsor()->setEmail(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('sponsors.store'), $sponsor->toArray())
            ->assertRedirect();

        $this->assertDatabaseHas($sponsor->getTable(), [
            'email' => null
        ]);
    }

    /** @test */
    public function cre()
    {
        $this->withoutExceptionHandling();
    }
}
