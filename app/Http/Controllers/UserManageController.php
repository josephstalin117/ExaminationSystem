<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use Illuminate\Http\Request;
use Config;

use App\Http\Requests;
use APP\User;
use APP\Profile;
use Mockery\CountValidator\Exception;

class UserManageController extends Controller {
    /**
     * Create a new controller instance.
     *
     */
    public function __construct() {

        $this->middleware('auth');
        $this->authorize('userManage', Auth::user());
    }

    /**
     * Show student list.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentsList() {
        //@todo list the students

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

    public function studentUpdate(Request $request) {

        $this->validate($request, [
            'telephone' => 'required',
            'nickname' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($request->input('id'));
        $user->profile->telephone = $request->input('telephone');
        $user->profile->nickname = $request->input('nickname');
        $user->email = $request->input('email');
        $user->profile->address = $request->input('address');

        $user->save();
        $user->profile->save();
        $request->session()->flash('success', '更新成功');

        return redirect('/usermanage/student');
    }

    public function studentDelete($id) {

        $user = User::findOrFail($id);
        $user->profile->delete();
        $user->delete();


        return redirect('/usermanage/student');
    }

    public function studentCreate(Request $request) {

        //@todo 需要处理password
        $this->validate($request, [
            'name' => 'required',
            'nickname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'telephone' => 'required',
            'address' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => Config::get('constants.ROLE_STUDENT'),
        ]);

        $user->profile()->save(new Profile());
        $user->profile->nickname = $request->input('nickname');
        $user->profile->telephone = $request->input('telephone');
        $user->profile->address = $request->input('address');

        $user->profile->save();

        $request->session()->flash('success', '新增成功');
        return redirect('/usermanage/student');
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
