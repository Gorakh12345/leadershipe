<?php
require_once('functions/connection.php');
require_once('functions/common_functions.php');

$con = get_connection();
$user_List = users_list($con);

	function users_list($con){
	
	$sql = "SELECT * FROM `user_master` WHERE 1";
	
	if (!mysqli_query($con,$sql)){
		error_log(PHP_EOL . 'ERROR: Unable to delete user_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
		throw new Exception("E_GENERAL_ERROR");
	}	$result=array();
		$query = mysqli_query($con, $sql);
			if($query){
				while($row=mysqli_fetch_array($query)){
					$result[]=$row;
					}
			}
			  if($result!=""){
				return $result;
			  }else{
				return false;
			  }
	
	}
	
	
	//echo json_encode($user_List);
	
	?>
    <input type="text" name="search" id="search"  autocomplete="off"/>
    <div id="auto_completed" class="data-list-custom"></div>
    <div id="email_id"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
	.data-list-custom ul{list-style:none; padding-left:0;    list-style: none;
    padding-left: 0;
    margin: 0;
    position: absolute;
    width: 173px;}
	.data-list-custom ul li{border:1px solid #ccc;}
	</style>
    <script>
	$(document).ready(function(e) {
		$("#search").on('keyup',function(){
			$("#auto_completed").show('fast');
			$("#email_id").html('');
			var search_key=$("#search").val();
			var users_data=<?php echo json_encode($user_List); ?>;
			if(search_key!=''){
			var filter_list = new Array();
			var sequence =0;
			for(i=0;i<users_data.length; i++){
				if(users_data[i]['name'].toLowerCase().indexOf(search_key.toLowerCase())>=0){
					filter_list[sequence]=users_data[i];
					sequence=sequence+1;
				}
			}
			
			var HTML='';
			HTML+='<ul>';
			for(j=0; j<filter_list.length; j++){
				HTML+='<li class="search_list" onclick="get_list_id('+filter_list[j]['id']+')">'+filter_list[j]['name'].toLowerCase()+'</li>';
				HTML+='<input type="hidden" id="search_list_email'+filter_list[j]['id']+'" value="'+filter_list[j]['email']+'">';	
				HTML+='<input type="hidden" id="search_list_name'+filter_list[j]['id']+'" value="'+filter_list[j]['name']+'">';		
			}
			HTML+='</ul>';
			$("#auto_completed").html(HTML);
			}
		});
			
    });
	
	function get_list_id(id){
		var user_name = document.getElementById("search_list_name"+id).value;
		var user_email = document.getElementById("search_list_email"+id).value;
		$("#search").val(user_name);
		$("#email_id").html(user_email);
		$("#auto_completed").hide('fast');			
	}
	
	
    </script>