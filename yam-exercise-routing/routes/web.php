<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    global $users;
    $name = array_column($users, 'name');
    $returnString = 'The users are: ' . implode(', ', $name);
    return $returnString;
});

Route::get('/api/user', function () {
    global $users;
    return response()->json($users);
});


