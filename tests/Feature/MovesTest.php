<?php

namespace Tests\Feature;

use App\Moves;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;

class MovesTest extends TestCase
{
    /** @test */
    function it_should_be_authenticated()
    {
        $this->post(route('movimentacoes.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    function it_should_store_in_database()
    {
        Carbon::setTestNow(now());

        $user = factory(User::class)->create();

        $moves = factory(Moves::class)->make();

        $this->actingAs($user)
            ->post(route('movimentacoes.store'), $moves->toArray());

        $this->assertDatabaseHas('moves', [
            'description' => $moves->description,
            'date' => $moves->date,
            'value' => $moves->value,
            'type' => $moves->type,
            'specification' => $moves->specification,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /** @test */
    function description_date_value_type_specification_field_is_required()
    {
        $moves = $this->moves()->setDescription(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $moves->toArray())
            ->assertSessionHasErrors([
                'description'
            ]);

        $moves = $this->moves()->setDate(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $moves->toArray())
            ->assertSessionHasErrors([
                'date'
            ]);

        $moves = $this->moves()->setValue(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $moves->toArray())
            ->assertSessionHasErrors([
                'value'
            ]);

        $moves = $this->moves()->setType(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $moves->toArray())
            ->assertSessionHasErrors([
                'type'
            ]);

        $moves = $this->moves()->setEspecification(null)->make();
        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $moves->toArray())
            ->assertSessionHasErrors([
                'specification'
            ]);
    }
    /** @test */
    function it_should_show_a_move_search()
    {
        $move = $this->moves()->make();

        $response =  $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $move->toArray());

        $this->assertEquals($move->description, Moves::first()->description);
        $this->assertEquals($move->date, Moves::first()->date);
        $this->assertEquals($move->value, Moves::first()->value);
        $this->assertEquals($move->type, Moves::first()->type);
        $this->assertEquals($move->specification, Moves::first()->specification);
    }

    /** @test */
    function it_should_list_allMoves()
    {
        Carbon::setTestNow(now());

        $this->actingAs($this->user()->create());

        $response = $this->get('/movimentacoes')
            ->assertOk();
    }

    /** @test */
    function move_can_be_updated()
    {
        $move = $this->moves()->make();

        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $move->toArray());

        $move = Moves::first();

        $newmove = $this->moves()->make();

        $response = $this->put('movimentacoes/' . $move->id, $newmove->toArray());

        $this->assertEquals($newmove->description, Moves::first()->description);
        $this->assertEquals($newmove->date, Moves::first()->date);
        $this->assertEquals($newmove->value, Moves::first()->value);
        $this->assertEquals($newmove->type, Moves::first()->type);
        $this->assertEquals($newmove->specification, Moves::first()->specification);
    }

    /** @test */
    function move_can_be_deleted()
    {
        $move = $this->moves()->make();

        $this->actingAs($this->user()->create())
            ->post(route('movimentacoes.store'), $move->toArray());

        $move = Moves::first();

        $response = $this->delete('movimentacoes/' . $move->id);

        $this->assertCount(0, Moves::all());
        // $response->assertRedirect(route('movimentacoes.index'));
    }
}
