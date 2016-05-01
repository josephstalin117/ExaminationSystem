<?php

namespace App\Http\Controllers;

use Config;
use Auth;
use App\Single;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller {
    //
    public function __construct() {

        $this->middleware('auth');
    }

    public function create(Request $request) {

        $this->authorize('userManage', Auth::user());

        $this->validate($request, [
            'title' => 'required',
            'score' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
            'remark' => 'required',
        ]);

        $singel = Single::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'score' => $request->input('score'),
            'a' => $request->input('a'),
            'b' => $request->input('b'),
            'c' => $request->input('c'),
            'd' => $request->input('d'),
            'answer' => $request->input('answer'),
            'remark' => $request->input('remark'),
        ]);

        $question = Question::create([
            'paper_id' => $request->input('paper_id'),
            'question_id' => $singel->id,
            'type' => Config('constants.QUESTION_SINGLE'),
        ]);

        $request->session()->flash('success', '新增成功');
        return redirect('/paper/edit/' . $request->input('paper_id'));
    }
}
