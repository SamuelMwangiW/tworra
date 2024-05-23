<?php

declare(strict_types=1);

use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
})->skip(function () {
    return ! Features::enabled(Features::registration());
}, 'Registration support is not enabled.');

test('registration screen cannot be rendered if support is disabled', function () {
    $response = $this->get('/register');

    $response->assertStatus(404);
})->skip(function () {
    return Features::enabled(Features::registration());
}, 'Registration support is enabled.');

test('new users can register', function () {
    $this->withoutExceptionHandling();

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'username' => 'john.doe',
        'password' => $password = fake()->password(minLength: 8),
        'password_confirmation' => $password,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/');
})->skip(function () {
    return ! Features::enabled(Features::registration());
}, 'Registration support is not enabled.');

it('rejects invalid usernames to register', function (string $invalidUsername) {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'should.fail@example.com',
        'username' => $invalidUsername,
        'password' => $password = fake()->password(minLength: 8),
        'password_confirmation' => $password,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $response->assertInvalid(['username']);

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'should.fail@example.com']);
})->with('invalid-usernames')->skip(function () {
    return ! Features::enabled(Features::registration());
}, 'Registration support is not enabled.');

it('rejects reserved usernames to register', function (string $reservedUsername) {
    config()->set('tworra.reserved-usernames', [$reservedUsername]);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'should.fail@example.com',
        'username' => $reservedUsername,
        'password' => $password = fake()->password(minLength: 8),
        'password_confirmation' => $password,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $response->assertInvalid(['username']);

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'should.fail@example.com']);
})->with('reserved-usernames')->skip(function () {
    return ! Features::enabled(Features::registration());
}, 'Registration support is not enabled.');
