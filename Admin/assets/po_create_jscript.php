<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_po_part'])){
        $pos_search=check_data($_POST['pos_search']);
        $by_brand=check_data($_POST['by_brand']);
        $by_model=check_data($_POST['by_model']);
        if($by_brand==""){
            $vehicle="";
        }else{
            $vehicle=" and ag_brand_no='$by_brand' and ag_vehicle_no='$by_model'";
        }
        $gstr=$_POST['get_po_part'];
        $rstr='Get PO Parts';
       
        if($gstr == $rstr){
            $gtinv="select * from ag_part where ag_part_name like'%$pos_search%' or ag_part_code like'%$pos_search%' or ag_part_cat like'%$pos_search%'";
            $invgt=$con->prepare($gtinv,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $invgt->setFetchMode(PDO::FETCH_ASSOC);
            $invgt->execute();
            $item_count=$invgt->rowCount();
            if($item_count == 0){
                echo"<tr><td colspan='3'>No Items Found</td></tr>";
            }else{
                $i=1;
                while($rwinv=$invgt->fetch()):
                    $ag_part_id=$rwinv['ag_part_id'];

                    $get_repo="select * from ag_part_repo where ag_part_id='$ag_part_id'$vehicle";
                    $repo_get=$con->prepare($get_repo,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $repo_get->setFetchMode(PDO::FETCH_ASSOC);
                    $repo_get->execute();
                    $count_part=$repo_get->rowCount();

                    $i_no=$rwinv['ag_part_no'];
                    $i_name=$rwinv['ag_part_name'];
                    echo"<tr>
                            <td>".$i++."</td>
                            <td>".$rwinv['ag_part_code']."</td>
                            <td style='text-align:left; min-width:250px; cursor:pointer' class='pos_item' data-pos='".encrypt_decrypt('encrypt', $i_no)."' data-brand='".$rwinv['ag_brand_no']."' data-vehicle='".$rwinv['ag_vehicle_no']."' data-part='".$rwinv['ag_part_name']."'>".$rwinv['ag_part_name']."</td>
                            <td style='min-width:150px;'>
                                <details class='details_open' style='display:inline-block'>
                                    <summary class='pop_up_open pop_up_summary po_part_brand_model_open' data-id='".encrypt_decrypt('encrypt', $rwinv['ag_part_id'])."' style='text-align:center'><i class='fa-solid fa-pen-to-square'></i> $count_part</summary>
                                    <div class='pop_up'>
                                        <div class='form min_width_form'>
                                            <h2>".$rwinv['ag_part_name']." Brands & Models <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                                            <div class='form_container'>
                                                <div class='table_container po_part_brand_model_table'></div>
                                            </div>
                                        </div>
                                    </div>
                                </details>
                            </td>
                            <td style='text-align:left'>".$rwinv['ag_part_cat']."</td>
                        </tr>";
                endwhile;
            }
        }
    }
    if(isset($_POST['po_part_brand_model_open'])){
        $ag_part_id=encrypt_decrypt('decrypt', $_POST['po_part_brand_model_open']);
        $get_brand="select pr.*,bn.ag_brand_name,vh.ag_vehicle_model_name,vh.ag_vehicle_mg_year from ag_part_repo pr left join ag_brand bn on pr.ag_brand_no=bn.ag_brand_no left join ag_vehicle vh on pr.ag_vehicle_no=vh.ag_vehicle_no where pr.ag_part_id='$ag_part_id'";
        $brand_get=$con->prepare($get_brand);
        $brand_get->setFetchMode(PDO::FETCH_ASSOC);
        $brand_get->execute();
        $count_brand=$brand_get->rowCount();
        $j=1;
       
        echo"<table class='item_table' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Brand Name</th>
                        <th>Model Name</th>
                    </tr>
                </thead>
                <tbody>";
        while($rw_brand=$brand_get->fetch()):
            $part_id=$rw_brand['ag_part_repo_id'];
            $i_status=$rw_brand['ag_part_repo_status'];
            if($i_status == 1){
                $checked='checked';
                $status='Active';
            }else{
                $checked='';
                $status='InActive';
            }
            echo"<tr>
                    <td>".$j++."</td>
                    <td>".$rw_brand['ag_brand_name']."</td>
                    <td>".$rw_brand['ag_vehicle_model_name']." (".$rw_brand['ag_vehicle_mg_year'].")</td>
                </tr>";
        endwhile;
        echo"</tbody>
        </table>";
    }
    if(isset($_POST['pos_add'])){
        $ag_po_status=0;
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['pos_add']);
        $ag_part_name=$_POST['pos_part_name'];

        $chsl="select * from ag_po_cart where ag_part_no=:ag_part_no and ag_po_status=:ag_po_status";
        $slch=$con->prepare($chsl,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $slch->bindParam(':ag_part_no',$ag_part_no);
        $slch->bindParam(':ag_po_status',$ag_po_status);
        $slch->setFetchMode(PDO::FETCH_ASSOC);
        $slch->execute();
        $cnslch=$slch->rowCount();
        $ag_po_qty=1;
        $ag_po_price=0; //need to change;
        
        $get_part="select pr.ag_part_no,c.ag_mg_company_name from ag_part pr left join ag_mg_company c on pr.ag_part_company=c.ag_mg_company_no where pr.ag_part_no='$ag_part_no' ";
        $part_get=$con->prepare($get_part);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        $ag_part_company=$rw_part['ag_mg_company_name'];

        if($cnslch == 1){
            $rwslch=$slch->fetch();
            $ag_po_cart_id=$rwslch['ag_po_cart_id'];
            $upsl="update ag_po_cart set ag_po_qty=ag_po_qty+1 where ag_po_cart_id=:ag_po_cart_id";
            $slup=$con->prepare($upsl,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $slup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
            $slup->execute();
        }
        else{
            $get_in="select ag_po_invoice_no from ag_po_cart where ag_po_status=:ag_po_status";
            $in_get=$con->prepare($get_in,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $in_get->bindParam(':ag_po_status',$ag_po_status);
            $in_get->setFetchMode(PDO::FETCH_ASSOC);
            $in_get->execute();
            $count_in=$in_get->rowCount();
            if($count_in > 0){
                $rw_in=$in_get->fetch();
                $ag_po_invoice_no=$rw_in['ag_po_invoice_no'];
            }else{
                $ag_po_invoice_no=substr(mt_rand(),0,10);
            }
            $discount=0;
            $tax=0;
            $ag_retailer_no=0; //need to change
            $ag_po_part_no=0;
            $ag_po_date=date('Y-m-d');
            $sladd="insert into ag_po_cart(ag_retailer_no,ag_po_invoice_no,ag_part_no,ag_part_name,ag_mg_company_name,ag_po_qty,ag_po_price,ag_po_discount,ag_po_tax,ag_po_date,ag_po_status)values(:ag_retailer_no,:ag_po_invoice_no,:ag_part_no,:ag_part_name,:ag_mg_company_name,:ag_po_qty,:ag_po_price,:ag_po_discount,:ag_po_tax,:ag_po_date,:ag_po_status)";
            $addsl=$con->prepare($sladd,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $addsl->bindParam(':ag_retailer_no',$ag_retailer_no);
            $addsl->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
            $addsl->bindParam(':ag_mg_company_name',$ag_part_company);
            $addsl->bindParam(':ag_part_no',$ag_part_no);
            $addsl->bindParam(':ag_part_name',$ag_part_name);
            $addsl->bindParam(':ag_po_qty',$ag_po_qty);
            $addsl->bindParam(':ag_po_price',$ag_po_price);
            $addsl->bindParam(':ag_po_discount',$discount);
            $addsl->bindParam(':ag_po_tax',$tax);
            $addsl->bindParam(':ag_po_date',$ag_po_date);
            $addsl->bindParam(':ag_po_status',$ag_po_status);
            $addsl->execute();
        }
    }
    if(isset($_POST['get_pos_items'])){
        $ag_po_status=0;

        $gtsl="select * from ag_po_cart where ag_po_status=:ag_po_status";
        $slgt=$con->prepare($gtsl,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $slgt->bindParam(':ag_po_status',$ag_po_status);
        $slgt->setFetchMode(PDO::FETCH_ASSOC);
        $slgt->execute();
        $cnslgt=$slgt->rowCount();
        if($cnslgt == 0){}else{
            echo"<table cellspacing='0' class='item_table'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Part Name</th>
                            <th>Alert Qty</th>
                            <th>Purchase Qty</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Discount %</th>
                            <th>Tax %</th>
                            <th style='text-align:right'>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>";
            $i=1; $stotal=0; $total_discount=0; $total_tax=0;
            while($rwsl=$slgt->fetch()):
                $ag_part_no=$rwsl['ag_part_no'];
                $befor_tax=($rwsl['ag_po_price']*$rwsl['ag_po_qty'])-(($rwsl['ag_po_price']*$rwsl['ag_po_qty'])*$rwsl['ag_po_discount'])/100;
                $discount_amt=(($rwsl['ag_po_price']*$rwsl['ag_po_qty'])*$rwsl['ag_po_discount'])/100;
                $after_tax=$befor_tax+($befor_tax*$rwsl['ag_po_tax']/100);
                $subtotal=$after_tax;
                $get_part="select * from ag_part where ag_part_no=:ag_part_no";
                $part_get=$con->prepare($get_part);
                $part_get->bindParam(':ag_part_no',$ag_part_no);
                $part_get->setFetchMode(PDO::FETCH_ASSOC);
                $part_get->execute();
                echo"<tr style='border-bottom:1px solid #17202A'>
                        <td><h5 class='sale_remove' id='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' style='color:#DC143C; font-weight:600; font-size:14px; cursor:pointer' title='Remove'><i class='fas fa-trash-alt' id='print_hidden'></i> <span style='color:#000'>".$i++."</span></h5></td>
                        <td style='width:250px'>".$rwsl['ag_part_name']."</td>
                        <td><input style='width:100px' class='pos_alert_qty' type='number' title='Alert Quantity' /></td>
                        <td><input style='width:100px' class='pos_qty' type='number' step='.01' value='".$rwsl['ag_po_qty']."' data-pos-qty='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."'  data-part-qty='".encrypt_decrypt('encrypt', $rwsl['ag_part_no'])."' title='Item Quantity' /></td>
                        <td><input style='width:100px' type='text' class='pos_price' value='".number_format($rwsl['ag_po_price'],2)."' data-pos-price='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' title='Item Price' /></td>
                        <td><input style='width:100px' type='text' class='pos_sale_price' title='Part Sale Price' data-part-sell-price='".encrypt_decrypt('encrypt', $rwsl['ag_part_no'])."'/></td>
                        <td><input style='width:100px' type='number' class='pos_discount' value='".$rwsl['ag_po_discount']."' data-pos-discount='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' title='Sell Price' /></td>
                        <td><input style='width:100px' type='number' class='pos_tax' value='".$rwsl['ag_po_tax']."' data-pos-tax='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' title='Item Tax' /></td>
                        <td style='text-align:right; border-right:1px solid #000 !important'>".number_format($subtotal,2)."</td>
                    </tr>";
                $stotal+=$subtotal;
                $total_discount+=(($rwsl['ag_po_price']*$rwsl['ag_po_qty'])*$rwsl['ag_po_discount'])/100;
                $total_tax+=$befor_tax*$rwsl['ag_po_tax']/100;
            endwhile;
            echo"<tr>
                    <td colspan='9' style='text-align:right'><br />
                        Gross Total: <span id='grand_total'>".number_format($stotal,2)."</span><br /><br />
                    </td>
                </tr>";
            echo"</tbody>
            </table>
            <form id='save_pos' enctype='multipart/form-data'>
                <div class='payment_container'>
                    <center><h4>Payment Mode</h4></center>
                        <select name='retailer' class='search_input retailer'>
                            <option value=''>Select Retailer</option>";
                            echo get_retailer(); 
                        echo"</select>
                        <select name='payment_mode' class='search_input po_py_mode'>
                            <option value='full'>Full Payment</option>
                            <option value='partly'>Partly Payment</option>
                            <option value='pending'>Pending Payment</option>
                        </select>
                        <select name='payment_type' class='search_input po_py_type'>
                            <option value='cash'>Cash</option>
                            <option value='online'>Online</option>
                            <option value='cheque'>Cheque</option>
                        </select>
                        <input type='hidden' class='pos_save' value='$cnslgt' name='pos_save'/>
                        <input type ='text' class='search_input po_rec_no' name='receipt_no' placeholder='Enter Receipt No'>  
                        <input type ='text' class='search_input po_amt_paid' name='amount_paid' placeholder='Enter Amount Paid'>  
                        <input type ='text' class='search_input po_inv_date' name='po_inv_date' onfocus=\"this.type='date'\" onblur=\"this.type='text'\" placeholder='Enter Invoice Date'>  
                        <input type ='text' class='search_input po_inv_due_date' name='po_inv_due_date' onfocus=\"this.type='date'\" onblur=\"this.type='text'\" placeholder='Enter Invoice Due Date'>  
                        <input type ='file' class='search_input po_rcp_img' name='po_rcp_img' placeholder='Select Receipt Image'>  
                        
                </div><br /><br />
                <center><button class='save_pos pop_up_submit' type='submit'>Save</button></center>
            </form>";
        }
    }
    if(isset($_POST['pos_qty'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_qty']);
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['data_part_qty']);
        $ag_po_qty=$_POST['pos_qty'];
      
        $upqty="update ag_part set ag_part_qty=:ag_po_qty where ag_part_no=:ag_part_no";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_qty',$ag_po_qty);
        $qtyup->bindParam(':ag_part_no',$ag_part_no);
        $qtyup->execute();

        $upqty="update ag_po_cart set ag_po_qty=:ag_po_qty where ag_po_cart_id=:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_qty',$ag_po_qty);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
        
    }
    if(isset($_POST['pos_sale_price'])){
       // $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_qty']);
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['data_part_sell']);
        $ag_part_selling_price=$_POST['pos_sale_price'];
      
        $upqty="update ag_part set ag_part_selling_price=:ag_part_selling_price where ag_part_no=:ag_part_no";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_part_selling_price',$ag_part_selling_price);
        $qtyup->bindParam(':ag_part_no',$ag_part_no);
        $qtyup->execute();

    }
    if(isset($_POST['pos_discount'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_discount']);
        $ag_po_discount=$_POST['pos_discount'];

        $upqty="update ag_po_cart set ag_po_discount=:ag_po_discount where ag_po_cart_id=:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_discount',$ag_po_discount);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
    }
    if(isset($_POST['pos_tax'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_tax']);
        $ag_po_tax=$_POST['pos_tax'];

        $upqty="update ag_po_cart set ag_po_tax=:ag_po_tax where ag_po_cart_id=:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_tax',$ag_po_tax);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
    }
    if(isset($_POST['pos_save'])){
        $ag_retailer_no=$_POST['retailer'];
        $ag_no_of_items=$_POST['pos_save'];
        $ag_po_status=1;
        $ag_po_payment_mode=$_POST['payment_mode'];
        if($ag_po_payment_mode == "full"){
            $ag_po_payment_mode=1;
        }elseif($ag_po_payment_mode == "partly"){
            $ag_po_payment_mode=2;
        }else{
            $ag_po_payment_mode=3;
        }
        $ag_po_payment_type=$_POST['payment_type'];
        if($ag_po_payment_type == "cash"){
            $ag_po_payment_type=1;
        }elseif($ag_po_payment_type == "online"){
            $ag_po_payment_type=2;
        }else{
            $ag_po_payment_type=3;
        }
        $ag_po_receipt_no=$_POST['receipt_no'];
        $ag_po_amount_paid=$_POST['amount_paid'];
        $ag_po_invoice_date=$_POST['po_inv_date'];
        $ag_po_invoice_due_date=$_POST['po_inv_due_date'];
        $ag_po_receipt_img=$_FILES['po_rcp_img']['tmp_name'];
               
        if($ag_retailer_no == ''){
            $msg="Please Select Retailer Name";
        }else{
            $check_po="select * from ag_po_cart where ag_po_status=0 and (ag_po_qty=0 or ag_po_qty='' or ag_po_price=0 or ag_po_price='')";
            $po_check=$con->prepare($check_po);
            $po_check->setFetchMode(PDO::FETCH_ASSOC);
            $po_check->execute();
            $count_po=$po_check->rowCount();
            if($count_po>0){ 
                $msg="Please Add Purchase Price or Quantity For All Parts";
            }else{
                $get_retailer="select ag_retailer_company_name from ag_retailer where ag_retailer_no=$ag_retailer_no ";
                $retailer_get=$con->prepare($get_retailer);
                $retailer_get->setFetchMode(PDO::FETCH_ASSOC);
                $retailer_get->execute();
                $rw_retailer=$retailer_get->fetch();
                $ag_retailer_company_name=$rw_retailer['ag_retailer_company_name'];
               
                $check_po="select * from ag_po_cart where ag_po_status=0";
                $po_check=$con->prepare($check_po);
                $po_check->setFetchMode(PDO::FETCH_ASSOC);
                $po_check->execute();
                $rw_in=$po_check->fetch();
                $ag_po_invoice_no=$rw_in['ag_po_invoice_no'];
                $ag_po_cart_repo_status=1;          

                $up_pos="update ag_po_cart set ag_retailer_no=:ag_retailer_no,ag_po_status=:ag_po_status where ag_po_status=0";
                $pos_up=$con->prepare($up_pos,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $pos_up->bindParam(':ag_retailer_no',$ag_retailer_no);
                $pos_up->bindParam(':ag_po_status',$ag_po_status);
                if($pos_up->execute()){
                    //$msg="PO Has Been Saved Successfully";
                    $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";     
                    $add_data="insert into ag_po_cart_repo(ag_po_invoice_no,ag_retailer_name,ag_po_payment_mode,ag_po_payment_type,ag_po_receipt_no,ag_po_amount_paid,ag_po_invoice_date,ag_po_invoice_due_date,ag_po_receipt_img,ag_no_of_items,ag_po_cart_repo_status)values(:ag_po_invoice_no,:ag_retailer_name,:ag_po_payment_mode,:ag_po_payment_type,:ag_po_receipt_no,:ag_po_amount_paid,:ag_po_invoice_date,:ag_po_invoice_due_date,:ag_po_receipt_img,:ag_no_of_items,:ag_po_cart_repo_status)";
                    $add_data=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $add_data->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
                    $add_data->bindParam(':ag_retailer_name',$ag_retailer_company_name);
                    $add_data->bindParam(':ag_po_payment_mode',$ag_po_payment_mode);
                    $add_data->bindParam(':ag_po_payment_type',$ag_po_payment_type);
                    $add_data->bindParam(':ag_po_receipt_no',$ag_po_receipt_no);
                    $add_data->bindParam(':ag_po_amount_paid',$ag_po_amount_paid);
                    $add_data->bindParam(':ag_po_invoice_date',$ag_po_invoice_date);
                    $add_data->bindParam(':ag_po_invoice_due_date',$ag_po_invoice_due_date);
                    $add_data->bindParam(':ag_po_receipt_img',$invimg);
                    $add_data->bindParam(':ag_no_of_items',$ag_no_of_items);
                    $add_data->bindParam(':ag_po_cart_repo_status',$ag_po_cart_repo_status);
                    if($add_data->execute()){
                        $path="../images/po_receipt/$invimg";
                        move_uploaded_file($_FILES['po_rcp_img']['tmp_name'],$path);
                        $msg="PO Has Been Saved Successfully";
                    }
                    else{
                        $msg="Something Went Wrong Please Try Again";
                    }
            }else{
                $msg="Something Went Wrong Please Try Again"; 
            }
            }
        }
       echo json_encode($msg);
    }
    if(isset($_POST['pos_price'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_price']);;
        $ag_po_price=$_POST['pos_price'];

        $upqty="update ag_po_cart set ag_po_price=:ag_po_price where ag_po_cart_id =:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_price',$ag_po_price);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
    }
    if(isset($_POST['change_search_brand'])) {
        $ag_brand_no = $_POST['change_search_brand'];
        $get_model="select * from ag_vehicle where ag_brand_no='$ag_brand_no'";
        $model_get=$con->prepare($get_model);
        $model_get->setFetchMode(PDO::FETCH_ASSOC);
        $model_get->execute();
        while($rw_model=$model_get->fetch()):
            echo"<option value='".$rw_model['ag_vehicle_no']."'>".$rw_model['ag_vehicle_model_name'].".(".$rw_model['ag_vehicle_mg_year'].")</option>";
        endwhile;
    }
    /*if(isset($_POST['pos_price'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_price']);;
        $part=explode('-',$_POST['part_no']);
        $part_no=$part[0];
        $ag_po_cart_id=$part[1];

        $upqty="update ag_po_cart set ag_po_price=:ag_po_price where ag_po_cart_id =:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_price',$ag_po_price);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
    }*/
?>