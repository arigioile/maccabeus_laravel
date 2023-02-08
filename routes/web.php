<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/index.html', function () {
    return view('index');
});

Route::get('/regolamento_rilanciata.html', function () {
    return view('regolamento_rilanciata');
});


Route::get('/squadra_ril.html', function () {
    return view('squadra_ril');
});


Route::get('/regolamento_supervolley.html', function () {
    return view('regolamento_supervolley');
});


Route::get('/squadra_super.html', function () {
    return view('squadra_super');
});


Route::get('/squadra_u13f.html', function () {
    return view('squadra_u13f');
});

Route::get('/squadra_u14misto.html', function () {
    return view('squadra_u14misto');
});

Route::get('/squadra_misto.html', function () {
    return view('squadra_u14misto');
});

Route::get('/squadra_misto.html', function () {
    return view('squadra_misto');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

    Route::get('/homepagesetup', [App\Http\Controllers\HomePageSetupController::class, 'index'])->name('homepagesetup.index');

    Route::post('/result/{result}/image/upload', [App\Http\Controllers\ImageController::class, 'resultImageUpload'])->name('result.image.upload');
    Route::get('/image/{image}/reject', [App\Http\Controllers\ImageController::class, 'rejectImage'])->name('image.reject');
    Route::get('/image/{image}/accept', [App\Http\Controllers\ImageController::class, 'acceptImage'])->name('image.accept');

    Route::resource('/season/{season}/tournament', App\Http\Controllers\TournamentController::class);
    Route::get('/season/{season}/tournament/{tournament}/download_calendar', [App\Http\Controllers\TournamentController::class, 'downloadRoundsAndTeams'])->name('tournament.download_calendar');
    Route::get('/season/{season}/tournament/{tournament}/download_results', [App\Http\Controllers\TournamentController::class, 'downloadResults'])->name('tournament.download_results');
    Route::get('/season/{season}/tournament/{tournament}/evaluate_classification', [App\Http\Controllers\TournamentController::class, 'evaluateClassification'])->name('tournament.evaluate_classification');
    Route::get('/season/{season}/activate', [App\Http\Controllers\SeasonController::class, 'activate'])->name('season.activate');

    Route::resource('/result', App\Http\Controllers\ResultController::class);
    Route::resource('/team', App\Http\Controllers\TeamController::class);

    Route::resource('/season', App\Http\Controllers\SeasonController::class);
    Route::resource('/notice', App\Http\Controllers\NoticeController::class);
});
