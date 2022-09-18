<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth:teacher,web'], function () {
  Route::get('classes/{id?}', [AjaxController::class, 'getClasses']);
  Route::get('sections/{id?}', [AjaxController::class, 'getSections']);
});
