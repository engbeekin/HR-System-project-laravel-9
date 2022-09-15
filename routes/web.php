<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EmployeTypeController;
use App\Models\EmployeType;
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

Route::resource('/employee', EmployeController::class);
Route::resource('/country', CountryController::class);
Route::resource('/department', DepartmentController::class);
Route::resource('/employee_type', EmployeTypeController::class);

Route::get('/employee/delete/{id}', [EmployeController::class, 'destroy']);


require __DIR__.'/auth.php';
