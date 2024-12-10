<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    // Useful Thoughts ===============

    protected $role = 'student';

    public function checkRole() : bool {
        $user = AuthController::logged();
        if($user->role != $this->role){
            return false;
        } else {
            return true;
        }
    }

    public function return_redirect($to) {
        return redirect($to);
    }

    public function return_view($blade) {
        return view($this->role.'.'.$blade)->with('user', AuthController::logged());
    }

    // View Controllers ==============

    public function dashboard(){
        if($this->checkRole()){
            return $this->return_view('dashboard');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function student_edit_form(){
        if($this->checkRole()){
            // Get student_id
            $user = AuthController::logged();
            $user_id = $user->id;
            // Query Data
            $find_student = Student::where('user_id','=',$user_id)->first();
            // Return view
            $view = view('student.edit-form');
            $view->with('student', $find_student);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function student_edit_save(){
        if($this->checkRole()){
            $request = Request::capture();
            $request->validate([
                'name'=>'required|string|max:255',
                'sex'=>'required|string|max:255',
                'name_wali'=>'required|string|max:255',
                'whatsapp_wali'=>'required|string|max:255',
                'address'=>'required|string|max:255',
                'whatsapp'=>'required|string|max:255',
            ]);
            // Get student_id
            $user = AuthController::logged();
            $user_id = $user->id;
            // Query Data and proccess
            $find_student = Student::where('user_id','=',$user_id)->first();
            $find_student->name = $request['name'];
            $find_student->sex = $request['sex'];
            $find_student->name_wali = $request['name_wali'];
            $find_student->whatsapp_wali = $request['whatsapp_wali'];
            $find_student->address = $request['address'];
            $find_student->whatsapp = $request['whatsapp'];
            $find_student->save();
            return redirect('/student/edit');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function score_index(){
        if($this->checkRole()){
            // Get student_id
            $user = AuthController::logged();
            $student = Student::where('user_id','=',$user->id)->first();
            // Get data from score and lesson
            $scores = Score::where('student_id','=',$student->id)->get();
            $lessons = Lesson::where('classroom_id','=',$student->classroom_id)->get();
            $classroom = Classroom::where('id','=',$student->classroom_id)->first();
            // Return view
            $view = view('student.score-index');
            $view->with('scores', $scores);
            $view->with('lessons', $lessons);
            $view->with('classroom', $classroom);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

}
