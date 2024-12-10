<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    // Controllers ==============

    public function dashboard(){
        if($this->checkRole()){
            return $this->return_view('dashboard');
        }
        // Not Auth
        return $this->return_redirect('/401');
    }

}
