<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AdImageController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)
    ->middleware('auth:sanctum');

Route::resource('ads', AdController::class)
    ->middleware('auth:sanctum');

Route::resource('ads_images', AdImageController::class)
    ->middleware('auth:sanctum');

Route::resource('branches', BranchController::class)
    ->middleware('auth:sanctum');

Route::resource('statuses', StatusController::class)
    ->middleware('auth:sanctum');

Route::resource('roles', RoleController::class)
    ->middleware('auth:sanctum');
