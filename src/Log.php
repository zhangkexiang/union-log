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

    public function info()
    {

        $this->monolog->pushHandler($handler = new StreamHandler('/tmp/laravel.log', Logger::INFO));

        $handler->setFormatter(new LineFormatter(
                "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                "Y-m-d H:i:s",
                false,
                false
        ));
        $this->monolog->info("222",[]);

    }


}


