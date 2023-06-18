<?php

it('should register a new user from api', function () {
    $response = $this
        ->post('/api/register', [
            'name' => 'foo',
            'email' => 'foo@bar.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $response->assertOk();
});
