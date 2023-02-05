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
