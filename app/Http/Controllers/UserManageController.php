<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use APP\User;
use Mockery\CountValidator\Exception;

class UserManageController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show student list.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsList() {
        //@todo list the students
        $this->authorize('userManage', Auth::user());

        $students = User::where('role', 2)->orderBy('created_at')->get();
        return view('manage.users_list', [
            'students' => $students,
        ]);
    }

    /**
     * Show teacher list.
     *
     * @return \Illuminate\Http\Response
     */
    public function teachersList(Request $request) {
        //@todo list teachers
        $this->authorize('userManage', Auth::user());
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $this->authorize('userManage', Auth::user());
            $user = User::find($id);
            $statusCode = 200;
            $response = ["user" => [
                'id' => (int)$id,
                'name' => $user->name,
                'nickname' => $user->profile->nickname,
                'avatar' => $user->profile->avatar,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'telephone' => $user->profile->telephone,
                'address' => $user->profile->address,
            ]];

        } catch (Exception $e) {
            $response = [
                "error" => "can't find user",
            ];
            $statusCode = 404;
        } finally {
            return Response::json($response, $statusCode);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
