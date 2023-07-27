<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['customer_add'])){
        $ag_customer_no=substr(mt_rand(),0,10);
        $ag_customer_name=check_data($_POST['customer_name']);
        $ag_customer_phone_no=check_data($_POST['customer_phone']);
        $ag_customer_address=check_data($_POST['customer_address']);
        $ag_customer_pending_amt=0;

        $add_data="insert into ag_customer(ag_customer_no,ag_customer_name,ag_customer_phone_no,ag_customer_address,ag_customer_pending_amt)
        values(:ag_customer_no,:ag_customer_name,:ag_customer_phone_no,:ag_customer_address,:ag_customer_pending_amt)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_customer_no',$ag_customer_no);
        $data_add->bindParam(':ag_customer_name',$ag_customer_name);
        $data_add->bindParam(':ag_customer_phone_no',$ag_customer_phone_no);
        $data_add->bindParam(':ag_customer_address',$ag_customer_address);
        $data_add->bindParam(':ag_customer_pending_amt',$ag_customer_pending_amt);
       
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_customer'])){
        $by_name=check_data($_POST['by_name']);
        $customer_get=$con->prepare("select * from ag_customer where ag_customer_name like'%$by_name%'  order by 1 desc");
        $customer_get->setFetchMode(PDO::FETCH_ASSOC);
        $customer_get->execute();
        $count_customer=$customer_get->rowCount();
        if($count_customer == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_customer=$customer_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_customer['ag_customer_name']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary customer_open' data-id='".encrypt_decrypt('encrypt', $rw_customer['ag_customer_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up customer_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['customer_open_table'])){
        $ag_customer_no=encrypt_decrypt('decrypt', $_POST['customer_open_table']);
        $get_customer="select * from ag_customer where ag_customer_no=:ag_customer_no";
        $customer_get=$con->prepare($get_customer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $customer_get->bindParam(':ag_customer_no',$ag_customer_no);
        $customer_get->setFetchMode(PDO::FETCH_ASSOC);
        $customer_get->execute();
        $rw_customer=$customer_get->fetch();
        echo"<form class='form small_width_form' id='customer_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_customer['ag_customer_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update customer Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='up_customer_name' value='".$rw_customer['ag_customer_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_customer' value='".encrypt_decrypt('encrypt', $rw_customer['ag_customer_no'])."' />
                    
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit customer_up' type='submit' name='customer_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_customer'])){
        $ag_customer_no=encrypt_decrypt('decrypt', check_data($_POST['up_customer']));
        $ag_customer_name=check_data($_POST['up_customer_name']);
             
        $up_customer="update ag_customer set ag_customer_name=:ag_customer_name where ag_customer_no=:ag_customer_no";
        $customer_up=$con->prepare($up_customer);
        $customer_up->bindParam(':ag_customer_no',$ag_customer_no);
        $customer_up->bindParam(':ag_customer_name',$ag_customer_name);
       
        if($customer_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>