<?php 

	ini_set('max_execution_time', 600);
	session_start();
	require_once('../../functions/connection.php');
	require_once('../../dao/access_control_dao.php');
	require_once('../../dao/excel_master_dao.php');
	
	$con = get_connection();
	$logid=$_SESSION['user_id'];
	

	if(isset($_GET["page"])){
	   $page = (int)$_GET["page"];
	} else{
	   $page = 1;
	}

	$setLimit = 20;
	$pageLimit = ($page * $setLimit) - $setLimit;
	$record_array_list=get_excel_List_by_user_id($con, $logid,$pageLimit,$setLimit);
		

	
/*		
 if(isset($_POST["import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		
	 
		 if($_FILES["file"]["size"] > 0) {
		  	$file = fopen($filename, "r");
			$companies='';
	        while (($row = fgetcsv($file, 10000, ",")) !== FALSE){
				if($companies==''){
					$companies=strtolower($row[0]);
					}else{
						$companies=$companies."','".strtolower($row[0]);
						}
			}
				$currect_ids_list="'".$companies."'";
				$search_data_list=search_excel_List_by_companies_name($con,$currect_ids_list,$logid);
				fclose($file);	
		 }
	}	 
 	*/
	if($search_data_list!=""){
		//$record_array_list_to_display=$search_data_list;
		}else{
			$record_array_list_to_display=$record_array_list;
		}
		
		
	
	function displayPaginationBelow($con,$per_page,$page){

       $page_url="?";
        $sql = "SELECT COUNT(*) as totalCount FROM excel_master";
		$query = mysqli_query($con, $sql);
        $rec =mysqli_fetch_array($query);
        $total = $rec['totalCount'];
        $adjacents = "2";
        $page = ($page == 0 ? 1 : $page); 
        $start = ($page - 1) * $per_page;                              
        $prev = $page - 1;                         
        $next = $page + 1;
        $setLastpage = ceil($total/$per_page);
        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if($setLastpage > 1){  
            $setPaginate .= "<ul class='setPaginate'>";
                    $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)){  
                for ($counter = 1; $counter <= $setLastpage; $counter++){
                    if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";                 
                }

            } elseif($setLastpage > 5 + ($adjacents * 2)){
                if($page < 1 + ($adjacents * 2)){
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";                 
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
                } elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
                    $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";                 
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
                } else {
                    $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++){
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";                 
                    }
                }
            }

            if ($page < $counter - 1){

                $setPaginate.= "<li><a href='{$page_url}page=$next'>Next</a></li>";

                $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";

            }else{

                $setPaginate.= "<li><a class='current_page'>Next</a></li>";

                $setPaginate.= "<li><a class='current_page'>Last</a></li>";

            }

            $setPaginate.= "</ul>\n";    

        }
     
        return $setPaginate;
    }


		
	
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSV List! | </title>
 <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>   
<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='css/bootstrap-table.min.css'>
<link rel='stylesheet prefetch' href='css/bootstrap-editable.css'>
<link rel="stylesheet" href="css/style.css">
<style>
.container{ width:100% !important;}
.bold-blue {
font-weight: bold;
color: #0277BD;
}
</style>

    <?php include("../includes/head-includes.php");?>
<style>
.home-content {
    width: 100%;

	position:relative;

}
.home-content .inner {
    display: block;
    width: 100%;
    height: 650px;
    position: relative;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
}
.home-content .inner .center {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;

    height: 66px;
    text-align: center;
}
.home-content .inner .center h1{ font-size:36px; text-align:center;}
.home-content .inner .center span {
    display: block;
    font-size: 32px;
}
.home-content .inner .center span a {
    color: #31708f;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 5px 36px;
    background: #fff;
    margin-top: 14px;
    display: inline-block;
}

.border {
    border: 1px solid #ccc;
    padding: 10px;
}
.import-btn{
    width: 100% !important;
    padding: 10px !important;
    background: #1abb9c !important;
	border:none !important;
}
.navi {
    width: 500px;
    margin: 5px;
    padding:2px 5px;
    border:1px solid #eee;
    }
    .show {
    color: blue;
    margin: 5px 0;
    padding: 3px 5px;
    cursor: pointer;
    font: 15px/19px Arial,Helvetica,sans-serif;
    }
    .show a {
    text-decoration: none;
    }
    .show:hover {
    text-decoration: underline;
    }
    ul.setPaginate li.setPage{
    padding:15px 10px;
    font-size:14px;
    }
    ul.setPaginate{
    margin:0px;
    padding:0px;
    height:100%;
    overflow:hidden;
    font:12px 'Tahoma';
    list-style-type:none;  
    } 
    ul.setPaginate li.dot{padding: 3px 0;}
    ul.setPaginate li{
    float:left;
    margin:0px;
    padding:0px;
    margin-left:5px;
    }
    ul.setPaginate li a
    {
    background: none repeat scroll 0 0 #ffffff;
    border: 1px solid #cccccc;
    color: #999999;
    display: inline-block;
    font: 15px/25px Arial,Helvetica,sans-serif;
    margin: 5px 3px 0 0;
    padding: 0 5px;
    text-align: center;
    text-decoration: none;
    }  
    ul.setPaginate li a:hover,
    ul.setPaginate li a.current_page
    {
    background: none repeat scroll 0 0 #0d92e1;
    border: 1px solid #000000;
    color: #ffffff;
    text-decoration: none;
    }
    ul.setPaginate li a{
    color:black;
    display:block;
    text-decoration:none;
    padding:5px 8px;
    text-decoration: none;
    }
