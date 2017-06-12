<?php

/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/6/12
 * Time: 13:09
 */

use Workerman\Worker;
require_once __DIR__.'/Workerman/Autoloader.php';

//创建一个Worker监听2345端口，使用http协议通讯
$http_worker = new Worker("http://0.0.0.0:2345");

//启动4个进程对外提供服务
$http_worker->count = 4;

//接收到浏览器发送的数据时回复hello world 给浏览器
$http_worker->onMessage = function($connection,$data){
    $connection->send('hello world');
};

//运行worker
Worker::runAll();