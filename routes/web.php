<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\covidController;
/*Illuminate\Contracts\Container\BindingResolutionException
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/search', 'App\Http\Controllers\covidController@search');
Route::get('/covid', 'App\Http\Controllers\covidController@index');
Route::post('/covid', 'App\Http\Controllers\covidController@filterByCountry');

require __DIR__.'/auth.php';
