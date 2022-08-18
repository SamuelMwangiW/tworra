<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia;

test('users must be logged in to view the timeline')
    ->get('/')
    ->assertRedirect('login');

test('users can view the timeline', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertInertia(
            fn(AssertableInertia $page) => $page->component('Timeline')
        );
});
