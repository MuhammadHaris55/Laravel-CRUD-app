<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/index',  function() {
    return view('welcome');
});

Route::get('/',[EmployeeController::class,'index'])->name('index_view');


Route::post('store',[EmployeeController::class, 'store'])->name('employee_store');

Route::get('employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees_edit');

Route::put('employees', [EmployeeController::class, 'update'])->name('employees_update');

Route::post('destroy/{id}', [EmployeeController::class,'destroy'])->name('employees_destroy');