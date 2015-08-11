<?php

include('dbconnection.php');
include('usefunction.php');

if($_POST){
$mail=$_REQUEST['email1'];
$pass=$_REQUEST['pass1'];
$gender=$_REQUEST['gender1'];
$usertype=$_REQUEST['usertype1'];
$test = new connection();
//testing($test);
//die();
Registration($mail,$pass,$gender,$usertype);

//print_r($_REQUEST);
}