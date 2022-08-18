<?php

declare(strict_types=1);

use App\Models\User;

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create(['username' => 'elonmusk']));

    $response = $this->put('/user/profile-information', [
        'name' => 'Elon Musk',
        'email' => 'elon@spacex.com',
        'username' => 'elonmusk',
        'url' => 'https://spacex.com',
        'location' => 'Mars',
        'description' => 'Mars & Cars, Chips & Dips',
    ]);

    expect($user->fresh())
        ->name->toEqual('Elon Musk')
        ->email->toEqual('elon@spacex.com')
        ->username->toBe('elonmusk')
        ->url->toBe('https://spacex.com')
        ->location->toBe('Mars')
        ->description->toBe('Mars & Cars, Chips & Dips');
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
