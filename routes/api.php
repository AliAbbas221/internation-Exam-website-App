<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\QuestionHandlingController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/collages',[CollageController::class,'index']);

Route::get('/sliders',[sliderController::class,'index']);
Route::get('/sliders/{slider}',[SliderController::class,'show']);

Route::prefix('auth')->group(function(){

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

});
    //mobile api
    Route::get('/engineerCollages', [CollageController::class,'getEngineerCollages']);
    //mobile api
    Route::get('/medicalCollages', [CollageController::class,'getMedicalCollages']);


Route::middleware(['auth:sanctum','check.collage.access'])->group(function(){
    
    Route::get('/collages/{collage}/specializations',[SpecializationController::class,'getCollageSpec']);

    Route::get('/collages/{collage}/terms/{type}', [TermController::class,'getCollageTerms']);

    Route::get('/terms/{term}/questions', [QuestionHandlingController::class,'getTermQuestions']);

    Route::get('/specializations/{specialization}/questions', [QuestionHandlingController::class,'spcializationTermQuestions']);

    Route::get('/specializations/{specialization}/bookQuestions', [QuestionHandlingController::class,'spcializationBookQuestions']);
    
    Route::get('/test/{collage}', [QuestionHandlingController::class,'getTestQuestions']);  

    //Route::get('/questions/{question}/reference', [QuestionController::class,'getReference']);

    //mobile apis
    Route::post('/complaints', [ComplaintController::class,'store']);  
    //Route::post('/favorites/{question}', [FavoriteController::class,'addFavorite']);
    //Route::delete('/favorites/{question}', [FavoriteController::class,'deleteFavorite']);
    Route::post('/favorites/{question}', [FavoriteController::class,'toggleFavorite']);
    Route::get('/favorites', [FavoriteController::class,'getFavorites']);

    Route::put('/users/{user}',[UserController::class,'update']);
    Route::get('/users/{user}',[UserController::class,'show']);
    Route::delete('/users/{user}',[UserController::class,'destroy']);

});

// Include the admin routes file

require_once __DIR__ . '/admin.php';

