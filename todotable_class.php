<?php
require_once ('todo_class.php');

class TodoTable
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get_todo($tid)
    {
        $sql = $this->db->prepare("SELECT * FROM todo2 WHERE tid=?");
        $sql->bindValue(1, $tid);
        $sql->execute();
        $data = $sql->fetch();
        $todo = new Todo($data['tid'],$data['tname'],$data['status'],$data['priority'],$data['registrationTime']);

        return $todo;
    }

    public function get_todoAll($sortColumn,$sortOrder)
    {
        $tnameSql = ["SELECT * FROM todo2 ORDER BY tname ASC","SELECT * FROM todo2 ORDER BY tname DESC"];
        $statusSql = ["SELECT * FROM todo2 ORDER BY status ASC","SELECT * FROM todo2 ORDER BY status DESC"];
        $prioritySql = ["SELECT * FROM todo2 ORDER BY priority ASC","SELECT * FROM todo2 ORDER BY priority DESC"];
        $registrationTimeSql = ["SELECT * FROM todo2 ORDER BY registrationTime ASC","SELECT * FROM todo2 ORDER BY registrationTime DESC"];

        $sql = "";

        if($sortColumn == "tname"){
            $sql = $this->db->prepare($tnameSql[$sortOrder]);
        }
        if($sortColumn == "status"){
            $sql = $this->db->prepare($statusSql[$sortOrder]);
        }
        if($sortColumn == "priority"){
            $sql = $this->db->prepare($prioritySql[$sortOrder]);
        }
        if($sortColumn == "registrationtime"){
            $sql = $this->db->prepare($registrationTimeSql[$sortOrder]);
        }

        $sql->execute();
        $all = $sql->fetchAll();
        $ret = array();

        foreach($all as $data){
            $todo = new Todo($data['tid'],$data['tname'],$data['status'],$data['priority'],$data['registrationTime']);
            $ret[] = $todo;
        }

        return $ret;
    }

    public function add($tname,$priority)
    {
        $sql = $this->db->prepare("INSERT INTO todo2 (tname,status,priority,registrationTime) VALUES(?,0,?,now())");
        $sql->bindValue(1, $tname);
        $sql->bindValue(2, $priority);
        $sql->execute();
    }

    public function update($todo)
    {
        $sql = $this->db->prepare("UPDATE todo2 SET tname=:tname,status=:status,priority=:priority WHERE tid=:tid");
        $sql->bindValue(':tname', $todo->getTname());
        $sql->bindValue(':status', $todo->getStatus());
        $sql->bindValue(':priority', $todo->getPriority());
        $sql->bindValue(':tid', $todo->getTid());
        $sql->execute();
    }

    public function delete($tid)
    {
        $sql = $this->db->prepare("DELETE FROM todo2 WHERE tid=?");
        $sql->bindValue(1, $tid);
        $sql->execute();
    }
}