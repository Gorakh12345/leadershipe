<?php
define('HOST','localhost');
define('USER','root');
define("PASS",'root');
define('DATABASE','useajax');
@ini_set('display_errors',1);

class connection{
    public $host =HOST;
    public $user = USER;
    public $password = PASS;
    public $db=DATABASE;
    public $dbc;
   
    function __construct() {
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->db);
       
        if(mysqli_errno($con)){
            echo"sum error";
        }
        else{
           $this->dbc = $con; // assign $con to $dbc
           echo"connected ";
        }
    }
}

//$test = new connection();

/*
$con=mysql_connect('localhost','root','root');
$db=mysql_select_db('useajax');
if($db){
    echo 'ok';
}

 
$sql="insert into users(email,pass,gender,usertype)values('gorakh@iimjobs.com','123545','male','admin')";
$q=mysqli_query($test->dbc,$sql);
if($q){
    echo 'inserted records';
}
 */
 ?>
 