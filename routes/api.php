<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    AuthController
}

Route::prefix('v1')->group(function () {

    // ══════════════════════════════════════════════════════
	// AUTH
	// ══════════════════════════════════════════════════════

	Route::prefix('auth')->name('auth.')->group(function () {
		Route::middleware('throttle:5,1')->group(function () {
			Route::post('login', [AuthController::class, 'login'])
						->name('login');
		});
    });
});
