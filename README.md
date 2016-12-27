#union-log
使用方法:

laravel5.1结构中 在config文件夹创建union.php

example:

return [
    'log'=>[
        'sms'=>'/tmp/laravel.log'
    ]

];

使用:
use Union\Log;
//异常情况 没有配置sendsms
Log::sendsms_info('success','daily');
Log::sendsms_info('success');//sendsms 配合不存在则默认打印到 /tmp/uion-log.log
//正常情况
Log::sms_info('asdf');//单个info日志
Log::sms_info('asdf','daily');//每日的info日志
Log::sms_error('asdf','daily');// 每日的错误日志
Log::sms_info('asdf','daily','error');// 每日的错误日志 限制'error'一下不打印 所以该信息不打印

//debug\info\notice\warning\error\critical\alert\emergency

