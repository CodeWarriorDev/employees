<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeesController;
use App\Models\EmployeesModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', [EmployeesController::class, 'show']);

