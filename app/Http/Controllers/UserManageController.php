<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserManageController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show student list.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsList() {
        //@todo list the students
        $this->authorize('userManage', Auth::user());

        $students=User::where('role',2)->orderBy('created_at')->get();
        return view('home',[$students]);
    }

    /**
     * Show teacher list.
     *
     * @return \Illuminate\Http\Response
     */
    public function teachersList(Request $request) {
        //@todo list teachers
        $this->authorize('userManage', Auth::user());
        return view('home');
    }
}
