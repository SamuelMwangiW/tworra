<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int,string|Password>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(4)->uncompromised(),
            'confirmed',
        ];
    }
}
