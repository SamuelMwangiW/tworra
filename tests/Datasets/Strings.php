<?php

dataset('tweets', [
    fn() => fake()->sentences(asText: true),
    fn() => fake()->sentence(),
    fn() => fake()->word(),
]);
