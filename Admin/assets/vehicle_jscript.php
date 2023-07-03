<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['vehicle_add'])){
        $ag_vehicle_no=substr(mt_rand(),0,10);
        $ag_vehicle_brand_no=check_data($_POST['vehicle_brand']);
        $ag_vehicle_model_name=check_data($_POST['model_name']);
        $ag_vehicle_model_type=check_data($_POST['model_type']);
        $ag_vehicle_mg_year=check_data($_POST['mg_yr']);
        $ag_vehicle_cc=check_data($_POST['vh_cc']);
        $ag_vehicle_fuel=check_data($_POST['vh_fuel']);
        $ag_vehicle_img='a.png';
        $ag_vehicle_status=1;
        $ag_vehicle_date=date('Y-m-d');     
       
        $add_data="insert into ag_vehicle(ag_vehicle_no,ag_vehicle_brand_no,ag_vehicle_model_name,ag_vehicle_model_type,ag_vehicle_mg_year,ag_vehicle_cc,ag_vehicle_fuel,ag_vehicle_img,ag_vehicle_status,ag_vehicle_date)
        values(:ag_vehicle_no,:ag_vehicle_brand_no,:ag_vehicle_model_name,:ag_vehicle_model_type,:ag_vehicle_mg_year,:ag_vehicle_cc,:ag_vehicle_fuel,:ag_vehicle_img,:ag_vehicle_status,:ag_vehicle_date)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $data_add->bindParam(':ag_vehicle_brand_no',$ag_vehicle_brand_no);
        $data_add->bindParam(':ag_vehicle_model_name',$ag_vehicle_model_name);
        $data_add->bindParam(':ag_vehicle_model_type',$ag_vehicle_model_type);
        $data_add->bindParam(':ag_vehicle_mg_year',$ag_vehicle_mg_year);
        $data_add->bindParam(':ag_vehicle_cc',$ag_vehicle_cc);
        $data_add->bindParam(':ag_vehicle_fuel',$ag_vehicle_fuel);
        $data_add->bindParam(':ag_vehicle_img',$ag_vehicle_img);
        $data_add->bindParam(':ag_vehicle_status',$ag_vehicle_status);
        $data_add->bindParam(':ag_vehicle_date',$ag_vehicle_date);
        
        if($data_add->execute()){
           // $path="../images/$invimg";
            //move_uploaded_file($_FILES['vehicle_img']['tmp_name'],$path);
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_vehicle'])){
        $vehicle_get=$con->prepare("select vh.*,bn.ag_brand_name from ag_vehicle vh left join ag_brand bn on vh.ag_vehicle_brand_no=bn.ag_brand_no");
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        $count_vehicle=$vehicle_get->rowCount();
        if($count_vehicle == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_vehicle=$vehicle_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_vehicle['ag_vehicle_model_name']."</td> 
                        <td>".$rw_vehicle['ag_vehicle_model_type']."</td>
                        <td>".$rw_vehicle['ag_brand_name']."</td>
                        <td>".$rw_vehicle['ag_vehicle_mg_year']."</td>
                        <td>".$rw_vehicle['ag_vehicle_cc']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary vehicle_part_open' data-id='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."'><i class='fa-solid fa-pen-to-square'></i> 15</summary>
                                <div class='pop_up vehicle_part_table'></div>
                            </details>
                        </td>
                        <td>".$rw_vehicle['ag_vehicle_fuel']."</td>
                        <td>".$rw_vehicle['ag_vehicle_img']."</td>
                        <td>".date('d-m-Y',strtotime($rw_vehicle['ag_vehicle_date']))."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary vehicle_open' data-id='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up vehicle_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
?>