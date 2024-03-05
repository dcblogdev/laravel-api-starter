<?php

use App\Models\User;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\postJson;

test('can login', function () {

    assertGuest();

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

    assertGuest();

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

    assertGuest();

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