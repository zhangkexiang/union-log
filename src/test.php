<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/Log.php';
use Union\Log;
//$info = new Log();
//$info->info();
Log::info('/tmp/laravel.log','asdf');
