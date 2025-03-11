<?php

namespace App\Http\Controllers;

use App\Models\EmployeesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        // Mengakses input dari request
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Menyiapkan data untuk dimasukkan ke dalam tabel
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ];

        try {
            // Menyisipkan data ke tabel 'employees'
            DB::table('employees')->insert($data);
            // Redirect ke halaman 'employees-data' dengan pesan sukses
            return redirect('employees-data')->with('success', 'Data Berhasil ditambahkan');
        } catch (Exception $e) {
            // Redirect ke halaman 'employees-add' dengan pesan error
            return redirect('employees-add')->with('error', $e->getMessage());
        }
    }

   public function insertWithValidation(Request $request)
       {
           // Membuat validasi menggunakan Validator laravel
           $validator = Validator::make(
               $request->all(),
               [
                   'name' => 'required', //Wajib disi
                   'email' => 'required|email', //Wajib disi dan harus email
                   'phone' => 'required|numeric', //Wajib disi dan harus angka, dengan panjang 11-12 angka
   
               ],
               [
                   // Memberikan pesan error jika validasi gagal
                   'name.required' => 'Kolom Nama Wajib diisi',
                   'email.required' => 'Kolom Email wajib diisi',
                   'email.email' => 'harus berupa format email',
                   'phone.required' => "Phone Wajib diisi",
                   'phone.numeric' => "Phone harus angka",
       
               ]
           );
   
           // Jika validasi gagal, redirect ke halaman 'employees-add' dengan pesan error
           if ($validator->fails()) {
               return redirect('employees-add')
                   ->with('error_validation', $validator->errors());
           }
   
           // Jika validasi berhasil, maka lanjutkan insert data
           try {
               $data = [
                   'name' => $request->name,
                   'email' => $request->email,
                   'phone' => $request->phone
               ];
               // Menyisipkan data ke tabel 'employees'
               DB::table('employees')->insert($data);
               // Redirect ke halaman 'employees-data' dengan pesan sukses
               return redirect('employees-data')->with('result', 'Data Berhasil ditambahkan');
           } catch (Exception $e) {
               // Jika terjadi error, redirect ke halaman 'employees-add' dengan pesan error
               return redirect('employees-add')->with('error', $e->getMessage());
           }
       }
       
}
