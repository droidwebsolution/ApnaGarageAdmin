<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['brand_add'])){
        $ag_brand_no=substr(mt_rand(),0,10);
        $ag_brand_code=check_data($_POST['brand_code']);
        $ag_brand_name=check_data($_POST['brand_name']);
        $ag_brand_category=check_data($_POST['brand_category']);
        //get img info
       // $fileName=basename($_FILES['brand_img']['name']);
        // $fileType=pathinfo($fileName,PATHINFO_EXTENSION);
        $ag_brand_img=$_FILES['brand_img']['tmp_name'];
        $ag_brand_status=1;
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
                        <td>"."<img src= ../images/".$rw_brand['ag_brand_img'].">"."</td>
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
        echo"<form class='form small_width_form' id='add_brand'>
                <h2>Edit Brand <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update Brand Code</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='brand_code' placeholder='* your Brand code' />
                    </div>
                    <p>Update Brand Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <input type='text' name='brand_name' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='brand_add' />
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit update_brand' type='submit' name='update_brand'><i class='fa-solid fa-save'></i> Save</button>
                    </center>
                </div>
            </form>";
    }
?>