<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas RESTful para UserController (¡usa plural!)
Route::apiResource('users', UserController::class);
