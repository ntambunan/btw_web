<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Lesson;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class ScoreManager extends Controller
{
    // Useful Thoughts
    protected $role = 'admin';

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

    //  Score Manager Functions ==============

    public function score_index($classroom_id, $lesson_id){
        if($this->checkRole()){
            // Request Scores data
            $scores = Score::where('lesson_id','=',$lesson_id)->get();
            $lesson = Lesson::where('id','=',$lesson_id)->first();
            $students = Student::all();
            // Create view
            $view = view('admin.score-index');
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
            $view = view('admin.score-form');
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
            return redirect('/admin/classroom/'.$classroom_id.'/lesson/'.$lesson_id.'/score');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }
}
