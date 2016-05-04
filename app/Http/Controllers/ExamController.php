<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;
use App\User;

class ExamController extends Controller {
    //
    public function __construct() {

        $this->middleware('auth');
    }

    public function papers() {
        $papers = Paper::orderBy('created_at')->get();
        return view('exam.papers', [
            'papers' => $papers,
        ]);
    }
}
