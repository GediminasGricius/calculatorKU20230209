<?php

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculator', [CalculatorController::class, "showForm"] )->name("form");
Route::post( '/calculator/result', [CalculatorController::class, "showResult"])->name("result");

Route::post('students/search', [StudentController::class, 'search'])->name('students.search');
Route::resource("students", StudentController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource("grades", GradeController::class);
