<?php
/*PHP/Laravel 09 Routingについて理解する
課題3
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('XXX',
    'AAA@bbb'
    );