<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function () {
    global $users;
    return response()->json($users);
});


Route::get('/user/{userIndex}', function ($userIndex) {
    global $users;

    $userIndex = (int)$userIndex;

    if (isset($users[$userIndex])) {
        return response()->json($users[$userIndex]);
    } else {
        return "Cannot find the user with index {$userIndex}";
    }
});

Route::get('/user/{userName}', function ($userName) {
    global $users;

    foreach ($users as $user) {
        if ($user['name'] === $userName) {
            return response()->json($user);
        }
    }
    return response()->json(["error" => "Cannot find the user with name '{$userName}'"], 404);
});

Route::prefix('/user')->group(function () {
    Route::get('/user', function () {
        global $users;
        return response()->json($users);
    });

    Route::get('/user/{userIndex}', function ($userIndex) {
        global $users;

        $userIndex = (int)$userIndex;

        if (isset($users[$userIndex])) {
            return response()->json($users[$userIndex]);
        } else {
            return response()->json(["error" => "Cannot find the user with index {$userIndex}"], 404);
        }
    });

    Route::get('/user/{userName}', function ($userName) {
        global $users;

        foreach ($users as $user) {
            if ($user['name'] === $userName) {
                return response()->json($user);
            }
        }
        return response()->json(["error" => "Cannot find the user with name '{$userName}'"], 404);
    });

    Route::get('/user/{userIndex}/post/{postIndex}', function ($userIndex, $postIndex) {
        global $users;
        $userIndex = (int)$userIndex;
        $postIndex = (int)$postIndex;
        if (isset($users[$userIndex])) {
            $user = $users[$userIndex];
            if(isset($user['posts'][$postIndex])){
                return $user['posts'][$postIndex];
                // return response()->json($user['posts'][$postIndex]);
            }
            else{
                return '{$userIndex} is error';
            }
        } else {
            return response()->json(["error" => "Cannot find the user with index {$userIndex}"], 404);
        }
    });

    Route::fallback(function () {
        return response()->json(['error' => 'Invalid request'], 400);
    });

    
});
