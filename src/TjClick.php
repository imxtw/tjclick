<?php

namespace newdun;

class TjClick
{

    public $type;
    public $password;
    public $host;
    public $port;

    private $conn;

    public function __construct()
    {
        if ($this->type == 'redis') {
            $this->conn = new Redis();
            $this->conn->connect($this->host, $this->port);
            $this->conn->auth($this->password);
        } else {
            // TODO : 其他驱动
        }

    }

    public function refreshClick($key)
    {
        if($this->conn->exist($key)) {
            $this->conn->incr($key);
        } else {
            $this->conn->set($key, 1);
        }
    }
}