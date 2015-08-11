<?php

function validateEmail($email) {
    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$", $email);
}

function checkvaliduser($mail) {
    
    $test1 = new connection();
    
   $sql = " SELECT `email`,`pass`,`gender`,`usertype` FROM `users` WHERE `email`='$mail'";
    $query = mysqli_query($test1->dbc,$sql);
    $user = mysqli_fetch_array($query);
    if ($user) {
        return false;
    } else {
        return true;
    }
}

function insertintousers($mail, $pass, $gender, $usertype) {
   $sql="INSERT INTO `users`()VALUES()";
}

function Registration($mail, $pass, $gender, $usertype) {

    if (checkvaliduser($mail) == true) {
        
        if ($pass !='' && $mail !='') {
           
            if (validateEmail($mail)) {
            
                $insert_id = insertintousers($mail, $pass, $gender, $usertype);
                if (is_numeric($insert_id) && $insert_id > 0) {
                    header("location:login.php");
                }
            } else {
                echo "Please Enter Valide email.";
            }
        } else {

            echo"Please Enter Valide email and Password.";
        }
    } else {
        echo "This is not Valide Email.";
    }
}
function lltesting($test){
     
$sql="insert into users(email,pass,gender,usertype)values('gorakh@iimjobs.com','123545','male','admin')";
$q=mysqli_query($test->dbc,$sql);
if($q){
    echo 'inserted records';
}
}