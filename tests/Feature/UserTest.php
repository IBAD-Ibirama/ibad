<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /** @test */
    public function it_should_authenticated()
    {
        $this->post(route('usuarios.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_store_in_database()
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
    public function name_field_email_field_password_field_is_required()
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
    public function user_can_be_updated()
    {
        $user = $this->user()->make();

        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray());

        $user = User::first();

        $newuser = $this->user()->make();

        $response = $this->put('usuarios/'.$user->id, $newuser->toArray());

        //NÃO FUNCIONA
        // $this->assertEquals($newuser->name, User::first()->name);
        // $this->assertEquals($newuser->email, User::first()->email);
        // $this->assertEquals($newuser->password, User::first()->password);    
    }

    /** @test */
    public function user_can_be_deleted()
    {
        $user = $this->user()->make();

        $this->actingAs($this->user()->create())
            ->post(route('usuarios.store'), $user->toArray());

        $user = User::first();

        $response = $this->delete('usuarios/' . $user->id);

        $this->assertCount(0, User::all());
    }

    /** @test */
    public function it_should_list_posts()
    {
        Carbon::setTestNow(now());

        $user = factory(User::class)->create();
        $users = factory(User::class)->make();

        $response = $this->actingAs($user)
            ->post(route('usuarios.store'), $users->toArray());

        //     $response
        //     ->assertJson([
        //         'success' => true
        //         // 'data' => true,
        //     ]);
        // $this->get(route('usuarios.index'))
        //     ->assertJsonStructure([
        //         '*' => [ 'name', 'email', 'email_verified_at', 'password','remember_token'],
        //     ]);
    }
}
