<?php
	function validate_insert_supplier_master($con, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $updated_by, $status) {
		if( $country_master_id == ''){
			$err_str .= 'E_NVL_COUNTRY_MASTER_ID,';
		} else {
			if (!ctype_digit($country_master_id)){
				$err_str .= 'E_DT_COUNTRY_MASTER_ID,';
			}

			if (strlen($country_master_id) > 11){
				$err_str .= 'E_SIZE_COUNTRY_MASTER_ID,';
			}
		} // end-else
		if( $city_master_id == ''){
			$err_str .= 'E_NVL_CITY_MASTER_ID,';
		} else {
			if (!ctype_digit($city_master_id)){
				$err_str .= 'E_DT_CITY_MASTER_ID,';
			}

			if (strlen($city_master_id) > 11){
				$err_str .= 'E_SIZE_CITY_MASTER_ID,';
			}
		} // end-else
						if( $Bus_scope_country == ''){
							$err_str .= 'Bus_scope_country,';
						} else {
				
							if (strlen($Bus_scope_country) > 512){
								$err_str .= 'Bus_scope_country,';
							}
						} // end-else
							
		if( $service_master_id == ''){
			$err_str .= 'E_NVL_SERVICE_MASTER_ID,';
		} else {
			if (!ctype_digit($service_master_id)){
				$err_str .= 'E_DT_SERVICE_MASTER_ID,';
			}

			if (strlen($service_master_id) > 11){
				$err_str .= 'E_SIZE_SERVICE_MASTER_ID,';
			}
		} // end-else
		if( $sub_service_master_id == ''){
			$err_str .= 'E_NVL_SUB_SERVICE_MASTER_ID,';
		} else {

			if (strlen($sub_service_master_id) > 50){
				$err_str .= 'E_SIZE_SUB_SERVICE_MASTER_ID,';
			}
		} // end-else
		if( $status == ''){
			$err_str .= 'E_NVL_STATUS,';
		} else {

			if (strlen($status) > 20){
				$err_str .= 'E_SIZE_STATUS,';
			}
		} // end-else
		if($err_str != ''){
        	throw new Exception ($err_str);
        }
	} // end-function

	function create_supplier_master($con, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $updated_by, $status){
		validate_insert_supplier_master($con, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $updated_by, $status);
		$id = mysqli_real_escape_string($con, $id);
//		if ($company_name == ''){
//			$company_name = 'NULL';
//		}

		$company_name = mysqli_real_escape_string($con, $company_name);
//		if ($comp_web_name == ''){
//			$comp_web_name = 'NULL';
//		}
		
		$company_value = mysqli_real_escape_string($con, $company_value);
//		if ($comp_web_name == ''){
//			$comp_web_name = 'NULL';
//		}

		$comp_web_name = mysqli_real_escape_string($con, $comp_web_name);
//		if ($first_name == ''){
//			$first_name = 'NULL';
//		}
//
   		$first_name = mysqli_real_escape_string($con, $first_name);
//		if ($last_name == ''){
//			$last_name = 'NULL';
//		}
//
		$last_name = mysqli_real_escape_string($con, $last_name);
//		if ($email == ''){
//			$email = 'NULL';
//		}
//
		$email = mysqli_real_escape_string($con, $email);
//		if ($password == ''){
//			$password = 'NULL';
//		}
//
		$password = mysqli_real_escape_string($con, $password);
//		if ($mobile == ''){
//			$mobile = 'NULL';
//		}

		$mobile = mysqli_real_escape_string($con, $mobile);
		$country_master_id = mysqli_real_escape_string($con, $country_master_id);
		$city_master_id = mysqli_real_escape_string($con, $city_master_id);
//		if ($company_logo == ''){
//			$company_logo = 'NULL';
//		}
//
		$company_logo = mysqli_real_escape_string($con, $company_logo);
//		if ($company_address == ''){
//			$company_address = 'NULL';
//		}
//
		$company_address = mysqli_real_escape_string($con, $company_address);
		$service_master_id = mysqli_real_escape_string($con, $service_master_id);
		$sub_service_master_id = mysqli_real_escape_string($con, $sub_service_master_id);
//		if ($Bus_scope_country == ''){
//			$Bus_scope_country = 'NULL';
//		}
//
		$Bus_scope_country = mysqli_real_escape_string($con, $Bus_scope_country);
//		if ($created_by == ''){
//			$created_by = 'NULL';
//		}
//

		$Bus_scope_country = mysqli_real_escape_string($con, $Bus_scope_country);
//		if ($branch_image == ''){
//			$branch_image = 'NULL';
//		}


//		//$created_by = mysqli_real_escape_string($con, $created_by);
//		if ($created_date == ''){
//			$created_date = 'NULL';
//		}
//
//		//$created_date = mysqli_real_escape_string($con, $created_date);
//		if ($updated_by == ''){
//			$updated_by = 'NULL';
//		}
//
//		//$updated_by = mysqli_real_escape_string($con, $updated_by);
//		if ($updated_date == ''){
//			$updated_date = 'NULL';
//		}

		//$updated_date = mysqli_real_escape_string($con, $updated_date);
		//$status = mysqli_real_escape_string($con, $status);

		$sql = "INSERT INTO supplier_master (company_name, company_value, comp_web_name, first_name, last_name, email, password, mobile, country_master_id, city_master_id, company_logo, company_address, service_master_id, sub_service_master_id, Bus_scope_country, branch_image, created_by, created_date, updated_by, updated_date, status) VALUES ( " .
				" " . "'" . $company_name . "'" . 
				"," . "'" . $company_value . "'" . 
				"," . "'" . $comp_web_name . "'" . 
				"," . "'" . $first_name . "'" . 
				"," . "'" . $last_name . "'" . 
				"," . "'" . $email . "'" . 
				"," . "'" . $password . "'" . 
				"," . "'" . $mobile . "'" . 
				"," . $country_master_id . 
				"," . $city_master_id . 
				"," . "'" . $company_logo . "'" . 
				"," . "'" . $company_address . "'" . 
				"," . $service_master_id . 
				"," . "'" . $sub_service_master_id . "'" .
				"," . "'" . $Bus_scope_country . "'" .
				"," . "'" . $branch_image . "'" .  
				"," . "'" . $_SESSION['mystand_user_id'] . "'" . 
				"," . "'" . date("Y-m-d H:i:s") . "'" . 
				"," . "'" . $_SESSION['mystand_user_id'] . "'" . 
				"," . "'" . date("Y-m-d H:i:s") . "'" . 
				"," . "'" . $status . "'" . 
				")";
		//echo $sql;
		
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to create supplier_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			throw new Exception("E_GENERAL_ERROR");
		}
		return mysqli_insert_id($con);	
	}
	function validate_update_supplier_master($con, $id, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $created_date, $updated_by, $status) {
		if( $id == ''){
			$err_str .= 'E_NVL_ID,';
		} else {
			if (!ctype_digit($id)){
				$err_str .= 'E_DT_ID,';
			}

			if (strlen($id) > 11){
				$err_str .= 'E_SIZE_ID,';
			}
		} // end-else
		if( $country_master_id == ''){
			$err_str .= 'E_NVL_COUNTRY_MASTER_ID,';
		} else {
			if (!ctype_digit($country_master_id)){
				$err_str .= 'E_DT_COUNTRY_MASTER_ID,';
			}

			if (strlen($country_master_id) > 11){
				$err_str .= 'E_SIZE_COUNTRY_MASTER_ID,';
			}
		} // end-else
		if( $city_master_id == ''){
			$err_str .= 'E_NVL_CITY_MASTER_ID,';
		} else {
			if (!ctype_digit($city_master_id)){
				$err_str .= 'E_DT_CITY_MASTER_ID,';
			}

			if (strlen($city_master_id) > 11){
				$err_str .= 'E_SIZE_CITY_MASTER_ID,';
			}
		} // end-else
		
			if( $Bus_scope_country == ''){
				$err_str .= 'Bus_scope_country,';
			} else {
				
	
				if (strlen($Bus_scope_country) > 512){
					$err_str .= 'Bus_scope_couzxcvntry,';
				}
			} // end-else
		
		if( $service_master_id == ''){
			$err_str .= 'E_NVL_SERVICE_MASTER_ID,';
		} else {
			if (!ctype_digit($service_master_id)){
				$err_str .= 'E_DT_SERVICE_MASTER_ID,';
			}

			if (strlen($service_master_id) > 11){
				$err_str .= 'E_SIZE_SERVICE_MASTER_ID,';
			}
		} // end-else
		if( $sub_service_master_id == ''){
			$err_str .= 'E_NVL_SUB_SERVICE_MASTER_ID,';
		} else {

			if (strlen($sub_service_master_id) > 50){
				$err_str .= 'E_SIZE_SUB_SERVICE_MASTER_ID,';
			}
		} // end-else
		if( $status == ''){
			$err_str .= 'E_NVL_STATUS,';
		} else {

			if (strlen($status) > 20){
				$err_str .= 'E_SIZE_STATUS,';
			}
		} // end-else
		if($err_str != ''){
        	throw new Exception ($err_str);
        }

	} // end-function

	function update_supplier_master($con, $id, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $created_date, $updated_by, $status){
		if($id == ''){
			throw new Exception("E_MAN_ID");
		}

		validate_update_supplier_master($con, $id, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $created_date, $updated_by, $status);

	$id = mysqli_real_escape_string($con, $id);			
//		if ($company_name == ''){
//			$company_name = 'NULL';
//		}

	$company_name = mysqli_real_escape_string($con, $company_name);			
//		if ($comp_web_name == ''){
//			$comp_web_name = 'NULL';
//		}

	$company_value = mysqli_real_escape_string($con, $company_value);			
//		if ($comp_web_name == ''){
//			$comp_web_name = 'NULL';
//		}

	$comp_web_name = mysqli_real_escape_string($con, $comp_web_name);			
//		if ($first_name == ''){
//			$first_name = 'NULL';
//		}

	$first_name = mysqli_real_escape_string($con, $first_name);			
//		if ($last_name == ''){
//			$last_name = 'NULL';
//		}

	$last_name = mysqli_real_escape_string($con, $last_name);			
//		if ($email == ''){
//			$email = 'NULL';
//		}

	$email = mysqli_real_escape_string($con, $email);			
//		if ($password == ''){
//			$password = 'NULL';
//		}

	$password = mysqli_real_escape_string($con, $password);			
//		if ($mobile == ''){
//			$mobile = 'NULL';
//		}

	$mobile = mysqli_real_escape_string($con, $mobile);			
	$country_master_id = mysqli_real_escape_string($con, $country_master_id);			
	$city_master_id = mysqli_real_escape_string($con, $city_master_id);			
//		if ($company_logo == ''){
//			$company_logo = 'NULL';
//		}

	$company_logo = mysqli_real_escape_string($con, $company_logo);			
//		if ($company_address == ''){
//			$company_address = 'NULL';
//		}

	$company_address = mysqli_real_escape_string($con, $company_address);			
	$service_master_id = mysqli_real_escape_string($con, $service_master_id);			
	$sub_service_master_id = mysqli_real_escape_string($con, $sub_service_master_id);			
//		if ($Bus_scope_country == ''){
//			$Bus_scope_country = 'NULL';
//		}

	$Bus_scope_country = mysqli_real_escape_string($con, $Bus_scope_country);			
//		if ($created_by == ''){
//			$created_by = 'NULL';
//		}
	$branch_image = mysqli_real_escape_string($con, $branch_image);			
//		if ($created_by == ''){
//			$created_by = 'NULL';
//		}
	$created_by = mysqli_real_escape_string($con, $created_by);			
//		if ($created_date == ''){
//			$created_date = 'NULL';
//		}

	$created_date = mysqli_real_escape_string($con, $created_date);			
//		if ($updated_by == ''){
//			$updated_by = 'NULL';
//		}

	$updated_by = mysqli_real_escape_string($con, $updated_by);			
//		if ($updated_date == ''){
//			$updated_date = 'NULL';
//		}

	$updated_date = mysqli_real_escape_string($con, $updated_date);			
	$status = mysqli_real_escape_string($con, $status);			

		$sql = "UPDATE supplier_master SET " .

			"  company_name = '" . $company_name . "'" .
			", company_value = '" . $company_value . "'" . 
			", comp_web_name = '" . $comp_web_name . "'" . 
			", first_name = '" . $first_name . "'" . 
			", last_name = '" . $last_name . "'" . 
			", email = '" . $email . "'" . 
			", password = '" . $password . "'" . 
			", mobile = '" . $mobile . "'" . 
			", country_master_id = " . $country_master_id . 
			", city_master_id = " . $city_master_id . 
			", company_logo = '" . $company_logo . "'" . 
			", company_address = '" . $company_address . "'" . 
			", service_master_id = " . $service_master_id . 
			", sub_service_master_id = '" . $sub_service_master_id . "'" . 
			", Bus_scope_country = '" . $Bus_scope_country . "'" . 
			", branch_image = '" . $branch_image . "'" . 
			", created_by = '" . $created_by . "'" . 
			", created_date = '" . $created_date . "'" . 
			", updated_by = '" . $_SESSION['mystand_user_id']. "'" .
			", updated_date = '" . date("Y-m-d H:i:s") . "'" . 
			", status = '" . $status . "'" . 
			
			" WHERE id = " . $id;

		//echo $sql;
		
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to update supplier_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			
			throw new Exception("E_GENERAL_ERROR,");
		}
	}

	function get_supplier_master_by_id($con, $id){
		$sql = "SELECT * FROM supplier_master WHERE id = " . $id;

		$result = mysqli_query($con, $sql);

		if (!$result) {
			throw new Exception("E_GENERAL_ERROR");
		}

		$row = mysqli_fetch_array($result);

		return $row;
	}

	function search_supplier_master($con, $id, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $created_date, $updated_by, $updated_date, $status, $order_by, $limit, $offset){
		$sql = "SELECT * from supplier_master WHERE 1 ";
		$id = mysqli_real_escape_string($con, $id);
		if ($id != '' && $id != 0){
			$sql .= " AND id = " . $id;
		}
		$company_name = mysqli_real_escape_string($con, $company_name);
		if ($company_name != ''){
			$sql .= " AND company_name = '" . $company_name . "'";
		}
		$company_value = mysqli_real_escape_string($con, $company_value);
		if ($company_value != ''){
			$sql .= " AND company_value = '" . $company_value . "'";
		}
		$comp_web_name = mysqli_real_escape_string($con, $comp_web_name);
		if ($comp_web_name != ''){
			$sql .= " AND comp_web_name = '" . $comp_web_name . "'";
		}
		$first_name = mysqli_real_escape_string($con, $first_name);
		if ($first_name != ''){
			$sql .= " AND first_name = '" . $first_name . "'";
		}
		$last_name = mysqli_real_escape_string($con, $last_name);
		if ($last_name != ''){
			$sql .= " AND last_name = '" . $last_name . "'";
		}
		$email = mysqli_real_escape_string($con, $email);
		if ($email != ''){
			$sql .= " AND email = '" . $email . "'";
		}
		$password = mysqli_real_escape_string($con, $password);
		if ($password != ''){
			$sql .= " AND password = '" . $password . "'";
		}
		$mobile = mysqli_real_escape_string($con, $mobile);
		if ($mobile != ''){
			$sql .= " AND mobile = '" . $mobile . "'";
		}
		$country_master_id = mysqli_real_escape_string($con, $country_master_id);
		if ($country_master_id != '' && $country_master_id != 0){
			$sql .= " AND country_master_id = " . $country_master_id;
		}
		$city_master_id = mysqli_real_escape_string($con, $city_master_id);
		if ($city_master_id != '' && $city_master_id != 0){
			$sql .= " AND city_master_id = " . $city_master_id;
		}
		$company_logo = mysqli_real_escape_string($con, $company_logo);
		if ($company_logo != ''){
			$sql .= " AND company_logo = '" . $company_logo . "'";
		}
		$company_address = mysqli_real_escape_string($con, $company_address);
		if ($company_address != ''){
			$sql .= " AND company_address = '" . $company_address . "'";
		}
		$service_master_id = mysqli_real_escape_string($con, $service_master_id);
		if ($service_master_id != '' && $service_master_id != 0){
			$sql .= " AND service_master_id = " . $service_master_id;
		}
		$sub_service_master_id = mysqli_real_escape_string($con, $sub_service_master_id);
		if ($sub_service_master_id != ''){
			$sql .= " AND sub_service_master_id = '" . $sub_service_master_id . "'";
		}
		$Bus_scope_country = mysqli_real_escape_string($con, $Bus_scope_country);
		if ($Bus_scope_country != ''){
			$sql .= " AND Bus_scope_country = '" . $Bus_scope_country . "'";
		}
		$branch_image = mysqli_real_escape_string($con, $branch_image);
		if ($branch_image != ''){
			$sql .= " AND branch_image = '" . $branch_image . "'";
		}
		$created_by = mysqli_real_escape_string($con, $created_by);
		if ($created_by != '' && $created_by != 0){
			$sql .= " AND created_by = " . $created_by;
		}
		$created_date = mysqli_real_escape_string($con, $created_date);
		$updated_by = mysqli_real_escape_string($con, $updated_by);
		if ($updated_by != '' && $updated_by != 0){
			$sql .= " AND updated_by = " . $updated_by;
		}
		$updated_date = mysqli_real_escape_string($con, $updated_date);
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

	function search_supplier_master_with_metadata($con, $id, $company_name, $company_value, $comp_web_name, $first_name, $last_name, $email, $password, $mobile, $country_master_id, $city_master_id, $company_logo, $company_address, $service_master_id, $sub_service_master_id, $Bus_scope_country, $branch_image, $created_by, $created_date, $updated_by, $updated_date, $status, $order_by, $limit, $offset){
	}

	function delete_supplier_master($con, $id){
		if($id == ''){
		  throw new Exception("E_MAN_ID");
		}

		$sql = "DELETE FROM supplier_master WHERE id = " . $id;

		//echo $sql;
		if (!mysqli_query($con,$sql))
		{
			error_log(PHP_EOL . 'ERROR: Unable to delete supplier_master -  '.mysqli_error($con), 3, 'sys_out_log.txt');
			throw new Exception("E_GENERAL_ERROR");
		}
	}
?>
