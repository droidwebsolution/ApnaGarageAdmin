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
    function get_vehicle(){
        global $con;
        $get_vehicle="select * from ag_vehicle";
        $vehicle_get=$con->prepare($get_vehicle,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        while($rw_vehicle=$vehicle_get->fetch()):
            echo"<option value='".$rw_vehicle['ag_vehicle_no']."'>".$rw_vehicle['ag_vehicle_model_name']."</option>";
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
				$_SESSION['adsesmail']=encrypt_decrypt('encrypt', $rwusr['uap_ad_email']);
				//header("Location: home");
				header("Location: inventory");
				die();
			}else{
				echo"<script>
						alert('You Entered Wrong User Email or Password');
						window.open('login','_self');
					</script>";
			}
		}
		if(isset($_SESSION['adsesmail'])){
			header("Location:home");
			die();
		}
	}
?>