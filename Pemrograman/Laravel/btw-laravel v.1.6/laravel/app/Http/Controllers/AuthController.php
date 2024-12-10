<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Cegah pendaftaran dengan role 'admin'
        if (strtolower($request->input('role')) == 'admin') {
            return redirect('/401');
        }

        // Validasi request sesuai rules di User model
        $request->validate(User::$rules);

        // Tambahkan field 'role_verified' ke request
        $request->merge(['role_verified' => false]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Buat user baru dan simpan ke database
            $new_user = new User();
            $new_user->fill($request->all());
            $new_user->save();

            // Buat student baru dan simpan ke database
            $new_student = new Student();
            $new_student->user_id = $new_user->id;
            $new_student->name = $request->name;
            $new_student->sex = $request->sex;
            $new_student->classroom_id = $request->classroom_id;
            $new_student->whatsapp = $request->whatsapp;
            $new_student->address = $request->address;
            $new_student->whatsapp_wali = $request->whatsapp_wali;
            $new_student->name_wali = $request->name_wali;
            $new_student->save();

            // Commit transaksi jika semua penyimpanan berhasil
            DB::commit();

            return view('register')->with('msg', 'Account registered successfully!');
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            return view('register')->with('msg', 'Failed to register new user!');
        }
    }

    public function login()
    {
        $request = Request::capture();
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check if the account is verified
        $find_user = User::where('email', '=', $request->email)->first();
        if (isset($find_user['role_verified'])) {
            if ($find_user['role_verified'] == 0 && $find_user['role'] != 'admin') {
                // 500
                return view('login')->with('msg', 'Account still not verified by Admin!');
            }
        }

        // Attempt Login
        $user = new User();
        $user->fill($request->all());
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Redirects on Role
            $role_links = [
                'admin' => 'admin/dashboard',
                'student' => 'student/dashboard',
                'mentor' => 'mentor/dashboard',
            ];
            $user = $this->logged();
            // 200
            return redirect($role_links[$user->role]);
        }

        // 500
        return view('login')->with('msg', 'Wrong credentials!');
    }

    public function logout()
    {
        Auth::logout();

        // 500
        return redirect('/login');
    }

    public static function logged()
    {
        $user = Auth::user();
        return $user;
    }
}
