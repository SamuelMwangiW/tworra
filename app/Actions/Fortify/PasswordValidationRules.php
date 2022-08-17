<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Rules\Password as FortifyPassword;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int,mixed>
     */
    protected function passwordRules(): array
    {
        return App::isProduction()
            ? $this->securePasswordRules()
            : $this->localPasswordRules();
    }

    /**
     * Validation rules used to validate passwords in production.
     *
     * @return array<int,mixed>
     */
    protected function securePasswordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(5)->uncompromised(),
            'confirmed',
        ];
    }

    /**
     * Validation rules used to validate passwords locally.
     *
     * @return array<int,mixed>
     */
    protected function localPasswordRules(): array
    {
        return [
            'required',
            'string',
            new FortifyPassword(),
            'confirmed',
        ];
    }
}
