<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Single;
use App\Question;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class SingleController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function create() {

        $this->authorize('userManage', Auth::user());
        return view('manage.create_single');
    }

    public function update($id) {

        $this->authorize('userManage', Auth::user());

        $single = Single::findOrFail($id);
        return view('manage.update_single', [
            'single' => $single,
        ]);
    }

    public function search($title) {

        $this->authorize('userManage', Auth::user());

        try {
            $response = [
                "singles" => [],
                "status" => "",
            ];

            $statusCode = 200;
            if (Single::where('title', 'LIKE', "%$title%")->count()) {
                $singles = Single::where('title', 'LIKE', "%$title%")->get();
                foreach ($singles as $single) {
                    $response['singles'][] = [
                        'id' => $single->id,
                        'title' => $single->title,
                    ];
                }
                $response["status"] = "success";
            } else {
                $response["status"] = "noresult";
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

    public function store(Request $request) {

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


        if ($request->input('id')) {
            $single = Single::findOrFail($request->input('id'));
        } else {
            $single = new Single;
        }

        $single->user_id = Auth::user()->id;
        $single->title = $request->input('title');
        $single->score = $request->input('score');
        $single->a = $request->input('a');
        $single->b = $request->input('b');
        $single->c = $request->input('c');
        $single->d = $request->input('d');
        $single->answer = $request->input('answer');
        $single->remark = $request->input('remark');

        if ($single->save()) {
            $request->session()->flash('success', '更新成功');
        }


        $request->session()->flash('success', '更新成功');
        return redirect('/question/singles');
    }

    public function destroy($id) {

        $this->authorize('userManage', Auth::user());

        try {
            $single = Single::findOrFail($id);
            $questions = Question::where('question_id', $single->id)->get();
            foreach ($questions as $question) {
                $question->delete();
            }
            $single->delete();
            $response = [
                "status" => "success",
            ];

            return Response::json($response, 200);
        } catch (\Exception $e) {
            $response = [
                "status" => "success",
            ];
            return Response::json($response, 404);
        }
    }
}
