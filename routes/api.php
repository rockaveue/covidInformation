<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/summary', function(){
    $jsonResponse = Http::get('https://api.covid19api.com/summary');
    $response = json_decode($jsonResponse);
    return response($jsonResponse, 200);
});

Route::get('/dayone/mongolia', function(){
    $jsonResponse2 = Http::get('https://api.covid19api.com/dayone/country/mongolia');
    $dayone = json_decode($jsonResponse2);
    return $dayone;
});

Route::get('dayone/{slug}', function($slug){
    $jsonResponse3 = Http::get('https://api.covid19api.com/dayone/country/'.$slug);
    $dayone = json_decode($jsonResponse3);
    return $dayone;
});
