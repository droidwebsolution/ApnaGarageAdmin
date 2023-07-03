<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
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
        //get img info
       // $fileName=basename($_FILES['brand_img']['name']);
        // $fileType=pathinfo($fileName,PATHINFO_EXTENSION);
        $ag_brand_img=$_FILES['brand_img']['tmp_name'];
        $ag_brand_status=$_POST['brand_Status'];
        if($ag_brand_status == "Active"){
            $ag_brand_status=1;
        }else{
            $ag_brand_status=2;
        }
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
            $path="../images/$invimg";
            move_uploaded_file($_FILES['brand_img']['tmp_name'],$path);
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_brand'])){
        $by_name=check_data($_POST['by_name']);
        $brand_get=$con->prepare("select * from ag_brand where ag_brand_name || ag_brand_code like'%$by_name%'  order by 1 desc");
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $count_brand=$brand_get->rowCount();
        if($count_brand == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_brand=$brand_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_brand['ag_brand_code']."</td> 
                        <td>".$rw_brand['ag_brand_name']."</td>
                        <td>".$rw_brand['ag_brand_category']."</td>
                        <td><img src= 'images/".$rw_brand['ag_brand_img']."' style='width:40px;height:40px'></td>
                        <td>";
                        if($rw_brand['ag_brand_status'] == 1){
                            echo 'Active';
                        }else{
                            echo"In Active";
                        }
                        
                        echo"</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary brand_open' data-id='".encrypt_decrypt('encrypt', $rw_brand['ag_brand_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up brand_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['brand_open_table'])){
        $ag_brand_no=encrypt_decrypt('decrypt', $_POST['brand_open_table']);
        $get_brand="select * from ag_brand where ag_brand_no=:ag_brand_no";
        $brand_get=$con->prepare($get_brand,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $brand_get->bindParam(':ag_brand_no',$ag_brand_no);
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $rw_brand=$brand_get->fetch();
        echo"<form class='form small_width_form' id='brand_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_brand['ag_brand_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update Brand Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='brand_name' value='".$rw_brand['ag_brand_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_brands' value='".encrypt_decrypt('encrypt', $rw_brand['ag_brand_no'])."' />
                    <p>Update Brand Category</p>
                    <div class='input'>
                        <i class='fa-solid fa-list'></i>
                        <select name='brand_category' value='".$rw_brand['ag_brand_category']."' >
                            <option>Bike</option>
                            <option value=''>Car</option>
                            <option value=''>Auto Rikshaw</option>
                        </select>
                    </div>
                    <p>Update Brand Image</p>
                    <div class='input'>
                        <i class='fa-solid fa-image'></i>
                        <input type='file' name='brand_img' />
                    </div>
                    <p>Update Brand Status</p>
                    <div class='input'>
                        <i class='fa-sharp fa-solid fa-battery-full'></i>
                        <select name='brand_status' value='".$rw_brand['ag_brand_status']."'>
                            <option>Active</option>
                            <option>In Active</option>
                        </select>
                    </div>
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit brand_up' type='submit' name='brand_up'><i class='fa-solid fa-save'></i> Update</button>
                    </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_brands'])){
        $ag_brand_no=encrypt_decrypt('decrypt', $_POST['up_brands']);
        $ag_brand_name=check_data($_POST['brand_name']);
        $ag_brand_category=check_data($_POST['brand_category']);
        $ag_brand_status=check_data($_POST['brand_status']);
        $gtinv="select ag_brand_img from ag_brand where ag_brand_no=:ag_brand_no";
        $invgt=$con->prepare($gtinv, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $invgt->bindParam(":ag_brand_no",$ag_brand_no);
        $invgt->execute();
        $rwinv=$invgt->fetch();
        
        if(empty($_FILES['brand_img']['tmp_name'])){
            $up_brand="update ag_brand set ag_brand_name=:ag_brand_name,ag_brand_category=:ag_brand_category,ag_brand_status=:ag_brand_status where ag_brand_no=:ag_brand_no";
            $brand_up=$con->prepare($up_brand);
            $brand_up->bindParam(':ag_brand_no',$ag_brand_no);
            $brand_up->bindParam(':ag_brand_name',$ag_brand_name);
            $brand_up->bindParam(':ag_brand_category',$ag_brand_category);
            $brand_up->bindParam(':ag_brand_status',$ag_brand_status);
            if($brand_up->execute()){
                $msg="Data Updated Succeessfully";
                echo json_encode($msg);
            }else{
                $msg="Something went wrong";
                echo json_encode($msg);
            }
        }
        else{
            $up_check_img=getimagesize($_FILES['brand_img']['tmp_name']);
            $up_img_size=$_FILES['brand_img']['size'];
            if($up_check_img == true){
                if($up_img_size >2000000){
                    $msg='Only 2MB Image File Allowed';
                    echo json_encode($msg);
                }else{
                    $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";
                    $up_brand="update ag_brand set ag_brand_name=:ag_brand_name,ag_brand_img=:ag_brand_img,ag_brand_category=:ag_brand_category,ag_brand_status=:ag_brand_status where ag_brand_no=:ag_brand_no";
                    $brand_up=$con->prepare($up_brand);
                    $brand_up->bindParam(':ag_brand_no',$ag_brand_no);
                    $brand_up->bindParam(':ag_brand_name',$ag_brand_name);
                    $brand_up->bindParam(':ag_brand_img',$invimg);
                    $brand_up->bindParam(':ag_brand_category',$ag_brand_category);
                    $brand_up->bindParam(':ag_brand_status',$ag_brand_status);
                    if($brand_up->execute()){
                        if($rwinv['ag_brand_img'] == ''){}else{
                            $old_img="../images/".$rwinv['ag_brand_img']."";
                            unlink($old_img);
                        }
                        $fpath="../images/$invimg";
                        move_uploaded_file($_FILES['brand_img']['tmp_name'],$fpath);
                        $msg="Brand Has Been Updated Successfully";
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