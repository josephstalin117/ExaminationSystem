<?php

namespace App\Http\Controllers;

use App\Room_user;
use App\Score;
use Auth;
use Response;
use Illuminate\Http\Request;
use Config;
use DB;

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
     * Show user list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $students = User::where('role', 2)->orderBy('created_at')->get();
        return view('manage.users', [
            'students' => $students,
        ]);
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

        } catch (\Exception $e) {
            $response = [
                "error" => "can't find user",
                "reason" => $e,
            ];
            $statusCode = 404;
        } finally {
            return Response::json($response, $statusCode);
        }

    }

    /**
     * 用户搜索模块
     * @param string $nickname
     * @return mixed
     */
    public function search($nickname = "") {
        $this->authorize('userManage', Auth::user());

        try {
            $response = [
                "users" => [],
                "status" => "",
            ];
            $users = DB::table('users')->join('profiles', 'users.id', '=', 'profiles.user_id')->select('users.*', 'profiles.nickname')->where('users.role', Config::get('constants.ROLE_STUDENT'))->where('profiles.nickname', "LIKE", "%$nickname%")->get();

            $statusCode = 200;

            foreach ($users as $user) {
                $response['users'][] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nickname' => $user->nickname,
                ];
            }

            $response["status"] = "success";

        } catch (\Exception $e) {
            $response = [
                "error" => "can't find user",
                "status"=>"fails",
            ];
            $statusCode = 404;
        } finally {
            return Response::json($response, $statusCode);
        }
    }

    public function destroy(Request $request, $id) {
        try {
            $user = User::findOrFail($id);
            $user->profile->delete();
            Room_user::where('user_id',$user->id)->delete();
            Score::where('user_id',$user->id)->delete();
            $user->delete();
            $response = [
                "status" => "success",
            ];

            $request->session()->flash('success', '删除成功');
            return Response::json($response, 200);
        } catch (\Exception $e) {
            return Response::json("{}", 404);
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

    public function studentCreate(Request $request) {

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

}
