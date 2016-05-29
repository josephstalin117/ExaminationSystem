<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class MenuController extends Controller {
    //
    public $menu;

    /**
     * MenuController constructor.
     * @param $menu
     */
    public function __construct(Application $app) {
        $this->menu = $app->menu;
    }

    public function menu() {
        $buttons = [
            [
                "type" => "view",
                "name" => "登陆考试系统",
                "url" => "http://121.42.50.74/",
                "key" => "EXAM"
            ],
        ];
        $this->menu->add($buttons);
    }
}
