<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['part_add'])){
        $ag_part_no=substr(mt_rand(),0,10);
        $part_get=$con->prepare("select * from ag_part order by 1 desc limit 1");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part=$part_get->rowCount();
        if($count_part == 0){
            $ag_part_code="AGP_01";
        }else{
            $rw_part=$part_get->fetch();
            $code=$rw_part['ag_part_code'];
            $ex=explode('_',$code);
            $ag_part_code="AGP_".($ex[1]+1);
        }
        $ag_brand_no=check_data($_POST['part_brand']);
        $ag_part_name=check_data($_POST['part_name']);
        $ag_part_purchase_price=check_data($_POST['purchase_price']);
        $ag_part_sale_price=check_data($_POST['sale_price']);
        $ag_part_qty=check_data($_POST['part_qty']);
        $ag_part_cat=check_data($_POST['part_cat']);
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
       
        $add_data="insert into ag_part(ag_part_no,ag_part_code,ag_brand_no,ag_part_name,ag_part_purchase_price,ag_part_sale_price,ag_part_qty,ag_part_cat,ag_part_hsn,ag_part_img,ag_part_status,ag_part_date)
        values(:ag_part_no,:ag_part_code,:ag_brand_no,:ag_part_name,:ag_part_purchase_price,:ag_part_sale_price,:ag_part_qty,:ag_part_cat,:ag_part_hsn,:ag_part_img,:ag_part_status,:ag_part_date)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_part_no',$ag_part_no);
        $data_add->bindParam(':ag_part_code',$ag_part_code);
        $data_add->bindParam(':ag_brand_no',$ag_brand_no);
        $data_add->bindParam(':ag_part_name',$ag_part_name);
        $data_add->bindParam(':ag_part_purchase_price',$ag_part_purchase_price);
        $data_add->bindParam(':ag_part_sale_price',$ag_part_sale_price);
        $data_add->bindParam(':ag_part_qty',$ag_part_qty);
        $data_add->bindParam(':ag_part_cat',$ag_part_cat);
        $data_add->bindParam(':ag_part_hsn',$ag_part_hsn);
        $data_add->bindParam(':ag_part_img',$invimg);
        $data_add->bindParam(':ag_part_status',$ag_part_status);
        $data_add->bindParam(':ag_part_date',$ag_part_date);
        
        if($data_add->execute()){
            $path="../images/part/$invimg";
            move_uploaded_file($_FILES['part_img']['tmp_name'],$path);
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_parts'])){
        $by_name=check_data($_POST['by_name']);
        $part_get=$con->prepare("select p.*,bn.ag_brand_name from ag_part p left join ag_brand bn on p.ag_brand_no=bn.ag_brand_no where p.ag_part_name like '%$by_name%'");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part=$part_get->rowCount();
        if($count_part == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_part=$part_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                      
                        <td>".$rw_part['ag_part_code']."</td>
                        <td>".$rw_part['ag_part_hsn']."</td>
                        <td>".$rw_part['ag_part_name']."</td>
                        <td><img src= 'images/part/".$rw_part['ag_part_img']."' style='width:40px;height:40px'></td>
                        <td>".$rw_part['ag_brand_no']."</td>
                        <td>".$rw_part['ag_part_qty']."</td>
                        <td>".$rw_part['ag_part_purchase_price']."</td>
                        <td>".$rw_part['ag_part_sale_price']."</td>
                        <td>".$rw_part['ag_part_cat']."</td>
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
        $get_part="select * from ag_part where ag_part_no=:ag_part_no";
        $part_get=$con->prepare($get_part,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $part_get->bindParam(':ag_part_no',$ag_part_no);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        echo"<form class='form min_width_form' id='part_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_part['ag_part_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                <div class='input_container'>
                    <p>Select Brand</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <select name='part_brand'>
                            <option value=''>Select Brand</option>";
                            echo get_brand(); 
                        echo"</select>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Part Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='part_name' value='".$rw_part['ag_part_name']."' placeholder='Part Name eg.foot rest' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Purchase Price</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='purchase price' value='".$rw_part['ag_part_purchase_price']."' placeholder='Only Digit Allowed'/>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Sale Price</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='sale_price' value='".$rw_part['ag_part_sale_price']."' placeholder='Only Digit Allowed' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Quantity</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='part_qty' value='".$rw_part['ag_part_qty']."' placeholder='*Eg. 50'/>
                    </div>
                </div>
                <div class='input_container'>
                    <p>Enter Category</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <select name='part_cat' value='".$rw_part['ag_part_cat']."' >
                            <option value='Oil'>Oil</option>
                            <option value='Spare'>Spare</option>
                            <option value='Accessories'>Accessories</option>
                        </select>
                    </div>
                </div>
                <input type='hidden' name='up_parts' value='".encrypt_decrypt('encrypt', $rw_part['ag_part_no'])."' />
                <div class='input_container'>
                    <p>Enter HSN</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='part_hsn' placeholder='Only Digits Allowed' value='".$rw_part['ag_part_hsn']."' />
                    </div>
                </div>
                <div class='input_container'>
                    <p>Choose Part Image</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='file' name='part_img'  />
                    </div>
                </div>
                
                <div class='input_container'>
                    <p>Select Status</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <select name='part_status' value='".$rw_part['ag_part_status']."'>
                            <option value='Active'>Active</option>
                            <option value='InActive'>InActive</option>
                        </select>
                    </div>
                </div><br clear='all'>                            
                <center>
                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                    <button class='pop_up_submit part_up' type='submit' name='part_up'><i class='fa-solid fa-save'></i> Update</button>
                </center>
            </div>
            </form>";
    }
    if(isset($_POST['up_parts'])){
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['up_parts']);
        //$ag_vehicle_brand_no=check_data($_POST['vehicle_brand']);
        $ag_brand_no=check_data($_POST['part_brand']);
        $ag_part_name=check_data($_POST['part_name']);
        $ag_part_purchase_price=check_data($_POST['purchase_price']);
        $ag_part_sale_price=check_data($_POST['sale_price']);
        $ag_part_qty=check_data($_POST['part_qty']);
        $ag_part_cat=check_data($_POST['part_cat']);
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
            $up_part="update ag_part set ag_part_name=:ag_part_name,ag_part_purchase_price=:ag_part_purchase_price,ag_part_sale_price=:ag_part_sale_price,ag_part_qty=:ag_part_qty,ag_part_cat=:ag_part_cat,ag_part_hsn=:ag_part_hsn,ag_part_status=:ag_part_status where ag_part_no=:ag_part_no";
            $part_up=$con->prepare($up_part);
            $part_up->bindParam(':ag_part_no',$ag_part_no);
           // $part_up->bindParam(':ag_part_code',$ag_part_code);
            //$part_up->bindParam(':ag_brand_no',$ag_brand_no);
            $part_up->bindParam(':ag_part_name',$ag_part_name);
            $part_up->bindParam(':ag_part_purchase_price',$ag_part_purchase_price);
            $part_up->bindParam(':ag_part_sale_price',$ag_part_sale_price);
            $part_up->bindParam(':ag_part_qty',$ag_part_qty);
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
?>