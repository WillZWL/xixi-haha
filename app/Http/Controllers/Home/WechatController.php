<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Log;
use Wechat;

class WechatController extends Controller
{

    public function serve()
    {
        Log::info('request arrived.');
        Wechat::server()->setMessageHandler(function($message){
            return $this->wechatHandler($message);
        });
        Log::info('return response.');
        return Wechat::server()->serve();
    }

    protected function wechatHandler($message)
    {
        switch ($message->MsgType) {
            case 'event':
                # 事件消息...
                break;
            case 'text':
                return $this->textHandler($message);
                break;
            default:
                return "欢迎关注 嘻嘻哈哈（http://xixi-haha.com)";
                break;
        }
    }

    protected function textHandler($message)
    {
        $user = $message->ToUserName;
        $from = $message->FromUserName;
        $msg = $message->Content;
        $content = "Hello ".$user. ", You want to ask ". $from ."  ".$msg;
        return $content;
    }
}
