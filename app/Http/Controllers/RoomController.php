<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use DB;
use App\User;
use App\Score;
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

    public function scores($room_id, $paper_id) {

        $this->authorize('userManage', Auth::user());

        $scores = Score::where('paper_id', $paper_id)->where('room_id', $room_id)->get();

        return view('manage.scores', [
            'scores' => $scores,
        ]);

    }

    public function create() {

        $this->authorize('userManage', Auth::user());
        return view('manage.create_room');
    }

    public function store(Request $request) {

        $this->authorize('userManage', Auth::user());

        $this->validate($request, [
            'name' => 'required',
            'paper_id' => 'required',
            'remark' => 'required',
        ]);

        $room = new Room;
        $room->name = $request->input('name');
        $room->paper_id = $request->input('paper_id');
        $room->remark = $request->input('remark');
        $room->save();


        if ($room) {
            $request->session()->flash('success', '新增一个考场');
        } else {
            $request->session()->flash('error', '失败');
        }

        return redirect('/roommanage/rooms');
    }

    public function edit($id) {
        $this->authorize('userManage', Auth::user());

        $room_users = Room_user::where('room_id', $id)->get();

        return view('manage.edit_room', [
            'room_users' => $room_users,
            'room_id' => $id,
        ]);
    }

    public function add_user(Request $request, $room_id, $user_id) {
        $this->authorize('userManage', Auth::user());

        try {
            User::findOrFail($user_id);
            Room::findOrFail($room_id);

            $count_room_user = Room_user::where('user_id', $user_id)->where('room_id', $room_id)->count();
            if (0 == $count_room_user) {

                $room_user = new Room_user;
                $room_user->user_id = $user_id;
                $room_user->room_id = $room_id;

                if ($room_user->save()) {
                    $response = [
                        "status" => "success",
                    ];
                }
            } else {
                $response = [
                    "status" => "existed",
                ];
            }

            $statusCode = 200;
            $request->session()->flash('success', '添加成功');
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

    public function remove_user($id) {
        $this->authorize('userManage', Auth::user());

        try {

            $room_user = Room_user::findOrFail($id);

            if ($room_user->delete()) {
                $response = [
                    "status" => "success",
                ];
            }

            $statusCode = 200;
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

    public function destroy($id) {
        $this->authorize('userManage', Auth::user());

        try {
            $room = Room::findOrFail($id);
            $room->delete();

            $room_users = Room_user::where('room_id', $id)->get();

            foreach ($room_users as $room_user) {
                $room_user->delete();
            }

            $response = [
                "status" => "success",
            ];

            return Response::json($response, 200);
        } catch (\Exception $e) {
            $response = [
                "status" => "fails",
            ];
            return Response::json($response, 404);
        }

    }

}
