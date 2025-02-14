<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeesModel extends Model
{
    
    // nama tabel yang digunakan
    protected $table = 'employees';

    // field apa saja yang boleh diisi
    protected $fillable = [];

    public function get(){
        return DB::table('employees')
        ->get();
    }
}
