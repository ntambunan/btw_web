<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;

class StudentManager extends Controller
{
    // Useful Thoughts ===============

    protected $role = 'admin';

    public function checkRole(): bool
    {
        $user = AuthController::logged();
        if ($user->role != $this->role) {
            return false;
        } else {
            return true;
        }
    }

    public function return_redirect($to)
    {
        return redirect($to);
    }

    public function return_view($blade)
    {
        return view($this->role . '.' . $blade)->with('user', AuthController::logged());
    }

    //  Student Manager Functions ==============

    public function student_index()
    {
        if ($this->checkRole()) {
            // Request Students data
            $students = Student::all();
            $classrooms = Classroom::all();
            // Create view
            $view = view('admin.student-index');
            $view->with('students', $students);
            $view->with('classrooms', $classrooms);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function student_registering()
    {
        if ($this->checkRole()) {
            // Request User data with role "student"
            $users = User::where('role', 'LIKE', 'student')
                ->where('role_verified', '=', 0) // Unverified
                ->get();
            // Create view
            $view = view('admin.student-registering');
            $view->with('users', $users);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function student_form($id)
    {
        if ($this->checkRole()) {
            // Query datas
            $student = Student::where('user_id', '=', $id)->first();
            $classrooms = Classroom::where('is_locked', '=', 0)->get();

            // Return View
            $view = view('admin.student-form', compact('student'));
            $view->with('classrooms', $classrooms);
            $view->with('id', $id);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function student_update(Request $requests)
    {
        if ($this->checkRole()) {
            // Tangkap request
            $requests = Request::capture();
            $requests->validate(Student::$rules);

            // Cari student berdasarkan user_id
            $student = Student::where('user_id', $requests->user_id)->first();

            // Pastikan student ditemukan
            if (!$student) {
                return $this->return_redirect('/404')->with('error', 'Student not found');
            }

            // Update data student
            $student->name = $requests->name;
            $student->sex = $requests->sex;
            $student->classroom_id = $requests->classroom_id;
            $student->address = $requests->address;
            $student->whatsapp = $requests->whatsapp;
            $student->name_wali = $requests->name_wali;
            $student->whatsapp_wali = $requests->whatsapp_wali;
            $student->status_paid = $requests->status_paid;

            // Simpan perubahan
            try {
                $student->save();
            } catch (Exception $e) {
                return $this->return_redirect('/500')->with('error', 'Failed to update student');
            }

            // Update status verifikasi pada users
            $user = User::where('id', $requests->user_id)->first();
            if ($user) {
                $user->role_verified = 1;
                $user->save();
            }

            // Redirect ke halaman index dengan pesan sukses
            return redirect('/admin/student/index')->with('success', 'Student updated successfully');
        }

        // Jika tidak memiliki hak akses
        return $this->return_redirect('/401');
    }
}