</style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
			<?php include("../includes/include-admin-sidebar.php");?>
        </div>
          
			<?php include("../includes/include-admin-body-header.php");?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="container">
            </br></br> 
            </br></br> 
            
            <form  action="export_excel.php" method="post" name="seach_excel" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <p class="border">Select CSV File</p>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="file" id="file" class="input-large border">
                    </div>
                    <div class="col-md-4">
                        
                        <button type="submit" id="submit" name="import" class="btn btn-primary import-btn">Search By CSV</button>
                    </div>
                </form>
               </br></br> 
              <input type="text" id="search" onkeyup='searchTable()' value="" placeholder="Search..."> 
      <table border="1" align="center" id="display_list">
        <tr>
            <th> S.No</th>
            <th> Phone No</th>
            <th> Fair Name</th>
            <th> Fair Place</th>
            <th> Comapany</th>
            <th> Address</th>
            <th> Country</th>
            <th> City</th>
            <th> Mail </th>
            <th> Agent</th>
            <th>Call Again Time</th>
            <th> Status</th>
        </tr>
        <?php foreach($record_array_list_to_display as $key=>$val){ ?>
        <tr>
        	<td style="text-align:center;"><?php echo $val['id']; ?></td>
            <td style="text-align:center;"><?php echo $val['phone_no']; ?></td>
            <td style="text-align:center;"><?php echo $val['fair_name']; ?></td>
            <td style="text-align:center;"><?php echo $val['fair_place']; ?></td>
            <td style="text-align:center;"><?php echo $val['co_name']; ?></td>
            <td style="text-align:center;"><?php echo $val['address']; ?></td>
            <td style="text-align:center;"><?php echo $val['country']; ?></td>
            <td style="text-align:center;"><?php echo $val['city']; ?></td>
            <td style="text-align:center;"><?php echo $val['mail_status']; ?></td>
            <td style="text-align:center;"><?php echo $val['agent_name']; ?></td>
            <td style="text-align:center;"><?php echo $val['call_again_time']; ?></td>
            <td style="text-align:center;"><?php if($val['status']!='0'){ echo "active"; }else{ echo "inactive"; } ?></td>
        </tr>
        <?php } ?>
    </table>
    
    <?php echo displayPaginationBelow($con,$setLimit,$page); ?>
             <!--   
                
            <div id="toolbar">
                    <select class="form-control">
                            <option value="">Export Basic</option>
                            <option value="all">Export All</option>
                            <option value="selected">Export Selected</option>
                    </select>
            </div>
            
            <table id="table" 
                     data-toggle="table"
                     data-search="true"
                     data-filter-control="true" 
                     data-show-export="true"
                     data-click-to-select="true"
                     data-toolbar="#toolbar">
                <thead>
                    <tr>
                        <th data-field="a" data-checkbox="true" ></th>
                        <th data-field="b" data-filter-control="select" data-sortable="true">S.No</th>
                        <th data-field="c" data-filter-control="select" data-sortable="true">PHONE NO</th>
                        <th data-field="d" data-filter-control="select" data-sortable="true">FAIR  NAME</th>
                        <th data-field="e" data-filter-control="select" data-sortable="true">FAIR PLACE</th>
                        <th data-field="f" data-filter-control="select" data-sortable="true">COMPANY</th>
                        <th data-field="g" data-filter-control="select" data-sortable="true">COUNTRY</th>
                        <th data-field="h" data-filter-control="select" data-sortable="true">CITY</th>
                        <th data-field="i" data-filter-control="select" data-sortable="true">ADDRESS</th>
                         <th data-field="j" data-filter-control="select" data-sortable="true">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($record_array_list_to_display as $key=>$val){ ?>
                    <tr>
                        <td class="bs-checkbox "><input data-index="0" name="btSelectItem" type="checkbox"></td>
                        <td width="50"><?php echo $val['id']; ?></td>
                        <td width="100"><?php echo $val['phone_no']; ?></td>
                        <td width="100"><?php echo $val['fair_name']; ?></td>
                        <td width="120"><?php echo $val['fair_place']; ?>&nbsp;</td>
                        <td width="100"><?php echo $val['co_name']; ?></td>
                        <td width="100"><?php echo $val['country']; ?></td>
                        <td width="121"><?php echo $val['city']; ?></td>
                        <td width="90"><?php echo $val['address']; ?></td>
                        <td width="50"><?php if($val['status']!='0'){ echo "active"; }else{ echo "inactive"; } ?></td>
                    </tr>
                     <?php } ?>
               </tbody>
            </table>  -->
            </div>
      </div>
    </div>
  </div>
</div>
        
		<script src='js/jquery.min.js'></script>
        <script src='js/bootstrap-table.js'></script>
        <script src='js/bootstrap-table-editable.js'></script>
        <script src='js/bootstrap-table-export.js'></script>
        <script src='js/tableExport.js'></script>
        <script src='js/bootstrap-table-filter-control.js'></script>
        <script src="js/index.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- /page content -->
	<script>
        
    function searchTable() {
        var input, filter, found, table, tr, td, i, j;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("display_list");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
            if (found) {
                tr[i].style.display = "";
                found = false;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    </script>

	
        </script>
        
    	<? include '../includes/body-footer.php';?>
      </div>
    </div>
    <? include '../includes/body-end-includes.php';?>
  </body>
</html>

