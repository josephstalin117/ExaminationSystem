<?php

namespace App\Http\Controllers;

use App\Paper;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class PaperController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        $this->authorize('userManage', Auth::user());
        $papers = Paper::orderBy('created_at')->get();
        return view('paper.index', [
            'papers' => $papers,
        ]);

    }
}
