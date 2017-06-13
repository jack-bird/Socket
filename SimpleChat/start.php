<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/6/13
 * Time: 11:31
 */

use Workerman\Worker;
require_once '../Workerman/Autoloader.php';

$global_uid = 0;

//当客户端链接上来时分配uid，并保存链接，并通知所有客户端
function handle_connection($connection){
    global $text_worker,$global_uid;
    $connection->uid = ++$global_uid;
}

function handle_message($connection,$data)
{
    global $text_worker;
    foreach($text_worker->connections as $conn){
        $conn->send("user[{$connection->uid}]said:$data");
    }
}

function handle_close($connection)
{
    global $text_worker;
    foreach($text_worker->connections as $conn)
    {
        $conn->send("user[{$connection->uid}]logout");
    }
}

$text_work = new Worker("text://0.0.0.0:2347");

$text_worker->count = 1;

$text_worker->onConnect = 'handle_connection';
$text_worker->onMessage = 'handle_message';
$text_worker->onClose = 'handle_close';

Worker::runAll();