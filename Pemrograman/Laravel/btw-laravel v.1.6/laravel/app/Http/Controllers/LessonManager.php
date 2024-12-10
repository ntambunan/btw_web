<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Classroom;
use Illuminate\Http\Request;
use DateTime;

class LessonManager extends Controller
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

    //  Lesson Manager Functions ==============

    public function lesson_index($classroom_id){
        if($this->checkRole()){
            // Request Lessons data
            $lessons = Lesson::where('classroom_id','=',$classroom_id)->get();
            $classroom = Classroom::where('id','=',$classroom_id)->first();
            // Create view
            $view = view('admin.lesson-index');
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
            $view = view('admin.lesson-form');
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
            return redirect('admin/classroom/'.$classroom_id.'/lesson');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }
}
