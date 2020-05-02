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

    public function get_todoAll($sorttname,$sortstatus,$sortpriority,$sortRegistrationTime)
    {
        $sql = "";

        if($sorttname){
            if($sorttname == 1){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY tnmae DESC");
            }elseif($sorttname == 10){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY tnmae ASC");
            }
        }

        if($sortstatus){
            if($sortstatus == 3){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY status DESC");
            }elseif($sortstatus == 2){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY status ASC");
            }
        }

        if($sortpriority){
            if($sortpriority == 5){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY priotiry DESC");
            }elseif($sortpriority == 4){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY priotiry ASC");
            }
        }

        if($sortRegistrationTime){
            if($sortRegistrationTime == 7){
                $sql = $this->db->prepare("SELECT * FROM todo2 ORDER BY registrationTime DESC");
            }elseif($sortRegistrationTime == 6){
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