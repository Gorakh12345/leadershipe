<?php 

	session_start();
	
	require_once('../functions/connection.php');
	require_once('../functions/inv_common_functions.php');
	require_once('../dao/access_control_dao.php');
	require_once('../dao/business_config_dao.php');
	require_once('../dao/inv_product_master_dao.php');
	require_once('../dao/inv_type_master_dao.php');
	require_once('../dao/inv_size_master_dao.php');
	require_once('../dao/inv_color_master_dao.php');
	require_once('../dao/inv_warehouse_master_dao.php');
	require_once('../dao/inv_product_category_dao.php');
	require_once('../dao/inv_product_listing_dao.php');
	require_once('../dao/inv_country_master_dao.php');
	require_once('../dao/inv_product_listing_history.php');
	require_once('../dao/inv_shipped_product_details.php');
	
	

	if (check_authentication() != 1) {
		header('Location: /inventory/access-control/login.php');
	}

	$con = get_connection();

	if ($_GET['id'] != '') {
		$row = get_product_listing_by_id($con, base64_decode($_GET['id']));
		
	/*	echo "<pre>";
		print_r($row);
		echo "</pre>";
		die;*/	
		$id                   = $row['id'];
		$master_category_id   = $row['master_category_id'];
		$product_name_id      = $row['product_name_id'];
		$product_type_id      = $row['product_type_id'];
		$product_size_id      = $row['product_size_id'];
		$product_color_id     = $row['product_color_id'];
		$stackable            = $row['stackable'];
		$product_model        = $row['product_model'];
		$country_id           = $row['country_id'];
		$warehouse_id         = $row['warehouse_id'];
		$product_quantity     = $row['product_quantity'];
		$product_image        = $row['product_image'];
		$status               = $row['status'];
	} else {
		$id 				  = $_POST['id'];
		$master_category_id   = $_POST['master_category_id'];
		$product_name_id      = $_POST['product_name_id'];
		$product_type_id      = $_POST['product_type_id'];
		$product_size_id      = $_POST['product_size_id'];
		$product_color_id     = $_POST['product_color_id'];
		$stackable            = $_POST['stackable'];
		$product_model        = $_POST['product_model'];
		$country_id           = $_POST['country_id'];
		$warehouse_id         = $_POST['warehouse_id'];
		$product_quantity     = $_POST['product_quantity'];
		$product_image        = $_POST['product_image'];
		$status               = $_POST['status'];
	}
	
	if ($_POST['id'] != '' || $_POST['product_name_id'] != '' ||$_POST['master_category_id'] != '' || $_POST['product_type_id'] != '' || $_POST['product_size_id'] != '' || $_POST['product_color_id'] != '' || $_POST['stackable'] != '' || $_POST['product_model'] != '' || $_POST['country_id']!='' || $_POST['warehouse_id'] != '' || $_POST['product_quantity'] != '' || $_POST['product_image'] != '' || $_POST['status'] != '') {

		if ($_POST['id'] != '') {
			try{
				
				$rand_no = mt_rand();
				
				if ($_FILES['product_image_files']['name'] != ''){
					
					if ($product_image != '' && $product_image != 'NUll')
					{
							unlink($_SERVER['DOCUMENT_ROOT']."/inventory/images".$product_image);
					}
					
					$product_image = upload_file('product-list-image', 'product_image_files', $rand_no, 'pay');
				} else {
					$product_image = $product_image;
				}				
								
				$affected_id = update_product_listing($con, $id, $master_category_id, $product_name_id, $product_type_id, $product_size_id, $product_color_id, $stackable, $product_model, $country_id, $warehouse_id, $product_quantity, $product_image, $created_by, $created_date, $updated_by, $status);
				
				if($affected_id){
				create_product_listing_history($con, $id, $product_quantity,'update', $status);
				$product_list_history_result = search_product_listing_history ($con, '', $product_listing_id, '',$reason, 'active', $order_by, $limit, $offset);
				
				$product_list_history 	 = mysqli_fetch_array($product_list_history_result);
				$product_list_history_id = $product_list_history['id'];
				$product_listing_id      = $product_list_history['product_listing_id'];
				$product_quantity        = $product_list_history['product_quantity'];
				$reason                  = $product_list_history['reason'];
				$product_listing_id      = $product_list_history['product_listing_id'];
				
				update_product_listing_history ($con, $product_list_history_id, $product_listing_id, $product_quantity,$reason, 'inactive');
				}
				header('Location: /inventory/product-listing/product_listing_search_results.php');

			} catch(Exception $e) {
				$error_msg = $e->getMessage();
			}

		} else {
		
			try{
				
				$rand_no = mt_rand();
				
				if ($_FILES['product_image_files']['name'] != ''){
					$product_image = upload_file('product-list-image', 'product_image_files', $rand_no, 'pay');
				} else {
					$product_image = $product_image;
				}		
					
				$result = get_product_listing_by_multiple_ids($con, $master_category_id, $product_name_id, $product_type_id,$product_size_id,$product_color_id,$country_id,$warehouse_id);
							
				if(empty($result)){
				$inserted_id = create_product_listing($con, $master_category_id, $product_name_id, $product_type_id, $product_size_id, $product_color_id, $stackable, $product_model, $country_id, $warehouse_id, $product_quantity, $product_image, $created_by, $updated_by, $status);
				
				create_product_listing_history($con, $inserted_id, $product_quantity,'add', $status);
				
				create_shipped_product_details($con, $inserted_id,'','','', '', 'new_entry', $status);
				
					header('Location: /inventory/product-listing/product_listing_search_results.php');
				}				
				
			} catch(Exception $e) {
				$error_msg = $e->getMessage();
			}

		}

	} 
	
	

$stackable_arr=array('yes'=>'Yes','no'=>'No');

?>
