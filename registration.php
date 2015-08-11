<?php 
//define('DS', DIRECTORY_SEPARATOR);
//require dirname(dirname(__FILE__)) . DS . 'select' . DS. 'dbconnection.php';
$ROOT_DIR=  dirname(dirname(__FILE__));
//include_once $ROOT_DIR.'/select/dbconnection.php';
//include('usefunction.php');
//include 'dbconnection.php';
?>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="/ajaxtest/events.js"></script>
   
    <script>
   
$(document).ready(function(){
$("#submit").click(function(){
var email = $("#email").val();
var pass = $("#pass").val();
var gender = $("#gender").val();
var usertype = $("#usertype").val();
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'gender1='+ gender + '&email1='+ email + '&pass1='+ pass + '&usertype1='+ usertype;

if(gender==''||email==''||pass==''||usertype=='')
{
alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "process.php",
data: dataString,
cache: false,
success: function(result){
$("#divid").html(result)
}
});
//$.post("process.php",{user:dataString},function(data){
//    $("#divid").html(data)
//});
}
return false;
});
});

    </script>
 <?php 
 if(isset($_POST['submit'])){
     $email=$_POST['email'];
      $pass=$_POST['pass'];
       $gender=$_POST['gender'];
        $usertype=$_POST['usertype'];
        $sql="INSERT INTO users( email, pass, gender, usertype )VALUES ('gorakh@iimjobs.com', '12345', 'male', 'admin')";
        
  $query = mysqli_query($con, $sql);
        if ($query){
        echo $email,$pass,$gender,$usertype;
 }
 }
 ?>
    <body>
        <div>
            <form name="reg" id="reg" method="post" action=""> 
                <div>
                    <input type="text" name="email" id="email" placeholder="email">        
                </div>
                    <div>
                        <input type="password" name="pass" id="pass" placeholder="password">        
                </div>
                    <div>
                        <select name="gender" id="gender">
                            <option value="">gender</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>        
                </div>
                    <div>
                        <input type="radio" name="usertype" id="usertype" checked="checked" value="admin">Admin<br>
                        <input type="radio" name="usertype" id="usertype" checked="checked" value="normal">normal
                </div>
                    <div>
                        <input type="submit" name="submit" id="submit" value="submit">        
                </div>
            </form>
        </div>
            
       
    </body>
</html>
<div id="divid"></div>