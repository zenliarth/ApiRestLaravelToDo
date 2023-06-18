<?php

use App\Models\User;

it('should register a new user from api', function () {
    $user = User::factory()->create();

    $response = $this
        ->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

    $response->assertOk();
});
