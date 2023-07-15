<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if (isset($_POST['selectedBrands'])) {
        $selectedBrands = $_POST['selectedBrands'];
        // Modify the query below to fetch the relevant vehicle models based on the selected brands
        $get_vehicle = "SELECT * FROM ag_vehicle WHERE ag_brand_no IN (" . implode(',', $selectedBrands) . ")";
        $vehicle_get = $con->prepare($get_vehicle, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        
        while ($rw_vehicle = $vehicle_get->fetch()):
          echo "<option value='" . $rw_vehicle['ag_vehicle_no'] . "'>" . $rw_vehicle['ag_vehicle_model_name'] . "</option>";
        endwhile;
      }
    // if(isset($_POST['part_add'])){
    //     $ag_part_no=substr(mt_rand(),0,10);
    //     $part_get=$con->prepare("select * from ag_part order by 1 desc limit 1");
    //     $part_get->setFetchMode(PDO::FETCH_ASSOC);
    //     $part_get->execute();
    //     $count_part=$part_get->rowCount();
    //     if($count_part == 0){
    //         $ag_part_code="AGP_01";
    //     }else{
    //         $rw_part=$part_get->fetch();
    //         $code=$rw_part['ag_part_code'];
    //         $ex=explode('_',$code);
    //         $ag_part_code="AGP_".($ex[1]+1);
    //     }
    //     $ag_brand_nos = $_POST['vehicle_brand']; // Array of selected brand IDs
    //     $ag_vehicle_nos = $_POST['vehicle_model']; 
    //     //$ag_brand_no = $_POST['vehicle_brand'];
    //    // $ag_brand_no = implode(',', $ag_brand_nos);
    //     //$ag_vehicle_no=$_POST['vehicle_model'];
    //     $ag_part_name=$_POST['part_name'];
    //     $ag_part_company=$_POST['part_company_name'];
    //     $ag_part_cat=$_POST['part_cat'];
    //     $ag_part_hsn=$_POST['part_hsn'];
    //     $ag_part_img=$_FILES['part_img']['tmp_name'];
    //     $ag_part_status=$_POST['part_status'];
    //     if($ag_part_status == "Active"){
    //         $ag_part_status=1;
    //     }else{
    //         $ag_part_status=2;
    //     }
    //     $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";
    //     $ag_part_date=date('Y-m-d');     
       
    //     $add_data="insert into ag_part(ag_part_no,ag_part_code,ag_brand_no,ag_vehicle_no,ag_part_name,ag_part_company,ag_part_hsn,ag_part_cat,ag_part_img,ag_part_status,ag_part_date)
    //     values(:ag_part_no,:ag_part_code,:ag_brand_no,:ag_vehicle_no,:ag_part_name,:ag_part_company,:ag_part_hsn,:ag_part_cat,:ag_part_img,:ag_part_status,:ag_part_date)";
    //     $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    //     $data_add->bindParam(':ag_part_no',$ag_part_no);
    //     $data_add->bindParam(':ag_part_code',$ag_part_code);
    //     $data_add->bindParam(':ag_brand_no',$ag_brand_no);
    //     $data_add->bindParam(':ag_vehicle_no',$ag_vehicle_no);
    //     $data_add->bindParam(':ag_part_name',$ag_part_name);
    //     $data_add->bindParam(':ag_part_company',$ag_part_company);
    //     $data_add->bindParam(':ag_part_cat',$ag_part_cat);
    //     $data_add->bindParam(':ag_part_hsn',$ag_part_hsn);
    //     $data_add->bindParam(':ag_part_img',$invimg);
    //     $data_add->bindParam(':ag_part_status',$ag_part_status);
    //     $data_add->bindParam(':ag_part_date',$ag_part_date);
        
    //     if($data_add->execute()){
    //         $path="../images/part/$invimg";
    //         move_uploaded_file($_FILES['part_img']['tmp_name'],$path);
    //         $msg="Data Added Successfully";
    //     }else{
    //         $msg="Something Wrong!!";
    //     }
    //     echo json_encode($msg);
    // }
    if (isset($_POST['part_add'])) {
        $ag_part_no = substr(mt_rand(), 0, 10);
        $part_get = $con->prepare("select * from ag_part order by 1 desc limit 1");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part = $part_get->rowCount();
        if ($count_part == 0) {
            $ag_part_code = "AGP_01";
        } else {
            $rw_part = $part_get->fetch();
            $code = $rw_part['ag_part_code'];
            $ex = explode('_', $code);
            $ag_part_code = "AGP_" . ($ex[1] + 1);
        }
        
        $ag_brand_nos = $_POST['vehicle_brand']; // Array of selected brand IDs
        $ag_vehicle_nos = $_POST['vehicle_model']; // Array of selected model IDs

        $ag_brand_nos = $_POST['vehicle_brand'];
        $ag_brand_no = implode(',', $ag_brand_nos);

        $ag_vehicle_nos = $_POST['vehicle_model'];
        $ag_vehicle_no = implode(',', $ag_vehicle_nos);

        $ag_part_name = $_POST['part_name'];
        $ag_part_company = $_POST['part_company_name'];
        $ag_part_cat = $_POST['part_cat'];
        $ag_part_hsn = $_POST['part_hsn'];
        $ag_part_img = $_FILES['part_img']['tmp_name'];
        $ag_part_status = $_POST['part_status'];
    
        if ($ag_part_status == "Active") {
            $ag_part_status = 1;
        } else {
            $ag_part_status = 2;
        }
    
        $invimg = date('Y-m-d') . "-" . substr(mt_rand(), 0, 10) . ".png";
        $ag_part_date = date('Y-m-d');
    
        $add_data = "INSERT INTO ag_part(ag_part_no, ag_part_code, ag_part_name,ag_part_company, ag_part_hsn, ag_part_cat, ag_part_img, ag_part_status, ag_part_date) 
                    VALUES(:ag_part_no, :ag_part_code, :ag_part_name, :ag_part_company, :ag_part_hsn, :ag_part_cat, :ag_part_img, :ag_part_status, :ag_part_date)";
        
        $data_add = $con->prepare($add_data, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_part_no', $ag_part_no);
        $data_add->bindParam(':ag_part_code', $ag_part_code);
        //$data_add->bindParam(':ag_brand_no', $ag_brand_no);
       // $data_add->bindParam(':ag_vehicle_no', $ag_vehicle_no);
        $data_add->bindParam(':ag_part_name', $ag_part_name);
        $data_add->bindParam(':ag_part_company', $ag_part_company);
        $data_add->bindParam(':ag_part_cat', $ag_part_cat);
        $data_add->bindParam(':ag_part_hsn', $ag_part_hsn);
        $data_add->bindParam(':ag_part_img', $invimg);
        $data_add->bindParam(':ag_part_status', $ag_part_status);
        $data_add->bindParam(':ag_part_date', $ag_part_date);
    
        if ($data_add->execute()) {
            $path = "../images/part/$invimg";
            move_uploaded_file($_FILES['part_img']['tmp_name'], $path);
    
            // Get the ID of the inserted part
            $part_id = $con->lastInsertId();
            $msg="$part_id";
            
            // Convert $ag_brand_nos to an array if it's a string
            if (is_string($ag_brand_nos)) {
                $ag_brand_nos = explode(',', $ag_brand_nos);
            }
             // Convert $ag_vehicle_nos to an array if it's a string
             if (is_string($ag_vehicle_nos)) {
                $ag_vehicle_nos = explode(',', $ag_vehicle_nos);
            }
            // Insert selected brands and models into the ag_part table
            foreach ($ag_brand_nos as $brand_id) {
                foreach ($ag_vehicle_nos as $vehicle_id) {
                    $insert_bridge = "INSERT INTO ag_part_repo(ag_part_id,ag_brand_no,ag_vehicle_no,ag_part_company,ag_part_name) 
                                      VALUES(:ag_part_id, :ag_brand_no, :ag_vehicle_no, :ag_part_company, :ag_part_name)";
                    $data_bridge = $con->prepare($insert_bridge, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $data_bridge->bindParam(':ag_part_id', $part_id);
                    $data_bridge->bindParam(':ag_brand_no', $brand_id);
                    $data_bridge->bindParam(':ag_vehicle_no', $vehicle_id);
                    $data_bridge->bindParam(':ag_part_company', $ag_part_company);
                    $data_bridge->bindParam(':ag_part_name', $ag_part_name);
                    $data_bridge->execute();
                }
            }
            
            $msg = "Data Added Successfully";
        } else {
            $msg = "Something Went Wrong";
        }
    
        echo json_encode($msg);
    }
    
    if(isset($_POST['brand_add'])){
        $ag_brand_no=substr(mt_rand(),0,10);
        $brand_get=$con->prepare("select * from ag_brand order by 1 desc limit 1");
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $count_brand=$brand_get->rowCount();
        if($count_brand == 0){
            $ag_brand_code="AG_01";
        }else{
            $rw_brand=$brand_get->fetch();
            $code=$rw_brand['ag_brand_code'];
            $ex=explode('_',$code);
            $ag_brand_code="AG_".($ex[1]+1);
        }
        $ag_brand_name=check_data($_POST['brand_name']);
        $ag_brand_category=check_data($_POST['brand_category']);
        $ag_brand_img=$_FILES['brand_img']['tmp_name'];
        $ag_brand_status=$_POST['brand_Status'];
        if($ag_brand_status == "Active"){
            $ag_brand_status=1;
        }else{
            $ag_brand_status=2;
        }

        $brand_get=$con->prepare("select * from ag_brand where ag_brand_name=:ag_brand_name");
        $brand_get->bindParam(':ag_brand_name',$ag_brand_name);
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $count_brand=$brand_get->rowCount();
        if($count_brand == 1){
            $msg="Brand Name Already Exist!!";
            echo json_encode($msg);
        }else{
            $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";     
            $add_data="insert into ag_brand(ag_brand_no,ag_brand_code,ag_brand_name,ag_brand_category,ag_brand_img,ag_brand_status)
            values(:ag_brand_no,:ag_brand_code,:ag_brand_name,:ag_brand_category,:ag_brand_img,:ag_brand_status)";
            $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $data_add->bindParam(':ag_brand_no',$ag_brand_no);
            $data_add->bindParam(':ag_brand_code',$ag_brand_code);
            $data_add->bindParam(':ag_brand_name',$ag_brand_name);
            $data_add->bindParam(':ag_brand_category',$ag_brand_category);
            $data_add->bindParam(':ag_brand_img',$invimg);
            $data_add->bindParam(':ag_brand_status',$ag_brand_status);
            
            if($data_add->execute()){
                $path="../images/brand/$invimg";
                move_uploaded_file($_FILES['brand_img']['tmp_name'],$path);
                $msg="Data Added Successfully";
            }else{
                $msg="Something Wrong!!";
            }
            echo json_encode($msg);
        }
    }
    if (isset($_POST['vehicle_add'])) {
        $modelNames = explode(',', $_POST['model_name']);
        $manufactureYears = explode(',', $_POST['mg_yr']);
        $vehicleCCs = explode(',', $_POST['vh_cc']);
    
        if (count($modelNames) !== count($manufactureYears) || count($modelNames) !== count($vehicleCCs)) {
            echo json_encode("The number of model names, manufacture years, and vehicle CCs should be the same.");
            return;
        }
    
        $ag_vehicle_status = 1;
        $ag_vehicle_date = date('Y-m-d');
        $msg = "";
    
        $vehicle_get = $con->prepare("SELECT MAX(ag_vehicle_code) AS max_code FROM ag_vehicle");
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        $result = $vehicle_get->fetch();
        $maxCode = $result['max_code'];
    
        if (empty($maxCode)) {
            $maxCode = 'AGV_00';
        }
    
        $maxCodeNumber = intval(substr($maxCode, -1));
    
        for ($i = 0; $i < count($modelNames); $i++) {
            $ag_vehicle_no = substr(mt_rand(), 0, 10);
            $ag_brand_no = check_data($_POST['vehicle_brand']);
            $ag_vehicle_model_name = check_data($modelNames[$i]);
            $ag_vehicle_model_type = check_data($_POST['model_type']);
            $ag_vehicle_mg_year = check_data($manufactureYears[$i]);
            $ag_vehicle_cc = check_data($vehicleCCs[$i]);
            $ag_vehicle_fuel = check_data($_POST['vh_fuel']);
            $ag_vehicle_img = $_FILES['vehicle_img']['tmp_name'];
    
            $invimg = date('Y-m-d') . "-" . substr(mt_rand(), 0, 10) . ".png";
    
            $maxCodeNumber++;
            $ag_vehicle_code = 'AGV_' . sprintf('%02d', $maxCodeNumber);
            $vehicle_get = $con->prepare("SELECT * FROM ag_vehicle where ag_vehicle_model_name=:ag_vehicle_model_name and ag_vehicle_mg_year=:ag_vehicle_mg_year");
            $vehicle_get->bindParam(':ag_vehicle_model_name',$ag_vehicle_model_name);
            $vehicle_get->bindParam(':ag_vehicle_mg_year',$ag_vehicle_mg_year);
            $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
            $vehicle_get->execute();
            $count_vehicle = $vehicle_get->rowCount();
            if($count_vehicle == 1){
                echo json_encode("Model with same Manufacture year already exist.");
                return;
            }else{

                $add_data = "INSERT INTO ag_vehicle(ag_vehicle_no, ag_vehicle_code, ag_brand_no, ag_vehicle_model_name, ag_vehicle_model_type, ag_vehicle_mg_year, ag_vehicle_cc, ag_vehicle_fuel, ag_vehicle_img, ag_vehicle_status, ag_vehicle_date)
                VALUES (:ag_vehicle_no, :ag_vehicle_code, :ag_brand_no, :ag_vehicle_model_name, :ag_vehicle_model_type, :ag_vehicle_mg_year, :ag_vehicle_cc, :ag_vehicle_fuel, :ag_vehicle_img, :ag_vehicle_status, :ag_vehicle_date)";
                $data_add = $con->prepare($add_data, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $data_add->bindParam(':ag_vehicle_no', $ag_vehicle_no);
                $data_add->bindParam(':ag_vehicle_code', $ag_vehicle_code);
                $data_add->bindParam(':ag_brand_no', $ag_brand_no);
                $data_add->bindParam(':ag_vehicle_model_name', $ag_vehicle_model_name);
                $data_add->bindParam(':ag_vehicle_model_type', $ag_vehicle_model_type);
                $data_add->bindParam(':ag_vehicle_mg_year', $ag_vehicle_mg_year);
                $data_add->bindParam(':ag_vehicle_cc', $ag_vehicle_cc);
                $data_add->bindParam(':ag_vehicle_fuel', $ag_vehicle_fuel);
                $data_add->bindParam(':ag_vehicle_img', $invimg);
                $data_add->bindParam(':ag_vehicle_status', $ag_vehicle_status);
                $data_add->bindParam(':ag_vehicle_date', $ag_vehicle_date);
        
                if ($data_add->execute()) {
                    $path = "../images/vehicle/$invimg";
                    move_uploaded_file($ag_vehicle_img, $path);
                    $msg .= "Data Added Successfully for model: $ag_vehicle_model_name\n";
                } else {
                    $msg .= "Failed to add data for model: $ag_vehicle_model_name\n";
                }
            }
        }
    
        echo json_encode($msg);
    }
    if(isset($_POST['get_parts'])){
        $by_name=check_data($_POST['by_name']);
        //$part_get=$con->prepare("select pt.*,vh.ag_vehicle_model_name,bn.ag_brand_name from ag_part pt left join ag_vehicle vh on pt.ag_vehicle_no=vh.ag_vehicle_no left join ag_brand bn on bn.ag_brand_no=pt.ag_brand_no where ag_part_code like'%$by_name%' || ag_part_name like'%$by_name%' || ag_brand_name like'%$by_name%' || ag_vehicle_model_name like'%$by_name%' || ag_part_cat like'%$by_name%'");
        $part_get=$con->prepare("select * from ag_part where ag_part_code like'%$by_name%' || ag_part_name like'%$by_name%' || ag_part_cat like'%$by_name%'");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part=$part_get->rowCount();
        if($count_part == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_part=$part_get->fetch()):
                $part_id=$rw_part['ag_part_id'];

                $get_repo="select * from ag_part_repo where ag_part_id=:ag_part_id group by ag_brand_no";
                $repo_get=$con->prepare($get_repo,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $repo_get->bindParam(':ag_part_id',$part_id);
                $repo_get->setFetchMode(PDO::FETCH_ASSOC);
                $repo_get->execute();
                $count_repo=$repo_get->rowCount();
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_part['ag_part_code']."</td>
                        <td>";
                            if($count_repo == 0){}else{
                            $i=1;
                            while($rw_repo=$repo_get->fetch()):
                                $ag_brand_no= $rw_repo['ag_brand_no'];

                                $get_brand="select * from ag_brand where ag_brand_no='$ag_brand_no'";
                                $brand_get=$con->prepare($get_brand);
                                $brand_get->setFetchMode(PDO::FETCH_ASSOC);
                                $brand_get->execute();
                                $rw_brand=$brand_get->fetch();
                                $ag_brand_name=$rw_brand['ag_brand_name'];
                                echo $ag_brand_name;
                                $sr=$i++;
                                if($count_repo == $sr){}else{
                                    echo",";
                                }
                            endwhile;
                        }
                    echo"</td>
                        <td>";
                        $get_repo="select * from ag_part_repo where ag_part_id=:ag_part_id group by ag_vehicle_no";
                        $repo_get=$con->prepare($get_repo,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $repo_get->bindParam(':ag_part_id',$part_id);
                        $repo_get->setFetchMode(PDO::FETCH_ASSOC);
                        $repo_get->execute();
                        $count_repo=$repo_get->rowCount();
                        $i=1;
                        while($rw_repo=$repo_get->fetch()):
                            $ag_vehicle_no= $rw_repo['ag_vehicle_no'];
                            $get_vehicle="select * from ag_vehicle where ag_vehicle_no='$ag_vehicle_no'";
                            $vehicle_get=$con->prepare($get_vehicle);
                            $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
                            $vehicle_get->execute();
                            $rw_vehicle=$vehicle_get->fetch();
                            $ag_vehicle_model_name=$rw_vehicle['ag_vehicle_model_name'];
                            echo $ag_vehicle_model_name;
                            $sr=$i++;
                            if($count_repo == $sr){}else{
                                echo",";
                            }
                        endwhile;
                        echo"</td>
                        <td>".$rw_part['ag_part_cat']."</td>
                        <td>".$rw_part['ag_part_name']."</td>
                        <td>".$rw_part['ag_part_hsn']."</td>
                        <td><img src= 'images/part/".$rw_part['ag_part_img']."' style='width:40px;height:40px'></td>
                        <td>".date('d-m-Y',strtotime($rw_part['ag_part_date']))."</td>
                        <td>";
                        if($rw_part['ag_part_status'] == 1){
                            echo 'Active';
                        }else{
                            echo"In Active";
                        }
                        echo"</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary up_open' data-id='".encrypt_decrypt('encrypt', $rw_part['ag_part_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up part_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['part_up_open'])){
        $ag_part_no=encrypt_decrypt('decrypt',check_data($_POST['part_up_open']));
        $part_get=$con->prepare("select pt.*,vh.ag_vehicle_model_name,bn.ag_brand_name from ag_part pt left join ag_vehicle vh on pt.ag_vehicle_no=vh.ag_vehicle_no left join ag_brand bn on bn.ag_brand_no=pt.ag_brand_no where pt.ag_part_no=:ag_part_no");
        $part_get->bindParam(':ag_part_no',$ag_part_no);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        if($rw_part['ag_part_status'] == 1){
            $status='Active';
        }else{
            $status='In Active';
        }
              echo"<form class='form min_width_form' id='part_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_part['ag_part_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                <div class='input_container'>
                    <p>Select Brand</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <select name='part_brand'>
                        <option value='". $rw_part['ag_brand_no']."'>".$rw_part['ag_brand_name']."</option>";
                            echo get_brand(); 
                        echo"</select>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Select Model</p>
                    <div class='input'>
                        <i class='fa-sharp fa-regular fa-motorcycle'></i>
                        <select name='part_vehicle'>
                            <option value='".$rw_part['ag_vehicle_no']."'>".$rw_part['ag_vehicle_model_name']."</option>";
                            echo get_vehicle(); 
                        echo"</select>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Category</p>
                    <div class='input'>
                        <i class='fa-solid fa-list'></i>
                        <select name='part_cat'>
                            <option value='".$rw_part['ag_part_cat']."'>".$rw_part['ag_part_cat']."</option>
                            <option value='Oil'>Oil</option>
                            <option value='Spare'>Spare</option>
                            <option value='Accessories'>Accessories</option>
                        </select>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Part Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-screwdriver-wrench'></i>
                        <input type='text' name='part_name' value='".$rw_part['ag_part_name']."' placeholder='Part Name eg.foot rest' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Part Company Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-screwdriver-wrench'></i>
                        <input type='text' name='part_company_name' placeholder='Part Company Name' required />
                    </div>
                 </div>
                <input type='hidden' name='up_parts' value='".encrypt_decrypt('encrypt', $rw_part['ag_part_no'])."' />
                <div class='input_container'>
                    <p>Enter HSN</p>
                    <div class='input'>
                        <i class='fa-brands fa-digital-ocean'></i>
                        <input type='text' name='part_hsn' placeholder='Only Digits Allowed' value='".$rw_part['ag_part_hsn']."' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Choose Part Image</p>
                    <div class='input'>
                        <i class='fa-solid fa-image'></i>
                        <input type='file' name='part_img'  />
                    </div>
                </div>
                
                <div class='input_container'>
                    <p>Select Status</p>
                    <div class='input'>
                        <i class='fa-solid fa-battery-full'></i>
                        <select name='part_status'>
                            <option value='$status'>$status</option>
                            <option value='Active'>Active</option>
                            <option value='InActive'>InActive</option>
                        </select>
                    </div>
                </div><br clear='all'>                            
                <center>
                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                    <button class='pop_up_submit part_up' type='submit' name='part_up'><i class='fa-solid fa-save'></i> Update</button>
                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                    <a target='_blank' href='images/part/".$rw_part['ag_part_img']."'><img style='width:100%; height:400px; object-fit:contain; border:1px solid rgb(0,0,0,0.2); margin-top:20px' src='images/part/".$rw_part['ag_part_img']."' /></a>
                    </center>
            </div>
            </form>";
    }
    if(isset($_POST['up_parts'])){
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['up_parts']);
        $ag_brand_no=encrypt_decrypt('decrypt', check_data($_POST['part_brand']));
        $ag_vehicle_no=check_data($_POST['part_vehicle']);
        $ag_brand_no=check_data($_POST['part_brand']);
        $ag_part_name=check_data($_POST['part_name']);
        $ag_part_company=check_data($_POST['part_company_name']);
        $ag_part_cat=$_POST['part_cat'];
        
        $ag_part_hsn=check_data($_POST['part_hsn']);
        $ag_part_img=$_FILES['part_img']['tmp_name'];
        $ag_part_status=$_POST['part_status'];
        if($ag_part_status == "Active"){
            $ag_part_status=1;
        }else{
            $ag_part_status=2;
        }
        $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";
        $ag_part_date=date('Y-m-d');     
        $gtinv="select ag_part_img from ag_part where ag_part_no=:ag_part_no";
        $invgt=$con->prepare($gtinv, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $invgt->bindParam(":ag_part_no",$ag_part_no);
        $invgt->execute();
        $rwinv=$invgt->fetch();
        
        if(empty($_FILES['part_img']['tmp_name'])){
            $up_part="update ag_part set ag_part_name=:ag_part_name,ag_part_company=:ag_part_company,ag_part_cat=:ag_part_cat,ag_part_hsn=:ag_part_hsn,ag_part_status=:ag_part_status where ag_part_no=:ag_part_no";
            $part_up=$con->prepare($up_part);
            $part_up->bindParam(':ag_part_no',$ag_part_no);
            $part_up->bindParam(':ag_brand_no',$ag_brand_no);
            $part_up->bindParam(':ag_vehicle_no',$ag_vehicle_no);
            $part_up->bindParam(':ag_part_name',$ag_part_name);
            $part_up->bindParam(':ag_part_company',$ag_part_company);
           
            $part_up->bindParam(':ag_part_cat',$ag_part_cat);
            $part_up->bindParam(':ag_part_hsn',$ag_part_hsn);
            $part_up->bindParam(':ag_part_status',$ag_part_status);
            
            
            if($part_up->execute()){
                // $update_bridge = "UPDATE ag_part_repo SET ag_brand_no = :ag_brand_no, ag_vehicle_no = :ag_vehicle_no, ag_part_company=:ag_part_company WHERE ag_part_id = :ag_part_id";
                // $data_bridge = $con->prepare($update_bridge);
                // $data_bridge->bindParam(':ag_part_id', $ag_part_no);
                // $data_bridge->bindParam(':ag_brand_no', $ag_brand_no);
                // $data_bridge->bindParam(':ag_vehicle_no', $ag_vehicle_no);

                $msg="Data Updated Succeessfully";
                echo json_encode($msg);
            }else{
                $msg="Something went wrong";
                echo json_encode($msg);
            }
        }
        else{
            $up_check_img=getimagesize($_FILES['part_img']['tmp_name']);
            $up_img_size=$_FILES['part_img']['size'];
            if($up_check_img == true){
                if($up_img_size >2000000){
                    $msg='Only 2MB Image File Allowed';
                    echo json_encode($msg);
                }else{
                    $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";
                    $up_part="update ag_part set ag_part_name=:ag_part_name,ag_part_purchase_price=:ag_part_purchase_price,ag_part_sale_price=:ag_part_sale_price,ag_part_qty=:ag_part_qty,ag_part_cat=:ag_part_cat,ag_part_hsn=:ag_part_hsn,ag_part_img=:ag_part_img,ag_part_status=:ag_part_status where ag_part_no=:ag_part_no";
                    $part_up=$con->prepare($up_part);
                    $part_up->bindParam(':ag_part_no',$ag_part_no);
                   // $part_up->bindParam(':ag_brand_no',$ag_brand_no);
                    $part_up->bindParam(':ag_part_name',$ag_part_name);
                    $part_up->bindParam(':ag_part_purchase_price',$ag_part_purchase_price);
                    $part_up->bindParam(':ag_part_sale_price',$ag_part_sale_price);
                    $part_up->bindParam(':ag_part_qty',$ag_part_qty);
                    $part_up->bindParam(':ag_part_cat',$ag_part_cat);
                    $part_up->bindParam(':ag_part_hsn',$ag_part_hsn);
                    $part_up->bindParam(':ag_part_img',$invimg);
                    $part_up->bindParam(':ag_part_status',$ag_part_status);
                   
                    if($part_up->execute()){
                        if($rwinv['ag_part_img'] == ''){}else{
                            $old_img="../images/part/".$rwinv['ag_part_img']."";
                            unlink($old_img);
                        }
                        $fpath="../images/part/$invimg";
                        move_uploaded_file($_FILES['part_img']['tmp_name'],$fpath);
                        $msg="Part Has Been Updated Successfully";
                        echo json_encode($msg);
                    }else{
                        $msg="Something Went Wrong Try Again";
                        echo json_encode($msg);
                    }
                }
            }else{
                $msg="But Only Image(.jpg, .jpeg & .png) File Allowed";
                echo json_encode($msg);
            }
        }
    }
    // if(isset($_POST['change_brand'])){
    //     $ag_brand_no=$_POST['change_brand'];
    //    // $get_vehicle="select * from ag_vehicle where ag_brand_no=:ag_brand_no or ag_vehicle_model_name='default'";
    //     $get_vehicle="select * from ag_vehicle where ag_brand_no IN (" . implode(',', $selectedBrands) . ")";
    //     $vehicle_get=$con->prepare($get_vehicle);
    //     $vehicle_get->bindParam(':ag_brand_no',$ag_brand_no);
    //     $vehicle_get->execute();
    //     while($rw_vehicle=$vehicle_get->fetch()):
    //         echo"<option value='".$rw_vehicle['ag_vehicle_no']."'>".$rw_vehicle['ag_vehicle_model_name']." (".$rw_vehicle['ag_vehicle_mg_year'].")</option>";
    //     endwhile;
    // }
    if (isset($_POST['change_brand'])) {
        $selectedBrands = $_POST['change_brand'];
        
        // If no brands are selected, return an empty response
        if (empty($selectedBrands)) {
          echo '';
          exit;
        }
        
        $inClause = implode(',', array_fill(0, count($selectedBrands), '?'));
        $get_vehicle = "SELECT * FROM ag_vehicle WHERE ag_brand_no IN ($inClause)";
        $vehicle_get = $con->prepare($get_vehicle);
        
        // Bind the selected brand values to the prepared statement
        foreach ($selectedBrands as $key => $brand) {
          $vehicle_get->bindValue(($key+1), $brand);
        }
        
        $vehicle_get->execute();
        
        while ($rw_vehicle = $vehicle_get->fetch()) {
          echo "<option value='" . $rw_vehicle['ag_vehicle_no'] . "'>" . $rw_vehicle['ag_vehicle_model_name'] . " (" . $rw_vehicle['ag_vehicle_mg_year'] . ")</option>";
        }
      }
    if(isset($_POST['refresh_brand'])){
        echo"<option value=''>Select Brand</option>";
        echo get_brand();
    }
    if(isset($_POST['refresh_model'])){
        echo"<option value=''>Select model</option>";
        echo get_vehicle();
    }
?>
