<?php
class dbconnection
{

public $servername;
public $username;
public $password;
public $dbname;

public $conn;


	function __construct()
	{
	    $this->conn = new mysqli('localhost','root','', 'technical_test');
	    //check connection
	    if($this->conn->connect_error)
	    {
	    	die("connection failed:" .$this->conn->connect_error);
	    }
	    // else
	    // {
	    // 	echo "connected successfully";
	    // }
        // SQL query to create 'items' table
       
	}
	function newfun(){
		return $this->conn;
	}

}




