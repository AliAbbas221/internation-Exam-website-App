<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CodeController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\SpecializationController;

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {
    
    Route::apiResource('/questions', QuestionController::class);

    Route::apiResource('/answers', AnswerController::class);

    Route::apiResource('/terms', TermController::class);

    Route::apiResource('/codes', CodeController::class);

    Route::apiResource('/sliders', SliderController::class);

    Route::apiResource('/complaints', ComplaintController::class);

    Route::apiResource('/users', UserController::class)->except('store');

    Route::apiResource('/categories', CategoryController::class);
    // Route::get('/categories',[CategoryController::class,'index']);
    // Route::post('/category/create',[CategoryController::class,'store']);
    // Route::get('/category/show/{uuid}',[CategoryController::class,'show']);
    // Route::delete('/category/destroy/{uuid}',[CategoryController::class,'destroy']);
    // Route::put('/category/update/{uuid}',[CategoryController::class,'update']);

    Route::apiResource('/collages', CollageController::class);
    // Route::get('/collages',[CollageController::class,'index']);
    // Route::get('/collage/show/{uuid}',[CollageController::class,'show']);
    // Route::post('/collage/create',[CollageController::class,'store']);
    // Route::put('/collage/update/{uuid}',[CollageController::class,'update']);
    // Route::DELETE('/collage/destroy/{uuid}',[CollageController::class,'destroy']);

    Route::apiResource('/specializations', SpecializationController::class);
    // Route::get('/specializations',[SpecializationController::class,'index']);
    // Route::post('/specialization/create',[SpecializationController::class,'store']);
    // Route::put('/specialization/update/{uuid}',[SpecializationController::class,'update']);
    // Route::delete('/specialization/destroy/{uuid}',[SpecializationController::class,'destroy']);



});
