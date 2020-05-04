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
        $sql = "";

        if($sortColumn == "tname"){
            if($sortOrder == 1){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY tname DESC");
            }elseif($sortOrder == 0){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY tname ASC");
            }
        }

        if($sortColumn == "status"){
            if($sortOrder == 1){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY status DESC");
            }elseif($sortOrder == 0){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY status ASC");
            }
        }

        if($sortColumn == "priority"){
            if($sortOrder == 1){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY priority DESC");
            }elseif($sortOrder == 0){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY priority ASC");
            }
        }

        if($sortColumn == "registrationtime"){
            if($sortOrder == 1){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY registrationTime DESC");
            }elseif($sortOrder == 0){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY registrationTime ASC");
            }
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