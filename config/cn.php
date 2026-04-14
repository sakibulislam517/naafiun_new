<?php
/**
* Connect class
*/
//

abstract class Cn 
{

	protected $db;
	private $host = 'localhost';
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	function __construct($database=''){
    	$db1 = !empty($database)?$database:$this->dbname;
    	$user = $this->user;
    	$pass = $this->pass;
    	$this->Connection($db1,$user,$pass);
	}

	public function Connection($db1,$user,$pass)
	{
		try {
            $this->db = new PDO('mysql:dbname='.$db1.';charset=utf8mb4;host='.$this->host, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $e)
		{ 
			echo "Server Updating";
		}
	}
}




?>