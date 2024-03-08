<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $response = Http::get('http://127.0.0.1:8000/api/tes');
    $users = $response->json(); // Mengambil data JSON dari respons

    return view('welcome', compact('users')); // Mengirim data pengguna ke tampilan welcome
});

Route::get('/list-user', function () {
    // $theUrl     = config('app.guzzle_test_url').'/api/users/';
    $users   = Http::get('http://127.0.0.1:8000/api/tes');
    // return 'hello';
    dd("hello");
    return;
    // return $users;
});
