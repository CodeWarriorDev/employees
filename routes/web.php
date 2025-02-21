<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeesController;
use App\Models\EmployeesModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees-data', [EmployeesController::class, 'show']);
Route::get('/employees-add', [EmployeesController::class, 'add']);
Route::post('/employees-insert', [EmployeesController::class, 'insert']);

