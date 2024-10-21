<?php

use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class)
    ->middleware('auth:sanctum');

Route::post('/users/{userId}/languages/attach', [LanguageController::class, 'attachLanguage'])
    ->middleware('auth:sanctum');

Route::delete('/users/{userId}/languages/detach', [LanguageController::class, 'detachLanguage'])
    ->middleware('auth:sanctum');

Route::resource('/projects', ProjectController::class)
    ->middleware('auth:sanctum');

Route::resource('/experiences', ExperienceController::class)
    ->middleware('auth:sanctum');

Route::resource('/educations', EducationController::class)
    ->middleware('auth:sanctum');

Route::resource('/languages', LanguageController::class)
    ->middleware('auth:sanctum');


