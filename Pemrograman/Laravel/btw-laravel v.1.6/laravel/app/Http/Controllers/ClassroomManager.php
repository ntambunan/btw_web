<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Mentor;
use Illuminate\Http\Request;

class ClassroomManager extends Controller
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

    //  Classroom Manager Functions ==============

    public function classroom_index(){
        if($this->checkRole()){
            // Request Classrooms data
            $classrooms = Classroom::all();
            $mentors = Mentor::all();
            // Create view
            $view = view('admin.classroom-index');
            $view->with('classrooms', $classrooms);
            $view->with('mentors', $mentors);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function classroom_form(){
        if($this->checkRole()){
            // Query datas
            $mentors = Mentor::all();
            // Create View
            $view = view('admin.classroom-form');
            $view->with('mentors', $mentors);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function classroom_create(){
        if($this->checkRole()){
            $requests = Request::capture();
            $requests->validate(Classroom::$rules);
            // Create Classroom
            $new_classroom = new Classroom($requests->all());
            $new_classroom->save();
            return redirect('/admin/classroom/index');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function classroom_lock($id){
        if($this->checkRole()){
            $requests = Request::capture();
            // Lock Classroom
            $find_classroom = Classroom::where('id','=',$id)->first();
            $find_classroom->is_locked = 1;
            $find_classroom->save();
            // Redirect
            return redirect('/admin/classroom/index');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function classroom_deactivate($id){
        if($this->checkRole()){
            $requests = Request::capture();
            // Lock Classroom
            $find_classroom = Classroom::where('id','=',$id)->first();
            $find_classroom->is_active = 0;
            $find_classroom->save();
            // Redirect
            return redirect('/admin/classroom/index');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }
}
