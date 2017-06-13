<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/6/13
 * Time: 10:34
 */
use Workerman\Worker;
require __DIR__.'Workerman\Autoloader.php';

$ws_worker = new Worker("websocket://0.0.0.0:2346");

$ws_worker->count=4;

$ws_worker->onMessage = function($connection,$data)
{
    $connection->send('hello'.$data);
};

Worker::runAll();