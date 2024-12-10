<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\UniqueConstraintViolationException;

class MentorManager extends Controller
{
    // Useful Thoughts ===============

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

    //  Mentor Manager Functions ==============

    public function mentor_index(){
        if($this->checkRole()){
            // Request Mentors data
            $mentors = Mentor::all();
            // Create view
            $view = view('admin.mentor-index');
            $view->with('mentors', $mentors);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function mentor_registering(){
        if($this->checkRole()){
            // Request User data with role "mentor"
            $users = User::where('role', 'LIKE', 'mentor')
                        ->where('role_verified', '=', 0) // Unverified
                        ->get();
            // Create view
            $view = view('admin.mentor-registering');
            $view->with('users', $users);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function mentor_form($id){
        if($this->checkRole()){
            $find_user = User::where('id','=',$id)->first();
            $view = view('admin.mentor-form');
            $view->with('id', $id);
            $view->with('email', $find_user['email']);
            $view->with('user', AuthController::logged()); // DONT FORGET
            return $view;
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

    public function mentor_create(){
        if($this->checkRole()){
            $requests = Request::capture();
            $requests->validate(Mentor::$rules);
            // Create Mentor
            $new_mentor = new Mentor($requests->all());
            // Make sure no duplicate
            try{
                $new_mentor->save();
            }catch(UniqueConstraintViolationException $e){
                return $this->return_redirect('/401');
            }
            // Update Verified @ users
            $user = User::where('id','=',$requests->user_id)
                    ->first();
            $user->role_verified = 1;
            $user->save();
            return redirect('/admin/mentor/index');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }
}
