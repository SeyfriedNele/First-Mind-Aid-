<?php

use App\Models\Kit;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

it('kit index loads for authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('kit.index'))
        ->assertStatus(200);
});

it('kit create page loads for authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('kit.create'))
        ->assertStatus(200);
});

it('can store a new kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    $response = $this->actingAs($user)
        ->post(route('kit.store'), [
            'title' => 'Feature Test Kit',
            'post' => 'Content from feature test',
        ]);

    Model::reguard();

    $response->assertRedirect(route('kit.index'));

    $this->assertDatabaseHas('kits', [
        'title' => 'Feature Test Kit',
        'post' => 'Content from feature test',
    ]);
});

it('can show, edit, update and delete a kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    // create initial kit
    $kit = Kit::create([
        'title' => 'Initial Kit',
        'post' => 'Initial post',
        'created_by' => $user->id,
    ]);

    Model::reguard();

    // show
    $this->actingAs($user)
        ->get(route('kit.show', $kit))
        ->assertStatus(200)
        ->assertSee('Initial Kit');

    // edit page
    $this->actingAs($user)
        ->get(route('kit.edit', $kit))
        ->assertStatus(200)
        ->assertSee('Initial Kit');

    // update
    Model::unguard();

    $this->actingAs($user)
        ->put(route('kit.update', $kit), [
            'title' => 'Updated Kit',
            'post' => 'Updated post',
        ])
        ->assertRedirect(route('kit.index'));

    Model::reguard();

    $this->assertDatabaseHas('kits', [
        'title' => 'Updated Kit',
        'post' => 'Updated post',
    ]);

    // delete
    $this->actingAs($user)
        ->delete(route('kit.destroy', $kit))
        ->assertRedirect(route('kit.index'));

    $this->assertDatabaseMissing('kits', [
        'title' => 'Updated Kit',
    ]);
});

it('can show a kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    $kit = Kit::create([
        'title' => 'Show Kit',
        'post' => 'Show post',
        'created_by' => $user->id,
    ]);

    Model::reguard();

    $this->actingAs($user)
        ->get(route('kit.show', $kit))
        ->assertStatus(200)
        ->assertSee('Show Kit');
});

it('can load edit page for a kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    $kit = Kit::create([
        'title' => 'Edit Kit',
        'post' => 'Edit post',
        'created_by' => $user->id,
    ]);

    Model::reguard();

    $this->actingAs($user)
        ->get(route('kit.edit', $kit))
        ->assertStatus(200)
        ->assertSee('Edit Kit');
});

it('can update a kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    $kit = Kit::create([
        'title' => 'To Update Kit',
        'post' => 'To update post',
        'created_by' => $user->id,
    ]);

    Model::reguard();

    $this->actingAs($user)
        ->put(route('kit.update', $kit), [
            'title' => 'Updated Separately',
            'post' => 'Updated separately',
        ])
        ->assertRedirect(route('kit.index'));

    $this->assertDatabaseHas('kits', [
        'title' => 'Updated Separately',
    ]);
});

it('can delete a kit', function () {
    $user = User::factory()->create();

    Model::unguard();

    $kit = Kit::create([
        'title' => 'To Delete Kit',
        'post' => 'To delete post',
        'created_by' => $user->id,
    ]);

    Model::reguard();

    $this->actingAs($user)
        ->delete(route('kit.destroy', $kit))
        ->assertRedirect(route('kit.index'));

    $this->assertDatabaseMissing('kits', [
        'title' => 'To Delete Kit',
    ]);
});
