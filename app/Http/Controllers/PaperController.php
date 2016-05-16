<?php

namespace App\Http\Controllers;

use App\Paper;
use Auth;
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

    //@todo 打分
    public function rate() {

    }
}
