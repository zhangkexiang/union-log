<?php
require __DIR__ . '/../vendor/autoload.php';
//require __DIR__ . '/../src/Log.php';
//use Union\Log;
//$info = new Log();
//$info->info();

//Log::info('/tmp/laravel.log','asdf');
//echo config('app.test','111');
//$conf = require_once __DIR__.'/../config/app.php';


//require __DIR__ . '/../src/Log.php';
use Union\Log;
Log::lala_info('qewr','daily');
//Log::sms_info('asdf');//单个info日志
//Log::sms_info('asdf','daily');//每日的info日志
//Log::sms_error('asdf','daily');// 每日的错误日志
//Log::sms_info('asdf','daily','error');// 每日的错误日志 限制'error'一下不打印 所以该信息不打印

//debug\info\notice\warning\error\critical\alert\emergency