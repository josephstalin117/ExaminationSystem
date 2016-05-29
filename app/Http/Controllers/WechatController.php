<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use WeChat;
use Log;

class WechatController extends Controller {
    //
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve() {
        Log::info('request arrived.');

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注宝宝!";
        });

        Log::info('return response.');
        return $wechat->server->serve();
    }

}
