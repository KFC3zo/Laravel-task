<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return 'About Page';
});
Route::get('/contact', function () {
    return 'Contact Page';
});

Route::get('/log-test', function () {
    Log::info('This is a test log from Telescope example.');
    return 'Log added!';
});
Route::get('/error-test', function () {
    throw new \Exception('This is a test exception!');
});
use App\Events\TestEvent;

Route::get('/event-test', function () {
    event(new TestEvent());
    return 'Event triggered!';
});
Route::get('/query-test', function () {
    DB::table('users')->get();
    return 'Query executed!';
});