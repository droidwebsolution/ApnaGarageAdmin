<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
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
    if(isset($_POST['get_mg_company'])){
        $by_name=check_data($_POST['by_name']);
        $mg_company_get=$con->prepare("select * from ag_mg_company where ag_mg_company_name like'%$by_name%'  order by 1 desc");
        $mg_company_get->setFetchMode(PDO::FETCH_ASSOC);
        $mg_company_get->execute();
        $count_mg_company=$mg_company_get->rowCount();
        if($count_mg_company == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_mg_company=$mg_company_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_mg_company['ag_mg_company_code']."</td>
                        <td>".$rw_mg_company['ag_mg_company_name']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary mg_company_open' data-id='".encrypt_decrypt('encrypt', $rw_mg_company['ag_mg_company_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up mg_company_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['mg_company_open_table'])){
        $ag_mg_company_no=encrypt_decrypt('decrypt', $_POST['mg_company_open_table']);
        $get_mg_company="select * from ag_mg_company where ag_mg_company_no=:ag_mg_company_no";
        $mg_company_get=$con->prepare($get_mg_company,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $mg_company_get->bindParam(':ag_mg_company_no',$ag_mg_company_no);
        $mg_company_get->setFetchMode(PDO::FETCH_ASSOC);
        $mg_company_get->execute();
        $rw_mg_company=$mg_company_get->fetch();
        echo"<form class='form small_width_form' id='mg_company_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_mg_company['ag_mg_company_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update mg_company Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='up_mg_company_name' value='".$rw_mg_company['ag_mg_company_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_mg_company' value='".encrypt_decrypt('encrypt', $rw_mg_company['ag_mg_company_no'])."' />
                    
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit mg_company_up' type='submit' name='mg_company_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_mg_company'])){
        $ag_mg_company_no=encrypt_decrypt('decrypt', check_data($_POST['up_mg_company']));
        $ag_mg_company_name=check_data($_POST['up_mg_company_name']);
             
        $up_mg_company="update ag_mg_company set ag_mg_company_name=:ag_mg_company_name where ag_mg_company_no=:ag_mg_company_no";
        $mg_company_up=$con->prepare($up_mg_company);
        $mg_company_up->bindParam(':ag_mg_company_no',$ag_mg_company_no);
        $mg_company_up->bindParam(':ag_mg_company_name',$ag_mg_company_name);
       
        if($mg_company_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>