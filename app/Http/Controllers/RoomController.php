<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use App\Room;
use App\Room_user;
use App\Http\Requests;

class RoomController extends Controller {

    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $this->authorize('userManage', Auth::user());

        $rooms = Room::get();

        return view('manage.rooms', [
            'rooms' => $rooms,
        ]);

    }

    //@todo
    public function create() {

        $this->authorize('userManage', Auth::user());
        return view('manage.create_room');
    }

    //@todo
    public function store(Request $request) {

        $this->authorize('userManage', Auth::user());

        $this->validate($request, [
            'name' => 'required',
            'paper_id' => 'required',
            'remark' => 'required',
        ]);

        $room=new Room;
        $room->name=$request->input('name');
        $room->paper_id=$request->input('paper_id');
        $room->remark=$request->input('remark');
        $room->save;


        if($room){
            $request->session()->flash('success', '新增一个考场');
        }else{
            $request->session()->flash('error','失败');
        }

        return redirect('/roommanage/rooms');
    }

    //@todo
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
        } catch (Exception $e) {
            $response = [
                "status" => "success",
            ];
            return Response::json($response, 404);
        }

    }

}
