<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/6/13
 * Time: 11:21
 */

use Workerman\Chatroom;
require_once '../Workerman/Autoloader.php';

$sk = new Worker('webstock://0.0.0.0:2340');

Class Sock{
    public $sockets;
    public $users;
    public $master;

    private $sda=array();
    private $slen=array();
    private $sjen=array();
    private $ar=array();
    private $n=array();

    public function __construct($address,$port)
    {
        $this->master=$this->WebSocket($address,$port);
        $this->sockets=array($this->master);
    }
}