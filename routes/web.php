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

Route::get("/students", [StudentController::class, "index"])->name("students.index")->middleware(['replace']);
Route::get("/grades", [GradeController::class, "index"])->name("grades.index");

Route::middleware(['auth'])->group(function (){
    Route::resource("students", StudentController::class)->except(['index']);
    Route::resource("grades", GradeController::class)->except(['index']);;
    Route::post('students/search', [StudentController::class, 'search'])->name('students.search')->middleware('adult');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



