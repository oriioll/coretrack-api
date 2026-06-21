<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuscleController;

Route::get('/test', function (Request $request) {
    return response()->json([
        "success" => true,
    ]);
});

Route::get('/muscles', [MuscleController::class, 'index']);

Route::get('/exercices/muscle/{muscleId}', [MuscleController::class, 'showExercisesByMuscles']);
