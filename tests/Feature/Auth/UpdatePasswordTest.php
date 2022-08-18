<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password can be updated', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/password', [
        'current_password' => 'password',
        'password' => $password = fake()->password(minLength: 8),
        'password_confirmation' => $password,
    ]);

    expect(Hash::check($password, $user->fresh()->password))->toBeTrue();
});

test('current password must be correct', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/password', [
        'current_password' => 'wrong-password',
        'password' => $password = fake()->password(minLength: 8),
        'password_confirmation' => $password,
    ]);

    $response->assertSessionHasErrors();

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});

test('new passwords must match', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});
