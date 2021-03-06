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

// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
//function handle_connection($connection,$data)
//{
//    //获取用户传过来的信息
//    $connection->send($data);
//}

// 当客户端发送消息过来时，转发给所有人
function onMessage($connection, $data)
{
//    global $text_worker;
//    foreach($text_worker->connections as $conn)
//    {
    $connection->send($data);
//    }
}

// 当客户端断开时，广播给所有客户端
function handle_close($connection)
{
    global $text_worker;
    foreach($text_worker->connections as $conn)
    {
        $conn->send("user[{$connection->uid}] logout");
    }
}

// 创建一个文本协议的Worker监听2347接口
$text_worker = new Worker("websocket://0.0.0.0:2347");

// 只启动1个进程，这样方便客户端之间传输数据
$text_worker->count = 1;

//$text_worker->onConnect = 'handle_connection';
//$text_worker->onMessage = 'handle_message';
//$text_worker->onClose = 'handle_close';

Worker::runAll();
