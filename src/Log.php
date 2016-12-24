<?php

namespace Union;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    private $monolog;

    public function __construct($name = "union-log")
    {
        $this->monolog = new Logger($name);
    }
    //声明成私有方法 外部通过静态调用则访问不到该方法进入 __callStatic 方法 而 callstatic方法中可以调用到private方法
    private function info($path,$msg)
    {
        $this->monolog->pushHandler($handler = new StreamHandler($path, Logger::INFO));
        $handler->setFormatter(new LineFormatter(
                "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                "Y-m-d H:i:s",
                false,
                false
        ));
        $this->monolog->info($msg,[]);

    }

    public static function __callStatic($method,$parameters){
//        call_user_func_array([new self, $method], $parameters);
        call_user_func_array([new static, $method], $parameters);
    }

}


