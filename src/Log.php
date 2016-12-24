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
//        $this->monolog->pushHandler(
//            $handler = new RotatingFileHandler($path, 0, $this->parseLevel($level))
//        );
//
//        $handler->setFormatter($formatter ? $formatter : $this->getDefaultFormatter());

        $this->monolog->pushHandler($handler = new StreamHandler('/tmp/laravel.log', Logger::INFO));

        $handler->setFormatter(new LineFormatter(
                "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                "Y-m-d H:i:s",
                false,
                false
        ));
        $this->monolog->info("222",[]);


//        $writer->useSingleFiles('/tmp/laravel.log','info',
//            new LineFormatter(
//                "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
//                "Y-m-d H:i:s",
//                false,
//                false
//        ));
//        $writer->info('12222');

    }


}


