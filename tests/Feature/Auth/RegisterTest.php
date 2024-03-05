<?php

use App\Models\User;
use function Pest\Laravel\postJson;

test('can register', function () {
    postJson(route('api.register'), [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => 'password',
    ])
        ->assertCreated()
         ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'token'
            ]
    ]);
});

test('cannot register without a name', function () {
    $email = fake()->email;
    User::factory()->create(['email' => $email]);

    postJson(route('api.register'), [
        'email' => $email,
        'password' => 'password',
    ])->assertUnprocessable();
});

test('cannot register with existing emails', function () {
    $email = fake()->email;
    User::factory()->create(['email' => $email]);

    postJson(route('api.register'), [
        'name' => fake()->name,
        'email' => $email,
        'password' => 'password',
    ])->assertUnprocessable();
});

test('Password must be more than 8 characters', function () {
    postJson(route('api.register'), [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => 'short',
    ])->assertUnprocessable();
});