<?php

declare(strict_types=1);

use App\Http\Controllers\Tweets\TimelineController;
use Illuminate\Support\Facades\Route;

Route::get('/', TimelineController::class)->name('timeline');
