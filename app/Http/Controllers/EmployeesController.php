<?php

namespace App\Http\Controllers;

use App\Models\EmployeesModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    //

    public function show()
    {

        $employees = DB::table('employees')
            ->get();

        $data = [
            'employees' => $employees
        ];

        return view('employees/show', $data);
    }
}
