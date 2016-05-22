<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;
use App\User;
use App\Room;
use App\Room_user;
use Auth;
use Config;

class ExamController extends Controller {
    public function __construct() {

        $this->middleware('auth');
    }

    public function exam($room_id, $paper_id) {
        $paper = Paper::findOrFail($paper_id);
        Room::findOrFail($room_id);
        $questions = $paper->questions;
        return view('exam.questions', [
            'questions' => $questions,
            'paper_id' => $paper_id,
            'room_id' => $room_id,
        ]);
    }


    public function exam_rooms() {

        $room_users = Room_user::where('user_id', Auth::id())->where('attended', Config::get('constants.EXAM_NOTATTEND'))->get();

        return view('exam.rooms', [
            'room_users' => $room_users,
        ]);

    }

    public function user_scores() {

        $scores = Score::where('user_id', Auth::id())->get();

        return view('exam.scores', [
            'scores' => $scores,
        ]);

    }

    public function rate(Request $request, $room_id, $paper_id) {
        static $result = 0;
        $paper = Paper::findOrFail($paper_id);
        Room::findOrFail($room_id);
        $questions = $paper->questions;
        foreach ($questions as $question) {
            if ($question->single->answer == $request->input($question->id)) {
                $result += $question->single->score;
            }
        }

        $score = new Score;

        $score->user_id = Auth::id();
        $score->score = $result;
        $score->paper_id = $paper_id;
        $score->room_id = $room_id;
        $score->save();

        Room_user::where('user_id', Auth::id())->where('room_id', $room_id)->update(['attended' => Config::get('constants.EXAM_ATTENDED')]);

        return redirect("/home");
    }
}
