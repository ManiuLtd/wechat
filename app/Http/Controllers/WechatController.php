<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

use App\Http\Requests;

class WechatController extends Controller
{
    public function index()
    {
        $options = [
            'debug' => true,
            'app_id' => config('wechat.app_id'),
            'secret' => config('wechat.secret'),
            'token' => config('wechat.token'),
            'log' => [
                'level' => 'debug',
                'file' => '/tmp/easywechat.log',
            ],
        ];

        $app = new Application($options);

        $server = $app->server;

        $server->setMessageHandler(function($message){
            return '你好';
        });

        $response =$app->server->serve();

        return $response;
    }
}
