<?php

namespace Union\Log;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    private $monolog;
    private $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct($name = "union-log")
    {
        $this->monolog = new Logger($name);
    }

//  程序入口
    public static function __callStatic($method,$parameters){



        $location = '';
        //测试环境和 与laravel搭配的环境判断
        $debug_backtrace = debug_backtrace();

//      laravel环境可以打印 调用日志位置
        if(sizeof($debug_backtrace)>2){
            $location = $debug_backtrace[2]['class'].':'.$debug_backtrace[1]['line'].':';
        }else{
            $location = $debug_backtrace[1]['class'].':'.$debug_backtrace[0]['line'].':';;
        }

        $arr = explode('_',$method);
        array_push($arr,$location);
        call_user_func_array([new static('union-log '.$arr[0]), 'write'],array_merge($arr,$parameters));
    }

    //声明成私有方法 外部通过静态调用则访问不到该方法进入 __callStatic 方法 而 callstatic方法中可以调用到private方法
    private function write($name,$level,$location,$msg,$mod='',$limit='debug')
    {
//        var_dump(compact('name','level','location','msg','mod'));
//      ----------文件路径----------
        $tmp = union_config('union.log.'.$name,'');//封装的一个自定义函数 保证 开发 测试 生产环境的配置调用

        if($tmp===null || $tmp===''){
            return ;//如果没有配置则不需要打印日志
//            $path = '/tmp/union-log.log';
        }else{
            $path = $tmp;
        }


//      ---------根据mode匹配单个日志还是每日一个日志----------
        $formatter=new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n", "Y-m-d H:i:s", false, false);
        if($mod == ''){
            $this->monolog->pushHandler($handler = new StreamHandler($path, $this->levels[$limit]));
        }else{
            $this->monolog->pushHandler(
                $handler = new RotatingFileHandler($path, 0, $this->levels[$limit])
            );
        }
        $handler->setFormatter($formatter);

//      ----------写日志----------
        $this->monolog->{$level}($location.' '.$msg,[]);

    }

}


