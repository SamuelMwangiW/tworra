<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param User $user
     * @param array<string,mixed> $input
     * @return void
     */
    public function update($user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'min:4', 'max:255', Rule::unique('users')->ignore($user->id)],
            'url' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:300'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        $profilePhoto = data_get($input, 'photo');

        if ($profilePhoto instanceof UploadedFile) {
            $user->updateProfilePhoto($profilePhoto);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'username' => $input['username'],
                'url' => data_get($input, 'url'),
                'location' => data_get($input, 'location'),
                'description' => data_get($input, 'description'),
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param User $user
     * @param array<string,mixed> $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'url' => data_get($input, 'url'),
            'location' => data_get($input, 'location'),
            'description' => data_get($input, 'description'),
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
