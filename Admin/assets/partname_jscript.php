<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
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
    if(isset($_POST['get_partname'])){
        $by_name=check_data($_POST['by_name']);
        $partname_get=$con->prepare("select * from ag_partname where ag_partname_name like'%$by_name%'  order by 1 desc");
        $partname_get->setFetchMode(PDO::FETCH_ASSOC);
        $partname_get->execute();
        $count_partname=$partname_get->rowCount();
        if($count_partname == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_partname=$partname_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_partname['ag_partname_name']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary partname_open' data-id='".encrypt_decrypt('encrypt', $rw_partname['ag_partname_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up partname_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['partname_open_table'])){
        $ag_partname_no=encrypt_decrypt('decrypt', $_POST['partname_open_table']);
        $get_partname="select * from ag_partname where ag_partname_no=:ag_partname_no";
        $partname_get=$con->prepare($get_partname,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $partname_get->bindParam(':ag_partname_no',$ag_partname_no);
        $partname_get->setFetchMode(PDO::FETCH_ASSOC);
        $partname_get->execute();
        $rw_partname=$partname_get->fetch();
        echo"<form class='form small_width_form' id='partname_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_partname['ag_partname_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Update partname Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='up_partname_name' value='".$rw_partname['ag_partname_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_partname' value='".encrypt_decrypt('encrypt', $rw_partname['ag_partname_no'])."' />
                    
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit partname_up' type='submit' name='partname_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_partname'])){
        $ag_partname_no=encrypt_decrypt('decrypt', check_data($_POST['up_partname']));
        $ag_partname_name=check_data($_POST['up_partname_name']);
             
        $up_partname="update ag_partname set ag_partname_name=:ag_partname_name where ag_partname_no=:ag_partname_no";
        $partname_up=$con->prepare($up_partname);
        $partname_up->bindParam(':ag_partname_no',$ag_partname_no);
        $partname_up->bindParam(':ag_partname_name',$ag_partname_name);
       
        if($partname_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>