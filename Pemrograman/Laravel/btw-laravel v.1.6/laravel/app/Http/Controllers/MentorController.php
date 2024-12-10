<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Mentor;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Score;
use DateTime;

class MentorController extends Controller
{
    // Useful Thoughts ===============

    protected $role = 'mentor';

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

    //  Classroom Manager Functions (Mentor) ==============

    public function classroom_index(){
        if($this->checkRole()){
            // Get mentor
            $user = AuthController::logged();
            $mentor = Mentor::where('user_id','=',$user->id)->first();
            // Request Classrooms data
            $classrooms = Classroom::where('mentor_id','=',$mentor->id)->get();
            // Create view
            $view = view('mentor.classroom-index');
            $view->with('classrooms', $classrooms);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    //  Lesson Manager Functions (Mentor) ==============

    public function lesson_index($classroom_id){
        // Mentor auth (make sure the mentor is the class mentor)
        $user = AuthController::logged();
        $mentor = Mentor::where('user_id','=',$user->id)->first();
        $classroom = Classroom::where('id','=',$classroom_id)->first();
        if($this->checkRole() && $classroom->mentor_id == $mentor->id){
            // Request Lessons data
            $lessons = Lesson::where('classroom_id','=',$classroom_id)->get();
            // Create view
            $view = view('mentor.lesson-index');
            $view->with('classroom', $classroom);
            $view->with('lessons', $lessons);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function lesson_form($classroom_id){
        if($this->checkRole()){
            // Get data
            $classroom = Classroom::where('id','=',$classroom_id)->first();
            // Make sure that the classroom is active and locked
            if($classroom->is_locked != 1 && $classroom->is_active != 1){
                return $this->return_redirect('/401');
            }
            // Create View
            $view = view('mentor.lesson-form');
            $view->with('classroom', $classroom);
            $view->with('classroom_id', $classroom_id);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function lesson_create($classroom_id){
        if($this->checkRole()){
            $requests = Request::capture();
            $requests->validate(Lesson::$rules);
            // Edit date format
            $date = DateTime::createFromFormat('m/d/Y', $requests['date']);
            $requests['date'] = $date->format('Y-m-d');
            // Create Lesson
            $new_lesson = new Lesson($requests->all());
            $new_lesson->save();
            return redirect('mentor/classroom/'.$classroom_id.'/lesson');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    //  Score Manager Functions (Mentor) ==============

    public function score_index($classroom_id, $lesson_id){
        if($this->checkRole()){
            // Request Scores data
            $scores = Score::where('lesson_id','=',$lesson_id)->get();
            $lesson = Lesson::where('id','=',$lesson_id)->first();
            $students = Student::all();
            // Create view
            $view = view('mentor.score-index');
            $view->with('scores', $scores);
            $view->with('lesson', $lesson);
            $view->with('students', $students);
            $view->with('classroom_id', $classroom_id);
            $view->with('lesson_id', $lesson_id);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function score_form($classroom_id, $lesson_id){
        if($this->checkRole()){
            $view = view('mentor.score-form');
            // Get Student which at this lesson class
            $lesson = Lesson::where('id','=',$lesson_id)->first();
            $classroom = Classroom::where('id','=',$lesson['classroom_id'])->first();
            $students = Student::where('classroom_id','=',$classroom['id'])->get();
            // Create View
            $view->with('students', $students);
            $view->with('lesson', $lesson);
            $view->with('classroom', $classroom);
            $view->with('classroom_id', $classroom_id);
            $view->with('lesson_id', $lesson_id);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function score_create($classroom_id, $lesson_id){
        if($this->checkRole()){
            $requests = Request::capture();
            for($i=0;$i<count($requests['student_id']);$i++){
                $new_score = new Score();
                $new_score->lesson_id = $requests['lesson_id'][$i];
                $new_score->student_id = $requests['student_id'][$i];
                $new_score->is_present = $requests['is_present'][$i];
                $new_score->s_run = $requests['s_run'][$i];
                $new_score->s_pushup = $requests['s_pushup'][$i];
                $new_score->s_pullup = $requests['s_pullup'][$i];
                $new_score->s_situp = $requests['s_situp'][$i];
                $new_score->s_shuttle = $requests['s_shuttle'][$i];
                $new_score->save();
            }
            return redirect('/mentor/classroom/'.$classroom_id.'/lesson/'.$lesson_id.'/score');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    // Profile Editor

    public function mentor_edit_form(){
        if($this->checkRole()){
            // Get mentor_id
            $user = AuthController::logged();
            $user_id = $user->id;
            // Query Data
            $find_mentor = Mentor::where('user_id','=',$user_id)->first();
            // Return view
            $view = view('mentor.edit-form');
            $view->with('mentor', $find_mentor);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function mentor_edit_save(){
        if($this->checkRole()){
            $request = Request::capture();
            $request->validate([
                'name'=>'required|string|max:255',
                'sex'=>'required|string|max:255',
                'whatsapp'=>'required|string|max:255',
                'address'=>'required|string|max:255',
            ]);
            // Get mentor_id
            $user = AuthController::logged();
            $user_id = $user->id;
            // Query Data and proccess
            $find_mentor = Mentor::where('user_id','=',$user_id)->first();
            $find_mentor->name = $request['name'];
            $find_mentor->sex = $request['sex'];
            $find_mentor->whatsapp = $request['whatsapp'];
            $find_mentor->address = $request['address'];
            $find_mentor->save();
            return redirect('/mentor/edit');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

}
