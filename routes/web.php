<?php

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
use App\User;
use App\Notifications\NotifySlack;

Route::get('/', function () {
    $animal = ["dog", "cat", "mouse", "monkey"];

    return view('home', [
        "animals" => $animal
    ]);
});
Route::get('/{animal}', function ($animal) {
    $user = new User();
    $user->notify(new NotifySlack($animal));

    return redirect('/');
});
