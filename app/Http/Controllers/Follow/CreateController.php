<?php

declare(strict_types=1);

namespace App\Http\Controllers\Follow;

use App\Models\User;
use App\Notifications\UserWasFollowed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateController
{
    public function __invoke(Request $request, User $user): RedirectResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();
        $authUser->following()->attach($user);
        $user->notify(new UserWasFollowed(follower: $authUser));

        return redirect()->back();
    }
}
