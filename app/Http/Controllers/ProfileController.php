<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $profile = $request->user()->profile()->first();

        return view('profile.index', [
            'profile' => $profile,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $profile = $request->user()->profile()->first();

        $profile->nickname = $request->nickname;
        $profile->telephone = $request->telephone;
        $profile->address = $request->address;

        $profile->save();
        $request->session()->flash('success','更新成功');

        return redirect('/home');
    }
}
