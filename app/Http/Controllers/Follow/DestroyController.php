<?php

declare(strict_types=1);

namespace App\Http\Controllers\Follow;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DestroyController
{
    public function __invoke(Request $request, User $user): RedirectResponse
    {
        $request->user()?->following()->detach($user);

        return redirect()->back();
    }
}
