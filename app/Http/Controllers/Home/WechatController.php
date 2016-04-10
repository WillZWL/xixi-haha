<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Log;

class WechatController extends Controller
{

    public function server()
    {
        Log::info('request arrived.');
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 嘻嘻哈哈（ xixi-haha.com ）";
        });
        Log::info('return response.');
        return $wechat->server->serve();
    }
}
