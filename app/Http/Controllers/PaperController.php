<?php

namespace App\Http\Controllers;

use App\Paper;
use Auth;
use App\Single;
use Config;
use App\Question;
use Illuminate\Http\Request;
use Response;

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

    /**
     * 试卷搜索
     * @param $name
     * @return mixed
     */
    public function search($name = "") {
        $this->authorize('userManage', Auth::user());

        try {
            $response = [
                "papers" => [],
                "status" => "",
            ];
            $papers = Paper::where('name', 'LIKE', "%$name%")->get();
            $statusCode = 200;
            foreach ($papers as $paper) {

                $response['papers'][] = [
                    'id' => $paper->id,
                    'nickname' => $paper->user->profile->nickname,
                    'name' => $paper->name,
                    'score' => $paper->score,
                    'remark' => $paper->remark,
                    'time' => $paper->time,
                ];
            }

            $response['status'] = "success";

        } catch (\Exception $e) {
            $response = [
                "error" => "can't find paper",
                "status" => "fails"
            ];
            $statusCode = 404;
        } finally {
            return Response::json($response, $statusCode);
        }
    }

    public function create(Request $request) {

        $this->authorize('userManage', Auth::user());

        $this->validate($request, [
            'name' => 'required',
            'score' => 'required',
            'time' => 'required',
        ]);

        Paper::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'time' => $request->input('time'),
            'remark' => $request->input('remark'),
        ]);

        $request->session()->flash('success', '新增成功');
        return redirect('/papers');
    }

    public function update($id) {
        $this->authorize('userManage', Auth::user());

        $paper = Paper::findOrFail($id);
        return view('manage.update_paper', [
            'paper' => $paper,
        ]);
    }

    public function store(Request $request) {

        $this->authorize('userManage', Auth::user());

        $this->validate($request, [
            'name' => 'required',
            'score' => 'required',
            'time' => 'required',
            'remark' => 'required',
        ]);

        $paper = Paper::findOrFail($request->input('id'));

        $paper->user_id = Auth::user()->id;
        $paper->name = $request->input('name');
        $paper->score = $request->input('score');
        $paper->remark = $request->input('remark');

        $paper->save();

        $request->session()->flash('success', '更新成功');
        return redirect('/papers');
    }

    public function edit($id) {
        $this->authorize('userManage', Auth::user());

        $paper = Paper::findOrFail($id);
        $questions = $paper->questions;

        return view('/paper.edit', [
            'paper' => $paper,
            'questions' => $questions,
        ]);
    }

    public function destroy(Request $request, $id) {
        $this->authorize('userManage', Auth::user());

        try {
            $paper = Paper::findOrFail($id);
            $questions = $paper->questions;
            foreach ($questions as $question) {
                $question->delete();
            }
            $paper->delete();
            $response = [
                "status" => "success",
            ];

            $request->session()->flash('success', '删除成功');
            return Response::json($response, 200);
        } catch (\Exception $e) {
            $response = [
                "status" => "success",
            ];
            return Response::json($response, 404);
        }

    }

    public function import_single($paper_id, $single_id) {
        $this->authorize('userManage', Auth::user());

        try {

            $response = [
                "status" => "",
            ];

            $statusCode = 200;
            $single = Single::findOrFail($single_id);
            $paper = Paper::findOrFail($paper_id);

            if (Question::where('paper_id', $paper->id)->where('question_id', $single->id)->count()) {

                $response['status'] = "exist";
            } else {
                $question = new Question;

                $question->paper_id = $paper_id;
                $question->question_id = $single_id;
                $question->type = Config::get('constants.QUESTION_SINGLE');

                if ($question->save()) {
                    $response["status"] = "success";
                } else {
                    $response["status"] = "noresult";
                }
            }

        } catch (\Exception $e) {
            $response = [
                "error" => $e,
                "status" => "fails",
            ];
            $statusCode = 404;
        } finally {
            return Response::json($response, $statusCode);
        }
    }


    public function remove($question_id) {

        $this->authorize('userManage', Auth::user());

        try {
            $question = Question::findOrFail($question_id);
            $question->delete();
            $response = [
                "status" => "success",
            ];

            return Response::json($response, 200);
        } catch (\Exception $e) {
            $response = [
                "status" => "fails",
                "reason" => $e,
            ];
            return Response::json($response, 404);
        }

    }
}
