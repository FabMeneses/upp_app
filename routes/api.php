<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController; // Ensure this matches the actual namespace and class name

// If the class does not exist, create it in the specified namespace

// Rutas RESTful para UserController (¡usa plural!)
Route::apiResource('users', UserController::class);

// routes/api.php
Route::post('/login', [AuthController::class, 'login']);
