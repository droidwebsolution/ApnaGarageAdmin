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
                                <summary class='pop_up_open pop_up_summary up_open' data-id='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up vehicle_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['vehicle_up_open'])){
        $ag_vehicle_no=encrypt_decrypt('decrypt',check_data($_POST['vehicle_up_open']));
        $get_vehicle="select * from ag_vehicle where ag_vehicle_no=:ag_vehicle_no";
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
                        <i class='fa-solid fa-user'></i>
                        <select name='vehicle_brand'>
                            <option value=''>Select Brand</option>
                            <?php echo get_brand(); ?>
                        </select>
                    </div>
                    <p>Enter Model Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='up_vh_model_name' value='".$rw_vehicle['ag_vehicle_model_name']."' placeholder='Enter Model Name' title='Enter Your Name' />
                    </div>
                    <div class='input_container'>
                                <p>Select Model Type</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='vehicle_type' value='".$rw_vehicle['ag_vehicle_model_type']."'>
                                        <option value=''>Scooter</option>
                                        <option value=''>Bike</option>
                                    </select>
                                </div>
                            </div>
                    <input type='hidden' name='up_vehicle' value='".encrypt_decrypt('encrypt', $rw_vehicle['ag_vehicle_no'])."' />
                    <div class='input_container'>
                    <p>Enter Vehicle Menufecture Year</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='mg_yr' value='".$rw_vehicle['ag_vehicle_mg_year']."' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Vehicle CC</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='vh_cc' value='".$rw_vehicle['ag_vehicle_cc']."'/>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Select Fuel</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <select name='vh_fuel' value='".$rw_vehicle['ag_vehicle_fuel']."'>
                            <option value=''>Petrol</option>
                            <option value=''>Diesel</option>
                            <option value=''>Electric</option>
                            <option value=''>CNG</option>
                        </select>
                    </div>
                </div>
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit vehicle_up' name='vehicle_up' type='submit'><i class='fa-solid fa-save'></i> Update</button>
                    </center>
                </div>
            </form>";
    }
?>