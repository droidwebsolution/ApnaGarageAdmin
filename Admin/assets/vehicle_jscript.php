<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['vehicle_add'])){
        $ag_vehicle_no=substr(mt_rand(),0,10);
        $vehicle_get=$con->prepare("select * from ag_vehicle order by 1 desc limit 1");
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        $count_vehicle=$vehicle_get->rowCount();
        if($count_vehicle == 0){
            $ag_vehicle_code="AGV_01";
        }else{
            $rw_vehicle=$vehicle_get->fetch();
            $code=$rw_vehicle['ag_vehicle_code'];
            $ex=explode('_',$code);
            $ag_vehicle_code="AGV_".($ex[1]+1);
        }
        $ag_brand_no=check_data($_POST['vehicle_brand']);
        $ag_vehicle_model_name=check_data($_POST['model_name']);
        $ag_vehicle_model_type=check_data($_POST['model_type']);
        $ag_vehicle_mg_year=check_data($_POST['mg_yr']);
        $ag_vehicle_cc=check_data($_POST['vh_cc']);
        $ag_vehicle_fuel=check_data($_POST['vh_fuel']);
        $ag_vehicle_img=$_FILES['vehicle_img']['tmp_name'];
        $ag_vehicle_status=1;
        $ag_vehicle_date=date('Y-m-d');  
        $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";

        $add_data="insert into ag_vehicle(ag_vehicle_no,ag_vehicle_code,ag_brand_no,ag_vehicle_model_name,ag_vehicle_model_type,ag_vehicle_mg_year,ag_vehicle_cc,ag_vehicle_fuel,ag_vehicle_img,ag_vehicle_status,ag_vehicle_date)
        values(:ag_vehicle_no,:ag_vehicle_code,:ag_brand_no,:ag_vehicle_model_name,:ag_vehicle_model_type,:ag_vehicle_mg_year,:ag_vehicle_cc,:ag_vehicle_fuel,:ag_vehicle_img,:ag_vehicle_status,:ag_vehicle_date)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $data_add->bindParam(':ag_vehicle_code',$ag_vehicle_code);
        $data_add->bindParam(':ag_brand_no',$ag_brand_no);
        $data_add->bindParam(':ag_vehicle_model_name',$ag_vehicle_model_name);
        $data_add->bindParam(':ag_vehicle_model_type',$ag_vehicle_model_type);
        $data_add->bindParam(':ag_vehicle_mg_year',$ag_vehicle_mg_year);
        $data_add->bindParam(':ag_vehicle_cc',$ag_vehicle_cc);
        $data_add->bindParam(':ag_vehicle_fuel',$ag_vehicle_fuel);
        $data_add->bindParam(':ag_vehicle_img',$invimg);
        $data_add->bindParam(':ag_vehicle_status',$ag_vehicle_status);
        $data_add->bindParam(':ag_vehicle_date',$ag_vehicle_date);
        
        if($data_add->execute()){
           $path="../images/vehicle/$invimg";
            move_uploaded_file($_FILES['vehicle_img']['tmp_name'],$path);
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_vehicle'])){
        $vehicle_get=$con->prepare("select vh.*,bn.ag_brand_name from ag_vehicle vh left join ag_brand bn on vh.ag_brand_no=bn.ag_brand_no");
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        $count_vehicle=$vehicle_get->rowCount();
        if($count_vehicle == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_vehicle=$vehicle_get->fetch()):
                $ag_vehicle_no=$rw_vehicle['ag_vehicle_no'];

                $check_part="select * from ag_vehicle_parts where ag_vehicle_no=:ag_vehicle_no";
                $part_check=$con->prepare($check_part);
                $part_check->bindParam(':ag_vehicle_no',$ag_vehicle_no);
                $part_check->setFetchMode(PDO::FETCH_ASSOC);
                $part_check->execute();
                $count_part=$part_check->rowCount();

                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_vehicle['ag_vehicle_code']."</td> 
                        <td>".$rw_vehicle['ag_vehicle_model_name']."</td> 
                        <td>".$rw_vehicle['ag_vehicle_model_type']."</td>
                        <td>".$rw_vehicle['ag_brand_name']."</td>
                        <td>".$rw_vehicle['ag_vehicle_mg_year']."</td>
                        <td>".$rw_vehicle['ag_vehicle_cc']."</td>
                        <td>".$rw_vehicle['ag_vehicle_fuel']."</td>
                        <td><img src= 'images/Vehicle/".$rw_vehicle['ag_vehicle_img']."' style='width:40px;height:40px'></td>
                        <td>".date('d-m-Y',strtotime($rw_vehicle['ag_vehicle_date']))."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary up_open' data-id='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up vehicle_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['vehicle_open_table'])){
        $ag_vehicle_no=encrypt_decrypt('decrypt',check_data($_POST['vehicle_open_table']));
        $get_vehicle="select vh.*, bn.ag_brand_name from ag_vehicle vh left join ag_brand bn on vh.ag_brand_no=bn.ag_brand_no where vh.ag_vehicle_no=:ag_vehicle_no";
        $vehicle_get=$con->prepare($get_vehicle,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $vehicle_get->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        $rw_vehicle=$vehicle_get->fetch();
        echo"<form class='form small_width_form' id='subs_up'>
                <h2>Edit ".$rw_vehicle['ag_vehicle_model_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Select Brand</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <select name='vehicle_brand'>
                        <option value='".encrypt_decrypt('encrypt', $rw_vehicle['ag_brand_no'])."'>".$rw_vehicle['ag_brand_name']."</option>";
                             echo get_brand(); 
                       echo" </select>
                    </div>
                    <p>Enter Model Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-bicycle'></i>
                        <input type='text' name='up_vh_model_name' value='".$rw_vehicle['ag_vehicle_model_name']."' placeholder='Enter Model Name' title='Enter Your Name' />
                    </div>
                    <div class='input_container'>
                                <p>Select Model Type</p>
                                <div class='input'>
                                    <i class='fa-solid fa-t'></i>
                                    <select name='vehicle_type' value='".$rw_vehicle['ag_vehicle_model_type']."'>
                                        <option value=''>Scooter</option>
                                        <option value=''>Bike</option>
                                    </select>
                                </div>
                            </div>
                    <input type='hidden' name='up_vehicles' value='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."' />
                    <div class='input_container'>
                    <p>Enter Vehicle Menufecture Year</p>
                    <div class='input'>
                        <i class='fa-solid fa-y'></i>
                        <input type='text' name='mg_yr' value='".$rw_vehicle['ag_vehicle_mg_year']."' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Vehicle CC</p>
                    <div class='input'>
                        <i class='fa-solid fa-c'></i>
                        <input type='text' name='vh_cc' value='".$rw_vehicle['ag_vehicle_cc']."'/>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Select Fuel</p>
                    <div class='input'>
                        <i class='fa-solid fa-gas-pump'></i>
                        <select name='vh_fuel' value='".$rw_vehicle['ag_vehicle_fuel']."'>
                            <option value='Petrol'>Petrol</option>
                            <option value='Diesel'>Diesel</option>
                            <option value='Electric'>Electric</option>
                            <option value='CNG'>CNG</option>
                        </select>
                    </div>
                </div>
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit vehicle_up' name='vehicle_up' type='submit'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                        </center>
                </div>
            </form>";
    }

    if(isset($_POST['get_vehicle_part'])){
        $ag_vehicle_no=0;
        $get_part="select vh.*,pt.ag_part_name from ag_vehicle_parts vh inner join ag_part pt on vh.ag_vehicle_part_no=pt.ag_part_no where vh.ag_vehicle_no=:ag_vehicle_no";
        $part_get=$con->prepare($get_part);
        $part_get->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $part_get->execute();
        $count_part=$part_get->rowCount();
        if($count_part == 0){
            echo"<tr><td style='text-align:left'>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_part=$part_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_part['ag_part_name']."</td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['vehicle_part_add'])){
        $ag_vehicle_no=0;
        $ag_vehicle_part_no=encrypt_decrypt('decrypt',check_data($_POST['vehicle_part_add']));
        
        $check_part="select * from ag_vehicle_parts where ag_vehicle_part_no=:ag_vehicle_part_no and ag_vehicle_no=0";
        $part_check=$con->prepare($check_part);
        $part_check->bindParam(':ag_vehicle_part_no',$ag_vehicle_part_no);
        $part_check->setFetchMode(PDO::FETCH_ASSOC);
        $part_check->execute();
        $count_part=$part_check->rowCount();
        if($count_part !== 0){}else{
            $add_part="insert into ag_vehicle_parts(ag_vehicle_no,ag_vehicle_part_no)values(:ag_vehicle_no,:ag_vehicle_part_no)";
            $part_add=$con->prepare($add_part);
            $part_add->bindParam(':ag_vehicle_no',$ag_vehicle_no);
            $part_add->bindParam(':ag_vehicle_part_no',$ag_vehicle_part_no);
            $part_add->execute();
        }
    }
     if(isset($_POST['up_vehicles'])){
        $ag_vehicle_no=encrypt_decrypt('decrypt', check_data($_POST['up_vehicles']));
        $ag_brand_no=encrypt_decrypt('decrypt', check_data($_POST['vehicle_brand']));
        $ag_vehicle_model_name=check_data($_POST['up_vh_model_name']);
        $ag_vehicle_model_type=check_data($_POST['vehicle_type']);
        $ag_vehicle_mg_year=check_data($_POST['mg_yr']);
        $ag_vehicle_cc=check_data($_POST['vh_cc']);
        $ag_vehicle_fuel=check_data($_POST['vh_fuel']);
                     
        $up_vehicle="update ag_vehicle set ag_brand_no=:ag_brand_no,ag_vehicle_model_name=:ag_vehicle_model_name,ag_vehicle_model_type=:ag_vehicle_model_type,ag_vehicle_mg_year=:ag_vehicle_mg_year,ag_vehicle_cc=:ag_vehicle_cc,ag_vehicle_fuel=:ag_vehicle_fuel where ag_vehicle_no=:ag_vehicle_no";
        $vehicle_up=$con->prepare($up_vehicle);
        $vehicle_up->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $vehicle_up->bindParam(':ag_brand_no',$ag_brand_no);
        $vehicle_up->bindParam(':ag_vehicle_model_name',$ag_vehicle_model_name);
        $vehicle_up->bindParam(':ag_vehicle_model_type',$ag_vehicle_model_type);
        $vehicle_up->bindParam(':ag_vehicle_mg_year',$ag_vehicle_mg_year);
        $vehicle_up->bindParam(':ag_vehicle_cc',$ag_vehicle_cc);
        $vehicle_up->bindParam(':ag_vehicle_fuel',$ag_vehicle_fuel);
     
       
        if($vehicle_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>