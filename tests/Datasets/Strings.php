<?php

declare(strict_types=1);

dataset('tweets', [
    fn () => fake()->sentences(asText: true),
    fn () => fake()->sentence(),
    fn () => fake()->word() . ' tweet',
]);
