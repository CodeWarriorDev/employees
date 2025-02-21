<?php

namespace App\Http\Controllers;

use App\Models\EmployeesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{

    public function show()
    {
        // Mengambil semua data dari tabel 'employees'
        $employees = DB::table('employees')->get();

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'title' => 'Data Karyawan', // Judul halaman
            'employees' => $employees  // Daftar karyawan
        ];

        // Mengembalikan view 'employees.show' dengan data
        return view('employees.show', $data);
    }
    public function add()
    {
        $data = [
            'title' => "Menambahkan Data Karyawan",
        ];
        return view('employees.add', $data);
    }

    //INSERT DATA
    public function insert(Request $request)
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // dd($name, $email, $phone);

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];
        // DB::table('employees')->insert($data);

        try {
            DB::table('employees')->insert($data);
            return redirect('employees-data')->with('success','Data Berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect('employees-add')->with('error', $e->getMessage());
            // return redirect('employees-add')->with('error', 'Data gagal ditambahkan');

         
        }
    }
}
