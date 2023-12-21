<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Actions;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/me', UserController::class);
    Route::get('/inventory', InventoryController::class);
    Route::get('/cut', Actions\CutController::class);
});
