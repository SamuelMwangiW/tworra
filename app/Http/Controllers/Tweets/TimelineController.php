<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tweets;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class TimelineController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render(
            component: 'Timeline',
            props: [
                'canRegisterAccount' => Features::enabled(Features::registration()),
            ]
        );
    }
}
