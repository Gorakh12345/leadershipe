<?php

	define("HOST", "localhost");
	define("USERNAME", "root");
	define("PASSWORD", "");
	define("DBNAME", "bookmybloom");
	

	class database {
                public $server = HOST;
                public $user = USERNAME;
                public $passwd = PASSWORD;
                public $db_name = DBNAME;
                public $dbCon;

        public function __construct(){
                $this->dbCon = mysqli_connect($this->server, $this->user, $this->passwd, $this->db_name);
        }

        public function __destruct(){
                mysqli_close($this->dbCon);
        }

        
 }
 
 
 $obj=new database();
 
 
 echo "<pre>";
 print_r($obj);
 echo "</pre>";
 
 
  $sql="SELECT * FROM `registration`";
  $results=$obj->dbCon->query($sql);
  $arry=$results->fetch_array();
  
  echo "<pre>";
 print_r($arry);
 echo "</pre>";