<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['retailer_add'])){
        $ag_reailer_no=substr(mt_rand(),0,10);
        $retailer_get=$con->prepare("select * from ag_retailer order by 1 desc limit 1");
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_pretailer=$retailer_get->rowCount();
        if($count_retailer == 0){
            $ag_retailer_code="AGR_1";
        }else{
            $rw_retailer=$retailer_get->fetch();
            $code=$rw_retailer['ag_retailer_code'];
            $ex=explode('_',$code);
            $ag_retailer_code="AGP_".($ex[1]+1);
        }
        $ag_retailer_company_name=check_data($_POST['r_company+name']);
        $ag_retailer_owner_name=check_data($_POST['r_owner_name']);
        $ag_retailer_comapny_phone=check_data($_POST['r_company_phone']);
        $ag_retailer_company_email=check_data($_POST['r_company_email']);
        $ag_retailer_company_website=check_data($_POST['r_company_web']);
        $ag_retailer_company_gst=check_data($_POST['r_company_gst']);
        $ag_retailer_company_tin=check_data($_POST['r_company_tin']);
        $ag_retailer_contact_persone_name=check_data($_POST['r_contact_persone_name']);
        $ag_retailer_contact_person_phone=check_data($_POST['r_contact_person_phone']);
        $ag_retailer_state=check_data($_POST['r_state']);
        $ag_retailer_city=check_data($_POST['r_city']);
        $ag_retailer_area=check_data($_POST['r_area']);
        $ag_retailer_house_no=check_data($_POST['r_house_no']);
        $ag_retailer_pincode=check_data($_POST['r_pincode']);
        $ag_retailer_register_date=check_data($_POST['r_register_date']);
               
        $add_data="insert into ag_vehicle()
        values(:ag_retailer_no,:ag_retailer_no)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_retailer_no',$ag_retailer_no);
      
        
        if($data_add->execute()){
           
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
?>