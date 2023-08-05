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
                     
                        <td style='text-align:center'>";
                        if($rw_retailer['ag_retailer_pending_amt']==0){
                            echo"--";
                        }else{
                            echo"<details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary'>".$rw_retailer['ag_retailer_pending_amt']."</summary>
                                <div class='pop_up'>
                                    <form class='form small_width_form' id='add_pending_amount'>
                                        <h2>Pay Remaining Amount <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                                        <div class='form_container'>
                                            <div class='input_container'>
                                                <p>Enter Amount You Want to Pay.</p>
                                                <div class='input'>
                                                    <i class='fa-solid fa-copyright'></i>
                                                    <input type='text' name='pending_amount' value='".$rw_retailer['ag_retailer_pending_amt']."' max='".$rw_retailer['ag_retailer_pending_amt']."' required>
                                                </div> 
                                                <div class='input'>
                                                <i class='fa-solid fa-copyright'></i>   
                                                    <input type='date' name='pay_date' required>
                                                </div>
                                                <div class='input'>
                                                <i class='fa-solid fa-copyright'></i>
                                                    <select name='pay_type'>
                                                        <option value=cash'>Cash</option>
                                                        <option value=online'>Online</option>
                                                        <option value=cheque'>Cheque</option>
                                                    </select>
                                                </div>
                                                    <input type='hidden' name='pending_amount_add' value='".$rw_retailer['ag_retailer_no']."' />
                                                </div>
                                            </div>
                                            <center>
                                                <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> RESET</button>
                                                <button class='pop_up_submit add_pending_amount' type='submit' name='add_payment'><i class='fa-solid fa-save'></i> ADD</button>
                                                <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> CANCEL</button>
                                            </center>
                                            <div class='table_container'>
                                            <table class='item_table big_table' cellspacing='0'>
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Pay Date</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount To Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                            $get_data = "select * from ag_retailer_credit";
                                            $data_get = $con->prepare($get_data, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                            $data_get->setFetchMode(PDO::FETCH_ASSOC);
                                            $data_get->execute();
                                            $j=1;
                                            while($rw_data=$data_get->fetch()):
                                                if($rw_data['ag_pay_type'] == 1){
                                                    $ag_pay_type="Cash";
                                                }elseif($rw_data['ag_pay_type'] == 2){
                                                    $ag_pay_type="Online";
                                                }else{
                                                    $ag_pay_type="Cheque";
                                                }
                                            echo"<tr>
                                                    <td>".$j++."</td>
                                                    <td>".$rw_data['ag_pay_date']."</td>
                                                    <td>$ag_pay_type</td>
                                                    <td>".$rw_data['ag_pay_amt']."</td>
                                                </tr>";
                                            endwhile;
                                           
                                           echo"</tbody>
                                    </table>
                                       
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </details>";
                        }
                        echo"</td>
                        <td style='text-align:center'>
                        <details class='details_open' style='display:inline-block'>
                            <summary class='pop_up_open pop_up_summary retailer_open' data-id='".encrypt_decrypt('encrypt', $rw_retailer['ag_retailer_no'])."'><i class='fa-solid fa-pen-to-square'></i> Edit</summary>
                            <div class='pop_up retailer_open_table'></div>
                        </details>
                    </td>
                    <td style='text-align:center'>
                        <details class='details_open' style='display:inline-block'>
                            <summary class='pop_up_open pop_up_summary retailer_history_open' data-id='".encrypt_decrypt('encrypt', $rw_retailer['ag_retailer_no'])."'><i class='fa-solid fa-eye'></i> View</summary>
                            <div class='pop_up'>
                            <div class='form min_width_form'>
                                        <h2>".$rw_retailer['ag_retailer_company_name']." History <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                                        <div class='form_container'>
                                        <div class='table_container retailer_history_table'></div>
                                        </div>
                                    </div></div>
                        </details>
                    </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['pending_amount_add'])){
        $ag_retailer_no=$_POST['pending_amount_add'];
        $ag_rc_no=substr(mt_rand(),0,10);
        $ag_retailer_pending_amt=$_POST['pending_amount'];
        $ag_pay_date=$_POST['pay_date'];
        $ag_pay_type=$_POST['pay_type'];
        if($ag_pay_type == "cash"){
            $ag_pay_type=1;
        }elseif($ag_pay_type == "online"){
            $ag_pay_type=2;
        }else{
            $ag_pay_type=3;
        }
        $amount_get=$con->prepare("select * from ag_retailer where ag_retailer_no='$ag_retailer_no'");
        $amount_get->setFetchMode(PDO::FETCH_ASSOC);
        $amount_get->execute();
        $rw_amount=$amount_get->fetch();
        $ac_retailer_amount=$rw_amount['ag_retailer_pending_amt'];
        if($ag_retailer_pending_amt > $ac_retailer_amount){
            $msg="Return Amount Should Be Less Than $ac_retailer_amount";
        }else{
            $up_amount=$ac_retailer_amount-$ag_retailer_pending_amt;
            $up_retailer=$con->prepare("update ag_retailer set ag_retailer_pending_amt='$up_amount' where ag_retailer_no='$ag_retailer_no'");
            if($up_retailer->execute()){
                $add_data='insert into ag_retailer_credit(ag_rc_no,ag_retailer_no,ag_pay_amt,ag_pay_date,ag_pay_type)
                values(:ag_rc_no,:ag_retailer_no,:ag_pay_amt,:ag_pay_date,:ag_pay_type)';
                $data_add=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $data_add->bindParam(':ag_rc_no',$ag_rc_no);
                $data_add->bindParam(':ag_retailer_no',$ag_retailer_no);
                $data_add->bindParam(':ag_pay_amt',$ag_retailer_pending_amt);
                $data_add->bindParam(':ag_pay_date',$ag_pay_date);
                $data_add->bindParam(':ag_pay_type',$ag_pay_type);
                $data_add->execute();
                $msg="Return Remaining Amount Successfully";
            }else{
                $msg="Something Went Wrong Please Try Again Later";
            }
        }
        echo json_encode($msg);
    }
    if(isset($_POST['retailer_open_table'])){
        $ag_retailer_no=encrypt_decrypt('decrypt', $_POST['retailer_open_table']);
        $get_retailer="select r.*,s.ag_state_name,c.ag_city_name from ag_retailer r left join ag_state s on r.ag_retailer_state=s.ag_state_no left join ag_city c on c.ag_city_no=r.ag_retailer_city where ag_retailer_no=:ag_retailer_no";
        $retailer_get=$con->prepare($get_retailer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $retailer_get->bindParam(':ag_retailer_no',$ag_retailer_no);
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $rw_retailer=$retailer_get->fetch();
        echo"<form class='form min_width_form' id='retailer_up' enctype='multipart/form-data'>
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
                            <select name='r_state' class='r_state'>
                            <option value='". $rw_retailer['ag_retailer_state']."'>".$rw_retailer['ag_state_name']."</option>";
                                    echo get_state(); 
                            echo"</select>
                        </div>
                    </div>
                    <div class='input_container'>
                        <p>Select City</p>
                        <div class='input'>
                            <i class='fa-solid fa-city'></i>
                            <select name='r_city' class='r_city'>
                                <option value='". $rw_retailer['ag_retailer_city']."'>".$rw_retailer['ag_city_name']."</option>";
                            echo"</select>
                        </div>
                    </div>
                    <div class='input_container'>
                        <p>Enter Area</p>
                        <div class='input'>
                            <i class='fa-solid fa-city'></i>
                            <input type='text' name='r_area' placeholder='Enter Area' value='".$rw_retailer['ag_retailer_area']."'/>
                        </div>
                    </div>
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
    if(isset($_POST['change_state'])){
        $ag_state_no=$_POST['change_state'];
        $get_city="select * from ag_city where ag_state_no=:ag_state_no";
        $city_get=$con->prepare($get_city);
        $city_get->bindParam(':ag_state_no',$ag_state_no);
        $city_get->execute();
        while($rw_city=$city_get->fetch()):
            echo"<option value='".$rw_city['ag_city_no']."'>".$rw_city['ag_city_name']."</option>";
        endwhile;
    }
    if(isset($_POST['retailer_history_table'])){
        $ag_retailer_no=encrypt_decrypt('decrypt', $_POST['retailer_history_table']);
        $get_retailer="select * from ag_po_cart_repo where ag_retailer_no=:ag_retailer_no";
        $retailer_get=$con->prepare($get_retailer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $retailer_get->bindParam(':ag_retailer_no',$ag_retailer_no);
        $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
        $retailer_get->execute();
        $count_retailer=$retailer_get->rowCount();
        
            echo"<table class='item_table big_table' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Invoice No</th>
                                <th>Payment Type</th>
                                <th>Amount To Paid</th>
                                <th>Remaing To Pay</th>
                                <th>We Paid</th>
                                <th>Invoice Date</th>
                                <th>Invoice Due Date</th>
                            </tr>
                        </thead>
                        <tbody>";
                            if($count_retailer == 0){
                                echo"<tr><td>No Records Found</td></tr>";
                            }else{$i=1;
                                while($rw_retailer=$retailer_get->fetch()):
                            echo"<tr>
                                <td>".$i++."</td>
                                <td>".$rw_retailer['ag_po_invoice_no']."</td>
                                <td>".$rw_retailer['ag_po_payment_type']."</td>
                                <td>".$rw_retailer['ag_po_amount_paid']."</td>
                                <td>".$rw_retailer['ag_po_pending_amt']."</td>
                                <td>".$rw_retailer['ag_po_cust_pay']."</td>
                                <td>".$rw_retailer['ag_po_invoice_date']."</td>
                                <td>".$rw_retailer['ag_po_invoice_due_date']."</td>
                            </tr>";
                        endwhile;
                        }
                       echo"</tbody>
                </table>";
                   
    }
?>