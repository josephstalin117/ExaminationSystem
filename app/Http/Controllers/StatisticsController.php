<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Paper;
use App\User;
use App\Score;
use App\Profile;
use App\Room;
use App\Room_user;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller {
    //
    public function __construct() {

        $this->middleware('auth');
        $this->authorize('userManage', Auth::user());
    }

    public function papers(Request $request) {
        $list = array();
        $keyword = $request->input('keyword');

        $papers = Paper::where('name', "LIKE", "%$keyword%")->get();

        foreach ($papers as $paper) {

            $max_score = DB::table('scores')->where('paper_id', $paper->id)->max('score');
            $min_score = DB::table('scores')->where('paper_id', $paper->id)->min('score');
            $avg_score = DB::table('scores')->where('paper_id', $paper->id)->avg('score');

            array_push($list, array(
                'id' => $paper->id,
                'name' => $paper->name,
                'total_score' => $paper->score,
                'min_score' => $min_score,
                'max_score' => $max_score,
                'avg_score' => $avg_score,
            ));

        }

        return view('statistics.papers', [
            'list' => $list,
            'keyword' => $keyword,
        ]);
    }

    public function paper(Request $request, $id) {

        $list = array();
        $keyword = $request->input('keyword');

        $paper = Paper::findOrFail($id);
        $rooms = Room::where('paper_id', $id)->get();

        foreach ($rooms as $room) {
            $room_users = Room_user::where('room_id', $room->id)->where('attended', Config::get('constants.EXAM_ATTENDED'))->get();
            foreach ($room_users as $room_user) {
                $user = User::findOrFail($room_user->user_id)->first();
                $score = Score::where('paper_id', $id)->where('user_id', $user->id)->where('room_id', $room->id)->first();

                array_push($list, array(
                    'nickname' => $user->profile->nickname,
                    'room_name' => $room->name,
                    'score' => $paper->score,
                ));
            }
        }


        return view('statistics.paper', [
            'list' => $list,
            'name' => $paper->name,
            'keyword' => $keyword,
        ]);
    }

    public function users(Request $request) {
        $keyword = $request->input('keyword');

        $users = DB::table('users')->join('profiles', 'users.id', '=', 'profiles.user_id')->select('users.*', 'profiles.nickname')->where('users.role', Config::get('constants.ROLE_STUDENT'))->where('profiles.nickname', "LIKE", "%$keyword%")->paginate(6);

        return view('statistics.users', [
            'users' => $users,
            'keyword' => $keyword,
        ]);
    }

    public function user(Request $request, $id) {

        $list = array();
        $keyword = $request->input('keyword');

        $user = User::findOrFail($id);
        $scores = Score::where('user_id', $user->id)->get();

        foreach ($scores as $score) {
            $room = Room::findOrFail($score->room_id);
            $paper = Paper::findOrFail($score->paper_id);

            array_push($list, array(
                'score' => $score->score,
                'room_name' => $room->name,
                'paper_name' => $paper->name,
            ));
        }

        return view('statistics.user', [
            'nickname' => $user->profile->nickname,
            'list' => $list,
            'keyword' => $keyword,
        ]);

    }
}
