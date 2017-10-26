<?php
	// GLOBAL Declaration
	// Do not delete
	
	function error_message($error){
		if($error == 'E_NVL_COUNTRY_MASTER_ID'){
			$message = 'Please select Country';
		}
		if($error == 'E_NVL_CITY_MASTER_ID'){
			$message = 'Please select City';
		}
		if($error == 'E_NVL_SERVICE_MASTER_ID'){
			$message = 'Please select Service';
		}
		if($error == 'E_NVL_SUB_SERVICE_MASTER_ID'){
			$message = 'Please select Sub Service';
		}
	return $message;
	}
	
	function company_url_encode($company){
		
		$company1 = str_replace(" ","-",$company);
		$company2 =strtolower($company1);
		return $company2;
	}
	function company_url_decode($company){
		
		$company1 = str_replace("-"," ",$company);
		$company2 =strtolower($company1);
		return $company2;
	}
	
	function upload_file_web($file_type, $pic_post_var, $id, $id_type){
		
		if($file_type == 'supplier-logo-images'){
			$upload_dir = 'expopanel/images/supplier-logo-images/';
		}elseif($file_type == 'supplier-branch-images'){
			$upload_dir = 'expopanel/images/supplier-branch-images/';
		}elseif($file_type == 'supplier-sub-branch-images'){
			$upload_dir = 'expopanel/images/supplier-sub-branch-images/';
		}elseif($file_type == 'profile-images'){
			$upload_dir = 'expopanel/images/profile-images/';
		}elseif($file_type == 'exhibitor-logo'){
			$upload_dir = 'expopanel/images/exhibitor-logo/';
		}elseif($file_type == 'event-logo'){
			$upload_dir = 'expopanel/images/event-logo/';			
		}elseif($file_type == 'organiser-logo'){
			$upload_dir = 'expopanel/images/organiser-logo/';			
		}else{
			$upload_dir = 'expopanel/images/other-image/';
		}
				
		 $orig_file_name = basename($_FILES[$pic_post_var]['name']);
		//exit;
		$orig_file_name_components = explode('.',$orig_file_name);
		$file_extn = $orig_file_name_components[1];
		$new_file_name = md5(uniqid(rand(), true)) . '.' . $file_extn;
		$full_file_path = $upload_dir . $new_file_name;
		move_uploaded_file($_FILES[$pic_post_var]['tmp_name'], $full_file_path);
		return '/' . $file_type . '/' . $new_file_name;
	}
	
	
	function upload_file($file_type, $pic_post_var, $id, $id_type){
		
		
		if($file_type == 'supplier-logo-images'){
			$upload_dir = '../../images/supplier-logo-images/';
		}elseif($file_type == 'supplier-branch-images'){
			$upload_dir = '../../images/supplier-branch-images/';
		}elseif($file_type == 'supplier-sub-branch-images'){
			$upload_dir = '../../images/supplier-sub-branch-images/';
		}elseif($file_type == 'profile-images'){
			$upload_dir = '../../images/profile-images/';
		}elseif($file_type == 'exhibitor-logo'){
			$upload_dir = '../../images/exhibitor-logo/';
		}elseif($file_type == 'profile-images1'){
			$upload_dir = '../../profile-images/';
		}elseif($file_type == 'organiser-logo'){
			$upload_dir = '../../images/organiser-logo/';
		}elseif($file_type == 'event-logo'){
			$upload_dir = '../../images/event-logo/';
			
		}else{
			$upload_dir = '../../images/other-image/';
		}
		
		
		 $orig_file_name = basename($_FILES[$pic_post_var]['name']);
		 
		$orig_file_name_components = explode('.',$orig_file_name);
		$file_extn = $orig_file_name_components[1];
		$new_file_name = md5(uniqid(rand(), true)) . '.' . $file_extn;
		$full_file_path = $upload_dir . $new_file_name;
		
		move_uploaded_file($_FILES[$pic_post_var]['tmp_name'], $full_file_path);
		return '/' . $file_type . '/' . $new_file_name;
	}
	
	
	function multiple_upload_file_web($file_type, $pic_post_var, $id, $file_number){
		if($file_type == 'supplier-stand-images'){
			$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/expopanel/images/supplier-stand-images/';
		}elseif($file_type == 'exhibitor-stand-images'){
			$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/expopanel/images/exhibitor-stand-images/';
		}elseif($file_type == 'publish-job-images'){
			$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/expopanel/images/publish-job-images/';
		}else{
			$upload_dir = '../../images/other-image/';
		}
		
		$orig_file_name = basename($_FILES[$pic_post_var]['name'][$file_number]);
		$orig_file_name_components = explode('.',$orig_file_name);
		$file_extn = $orig_file_name_components[1];
		$new_file_name = md5(uniqid(rand(), true)) . '.' . $file_extn;
		$full_file_path = $upload_dir . $new_file_name;
		move_uploaded_file($_FILES[$pic_post_var]['tmp_name'][$file_number], $full_file_path);
		return '/' . $file_type . '/' . $new_file_name;
	}
	
	
	function multiple_upload_file($file_type, $pic_post_var, $id, $file_number){
		
		if($file_type == 'supplier-stand-images'){
			$upload_dir = '../../images/supplier-stand-images/';
		}elseif($file_type == 'supplier-sub-branch-images'){
			$upload_dir = '../../images/supplier-sub-branch-images/';
		}elseif($file_type == 'exhibitor-publish-stand-images'){
			$upload_dir = '../../images/exhibitor-publish-stand-images/';
		}else{
			$upload_dir = '../../images/other-image/';
		}
		
		$orig_file_name = basename($_FILES[$pic_post_var]['name'][$file_number]);
		$orig_file_name_components = explode('.',$orig_file_name);
		$file_extn = $orig_file_name_components[1];
		$new_file_name = md5(uniqid(rand(), true)) . '.' . $file_extn;
		$full_file_path = $upload_dir . $new_file_name;
		move_uploaded_file($_FILES[$pic_post_var]['tmp_name'][$file_number], $full_file_path);
		return '/' . $file_type . '/' . $new_file_name;
	}
	
	
	
	function delete_multiple_images($con, $suppiler_id){
		
//		$result = search_supplier_image_master($con, '', $suppiler_id,'', '', '', '');
//		while($row = mysqli_fetch_array($result)) {
//			try{
//			unlink($_SERVER['DOCUMENT_ROOT']."cpanel/images".$row['image_path']);
//			}catch(Exception $e){
//				
//			}
//		}

		$sql = "DELETE FROM supplier_image_master WHERE supplier_master_id = " . $suppiler_id;

		//echo $sql;
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to delete supplier_image_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			throw new Exception("E_GENERAL_ERROR");
		}		
	}

	function delete_publish_multiple_images($con, $publish_stand_master_id){

		$sql = "DELETE FROM publish_stand_image_master WHERE publish_stand_master_id = " . $publish_stand_master_id;

		//echo $sql;
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to delete publish_stand_image_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			throw new Exception("E_GENERAL_ERROR");
		}		
	}
	
	
	
	
	function check_existing_user_exhibitor_supplier($con, $email){

		$sql = "SELECT email FROM supplier_master WHERE email = '" . $email."'";
		$result = mysqli_query($con, $sql);
		$supplier_count = mysqli_num_rows($result);
		
		if($supplier_count>0){
			$supplier_email = 1;
		}
		
		
		$sql = "SELECT exhibitor_email FROM exhibitor_master WHERE exhibitor_email = '" . $email."'";
		$result = mysqli_query($con, $sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$exhibitor_email = 1;
		}

		$email_count = 0;
		
		$email_count += $exhibitor_email + $supplier_email;
		
		return $email_count;
		
	}

	
	
	
	
	
	
	
	
	
	
	
 	function custom_search_publish_stand_image_master($con, $exhibitor_master_id, $publish_stand_master_id){
	
	  $sql = "SELECT * FROM publish_stand_image_master WHERE exhibitor_master_id = '" . $exhibitor_master_id."' and publish_stand_master_id = '" . $publish_stand_master_id."'";

		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to delete publish_stand_image_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			//throw new Exception("E_GENERAL_ERROR");
		}
		
		$result = mysqli_query($con, $sql);
		return $result;
	
	}
	
	
	
	
	
	
	

	
	function delete_supplier_branch_master_by_supplier_id($con, $suppiler_id){
		$sql = "DELETE FROM supplier_branch_master WHERE supplier_master_id = " . $suppiler_id;

		//echo $sql;
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to delete supplier_branch_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			throw new Exception("E_GENERAL_ERROR");
		}		
	}
	
	
	
	function get_supplier_content_master_by_supplier_master_id($con, $id){
		$sql = "SELECT * FROM supplier_content_master WHERE supplier_master_id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row;
	}
	
	function get_exhibitor_content_master_by_exhibitor_master_id($con, $id){
		 $sql = "SELECT * FROM exhibitor_content_master WHERE exhibitor_master_id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row;
	}
	
	
	function check_supplier_email_duplicasy($con, $supplier_email){
		$sql = "SELECT email FROM supplier_master WHERE email = '" . $supplier_email."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$count = mysqli_num_rows($result);

		return $count;
	}
	
	function format_date($datetime){
		$datetime_value =  date("d-M-Y",strtotime($datetime));
		return $datetime_value;
	}	
	
	function format_date_web($datetime){
		$datetime_value =  date("d M Y",strtotime($datetime));
		return $datetime_value;
	}
	
	function days_count_between_two_dates($start_date1, $end_date){
		
		$start = strtotime($start_date1);
		$end = strtotime($end_date);
		
		$days_between = ceil(abs($end - $start) / 86400);
		
		return $days_between;
	}	
	
	function get_max_row_id($con, $table_name){
		$sql = "SELECT MAX(id) as id FROM ". $table_name;
		$result = mysqli_query($con, $sql);
		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}
		$row = mysqli_fetch_array($result);
		return $row['id'];
	}
	
	
	
	function get_supplier_english_content_master_by_supplier_id($con, $supplier_master_id){
		$sql = "SELECT english_content FROM supplier_content_master WHERE supplier_master_id = " . $supplier_master_id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['english_content'];
	}
	
	function get_supplier_image_master_by_supplier_id($con, $supplier_master_id){
		$sql = "SELECT * FROM supplier_image_master WHERE supplier_master_id = " . $supplier_master_id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['image_path'];
	}
	
	///////////////// city master /////////
	
	
	function get_city_master_name_by_value($con, $value){
		$sql = "SELECT * FROM city_master WHERE value = " . $value ."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	function get_city_master_id_by_value($con, $value){
		$sql = "SELECT * FROM city_master WHERE value = " . $value ."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['id'];
	}
	function get_country_master_name_by_value($con, $value){
		$sql = "SELECT * FROM country_master WHERE value = '" . $value ."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	function get_country_master_id_by_value($con, $value){
		$sql = "SELECT * FROM country_master WHERE value = '" . $value ."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['id'];
	}
	
	function get_city_master_name_by_id($con, $id){
		$sql = "SELECT * FROM city_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	function get_country_master_name_by_id($con, $id){
		$sql = "SELECT * FROM country_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	//////////////city master ////////////	 
	
	///////////////// industry master /////////
	function get_industry_master_name_by_id($con, $id){
		$sql = "SELECT * FROM industry_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	//////////////industry master ////////////	 
	
	///////////////// type master /////////
	function get_service_master_name_by_id($con, $id){
		$sql = "SELECT * FROM service_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_NVL_SUB_TYPE_MASTER_ID");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	
	function get_sub_service_master_name_by_id($con, $id){
		$sql = "SELECT * FROM sub_service_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_NVL_SUB_SERVICE_MASTER_ID");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	//////////////industry master ////////////	 

	///////////////// size master /////////
	function get_size_master_name_by_id($con, $id){
		$sql = "SELECT * FROM size_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	//////////////size master ////////////	 
	
	
	///////////////// product code /////////
	function generate_product_code_by_sub_type($con, $sub_type_master_id){
		
		$sub_type = get_type_master_name_by_id($con, $sub_type_master_id);
		
		$words = explode(" ", $sub_type);
		$acronym = "";
		
		foreach ($words as $w) {
		  $acronym .= $w[0];
		}
		$max_id = get_max_row_id($con, 'project_master');
		$max_id = $max_id + 1;
		
		$max_id_with_4digit = str_pad($max_id, 4, "0", STR_PAD_LEFT);
		
		$product_code = $acronym . $max_id_with_4digit;

		return $product_code;
	}
	//////////////product code ////////////	 
	
	///////////////// seo url /////////
	function get_seo_url_by_identifier($con, $table, $identifier){
		
		$sql = "SELECT seo_url FROM ".$table." WHERE identifier = '" . $identifier."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);


		return $row['seo_url'];
	}
	//////////////user master ////////////	  


	///////////////// user master /////////
	function get_user_master_name_by_id($con, $id){
		$sql = "SELECT * FROM user_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['name'];
	}
	//////////////user master ////////////	  
	 
	///////////////// user master /////////
	function get_business_config_name_by_identifier($con, $identifier){
		$sql = "SELECT * FROM business_config WHERE value = '" . $identifier."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);


		return $row['name'];
	}
	
	function get_business_config_name_by_id($con, $id){
		$sql = "SELECT * FROM business_config WHERE id = '" . $id."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);


		return $row['name'];
	}
	
	
	//////////////user master ////////////	 
	
	function custom_search_project_master($con, $type_master_id, $sub_type_master_id, $industry_master_id, $size, $start_event_date, $end_event_date, $status, $order_by, $limit, $offset){
		$sql = "SELECT * from project_master WHERE 1 ";
		
		
		$type_master_id = mysqli_real_escape_string($con, $type_master_id);
		if ($type_master_id != '' && $type_master_id != 0){
			$sql .= " AND type_master_id = " . $type_master_id;
		}
		$sub_type_master_id = mysqli_real_escape_string($con, $sub_type_master_id);
		if ($sub_type_master_id != '' && $sub_type_master_id != 0){
			$sql .= " AND sub_type_master_id = " . $sub_type_master_id;
		}
		$industry_master_id = mysqli_real_escape_string($con, $industry_master_id);
		if ($industry_master_id != '' && $industry_master_id != 0){
			$sql .= " AND industry_master_id = " . $industry_master_id;
		}
		$size = mysqli_real_escape_string($con, $size);
		if ($size != ''){
			$sql .= " AND size = '" . $size . "'";
		}
		
//		$event_date = mysqli_real_escape_string($con, $event_date);
		if ($start_event_date != '' && $end_event_date != ''){
			
			$sql .= " AND (`event_date` >= '".$start_event_date."' AND `event_date` <= '".$end_event_date."')" ;
			
		}
		
		$status = mysqli_real_escape_string($con, $status);
		if ($status != ''){
			$sql .= " AND status = '" . $status . "'";
		}
		if ($order_by != ''){
			$sql .= " ORDER BY " . $order_by;
		}

		if ($limit != '' && $offset != ''){
			$sql .= " LIMIT " . $limit . " OFFSET " . $offset;
		}

		//echo $sql;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		return $result;
	} 
            
			 ###############################################################################################
    
                                             /* Gorakh Common Function */ 
    
             ###############################################################################################    
    
    
    
	function get_supplier_master_company_name_by_id($con, $id){
		$sql = "SELECT company_name FROM supplier_master WHERE id = '" . $id."'";

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row['company_name'];
	}
     
	 function publish_stand_image_master_by_ids($con, $exhibitor_master_id, $publish_stand_master_id){
        
    	  $sql = "SELECT * FROM publish_stand_image_master WHERE exhibitor_master_id = '" . $exhibitor_master_id."' and publish_stand_master_id = '" . $publish_stand_master_id."'";
    
    		if (!mysqli_query($con,$sql)){
    			error_log(PHP_EOL . 'ERROR: Unable to delete publish_stand_image_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
    			throw new Exception("E_GENERAL_ERROR");
    		}		
        		$query = mysqli_query($con, $sql);
                    if($query){
                        $result=mysqli_fetch_array($query);
                    }
                      if($result!=""){
                        return $result;
                      }else{
                        return false;
                      }
    		
     }
	 
	 
	  function top_trade_shows_list($con, $offset, $limt){
        
    	  $sql = "SELECT * FROM `organiser_event_master` GROUP BY ( organiser_master_id ) LIMIT $offset ,$limt";
    
    		if (!mysqli_query($con,$sql)){
    			error_log(PHP_EOL . 'ERROR: Unable to delete publish_stand_image_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
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
	 
	 
		
    
?>