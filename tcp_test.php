<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/6/13
 * Time: 10:53
 */
use Workerman\Worker;
require_once __DIR__.'/Workerman/Autoloader.php';

$tcp_worker = new Worker("tcp://0.0.0.0:2347");

$tcp_worker->count=4;

$tcp_worker->onMessage = function($connection,$data){
    $connection->send('hello'.$data);
};

Worker::runAll();