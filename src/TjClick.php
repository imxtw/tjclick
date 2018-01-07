<?php

namespace newdun;

class TjClick
{
    public $password;
    public $host;
    public $prot;

    private $conn;

    public function __construct()
    {
        $this->conn = new Redis();
        $this->conn->connect($this->host, $this->prot);
        $this->conn->auth($this->password);
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