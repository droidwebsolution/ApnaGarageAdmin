<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['retailer_add'])){
        $ag_retailer_no=substr(mt_rand(),0,10);
        $retailer_get=$con->prepare("select * from ag_retailer order by 1 desc limit 1");
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        if($count_retailer == 0){
            $ag_retailer_code="RT_1";
        }else{
            $rw_retailer=$retailer_get->fetch();
            $code=$rw_retailer['ag_retailer_code'];
            $ex=explode('_',$code);
            $ag_retailer_code="RT_".($ex[1]+1);
        }
        $ag_retailer_company_name=check_data($_POST['r_company_name']);
        $ag_retailer_owner_name=check_data($_POST['r_owner_name']);
        $ag_retailer_comapny_phone=check_data($_POST['r_company_phone']);
        $ag_retailer_comapny_alt_phone=check_data($_POST['r_company_alt_phone']);
        $ag_retailer_company_email=check_data($_POST['r_company_email']);
        $ag_retailer_company_website=check_data($_POST['r_company_web']);
        $ag_retailer_company_gst=check_data($_POST['r_company_gst']);
        $ag_retailer_company_tin=check_data($_POST['r_company_tin']);
        $ag_retailer_contact_persone_name=check_data($_POST['r_contact_person_name']);
        $ag_retailer_contact_person_phone=check_data($_POST['r_contact_person_phone']);
        $ag_retailer_state=check_data($_POST['r_state']);
        $ag_retailer_city=check_data($_POST['r_city']);
        $ag_retailer_area=check_data($_POST['r_area']);
        $ag_retailer_house_no=check_data($_POST['r_house_no']);
        $ag_retailer_pincode=check_data($_POST['r_pincode']);
        $ag_retailer_register_date=check_data($_POST['r_register_date']);
               
        $add_data="insert into ag_retailer(ag_retailer_no,ag_retailer_code,ag_retailer_company_name,ag_retailer_owner_name,ag_retailer_comapny_phone,ag_retailer_comapny_alt_phone,ag_retailer_company_email,ag_retailer_company_website,ag_retailer_company_gst,ag_retailer_company_tin,ag_retailer_contact_persone_name,ag_retailer_contact_person_phone,ag_retailer_state,ag_retailer_city,ag_retailer_area,ag_retailer_house_no,ag_retailer_pincode,ag_retailer_register_date)
        values(:ag_retailer_no,:ag_retailer_code,:ag_retailer_company_name,:ag_retailer_owner_name,:ag_retailer_comapny_phone,:ag_retailer_comapny_alt_phone,:ag_retailer_company_email,:ag_retailer_company_website,:ag_retailer_company_gst,:ag_retailer_company_tin,:ag_retailer_contact_persone_name,:ag_retailer_contact_person_phone,:ag_retailer_state,:ag_retailer_city,:ag_retailer_area,:ag_retailer_house_no,:ag_retailer_pincode,:ag_retailer_register_date)";
        
        $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_retailer_no',$ag_retailer_no);
        $data_add->bindParam(':ag_retailer_code',$ag_retailer_code);
        $data_add->bindParam(':ag_retailer_company_name',$ag_retailer_company_name);
        $data_add->bindParam(':ag_retailer_owner_name',$ag_retailer_owner_name);
        $data_add->bindParam(':ag_retailer_comapny_phone',$ag_retailer_comapny_phone);
        $data_add->bindParam(':ag_retailer_comapny_alt_phone',$ag_retailer_comapny_alt_phone);
        $data_add->bindParam(':ag_retailer_company_email',$ag_retailer_company_email);
        $data_add->bindParam(':ag_retailer_company_website',$ag_retailer_company_website);
        $data_add->bindParam(':ag_retailer_company_gst',$ag_retailer_company_gst);
        $data_add->bindParam(':ag_retailer_company_tin',$ag_retailer_company_tin);
        $data_add->bindParam(':ag_retailer_contact_persone_name',$ag_retailer_contact_persone_name);
        $data_add->bindParam(':ag_retailer_contact_person_phone',$ag_retailer_contact_person_phone);
        $data_add->bindParam(':ag_retailer_state',$ag_retailer_state);
        $data_add->bindParam(':ag_retailer_city',$ag_retailer_city);
        $data_add->bindParam(':ag_retailer_area',$ag_retailer_area);
        $data_add->bindParam(':ag_retailer_area',$ag_retailer_area);
        $data_add->bindParam(':ag_retailer_house_no',$ag_retailer_house_no);
        $data_add->bindParam(':ag_retailer_pincode',$ag_retailer_pincode);
        $data_add->bindParam(':ag_retailer_register_date',$ag_retailer_register_date);
        
        if($data_add->execute()){
            $msg="Data Added Successfully";
        }else{
            $msg="Something Wrong!!";
        }
        echo json_encode($msg);
    }
    if(isset($_POST['get_retailer'])){
        $by_name=check_data($_POST['by_name']);
        //select pt.*,vh.ag_vehicle_model_name,bn.ag_brand_name from ag_part pt left join ag_vehicle vh on pt.ag_vehicle_no=vh.ag_vehicle_no left join ag_brand bn on bn.ag_brand_no=pt.ag_brand_no
        $retailer_get=$con->prepare("select r.*,s.ag_state_name,c.ag_city_name from ag_retailer r left join ag_state s on r.ag_retailer_state=s.ag_state_no left join ag_city c on c.ag_city_no=r.ag_retailer_city where ag_retailer_company_name like'%$by_name%' || ag_retailer_code like'%$by_name%'");
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        if($count_retailer == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_retailer=$retailer_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_retailer['ag_retailer_code']."</td> 
                        <td>".$rw_retailer['ag_retailer_company_name']."</td> 
                        <td>".$rw_retailer['ag_retailer_owner_name']."</td>
                        <td>".$rw_retailer['ag_retailer_comapny_phone']."</td>
                        <td>".$rw_retailer['ag_retailer_comapny_alt_phone']."</td>
                        <td>".$rw_retailer['ag_retailer_company_email']."</td>
                        <td>".$rw_retailer['ag_retailer_company_website']."</td>
                        <td>".$rw_retailer['ag_retailer_company_gst']."</td>
                        <td>".$rw_retailer['ag_retailer_company_tin']."</td>
                        <td>".$rw_retailer['ag_retailer_contact_persone_name']."</td>
                        <td>".$rw_retailer['ag_retailer_contact_person_phone']."</td>
                        <td>".$rw_retailer['ag_state_name']."</td>
                        <td>".$rw_retailer['ag_city_name']."</td>
                        <td>".$rw_retailer['ag_retailer_register_date']."</td>
                     
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary retailer_open' data-id='".encrypt_decrypt('encrypt', $rw_retailer['ag_retailer_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                                <div class='pop_up retailer_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['retailer_open_table'])){
        $ag_retailer_no=encrypt_decrypt('decrypt', $_POST['retailer_open_table']);
        $get_retailer="select r.*,s.ag_state_name,c.ag_city_name from ag_retailer r left join ag_state s on r.ag_retailer_state=s.ag_state_no left join ag_city c on c.ag_city_no=r.ag_retailer_city where ag_retailer_no=:ag_retailer_no";
        $retailer_get=$con->prepare($get_retailer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $retailer_get->bindParam(':ag_retailer_no',$ag_retailer_no);
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $rw_retailer=$retailer_get->fetch();
        echo"<form class='form min_width_form' id='state_up' enctype='multipart/form-data'>
                <h2>Edit ".$rw_retailer['ag_retailer_company_name']." <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                <div class='form_container'>
                    
                    <input type='hidden' name='up_retailers' value='".encrypt_decrypt('encrypt', $rw_retailer['ag_retailer_no'])."' />
                    <div class='input_container'>
                                <p>Enter Retailer Company Name</p>
                                <div class='input'>
                                    <i class='fa-solid fa-copyright'></i>
                                    <input type='text' name='r_company_name' value='".$rw_retailer['ag_retailer_company_name']."' placeholder='Company Name' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Retailer Owner Name</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='text' name='r_owner_name' value='".$rw_retailer['ag_retailer_owner_name']."' placeholder='owner Name' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Company Phone No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-phone'></i>
                                    <input type='tel' name='r_company_phone' value='".$rw_retailer['ag_retailer_comapny_phone']."' placeholder='Enter Digits Only' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Company Alternate Phone No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-phone'></i>
                                    <input type='tel' name='r_company_alt_phone' value='".$rw_retailer['ag_retailer_comapny_alt_phone']."' placeholder='Enter Digits Only' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Company Email Id</p>
                                <div class='input'>
                                    <i class='fa-solid fa-envelope'></i>
                                    <input type='email' name='r_company_email' value='".$rw_retailer['ag_retailer_company_email']."' placeholder='Enter Comapny Email' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Website Link</p>
                                <div class='input'>
                                    <i class='fa-solid fa-browser'></i>
                                    <input type='text' name='r_company_web' value='".$rw_retailer['ag_retailer_company_website']."' placeholder='Enter webisite formate'/>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Company GST No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-n'></i>
                                    <input type='text' name='r_company_gst' value='".$rw_retailer['ag_retailer_company_gst']."' placeholder='Enter GST No' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter TIN No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-n'></i>
                                    <input type='text' name='r_company_tin' value='".$rw_retailer['ag_retailer_company_tin']."' placeholder='Enter TIN no' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Contact Person Name</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='text' name='r_contact_person_name' value='".$rw_retailer['ag_retailer_contact_persone_name']."' placeholder='Enter Contact Person Name' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Contact Person Phone No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-phone'></i>
                                    <input type='tel' name='r_contact_person_phone' value='".$rw_retailer['ag_retailer_contact_person_phone']."' placeholder='Enter Contact Person Phone No' />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Select state</p>
                                <div class='input'>
                                    <i class='fa-solid fa-city'></i>
                                    <select name='r_state'>
                                    <option value='". $rw_retailer['ag_retailer_state']."'>".$rw_retailer['ag_state_name']."</option>";
                                         echo get_state(); 
                                    echo"</select>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Select City</p>
                                <div class='input'>
                                    <i class='fa-solid fa-city'></i>
                                    <select name='r_city'>
                                    <option value='". $rw_retailer['ag_retailer_city']."'>".$rw_retailer['ag_city_name']."</option>";
                                         echo get_city(); 
                                   echo" </select>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Area</p>
                                <div class='input'>
                                    <i class='fa-solid fa-city'></i>
                                    <input type='text' name='r_area' placeholder='Enter Area' value='".$rw_retailer['ag_retailer_area']."'/>
                                </div>
                            </div>
                            <input type='hidden' name='retailer_add' />
                            <div class='input_container'>
                                <p>Enter Shop No</p>
                                <div class='input'>
                                    <i class='fa-solid fa-n'></i>
                                    <input type='text' name='r_house_no' placeholder='Enter Shop No' value='".$rw_retailer['ag_retailer_house_no']."'/>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter PinCode</p>
                                <div class='input'>
                                    <i class='fa-solid fa-n'></i>
                                    <input type='text' name='r_pincode' placeholder='Enter Pin-code' value='".$rw_retailer['ag_retailer_pincode']."'/>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Registration Date</p>
                                <div class='input'>
                                    <i class='fa-solid fa-calendar-days'></i>
                                    <input type='date' name='r_register_date' placeholder='Enter Date' value='".$rw_retailer['ag_retailer_register_date']."'/>
                                </div>
                            </div><br clear='all'>
                    <center>
                        <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                        <button class='pop_up_submit retailer_up' type='submit' name='retailer_up'><i class='fa-solid fa-save'></i> Update</button>
                        <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

                        </center>
                </div>
            </form>";
    }
    if(isset($_POST['up_retailers'])){
        $ag_retailer_no=encrypt_decrypt('decrypt', check_data($_POST['up_retailers']));
        $ag_retailer_company_name=check_data($_POST['r_company_name']);
        $ag_retailer_owner_name=check_data($_POST['r_owner_name']);
        $ag_retailer_comapny_phone=check_data($_POST['r_company_phone']);
        $ag_retailer_comapny_alt_phone=check_data($_POST['r_company_alt_phone']);
        $ag_retailer_company_email=check_data($_POST['r_company_email']);
        $ag_retailer_company_website=check_data($_POST['r_company_web']);
        $ag_retailer_company_gst=check_data($_POST['r_company_gst']);
        $ag_retailer_company_tin=check_data($_POST['r_company_tin']);
        $ag_retailer_contact_persone_name=check_data($_POST['r_contact_person_name']);
        $ag_retailer_contact_person_phone=check_data($_POST['r_contact_person_phone']);
        $ag_retailer_state=check_data($_POST['r_state']);
        $ag_retailer_city=check_data($_POST['r_city']);
        $ag_retailer_area=check_data($_POST['r_area']);
        $ag_retailer_house_no=check_data($_POST['r_house_no']);
        $ag_retailer_pincode=check_data($_POST['r_pincode']);
        $ag_retailer_register_date=check_data($_POST['r_register_date']);
        
        $up_retailer="update ag_retailer set ag_retailer_company_name=:ag_retailer_company_name,ag_retailer_owner_name=:ag_retailer_owner_name,ag_retailer_comapny_phone=:ag_retailer_comapny_phone,ag_retailer_comapny_alt_phone=:ag_retailer_comapny_alt_phone,ag_retailer_company_email=:ag_retailer_company_email,ag_retailer_company_website=:ag_retailer_company_website,ag_retailer_company_gst=:ag_retailer_company_gst,ag_retailer_company_tin=:ag_retailer_company_tin,ag_retailer_contact_persone_name=:ag_retailer_contact_persone_name,ag_retailer_contact_person_phone=:ag_retailer_contact_person_phone,ag_retailer_state=:ag_retailer_state,ag_retailer_city=:ag_retailer_city,ag_retailer_area=:ag_retailer_area,ag_retailer_house_no=:ag_retailer_house_no,ag_retailer_pincode=:ag_retailer_pincode,ag_retailer_register_date=:ag_retailer_register_date where ag_retailer_no=:ag_retailer_no";
        $retailer_up=$con->prepare($up_retailer);
        $retailer_up->bindParam(':ag_retailer_no',$ag_retailer_no);
        $retailer_up->bindParam(':ag_retailer_company_name',$ag_retailer_company_name);
        $retailer_up->bindParam(':ag_retailer_owner_name',$ag_retailer_owner_name);
        $retailer_up->bindParam(':ag_retailer_comapny_phone',$ag_retailer_comapny_phone);
        $retailer_up->bindParam(':ag_retailer_comapny_alt_phone',$ag_retailer_comapny_alt_phone);
        $retailer_up->bindParam(':ag_retailer_company_email',$ag_retailer_company_email);
        $retailer_up->bindParam(':ag_retailer_company_website',$ag_retailer_company_website);
        $retailer_up->bindParam(':ag_retailer_company_gst',$ag_retailer_company_gst);
        $retailer_up->bindParam(':ag_retailer_company_tin',$ag_retailer_company_tin);
        $retailer_up->bindParam(':ag_retailer_contact_persone_name',$ag_retailer_contact_persone_name);
        $retailer_up->bindParam(':ag_retailer_contact_person_phone',$ag_retailer_contact_person_phone);
        $retailer_up->bindParam(':ag_retailer_state',$ag_retailer_state);
        $retailer_up->bindParam(':ag_retailer_city',$ag_retailer_city);
        $retailer_up->bindParam(':ag_retailer_area',$ag_retailer_area);
        $retailer_up->bindParam(':ag_retailer_house_no',$ag_retailer_house_no);
        $retailer_up->bindParam(':ag_retailer_pincode',$ag_retailer_pincode);
        $retailer_up->bindParam(':ag_retailer_register_date',$ag_retailer_register_date);
        if($retailer_up->execute()){
            $msg="Data Updated Succeessfully";
            echo json_encode($msg);
        }else{
            $msg="Something went wrong";
            echo json_encode($msg);
        }
    }
?>