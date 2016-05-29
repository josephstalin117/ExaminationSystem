<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use WeChat;

class WechatController extends Controller {
    //
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve() {

        $wechat = app('WeChat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注宝宝!";
        });

        return $wechat->server->serve();
    }

}
