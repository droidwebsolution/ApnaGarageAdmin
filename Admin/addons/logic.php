<?php
    include("apna_garage.php");
    global $con;
    function encrypt_decrypt($action, $string){
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '11566d7582d17996fe86f702e9e1cb16';
        $secret_iv = '11566d7582d17996fe86f702e9e1cb16';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
    function check_data($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        //$data=escapeshellcmd($data);
        return $data;
    }
    function get_brand(){
        global $con;
        $get_brand="select * from ag_brand";
        $brand_get=$con->prepare($get_brand,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        while($rw_brand=$brand_get->fetch()):
            echo"<option value='".$rw_brand['ag_brand_no']."'>".$rw_brand['ag_brand_name']."</option>";
        endwhile;
    }
    function get_mg_company(){
        global $con;
        $get_mg_company="select * from ag_mg_company";
        $mg_company_get=$con->prepare($get_mg_company,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $mg_company_get->setFetchMode(PDO::FETCH_ASSOC);
        $mg_company_get->execute();
        while($rw_mg_company=$mg_company_get->fetch()):
            echo"<option value='". $rw_mg_company['ag_mg_company_no']."'>".$rw_mg_company['ag_mg_company_name']."</option>";
        endwhile;
    }
    function get_partname(){
        global $con;
        $get_partname="select * from ag_partname";
        $partname_get=$con->prepare($get_partname,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $partname_get->setFetchMode(PDO::FETCH_ASSOC);
        $partname_get->execute();
        while($rw_partname=$partname_get->fetch()):
            echo"<option value='". $rw_partname['ag_partname_no']."'>".$rw_partname['ag_partname_name']."</option>";
        endwhile;
    }
    function get_state(){
        global $con;
        $get_state="select * from ag_state";
        $state_get=$con->prepare($get_state,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $state_get->setFetchMode(PDO::FETCH_ASSOC);
        $state_get->execute();
        while($rw_state=$state_get->fetch()):
            echo"<option value='". $rw_state['ag_state_no']."'>".$rw_state['ag_state_name']."</option>";
        endwhile;
    }
    function get_city(){
        global $con;
        $get_city="select * from ag_city";
        $city_get=$con->prepare($get_city,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $city_get->setFetchMode(PDO::FETCH_ASSOC);
        $city_get->execute();
        while($rw_city=$city_get->fetch()):
            echo"<option value='".$rw_city['ag_city_no']."'>".$rw_city['ag_city_name']."</option>";
        endwhile;
    }
    function get_parts(){
        global $con;
        $get_part="select * from ag_part";
        $part_get=$con->prepare($get_part,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        while($rw_part=$part_get->fetch()):
            echo"<option value='". $rw_part['ag_part_no']."'>".$rw_part['ag_part_name']."</option>";
        endwhile;
    }
    function get_expense() {
        global $con;
        $get_expense = "select * from ag_part";
        $expense_get = $con->prepare($get_expense, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $expense_get->setFetchMode(PDO::FETCH_ASSOC);
        $expense_get->execute();
        
        $total_part_expense = 0; 
        
        while ($rw_expense = $expense_get->fetch()):
            $ag_part_qty = $rw_expense['ag_part_qty'];
            $ag_part_purchase_price = $rw_expense['ag_part_purchase_price'];
            $part_total = $ag_part_qty * $ag_part_purchase_price;
            $total_part_expense += $part_total; 
        endwhile;
        
        $get_hold = "select * from ag_part_hold_stock where ag_hold_status=1;";
        $hold_get = $con->prepare($get_hold, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $hold_get->setFetchMode(PDO::FETCH_ASSOC);
        $hold_get->execute();
        
        $total_hold_expense = 0; 
        
        while ($rw_hold = $hold_get->fetch()):
            $ag_new_pp = $rw_hold['ag_new_pp'];
            $ag_hold_qty = $rw_hold['ag_hold_qty'];
            $hold_total = $ag_new_pp * $ag_hold_qty;
            $total_hold_expense += $hold_total; 
        endwhile;
        
        $total_expense = $total_part_expense + $total_hold_expense;
        echo "$total_expense";
    }
    function get_selling(){
        global $con;
        $get_sell="select * from ag_sells_order_cart";
        $sell_get = $con->prepare($get_sell, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sell_get->setFetchMode(PDO::FETCH_ASSOC);
        $sell_get->execute();

        $total_sell_amount=0;

        while($rw_sell = $sell_get->fetch()):
         $ag_sells_price=$rw_sell['ag_sells_price'];
         $ag_sells_qty=$rw_sell['ag_sells_qty'];
         $sell_total= $ag_sells_price * $ag_sells_qty;
        endwhile;
        $total_sell_amount =+ $sell_total;
        echo $total_sell_amount;
    }
    function get_retailer_count(){
        global $con;
        $get_retailer="select * from ag_retailer";
        $retailer_get=$con->prepare($get_retailer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        echo $count_retailer;
       
    }
    function get_vehicle(){
        global $con;
        $get_vehicle="select * from ag_vehicle";
        $vehicle_get=$con->prepare($get_vehicle,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        while($rw_vehicle=$vehicle_get->fetch()):
           // $model_name_year = $rw_vehicle['ag_vehicle_name'] . ' (' . $rw_vehicle['ag_vehicle_mg_year'] . ')';
            //echo "<option value='".$rw_vehicle['ag_vehicle_no']."'>".$model_name_year."</option>";
            echo"<option value='".$rw_vehicle['ag_vehicle_no']."'>".$rw_vehicle['ag_vehicle_model_name'].".(".$rw_vehicle['ag_vehicle_mg_year'].")</option>";
        endwhile;
    }
    function get_retailer(){
        global $con;
        $get_retailer="select * from ag_retailer";
        $retailer_get=$con->prepare($get_retailer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        while($rw_retailer=$retailer_get->fetch()):
            echo"<option value='".$rw_retailer['ag_retailer_no']."'>".$rw_retailer['ag_retailer_company_name']."</option>";
        endwhile;
    }
    function get_customer(){
        global $con;
        $get_customer="select * from ag_customer";
        $customer_get=$con->prepare($get_customer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $customer_get->setFetchMode(PDO::FETCH_ASSOC);
        $customer_get->execute();
        while($rw_customer=$customer_get->fetch()):
            echo"<option value='".$rw_customer['ag_customer_no']."'>".$rw_customer['ag_customer_name']."</option>";
        endwhile;
    }
    function login(){
		global $con;
		if(isset($_POST['user_login'])){
			$ag_admin_email=$_POST['user_email'];
			$ag_admin_password=encrypt_decrypt('encrypt', $_POST['user_password']);
			$gtusr="select * from ag_admin where ag_admin_email=:ag_admin_email and ag_admin_password=:ag_admin_password";
			$usrgt=$con->prepare($gtusr,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$usrgt->bindParam(':ag_admin_email',$ag_admin_email);
			$usrgt->bindParam(':ag_admin_password',$ag_admin_password);
			$usrgt->setFetchMode(PDO::FETCH_ASSOC);
			$usrgt->execute();
			$rwusr=$usrgt->fetch();
			if($usrgt->rowCount()==1){
				$_SESSION['adsesmail']=encrypt_decrypt('encrypt', $rwusr['ag_admin_email']);
				header("Location: index.php");
				die();
			}else{
				echo"<script>
						alert('You Entered Wrong User Email or Password');
						window.open('login.php','_self');
					</script>";
			}
		}
	}
?>