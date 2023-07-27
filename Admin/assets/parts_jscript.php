<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['selectedBrands'])) {
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
    if(isset($_POST['part_add'])) {
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

        $ag_partname_no = $_POST['partname'];
        $partname_get="select * from ag_partname where ag_partname_no=:ag_partname_no";
        $get_partname=$con->prepare($partname_get);
        $get_partname->bindParam(':ag_partname_no', $ag_partname_no);
        $get_partname->setFetchMode(PDO::FETCH_ASSOC);
        $get_partname->execute();
        $rw_partname = $get_partname->fetch();

        $ag_part_name = $rw_partname['ag_partname_name'];
        $ag_part_company = $_POST['mg_company'];
        $ag_part_purchase_price=0;
        $ag_part_selling_price = 0;
        $ag_part_qty = 0;
        $ag_part_alert_qty =$_POST['part_alert_qty'];
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
    
        $add_data = "INSERT INTO ag_part(ag_part_no, ag_part_code, ag_part_name,ag_part_company,ag_part_purchase_price,ag_part_selling_price,ag_part_qty,ag_part_alert_qty, ag_part_hsn, ag_part_cat, ag_part_img, ag_part_status, ag_part_date) 
                    VALUES(:ag_part_no, :ag_part_code, :ag_part_name, :ag_part_company,:ag_part_purchase_price,:ag_part_selling_price,:ag_part_qty,:ag_part_alert_qty, :ag_part_hsn, :ag_part_cat, :ag_part_img, :ag_part_status, :ag_part_date)";
        
        $data_add = $con->prepare($add_data, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_part_no', $ag_part_no);
        $data_add->bindParam(':ag_part_code', $ag_part_code);
        //$data_add->bindParam(':ag_brand_no', $ag_brand_no);
       // $data_add->bindParam(':ag_vehicle_no', $ag_vehicle_no);
        $data_add->bindParam(':ag_part_name', $ag_part_name);
        $data_add->bindParam(':ag_part_company', $ag_part_company);
        $data_add->bindParam(':ag_part_purchase_price', $ag_part_purchase_price);
        $data_add->bindParam(':ag_part_selling_price', $ag_part_selling_price);
        $data_add->bindParam(':ag_part_qty', $ag_part_qty);
        $data_add->bindParam(':ag_part_alert_qty', $ag_part_alert_qty);
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
            foreach ($ag_vehicle_nos as $vehicle_id) {
                $get_vehicle="select * from ag_vehicle where ag_vehicle_no='$vehicle_id'";
                $vehicle_get=$con->prepare($get_vehicle);
                $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
                $vehicle_get->execute();
                $rw_vehicle=$vehicle_get->fetch();
                $ag_brand_no=$rw_vehicle['ag_brand_no'];
                $ag_part_repo_status=1;

                $insert_bridge = "INSERT INTO ag_part_repo(ag_part_id,ag_brand_no,ag_vehicle_no,ag_part_company,ag_part_name,ag_part_repo_status) 
                                    VALUES(:ag_part_id, :ag_brand_no, :ag_vehicle_no, :ag_part_company, :ag_part_name,:ag_part_repo_status)";
                $data_bridge = $con->prepare($insert_bridge, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $data_bridge->bindParam(':ag_part_id', $part_id);
                $data_bridge->bindParam(':ag_brand_no', $ag_brand_no);
                $data_bridge->bindParam(':ag_vehicle_no', $vehicle_id);
                $data_bridge->bindParam(':ag_part_company', $ag_part_company);
                $data_bridge->bindParam(':ag_part_name', $ag_part_name);
                $data_bridge->bindParam(':ag_part_repo_status', $ag_part_repo_status);
                $data_bridge->execute();
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
    if(isset($_POST['vehicle_add'])) {
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
    if(isset($_POST['partname_add'])){
        $ag_partname_no=substr(mt_rand(),0,10);
        $ag_partname_name=check_data($_POST['partname_name']);
          
        $add_data="insert into ag_partname(ag_partname_no,ag_partname_name)
        values(:ag_partname_no,:ag_partname_name)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_partname_no',$ag_partname_no);
        $data_add->bindParam(':ag_partname_name',$ag_partname_name);
       
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['mg_company_add'])){
        $ag_mg_company_no=substr(mt_rand(),0,10);
        $mg_company_get = $con->prepare("select * from ag_mg_company order by 1 desc limit 1");
        $mg_company_get->setFetchMode(PDO::FETCH_ASSOC);
        $mg_company_get->execute();
        $count_mg_company = $mg_company_get->rowCount();
        if ($count_mg_company == 0) {
            $ag_mg_company_code = "AGC_01";
        } else {
            $rw_mg_company = $mg_company_get->fetch();
            $code = $rw_mg_company['ag_mg_company_code'];
            $ex = explode('_', $code);
            $ag_mg_company_code = "AGC_" . ($ex[1] + 1);
        }
        $ag_mg_company_name=check_data($_POST['mg_company_name']);
          
        $add_data="insert into ag_mg_company(ag_mg_company_no,ag_mg_company_code,ag_mg_company_name)
        values(:ag_mg_company_no,:ag_mg_company_code,:ag_mg_company_name)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_mg_company_no',$ag_mg_company_no);
        $data_add->bindParam(':ag_mg_company_code',$ag_mg_company_code);
        $data_add->bindParam(':ag_mg_company_name',$ag_mg_company_name);
       
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_parts'])){
        $by_name=check_data($_POST['by_name']);
        $by_brand=check_data($_POST['by_brand']);
        $by_model=check_data($_POST['by_model']);
        if($by_brand==""){
            $vehicle="";
        }else{
            $vehicle=" and ag_brand_no='$by_brand' and ag_vehicle_no='$by_model'";
        }
        $part_get=$con->prepare("select * from ag_part where ag_part_name like'%$by_name%' or ag_part_code like'%$by_name%' or ag_part_company like'%$by_name%' or ag_part_cat like'%$by_name%'");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part=$part_get->rowCount();
        if($count_part == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_part=$part_get->fetch()):
                $part_id=$rw_part['ag_part_id'];
                $ag_part_no=$rw_part['ag_part_no'];
                $get_brand="select * from ag_part_repo where ag_part_id='$part_id'$vehicle";
                $brand_get=$con->prepare($get_brand);
                $brand_get->setFetchMode(PDO::FETCH_ASSOC);
                $brand_get->execute();
                $count_brand=$brand_get->rowCount();
                if($count_brand == 0){}else{
                    $get_hold_stock="select * from ag_part_hold_stock where ag_part_no='$ag_part_no' and ag_hold_status=1";
                    $hold_stock_get=$con->prepare($get_hold_stock);
                    $hold_stock_get->setFetchMode(PDO::FETCH_ASSOC);
                    $hold_stock_get->execute();
                    $hold_stock=$hold_stock_get->rowCount();
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_part['ag_part_code']."</td>
                        <td>".$rw_part['ag_part_name']."</td>
                        <td>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary part_brand_model_open' data-id='".encrypt_decrypt('encrypt', $rw_part['ag_part_id'])."' style='text-align:center'><i class='fa-solid fa-pen-to-square'></i> $count_brand</summary>
                                <div class='pop_up'>
                                    <div class='form min_width_form'>
                                        <h2>".$rw_part['ag_part_name']." Brands & Models <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                                        <div class='form_container'>
                                            <div class='table_container part_brand_model_table'></div>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </td>
                        <td>".number_format($rw_part['ag_part_purchase_price'],2)."</td>
                        <td>".number_format($rw_part['ag_part_selling_price'],2)."</td>
                        <td>".$rw_part['ag_part_qty']."</td>
                        <td>".$rw_part['ag_part_alert_qty']."</td>
                        <td>";
                        if($hold_stock == 0){
                            echo "--";
                        }else{
                            echo"<details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary part_hold_stock_open' data-id='".encrypt_decrypt('encrypt', $rw_part['ag_part_no'])."' style='text-align:center'><i class='fa-solid fa-pen-to-square'></i> $hold_stock</summary>
                                <div class='pop_up'>
                                    <div class='form min_width_form'>
                                        <h2>".$rw_part['ag_part_name']." Hold Stock Details <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                                        <div class='form_container'>
                                            <div class='table_container part_hold_stock_table'></div>
                                        </div>
                                    </div>
                                </div>
                            </details>";
                        }
                        echo"</td>
                        <td>".$rw_part['ag_part_cat']."</td>
                        <td>".$rw_part['ag_part_company']."</td>
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
                }
            endwhile;
        }
    }
    if(isset($_POST['part_brand_model_open'])){
        $ag_part_id=encrypt_decrypt('decrypt', $_POST['part_brand_model_open']);
        $get_brand="select pr.*,bn.ag_brand_name,vh.ag_vehicle_model_name,vh.ag_vehicle_mg_year from ag_part_repo pr left join ag_brand bn on pr.ag_brand_no=bn.ag_brand_no left join ag_vehicle vh on pr.ag_vehicle_no=vh.ag_vehicle_no where pr.ag_part_id='$ag_part_id'";
        $brand_get=$con->prepare($get_brand);
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $count_brand=$brand_get->rowCount();
        $j=1;
        echo"<script>
                $('.multiple-checkboxe$ag_part_id').multiselect({
                    includeSelectAllOption: true,
                    nonSelectedText: 'Select Brand',
                    onChange: function(option, checked, select) {}
                });
               
                // Initialize the 'Select Model' select element as a multiple-select checkbox
                $('.refresh_model$ag_part_id').multiselect({
                    includeSelectAllOption: true, 
                    nonSelectedText: 'Select Model',
                    onChange: function(option, checked, select) {}
                });
                $(document).on('change','.refresh_brand$ag_part_id',function(){
                    var change_brand=$(this).val();
                    //$('.refresh_model$ag_part_id').attr('mulitple','multiple');
                    $.ajax({
                        url:'assets/parts_jscript.php',
                        method:'post',
                        data:{change_brand:change_brand},
                        success:function(data){
                            // Update the options of the 'Select Model' select element
                            $('.refresh_model$ag_part_id').html(data);
        
                            // After updating the options, reinitialize the 'Select Model' select element as a multiple-select checkbox
                            $('.refresh_model$ag_part_id').multiselect('rebuild');
                        }
                    });
                });
            </script>";
        echo"<form id='add_new_part' data-id='".encrypt_decrypt('encrypt', $ag_part_id)."' style='margin-top:-20px'>
                <div class='input_container'>
                    <p>Select Brand</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <select required class='refresh_brand$ag_part_id multiple-checkboxe$ag_part_id' multiple='multiple'>";
                            echo get_brand();
                        echo"</select>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Select Model</p>
                    <div class='input'>
                        <i class='fa-sharp fa-regular fa-motorcycle'></i>
                        <select name='part_vehicle_model[]' required class='refresh_model$ag_part_id' multiple='multiple'></select>
                    </div>
                </div>
                <input type='hidden' name='new_part_add' value='$ag_part_id' />
                <div class='input_container'>
                    <p style='visibility:hidden'>te</p>
                    <div class='input' style='background:none'>
                        <button type='submit' class='add_new_part' style='height:35px; width:100px; border-radius:10px; color:#fff; font-weight:600; background:#2e2e2e; outline:none; border:none;'>ADD</button>
                    </div>
                </div>
            </form>
            <!--<center>
                <input type='text' placeholder='Search by Brand or Model Name' />
            </center>-->
            <table class='item_table'>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Brand Name</th>
                        <th>Model Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>";
        while($rw_brand=$brand_get->fetch()):
            $part_id=$rw_brand['ag_part_repo_id'];
            $i_status=$rw_brand['ag_part_repo_status'];
            if($i_status == 1){
                $checked='checked';
                $status='Active';
            }else{
                $checked='';
                $status='InActive';
            }
            echo"<tr>
                    <td>".$j++."</td>
                    <td>".$rw_brand['ag_brand_name']."</td>
                    <td>".$rw_brand['ag_vehicle_model_name']." (".$rw_brand['ag_vehicle_mg_year'].")</td>
                    <td>
                        <label class='switch'>
                            <input type='checkbox' name='ite_status' class='part_brand_model_delete' $checked data-id='".encrypt_decrypt('encrypt', $ag_part_id)."' data-delete='".encrypt_decrypt('encrypt', $part_id)."'>
                            <span class='slider round'></span>
                        </label>
                </tr>";
        endwhile;
        echo"</tbody>
        </table>";
    }
    if(isset($_POST['new_part_add'])){
        $ag_part_id=$_POST['new_part_add'];
        $ag_v_no=$_POST['part_vehicle_model'];

        $get_part="select * from ag_part_repo where ag_part_id='$ag_part_id'";
        $part_get=$con->prepare($get_part);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        $ag_part_company=$rw_part['ag_part_company'];
        $ag_part_name=$rw_part['ag_part_name'];
        $ag_part_repo_status=1;
        foreach($ag_v_no as $ag_vehicle_no){
            $check_part="select * from ag_part_repo where ag_part_id='$ag_part_id' and ag_vehicle_no='$ag_vehicle_no'";
            $part_check=$con->prepare($check_part);
            $part_check->setFetchMode(PDO::FETCH_ASSOC);
            $part_check->execute();
            $count_part=$part_check->rowCount();
            if($count_part > 0){}else{
                $get_vehicle="select * from ag_vehicle where ag_vehicle_no='$ag_vehicle_no'";
                $vehicle_get=$con->prepare($get_vehicle);
                $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
                $vehicle_get->execute();
                $rw_vehicle=$vehicle_get->fetch();
                $ag_brand_no=$rw_vehicle['ag_brand_no'];
                
                $insert_bridge = "INSERT INTO ag_part_repo(ag_part_id,ag_brand_no,ag_vehicle_no,ag_part_company,ag_part_name,ag_part_repo_status) 
                                    VALUES(:ag_part_id, :ag_brand_no, :ag_vehicle_no, :ag_part_company, :ag_part_name,:ag_part_repo_status)";
                $data_bridge = $con->prepare($insert_bridge, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $data_bridge->bindParam(':ag_part_id', $ag_part_id);
                $data_bridge->bindParam(':ag_brand_no', $ag_brand_no);
                $data_bridge->bindParam(':ag_vehicle_no', $ag_vehicle_no);
                $data_bridge->bindParam(':ag_part_company', $ag_part_company);
                $data_bridge->bindParam(':ag_part_name', $ag_part_name);
                $data_bridge->bindParam(':ag_part_repo_status', $ag_part_repo_status);
                $data_bridge->execute();
            }
        }
    }
    if(isset($_POST['part_brand_model_delete'])){
        $ag_part_id=encrypt_decrypt('decrypt', $_POST['part_brand_model_delete']);

        $status=$_POST['status'];
        if($status == "Active"){
            $i_status=1;
        }else{
            $i_status=2;
        }

        $delete_part="update ag_part_repo set ag_part_repo_status='$i_status' where ag_part_repo_id='$ag_part_id'";
        $part_delete=$con->prepare($delete_part);
        $part_delete->execute();
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
                    <input type='text' name='part_company_name' value='".$rw_part['ag_part_company']."' placeholder='Part Company Name' required />
                </div>
                </div>
                <div class='input_container'>
                                    <p>Enter Part Alert Quantity</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-screwdriver-wrench'></i>
                                        <input type='text' name='part_alert_qty' placeholder='Part Alert Quantity' required />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Part Selling Price</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-screwdriver-wrench'></i>
                                        <input type='text' name='part_selling_price' placeholder='Part Part Selling Price' required />
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
        // $ag_vehicle_no=check_data($_POST['part_vehicle']);
        // $ag_brand_no=check_data($_POST['part_brand']);
        $ag_part_name=check_data($_POST['part_name']);
        $ag_part_company=check_data($_POST['part_company_name']);
        $ag_part_alert_qty = $_POST['part_alert_qty'];
        $ag_part_selling_price = $_POST['part_selling_price'];
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
            $up_part="update ag_part set ag_part_name=:ag_part_name,ag_part_company=:ag_part_company,ag_part_alert_qty=:ag_part_alert_qty,ag_part_selling_price=:ag_part_selling_price,ag_part_cat=:ag_part_cat,ag_part_hsn=:ag_part_hsn,ag_part_status=:ag_part_status where ag_part_no=:ag_part_no";
            $part_up=$con->prepare($up_part);
            $part_up->bindParam(':ag_part_no',$ag_part_no);
            // $part_up->bindParam(':ag_brand_no',$ag_brand_no);
            // $part_up->bindParam(':ag_vehicle_no',$ag_vehicle_no);
            $part_up->bindParam(':ag_part_name',$ag_part_name);
            $part_up->bindParam(':ag_part_company',$ag_part_company);
            $part_up->bindParam(':ag_part_alert_qty', $ag_part_alert_qty);
            $part_up->bindParam(':ag_part_selling_price', $ag_part_selling_price);
            $part_up->bindParam(':ag_part_cat',$ag_part_cat);
            $part_up->bindParam(':ag_part_hsn',$ag_part_hsn);
            $part_up->bindParam(':ag_part_status',$ag_part_status);

            if($part_up->execute()){
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
                    $up_part="update ag_part set ag_part_name=:ag_part_name,ag_part_company=:ag_part_company,ag_part_alert_qty=:ag_part_alert_qty,ag_part_selling_price=:ag_part_selling_price,ag_part_cat=:ag_part_cat,ag_part_hsn=:ag_part_hsn,ag_part_img=:ag_part_img,ag_part_status=:ag_part_status where ag_part_no=:ag_part_no";
                    $part_up=$con->prepare($up_part);
                    $part_up->bindParam(':ag_part_no',$ag_part_no);
                   // $part_up->bindParam(':ag_brand_no',$ag_brand_no);
                    $part_up->bindParam(':ag_part_name',$ag_part_name);
                    $part_up->bindParam(':ag_part_company',$ag_part_company);
                    $part_up->bindParam(':ag_part_alert_qty', $ag_part_alert_qty);
                    $part_up->bindParam(':ag_part_selling_price', $ag_part_selling_price);
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
    if(isset($_POST['change_brand'])) {
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
    if(isset($_POST['change_search_brand'])) {
        $ag_brand_no = $_POST['change_search_brand'];
        $get_model="select * from ag_vehicle where ag_brand_no='$ag_brand_no'";
        $model_get=$con->prepare($get_model);
        $model_get->setFetchMode(PDO::FETCH_ASSOC);
        $model_get->execute();
        while($rw_model=$model_get->fetch()):
            echo"<option value='".$rw_model['ag_vehicle_no']."'>".$rw_model['ag_vehicle_model_name'].".(".$rw_model['ag_vehicle_mg_year'].")</option>";
        endwhile;
    }
    if(isset($_POST['refresh_brand'])){
        echo"<option value=''>Select Brand</option>";
        echo get_brand();
    }
    if(isset($_POST['refresh_model'])){
        echo"<option value=''>Select model</option>";
        echo get_vehicle();
    }
    if(isset($_POST['refresh_partname'])){
        echo"<option value=''>Select Part Name</option>";
        echo get_partname();
    }
    if(isset($_POST['refresh_mg_company'])){
        echo"<option value=''>Select Menufecture Comapny</option>";
        echo get_mg_company();
    }
    if(isset($_POST['part_hold_stock_open'])){
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['part_hold_stock_open']);
        $get_stock=$con->prepare("select * from ag_part_hold_stock where ag_part_no='$ag_part_no' and ag_hold_status=1");
        $get_stock->setFetchMode(PDO::FETCH_ASSOC);
        $get_stock->execute();
        echo"<table class='item_table'>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Old Purchase Price</th>
                        <th>New Purchase Price</th>
                        <th>Old Sale Price</th>
                        <th>New Sale Price</th>
                        <th>Hold Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
        $i=1;
        while($rw_stock=$get_stock->fetch()):
            if($rw_stock['ag_hold_status'] == 1){
                $action="<button class='stock_push pop_up_stock_push ' data-id='".$rw_stock['ag_hold_id']."'>Stock Push</button>";
            }else{
                $action="--";
            }
            echo"<tr>
                <td>".$i++."</td>
                <td>".$rw_stock['ag_old_pp']."</td>
                <td>".$rw_stock['ag_new_pp']."</td>
                <td>".$rw_stock['ag_old_sp']."</td>
                <td>".$rw_stock['ag_new_sp']."</td>
                <td>".$rw_stock['ag_hold_qty']."</td>
                <td>$action</td>
            </tr>";
        endwhile;
        echo"</tbody>
        </table>";
    }
    if(isset($_POST['stock_push'])){
        $ag_hold_id=$_POST['stock_push'];

        $get_stock="select * from ag_part_hold_stock where ag_hold_id='$ag_hold_id'";
        $stock_get=$con->prepare($get_stock);
        $stock_get->setFetchMode(PDO::FETCH_ASSOC);
        $stock_get->execute();
        $rw_stock=$stock_get->fetch();
        $ag_part_purchase_price=$rw_stock['ag_new_pp'];
        $ag_part_selling_price=$rw_stock['ag_new_sp'];
        $ag_hold_qty=$rw_stock['ag_hold_qty'];
        $ag_part_no=$rw_stock['ag_part_no'];

        $up_part="update ag_part set ag_part_purchase_price='$ag_part_purchase_price',ag_part_selling_price='$ag_part_selling_price',ag_part_qty=ag_part_qty+'$ag_hold_qty' where ag_part_no='$ag_part_no'";
        $part_up=$con->prepare($up_part);
        if($part_up->execute()){
            $up_stock="update ag_part_hold_stock set ag_hold_status=2 where ag_hold_id='$ag_hold_id'";
            $stock_up=$con->prepare($up_stock);
            $stock_up->execute();
            $msg="Hold Stock has Been Updated Successfully";
        }else{
            $msg="Something Went Wrong Please Try Again";
        }
        echo $msg;
    }
?>
