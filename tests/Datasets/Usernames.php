<?php

declare(strict_types=1);

dataset('invalid-usernames', [
    'email@example.tld',
    'specialch+r#ct&r$',
    'sht'
]);

dataset('reserved-usernames', [
    'tweets',
    'root',
    'tweet',
    'admin',
    'dashboard',
]);
