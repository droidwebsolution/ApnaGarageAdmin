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
?>