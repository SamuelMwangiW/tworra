<?php

declare(strict_types=1);

use App\Models\User;

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create(['username' => 'jane.doe']));

    $response = $this->put('/user/profile-information', [
        'name' => 'Test Name',
        'email' => 'test@example.com',
        'username' => 'jane.doe',
    ]);

    expect($user->fresh())
        ->name->toEqual('Test Name')
        ->email->toEqual('test@example.com')
        ->username->toBe('jane.doe');
});

test('profile email and username can not be both updated', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/profile-information', [
        'name' => 'Test Name',
        'email' => 'test@example.com',
        'username' => 'jane.doe',
    ]);

    expect($user->fresh())
        ->name->toEqual('Test Name')
        ->email->toEqual('test@example.com')
        ->username->not->toBe('jane.doe')
        ->hasVerifiedEmail()->toBeFalse();
});
