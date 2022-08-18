<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

class ShareInertiaData
{
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::share(
            array_filter([
                'jetstream' => function () use ($request) {
                    return [
                        'canManageTwoFactorAuthentication' => Features::canManageTwoFactorAuthentication(),
                        'canUpdatePassword' => Features::enabled(Features::updatePasswords()),
                        'canRegisterAccount' => Features::enabled(Features::registration()),
                        'canUpdateProfileInformation' => Features::canUpdateProfileInformation(),
                        'hasEmailVerification' => Features::enabled(Features::emailVerification()),
                        'flash' => $request->session()->get('flash', []),
                        'hasAccountDeletionFeatures' => Jetstream::hasAccountDeletionFeatures(),
                        'hasApiFeatures' => Jetstream::hasApiFeatures(),
                        'hasTermsAndPrivacyPolicyFeature' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
                        'managesProfilePhotos' => Jetstream::managesProfilePhotos(),
                    ];
                },
                'auth' => [
                    'user' => function () use ($request) {
                        if (!$user = $request->user()) {
                            return null;
                        }

                        return array_merge($user->toArray(), [
                            'two_factor_enabled' => !is_null($user->two_factor_secret),
                        ]);
                    },
                ],
                'errorBags' => function () {
                    if (!$error = Session::get('errors')) {
                        return [];
                    }

                    /** @var \Illuminate\Support\ViewErrorBag $error */
                    return collect($error->getBags())->mapWithKeys(
                        fn($bag, $key) => [$key => $bag->messages()]
                    )->all();
                },
            ])
        );

        return $next($request);
    }
}
