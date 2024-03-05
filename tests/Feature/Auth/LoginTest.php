<?php

use App\Models\User;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\postJson;

test('can login', function () {

    $email = fake()->email;

    User::factory()->create([
        'email' => $email,
        'password' => bcrypt('password'),
    ]);

    postJson(route('api.login'), [
        'email' => $email,
        'password' => 'password',
    ])
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'token'
            ]
        ]);
});

test('cannot login with invalid wrong email', function () {

    $email = fake()->email;

    User::factory()->create([
        'email' => $email,
        'password' => bcrypt('password'),
    ]);

    postJson(route('api.login'), [
        'email' => fake()->email,
        'password' => 'password',
    ])->assertUnprocessable();
});

test('cannot login with invalid wrong password', function () {

    $email = fake()->email;

    User::factory()->create([
        'email' => $email,
        'password' => bcrypt('password'),
    ]);

    postJson(route('api.login'), [
        'email' => $email,
        'password' => fake()->password,
    ])->assertUnprocessable();
});