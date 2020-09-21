<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;


class UserTest extends TestCase
{
    /** @test */
    function it_should_authenticated()
    {
        $this->post(route('usuarios.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    function it_should_store_in_database()
    {
        Carbon::setTestNow(now());

        $user1 = factory(User::class)->create();

        $this->actingAs($user1)
            ->post(route('usuarios.store'), $user1->toArray());

        $this->assertDatabaseHas('users', [
            'id' => $user1->id,
            'name' => $user1->name,
            'email' => $user1->email,
            'email_verified_at' => now(),
            'password' => $user1->password,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /** @test */
    function name_field_email_field_password_field_is_required()
    {
        $user = $this->user()->setName(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray())
            ->assertSessionHasErrors([
                'name'
            ]);

        $user = $this->user()->setEmail(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray())
            ->assertSessionHasErrors([
                'email'
            ]);

        $user = $this->user()->setPassword(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray())
            ->assertSessionHasErrors([
                'password'
            ]);
    }

    /** @test */
    function it_should_show_a_move_search()
    {
        $user = $this->user()->make();

        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray());

        $user = User::first();

        $this->assertEquals($user->id, User::first()->id);
    }

    /** @test */
    function it_should_list_allUsers()
    {
        Carbon::setTestNow(now());

        $user = $this->user()->make();

        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray());

        $response = $this->get('/usuarios')
            ->assertOk();
    }

    /** @test */
    function user_can_be_deleted()
    {
        $user = $this->user()->make();

        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray());

        $user = User::first();

        $response = $this->delete('usuarios/' . $user->id);

        $this->assertCount(0, User::all());
    }
}
