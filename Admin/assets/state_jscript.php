<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['state_add'])){
        $ag_state_no=substr(mt_rand(),0,10);
        $ag_state_name=check_data($_POST['state_name']);
          
        $add_data="insert into ag_state(ag_state_no,ag_state_name)
        values(:ag_state_no,:ag_state_name)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_state_no',$ag_state_no);
        $data_add->bindParam(':ag_state_name',$ag_state_name);
       
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_state'])){
        $by_name=check_data($_POST['by_name']);
        $state_get=$con->prepare("select * from ag_state where ag_state_name like'%$by_name%'  order by 1 desc");
        $state_get->setFetchMode(PDO::FETCH_ASSOC);
        $state_get->execute();
        $count_state=$state_get->rowCount();
        if($count_state == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_state=$state_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_state['ag_state_name']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary state_open' data-id='".encrypt_decrypt('encrypt', $rw_state['ag_state_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up state_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['state_open_table'])){
        $ag_state_no=encrypt_decrypt('decrypt', $_POST['state_open_table']);
        $get_state="select * from ag_state where ag_state_no=:ag_state_no";
        $state_get=$con->prepare($get_state,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $state_get->bindParam(':ag_state_no',$ag_state_no);
        $state_get->setFetchMode(PDO::FETCH_ASSOC);
        $state_get->execute();
        $rw_state=$state_get->fetch();
        echo"<form class='form small_width_form' id='state_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_state['ag_state_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update State Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='up_state_name' value='".$rw_state['ag_state_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_state' value='".encrypt_decrypt('encrypt', $rw_state['ag_state_no'])."' />
                    
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit state_up' type='submit' name='state_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_state'])){
        $ag_state_no=encrypt_decrypt('decrypt', check_data($_POST['up_state']));
        $ag_state_name=check_data($_POST['up_state_name']);
             
        $up_state="update ag_state set ag_state_name=:ag_state_name where ag_state_no=:ag_state_no";
        $state_up=$con->prepare($up_state);
        $state_up->bindParam(':ag_state_no',$ag_state_no);
        $state_up->bindParam(':ag_state_name',$ag_state_name);
       
        if($state_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>