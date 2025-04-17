<?php

use App\Interfaces\Http\Controllers\BookingController;
use App\Interfaces\Http\Controllers\TimeSlotController;
use App\Interfaces\Http\Controllers\UserController;
use App\Interfaces\Http\Controllers\ArenaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('transaction')->group(function () {
    
    Route::group(['prefix' => 'auth'] , function () {
        Route::post('/register' , [UserController::class , 'register']);
        Route::post('/login' , [UserController::class , 'login']);
        Route::post('/logout' , [UserController::class , 'logout'])->middleware('auth:sanctum');
    });

    Route::group(['prefix' => 'arenas' , 'middleware' => ['auth:sanctum' => 'arena-owner']] , function () {
        Route::post('/add-sports' , [ArenaController::class , 'addSports']);
    });
    Route::apiResource('arenas' , ArenaController::class)->middleware('auth:sanctum');

    Route::apiResource('time-slots' , TimeSlotController::class)->middleware('auth:sanctum');

    Route::group(['prefix' => 'bookings' , 'middleware' => 'auth:sanctum'] , function () {
        Route::post('/book' , [BookingController::class , 'book']);
        Route::post('/change-status' , [BookingController::class , 'changeStatus'])->middleware('arena-owner');
        Route::get('/' , [BookingController::class , 'allBookings'])->middleware('arena-owner');
    });
});
