<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\OfficeSpaceController;
use App\Http\Controllers\Api\BookingTransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//middleware apikey untuk memeriksa apakah api key valid
Route::middleware('api_key')->group(function(){  //api-key diambil dari app.php
    
    //method get hanya untuk mengambil data    
    //tapi kita bisa juga menggunakan method get untuk mengambil data tertentu
    Route::get('/city/{city:slug}', [CityController::class, 'show']);

    //method resource bisa dipakai untuk CRUD tanpa perlu get 
    //cukup resource sebenernya sudah cukup untuk semuanya
    Route::apiResource('/cities', CityController::class); 

    Route::get('/office/{officeSpace:slug}', [OfficeSpaceController::class, 'show']);
    Route::apiResource('/offices', OfficeSpaceController::class);
    
    Route::post('/booking-transaction', [BookingTransactionController::class, 'store']);//method post untuk menyimpan data
    Route::post('/check-booking', [BookingTransactionController::class, 'booking_details']); 

});