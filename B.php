<?php

class B
{
    public $db;
    public $link;

    function func3()
    {
	$this->db = new PDO('pgsql:user=validuser dbname=validdb password=validpass');
	$data = [':1', '11'];
        try {
            $this->link = $this->db->prepare('SELECT :1');
            foreach($data as $param=>$value)
            {
        	    $this->link->bindValue($param, $value);
            }
            //$this->link->execute();
        }catch (PDOException $e) {
        }
    }
}
