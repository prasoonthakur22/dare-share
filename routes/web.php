<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CreatorDetailController;
use App\Http\Controllers\DareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ResponderController;
use App\Http\Controllers\ResponderDetailController;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

#Auth
Auth::routes();

#Google Auth
// Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [SocialiteController::class, 'handleCallback']);

#User
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:web']], function () {
    Route::prefix('/admin')->group(function () {
        #Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        #Dare
        Route::get('/dares', [DareController::class, 'index']);
        Route::get('/create-dare', [DareController::class, 'create']);
        Route::get('/edit-dare/{dare_id}', [DareController::class, 'edit']);
        Route::post('/update-dare/{dare_id}', [DareController::class, 'update'])->name('update.dare');
        Route::post('/store-dare', [DareController::class, 'store'])->name('store.dare');
        Route::get('/delete-dare/{dare_id}', [DareController::class, 'delete'])->name('delete.dare');

        #Quizzes
        Route::get('/add-quizze/{dare_id}', [QuizzeController::class, 'addQuizze']);
        Route::get('/view-quizze/{dare_id}', [QuizzeController::class, 'viewQuizze']);
        Route::get('/edit-quizze/{quizze_id}', [QuizzeController::class, 'editQuizze']);
        Route::post('/update-quizze/{quizze_id}', [QuizzeController::class, 'updateQuizze'])->name('update.quizze');
        Route::post('/store-quizze', [QuizzeController::class, 'storeQuizze'])->name('store.quizze');
        Route::get('/delete-quizze/{quizze_id}', [QuizzeController::class, 'deleteQuizze'])->name('delete.quizze');

        #Choices
        Route::get('/add-choice/{dare_id}', [ChoiceController::class, 'addChoice']);
        Route::get('/view-choice/{dare_id}', [ChoiceController::class, 'viewChoice']);
        Route::get('/edit-choice/{choice_id}', [ChoiceController::class, 'editChoice']);
        Route::post('/update-choice/{choice_id}', [ChoiceController::class, 'updateChoice'])->name('update.choice');
        Route::post('/store-choice', [ChoiceController::class, 'storeChoice'])->name('store.choice');
        Route::get('/delete-choice/{dare_id}', [ChoiceController::class, 'deleteChoice'])->name('delete.choice');
    });
});

#Creators
Route::prefix('creator')->group(function () {
    Route::get('/{dare_id}', [CreatorController::class, 'index'])->name('store.index');
    Route::post('/store/{dare_id}', [CreatorController::class, 'store'])->name('store.creator');
    // Route::get('/delete/{creator_id}', [CreatorController::class, 'delete'])->name('delete.creator');
});

#CreatorDetails
Route::prefix('creator_details')->group(function () {
    Route::get('/{dare_id}', [CreatorDetailController::class, 'index']);
    Route::post('/{dare_id}', [CreatorDetailController::class, 'store'])->name('store.creator_details');
    Route::post('/delete/alldata', [CreatorDetailController::class, 'delete']);
});

#Responder
Route::prefix('responder')->group(function () {
    Route::get('/{share_url}', [ResponderController::class, 'index']);
    Route::post('/{share_url}', [ResponderController::class, 'store'])->name('store.responder');
});

#ResponderDetails
Route::prefix('responder_details')->group(function () {
    // Route::get('/{share_url}', [ResponderDetailController::class, 'index']);
    Route::post('/{creator_id}', [ResponderDetailController::class, 'store'])->name('store.responder_details');
});

#Static pages
Route::get('/about-site', [StaticController::class, 'about']);
Route::get('/privacy-policy', [StaticController::class, 'privacy']);
