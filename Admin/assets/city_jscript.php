<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['city_add'])){
        $ag_city_no=substr(mt_rand(),0,10);
        $ag_city_name=check_data($_POST['city_name']);
        $ag_state_no=check_data($_POST['state']);
          
        $add_data="insert into ag_city(ag_city_no,ag_state_no,ag_city_name)
        values(:ag_city_no,:ag_state_no,:ag_city_name)";
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_city_no',$ag_city_no);
        $data_add->bindParam(':ag_state_no',$ag_state_no);
        $data_add->bindParam(':ag_city_name',$ag_city_name);
       
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_city'])){
        $by_name=check_data($_POST['by_name']);
        $city_get=$con->prepare("select c.*,s.ag_state_name from ag_city c left join ag_state s on c.ag_state_no=s.ag_state_no where ag_city_name like'%$by_name%'  order by 1 desc");
        $city_get->setFetchMode(PDO::FETCH_ASSOC);
        $city_get->execute();
        $count_city=$city_get->rowCount();
        if($count_city == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_city=$city_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_city['ag_state_name']."</td>
                        <td>".$rw_city['ag_city_name']."</td>
                      
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary city_open' data-id='".encrypt_decrypt('encrypt', $rw_city['ag_city_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up city_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['city_open_table'])){
        $ag_city_no=encrypt_decrypt('decrypt', $_POST['city_open_table']);
        $get_city="select ct.*,st.ag_state_name from ag_city ct left join ag_state st on ct.ag_state_no=st.ag_state_no where ct.ag_city_no=:ag_city_no";
        $city_get=$con->prepare($get_city,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $city_get->bindParam(':ag_city_no',$ag_city_no);
        $city_get->setFetchMode(PDO::FETCH_ASSOC);
        $city_get->execute();
        $rw_city=$city_get->fetch();
        echo"<form class='form small_width_form' id='city_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_city['ag_city_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    <p>Select state</p>
                    <div class='input'>
                        <i class='fa-solid fa-user'></i>
                        <select name='state'>
                            <option value='". $rw_city['ag_state_no']."'>".$rw_city['ag_state_name']."</option>";
                            echo get_state(); 
                        echo"</select>
                    </div>
                    <p>Update City Name</p>
                    <div class='input'>
                        <i class='fa-solid fa-copyright'></i>
                        <input type='text' name='up_city_name' value='".$rw_city['ag_city_name']."' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                    </div>
                    <input type='hidden' name='up_cities' value='".encrypt_decrypt('encrypt', $rw_city['ag_city_no'])."' />
                    
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit city_up' type='submit' name='city_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_cities'])){
        $ag_city_no=encrypt_decrypt('decrypt', check_data($_POST['up_cities']));
        $ag_state_no=check_data($_POST['state']);
        $ag_city_name=check_data($_POST['up_city_name']);
       // $ag_city_price=check_data($_POST['up_subs_price']);
        
        $up_city="update ag_city set ag_state_no=:ag_state_no,ag_city_name=:ag_city_name where ag_city_no=:ag_city_no";
        $city_up=$con->prepare($up_city);
        $city_up->bindParam(':ag_state_no',$ag_state_no);
        $city_up->bindParam(':ag_city_no',$ag_city_no);
        $city_up->bindParam(':ag_city_name',$ag_city_name);
   
        if($city_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>