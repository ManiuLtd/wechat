<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

use App\Http\Requests;

class WechatController extends Controller
{
    public function index()
    {

        $options = weOption();

        $app = new Application($options);

        $server = $app->server;

        $server->setMessageHandler(function($message){
            switch ($message->MsgType) {
                case 'event':
                    if($message->Event == 'subscribe'){
                        return '欢迎观注小莫公众号';
                    }else{
                        return '收到事件消息';
                    }
                    break;
                case 'text':
                    return $message->Content;
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });

        $response =$app->server->serve();

        return $response;
    }

    public function oauth_callback()
    {
        $options = weOption();
        $app = new Application($options);
        $oauth = $app->oauth;
        $user = $oauth->user();

        dd($user);

        $userinfo = $user->toJson();

        if (isset($_COOKIE["url"])){
           $url = $_COOKIE['url'];
        }
        setcookie("userinfo", $userinfo,time()+3600,'/','ana51.com');
        return redirect($url);

    }

    public function oauth(Request $request)
    {
        if($request->url){
            setcookie("url", $request->url,time()+3600,'/','ana51.com');
        }else{
            echo '请输入url';
            return false;
        }
        $options = weOption();
        $app = new Application($options);
        return $response = $app->oauth->scopes(['snsapi_userinfo'])->redirect();
    }

    public function test()
    {
        return redirect('http://www.baidu.com');
    }


}
