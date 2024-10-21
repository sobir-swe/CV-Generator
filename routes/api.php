<?php

use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\SocialNetworkController;
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

Route::resource('/skills', SkillController::class)
    ->middleware('auth:sanctum');

Route::post('/users/{userId}/skills/attach', [SkillController::class, 'attachSkill'])
    ->middleware('auth:sanctum');

Route::delete('/users/{userId}/skills/detach', [SkillController::class, 'detachSkill'])
    ->middleware('auth:sanctum');

Route::resource('/social_networks', SocialNetworkController::class)
    ->middleware('auth:sanctum');

Route::post('/users/{userId}/social_networks/attach', [SocialNetworkController::class, 'attachSocialNetwork'])
    ->middleware('auth:sanctum');

Route::delete('/users/{userId}/social_networks/detach', [SocialNetworkController::class, 'detachSocialNetwork'])
    ->middleware('auth:sanctum');

