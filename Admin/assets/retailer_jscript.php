<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['retailer_add'])){
        $ag_retailer_no=substr(mt_rand(),0,10);
        $retailer_get=$con->prepare("select * from ag_retailer order by 1 desc limit 1");
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        if($count_retailer == 0){
            $ag_retailer_code="RT_1";
        }else{
            $rw_retailer=$retailer_get->fetch();
            $code=$rw_retailer['ag_retailer_code'];
            $ex=explode('_',$code);
            $ag_retailer_code="RT_".($ex[1]+1);
        }
        $ag_retailer_company_name=check_data($_POST['r_company_name']);
        $ag_retailer_owner_name=check_data($_POST['r_owner_name']);
        $ag_retailer_comapny_phone=check_data($_POST['r_company_phone']);
        $ag_retailer_comapny_alt_phone=check_data($_POST['r_company_alt_phone']);
        $ag_retailer_company_email=check_data($_POST['r_company_email']);
        $ag_retailer_company_website=check_data($_POST['r_company_web']);
        $ag_retailer_company_gst=check_data($_POST['r_company_gst']);
        $ag_retailer_company_tin=check_data($_POST['r_company_tin']);
        $ag_retailer_contact_persone_name=check_data($_POST['r_contact_person_name']);
        $ag_retailer_contact_person_phone=check_data($_POST['r_contact_person_phone']);
        $ag_retailer_state=check_data($_POST['r_state']);
        $ag_retailer_city=check_data($_POST['r_city']);
        $ag_retailer_area=check_data($_POST['r_area']);
        $ag_retailer_house_no=check_data($_POST['r_house_no']);
        $ag_retailer_pincode=check_data($_POST['r_pincode']);
        $ag_retailer_register_date=check_data($_POST['r_register_date']);
               
        $add_data="insert into ag_retailer(ag_retailer_no,ag_retailer_code,ag_retailer_company_name,ag_retailer_owner_name,ag_retailer_comapny_phone,ag_retailer_comapny_alt_phone,ag_retailer_company_email,ag_retailer_company_website,ag_retailer_company_gst,ag_retailer_company_tin,ag_retailer_contact_persone_name,ag_retailer_contact_person_phone,ag_retailer_state,ag_retailer_city,ag_retailer_area,ag_retailer_house_no,ag_retailer_pincode,ag_retailer_register_date)
        values(:ag_retailer_no,:ag_retailer_code,:ag_retailer_company_name,:ag_retailer_owner_name,:ag_retailer_comapny_phone,:ag_retailer_comapny_alt_phone,:ag_retailer_company_email,:ag_retailer_company_website,:ag_retailer_company_gst,:ag_retailer_company_tin,:ag_retailer_contact_persone_name,:ag_retailer_contact_person_phone,:ag_retailer_state,:ag_retailer_city,:ag_retailer_area,:ag_retailer_house_no,:ag_retailer_pincode,:ag_retailer_register_date)";
        
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_retailer_no',$ag_retailer_no);
        $data_add->bindParam(':ag_retailer_code',$ag_retailer_code);
        $data_add->bindParam(':ag_retailer_company_name',$ag_retailer_company_name);
        $data_add->bindParam(':ag_retailer_owner_name',$ag_retailer_owner_name);
        $data_add->bindParam(':ag_retailer_comapny_phone',$ag_retailer_comapny_phone);
        $data_add->bindParam(':ag_retailer_comapny_alt_phone',$ag_retailer_comapny_alt_phone);
        $data_add->bindParam(':ag_retailer_company_email',$ag_retailer_company_email);
        $data_add->bindParam(':ag_retailer_company_website',$ag_retailer_company_website);
        $data_add->bindParam(':ag_retailer_company_gst',$ag_retailer_company_gst);
        $data_add->bindParam(':ag_retailer_company_tin',$ag_retailer_company_tin);
        $data_add->bindParam(':ag_retailer_contact_persone_name',$ag_retailer_contact_persone_name);
        $data_add->bindParam(':ag_retailer_contact_person_phone',$ag_retailer_contact_person_phone);
        $data_add->bindParam(':ag_retailer_state',$ag_retailer_state);
        $data_add->bindParam(':ag_retailer_city',$ag_retailer_city);
        $data_add->bindParam(':ag_retailer_area',$ag_retailer_area);
        $data_add->bindParam(':ag_retailer_area',$ag_retailer_area);
        $data_add->bindParam(':ag_retailer_house_no',$ag_retailer_house_no);
        $data_add->bindParam(':ag_retailer_pincode',$ag_retailer_pincode);
        $data_add->bindParam(':ag_retailer_register_date',$ag_retailer_register_date);
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_retailer'])){
        $by_name=check_data($_POST['by_name']);
        $retailer_get=$con->prepare("select *from ag_retailer where ag_retailer_company_name like'%$by_name%' || ag_retailer_code like'%$by_name%'");
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        if($count_retailer == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_retailer=$retailer_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_retailer['ag_retailer_code']."</td> 
                        <td>".$rw_retailer['ag_retailer_company_name']."</td> 
                        <td>".$rw_retailer['ag_retailer_owner_name']."</td>
                        <td>".$rw_retailer['ag_retailer_comapny_phone']."</td>
                        <td>".$rw_retailer['ag_retailer_company_email']."</td>
                        <td>".$rw_retailer['ag_retailer_company_website']."</td>
                        <td>".$rw_retailer['ag_retailer_company_gst']."</td>
                        <td>".$rw_retailer['ag_retailer_company_tin']."</td>
                        <td>".$rw_retailer['ag_retailer_contact_persone_name']."</td>
                        <td>".$rw_retailer['ag_retailer_contact_person_phone']."</td>
                        <td>".$rw_retailer['ag_retailer_register_date']."</td>
                     
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary up_open' data-id='".encrypt_decrypt('encrypt', $rw_retailer['ag_retailer_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up retailer_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
?>