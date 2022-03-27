<?php

use App\Http\Controllers\Api\FileUploadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Twitter\TwitterController;
use App\Http\Controllers\Twitter\LikeController;
use App\Http\Controllers\Practice\PracticeController;
use App\Http\Controllers\TypeScript\TypeScriptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/twitters', [TwitterController::class, 'index'])
    ->name('twitter.index')->middleware('auth');

Route::put("/twitters", [TwitterController::class, 'profileUpdate'])->name('twitter.profile.update');

Route::post('/twitters/fileupload', [TwitterController::class, 'fileUpload'])->name('twitter.fileupload');

Route::get('/practice', [PracticeController::class, 'index'])
    ->name('practice.index')->middleware('auth');

Route::get('/typescript', [TypeScriptController::class, 'index'])
    ->name('typescript.index')->middleware('auth');

Route::get("/twitters/create", [TwitterController::class, 'create'])->name('twitter.create');

Route::get("/twitters/{post}", [TwitterController::class, 'edit'])->name('twitter.edit');

Route::get("/twitters/{post}/likes", [LikeController::class, 'index'])->name('twitter.likes');

Route::post('/twitters/{post}/like', [LikeController::class, 'store'])->name('twitter.like');

Route::delete('/twitters/{post}/unlike', [LikeController::class, 'destroy'])->name('twitter.unlike');

Route::put("/twitters/{post}", [TwitterController::class, 'update'])->name('twitter.update');

Route::delete("/twitters/{post}", [TwitterController::class, 'destroy'])->name('twitter.destroy');

Route::resource('/twitters', TwitterController::class)->only([
    'index',
    'store'
])->names([
    'index' => 'twitter.index',
    'store' => 'twitter.store'
])->middleware(['auth']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
