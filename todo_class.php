<?php

class Todo
{
    // プロパティの宣言
    private $tid;
    private $tname;
    private $status;
    private $priority;
    private $registrationTime;

    public function __construct($tid,$tname,$status,$priority,$registrationTime)
    {
        $this->tid = $tid;
        $this->tname = $tname;
        $this->status = $status;
        $this->priority = $priority;
        $this->registrationTime = $registrationTime;
    }

    public function getTid()
    {
        return $this->tid;
    }

    public function getTname()
    {
        return $this->tname;
    }

    public function getStatus()
    {
        return $this->status;
    }

    function getStatusDisplay()
    {
        $env = require ('env.php');
        $statusDisplay = $env['status'][$this->status];

        return $statusDisplay;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    function getPriorityDisplay()
    {
        $env = require ('env.php');
        $priorityDisplay = $env['priority'][$this->priority];

        return $priorityDisplay;
    }

    public function getRegistrationTime()
    {
        return $this->registrationTime;
    }
}
