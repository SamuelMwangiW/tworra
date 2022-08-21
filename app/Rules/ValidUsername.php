<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValidUsername implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if ($this->usernameIsReserved($value)) {
            $fail('The :attribute is reserved');
        }

        if ($this->containsInvalidCharacters($value)) {
            $fail('The :attribute may only contain letters, numbers, dashes, underscores and dots.');
        };
    }

    protected function usernameIsReserved(string $value): bool
    {
        $reservedUsernames = config(
            key: 'tworra.reserved-usernames',
            default: []
        );

        return collect($reservedUsernames)->contains($value);
    }

    protected function containsInvalidCharacters(string $value): bool
    {
        return preg_match('/^[0-9A-Za-z.\-_]+$/u', $value) <= 0;
    }
}
