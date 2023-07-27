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
                echo"<li><td colspan='3'>No Items Found</td></li>";
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
                    echo"
                        <li class='sale_item_add' data-id='$i_no'>
                            <img src= 'images/part/".$rwinv['ag_part_img']."' />
                            <p>".$rwinv['ag_part_code']."</p>
                            <p>".$rwinv['ag_part_name']."</p>
                            <p>Quantity: ".$rwinv['ag_part_qty']."</p>
                            <p>Price: ".$rwinv['ag_part_selling_price']."</p>
                        </li>
                        ";
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
    if(isset($_POST['so_add'])){
        $ag_po_status=0;
        $ag_part_no= $_POST['so_add'];
        $ag_sells_invoice_no=substr(mt_rand(),0,10);
        $ag_mg_company_name="abc";
        $ag_sells_qty=1;
        $ag_sells_discount=0;
        $ag_sells_tax=0;
        $ag_sells_date=date('Y-m-d');
        $ag_sells_status=0;
        $get_part="select * from ag_part where ag_part_no=$ag_part_no";
        $part_get=$con->prepare($get_part);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        $ag_mg_company_name=$rw_part['ag_part_company'];
        $ag_part_name=$rw_part['ag_part_name'];
        $ag_sells_price=$rw_part['ag_part_selling_price'];
        $ag_sells_purchase_price=$rw_part['ag_part_purchase_price'];

        $data_add="insert into ag_sells_order_cart(ag_sells_invoice_no,ag_part_no,ag_part_name,ag_mg_company_name,ag_sells_qty,ag_sells_price,ag_sells_purchase_price,ag_sells_discount,ag_sells_tax,ag_sells_date,ag_sells_status)
        values(:ag_sells_invoice_no,:ag_part_no,:ag_part_name,:ag_mg_company_name,:ag_sells_qty,:ag_sells_price,:ag_sells_purchase_price,:ag_sells_discount,:ag_sells_tax,:ag_sells_date,:ag_sells_status)";
        $add_data=$con->prepare($data_add,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $add_data->bindParam(':ag_sells_invoice_no',$ag_sells_invoice_no);
        $add_data->bindParam(':ag_part_no',$ag_part_no);
        $add_data->bindParam(':ag_part_name',$ag_part_name);
        $add_data->bindParam(':ag_mg_company_name',$ag_mg_company_name);
        $add_data->bindParam(':ag_sells_qty',$ag_sells_qty);
        $add_data->bindParam(':ag_sells_price',$ag_sells_price);
        $add_data->bindParam(':ag_sells_purchase_price',$ag_sells_purchase_price);
        $add_data->bindParam(':ag_sells_discount',$ag_sells_discount);
        $add_data->bindParam(':ag_sells_tax',$ag_sells_tax);
        $add_data->bindParam(':ag_sells_date',$ag_sells_date);
        $add_data->bindParam(':ag_sells_status',$ag_sells_status);
       $add_data->execute();
     }
    if(isset($_POST['get_pos_items'])){
        $ag_sells_status=0;
        $gtsl="select * from ag_sells_order_cart where ag_sells_status=:ag_sells_status";
        $slgt=$con->prepare($gtsl,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $slgt->bindParam(':ag_sells_status',$ag_sells_status);
        $slgt->setFetchMode(PDO::FETCH_ASSOC);
        $slgt->execute();
        $cnslgt=$slgt->rowCount();
        if($cnslgt == 0){}else{
            echo"<form id='save_pos' enctype='multipart/form-data'>
            <table cellspacing='0' class='item_table'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Part Name</th>
                            <th>Sell Qty</th>
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
                $befor_tax=($rwsl['ag_sells_price']*$rwsl['ag_sells_qty'])-(($rwsl['ag_sells_price']*$rwsl['ag_sells_qty'])*$rwsl['ag_sells_discount'])/100;
                $discount_amt=(($rwsl['ag_sells_price']*$rwsl['ag_sells_qty'])*$rwsl['ag_sells_discount'])/100;
                $after_tax=$befor_tax+($befor_tax*$rwsl['ag_sells_tax']/100);
                $subtotal=$after_tax;
                $get_part="select * from ag_part where ag_part_no=:ag_part_no";
                $part_get=$con->prepare($get_part);
                $part_get->bindParam(':ag_part_no',$ag_part_no);
                $part_get->setFetchMode(PDO::FETCH_ASSOC);
                $part_get->execute();
                echo"<tr style='border-bottom:1px solid #17202A'>
                        <td><h5 class='sale_remove' id='".encrypt_decrypt('encrypt', $rwsl['ag_sells_order_id'])."' style='color:#DC143C; font-weight:600; font-size:14px; cursor:pointer' title='Remove'><i class='fas fa-trash-alt' id='print_hidden'></i> <span style='color:#000'>".$i++."</span></h5></td>
                        <td style='width:250px'>".$rwsl['ag_part_name']."</td>
                        <td><input style='width:100px' class='pos_qty' type='number' step='.01' value='".$rwsl['ag_sells_qty']."' data-pos-qty='".encrypt_decrypt('encrypt', $rwsl['ag_sells_order_id'])."'  data-part-qty='".encrypt_decrypt('encrypt', $rwsl['ag_part_no'])."' title='Item Quantity' /></td>
                        <td><input style='width:100px' type='text' class='pos_price' value='".number_format($rwsl['ag_sells_price'],2)."' data-pos-price='".encrypt_decrypt('encrypt', $rwsl['ag_sells_order_id'])."' title='Item Price' /></td>
                        <td><input style='width:100px' type='number' class='pos_discount' value='".$rwsl['ag_sells_discount']."' data-pos-discount='".encrypt_decrypt('encrypt', $rwsl['ag_sells_order_id'])."' title='Sell Price' /></td>
                        <td><input style='width:100px' type='number' class='pos_tax' value='".$rwsl['ag_sells_tax']."' data-pos-tax='".encrypt_decrypt('encrypt', $rwsl['ag_sells_order_id'])."' title='Item Tax' /></td>
                        <td style='text-align:right; border-right:1px solid #000 !important'>".number_format($subtotal,2)."</td>
                    </tr>";
                $stotal+=$subtotal;
                $total_discount+=(($rwsl['ag_sells_price']*$rwsl['ag_sells_qty'])*$rwsl['ag_sells_discount'])/100;
                $total_tax+=$befor_tax*$rwsl['ag_sells_tax']/100;
            endwhile;
            echo"<tr>
                    <td colspan='9' style='text-align:right'><br />
                        <b>Basic Total: <span id='grand_total'>".number_format($stotal,2)."</span><br /><br />
                        Pending Amount: <span id='pending_payment'>0.00</span><br /><br />
                        Net Payment: <span id='net_payment'>".number_format($stotal,2)."</span><br /><br /></b>
                        Customer Pay: <input id='cust_pay' type='number' style='width:60px; text-align:right' value='".number_format($stotal,2)."' name='sells_pending_amt' /><br /><br /></b>

                    </td>
                </tr>";
            echo"</tbody>
            </table>
            
                <div class='payment_container refresh_add'>
                        <select name='customer' class='search_input customer'>
                            <option value=''>Select Customer</option>";
                            echo get_customer(); 
                        echo"</select>
                        
                        <select name='payment_type' class='search_input po_py_type'>
                            <option value='cash'>Cash</option>
                            <option value='online'>Online</option>
                            <option value='cheque'>Cheque</option>
                        </select>
                        <input type='hidden' class='pos_save' value='$cnslgt' name='pos_save'/>
                        <input type ='text' class='search_input po_rec_no' name='receipt_no' placeholder='Enter Receipt No' required>  
                        <input type ='hidden' class='search_input po_amt_paid' value='$stotal' name='amount_paid' placeholder='Enter Amount Paid'>  
                        <input type ='text' class='search_input po_inv_date' name='po_inv_date' onfocus=\"this.type='date'\" onblur=\"this.type='text'\" placeholder='Select Invoice Date'>  
                        <input type ='text' class='search_input po_rcp_img' name='po_rcp_img' onfocus=\"this.type='file'\" placeholder='Select Receipt Image' required>  
                </div><br /><br />
                <center><button class='save_pos pop_up_submit' type='submit'>Save</button></center>
            </form>";
        }
    }
    if(isset($_POST['pos_qty'])){
        $ag_sells_order_id =encrypt_decrypt('decrypt', $_POST['data_pos_qty']);
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['data_part_qty']);
        $ag_sells_qty=$_POST['pos_qty'];
      
        // $upqty="update ag_part set ag_part_qty=:ag_sells_qty where ag_part_no=:ag_part_no";
        // $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        // $qtyup->bindParam(':ag_sells_qty',$ag_sells_qty);
        // $qtyup->bindParam(':ag_part_no',$ag_part_no);
        // $qtyup->execute();

        $get_part="select * from ag_part where ag_part_no=:ag_part_no";
        $part_get=$con->prepare($get_part,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $part_get->bindParam(':ag_part_no',$ag_part_no);
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $rw_part=$part_get->fetch();
        if($ag_sells_qty > $rw_part['ag_part_qty']){
            echo "Not Having Enough Quantity";
        }else{
            $upqty="update ag_sells_order_cart set ag_sells_qty=:ag_sells_qty where ag_sells_order_id =:ag_sells_order_id ";
            $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $qtyup->bindParam(':ag_sells_qty',$ag_sells_qty);
            $qtyup->bindParam(':ag_sells_order_id',$ag_sells_order_id );
            $qtyup->execute();
        }

    }
    /*if(isset($_POST['pos_sale_price'])){
       // $ag_sells_order_id=encrypt_decrypt('decrypt', $_POST['data_pos_qty']);
        $ag_part_no=encrypt_decrypt('decrypt', $_POST['data_part_sell']);
        $ag_part_selling_price=$_POST['pos_sale_price'];
      
        $upqty="update ag_part set ag_part_selling_price=:ag_part_selling_price where ag_part_no=:ag_part_no";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_part_selling_price',$ag_part_selling_price);
        $qtyup->bindParam(':ag_part_no',$ag_part_no);
        $qtyup->execute();

    }*/
    if(isset($_POST['pos_discount'])){
        $ag_sells_order_id =encrypt_decrypt('decrypt', $_POST['data_pos_discount']);
        $ag_sells_discount=$_POST['pos_discount'];

        $upqty="update ag_sells_order_cart set ag_sells_discount=:ag_sells_discount where ag_sells_order_id=:ag_sells_order_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_sells_discount',$ag_sells_discount);
        $qtyup->bindParam(':ag_sells_order_id',$ag_sells_order_id);
        $qtyup->execute();
    }
    if(isset($_POST['pos_tax'])){
        $ag_sells_order_id=encrypt_decrypt('decrypt', $_POST['data_pos_tax']);
        $ag_sells_tax=$_POST['pos_tax'];

        $upqty="update ag_sells_order_cart set ag_sells_tax=:ag_sells_tax where ag_sells_order_id=:ag_sells_order_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_sells_tax',$ag_sells_tax);
        $qtyup->bindParam(':ag_sells_order_id',$ag_sells_order_id);
        $qtyup->execute();
    }
    if(isset($_POST['pos_save'])){
        $ag_customer_no=$_POST['customer'];
        $ag_no_of_items=$_POST['pos_save'];
        $ag_sells_status=1;
      
        $ag_sells_cust_pay=$_POST['sells_pending_amt'];
        $ag_sells_payment_type=$_POST['payment_type'];
        if($ag_sells_payment_type == "cash"){
            $ag_sells_payment_type=1;
        }elseif($ag_sells_payment_type == "online"){
            $ag_sells_payment_type=2;
        }else{
            $ag_sells_payment_type=3;
        }
        $ag_so_receipt_no=$_POST['receipt_no'];
        $ag_sells_amount_paid=$_POST['amount_paid'];
        $ag_so_invoice_date=$_POST['po_inv_date'];
        $ag_so_receipt_img=$_FILES['po_rcp_img']['tmp_name'];
           
        if($ag_customer_no == ''){
            $msg="Please Select Customer Name";
        }else{
            $check_po="select * from ag_sells_order_cart where ag_sells_status=0 and (ag_sells_qty=0 or ag_sells_qty='' or ag_sells_price=0 or ag_sells_price='')";
            $po_check=$con->prepare($check_po);
            $po_check->setFetchMode(PDO::FETCH_ASSOC);
            $po_check->execute();
            $count_po=$po_check->rowCount();
            if($count_po>0){ 
                $msg="Please Add Sells Price or Quantity For All Parts";
            }else{
                $get_customer="select * from ag_customer where ag_customer_no=$ag_customer_no ";
                $customer_get=$con->prepare($get_customer);
                $customer_get->setFetchMode(PDO::FETCH_ASSOC);
                $customer_get->execute();
                $rw_customer=$customer_get->fetch();
                $ag_sells_pending_amt=$rw_customer['ag_customer_pending_amt'];

                $ac_amt=$ag_sells_amount_paid+$ag_sells_pending_amt;   

                $ag_customer_name=$rw_customer['ag_customer_name'];
                $ag_customer_phone_no=$rw_customer['ag_customer_phone_no'];
                $ag_customer_address=$rw_customer['ag_customer_address'];
                              
                $checks_po="select * from ag_sells_order_cart where ag_sells_status=0";
                $po_checks=$con->prepare($checks_po);
                $po_checks->setFetchMode(PDO::FETCH_ASSOC);
                $po_checks->execute();
                $rw_in=$po_checks->fetch();
                $ag_sells_invoice_no=$rw_in['ag_sells_invoice_no'];
                $ag_sells_order_cart_repo_status=1;          

                if($ac_amt < $ag_sells_cust_pay){}else{
                    $up_pos="update ag_sells_order_cart set ag_customer_no=:ag_customer_no,ag_sells_status=:ag_sells_status where ag_sells_status=0";
                    $pos_up=$con->prepare($up_pos,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $pos_up->bindParam(':ag_customer_no',$ag_customer_no);
                    $pos_up->bindParam(':ag_sells_status',$ag_sells_status);
                    if($pos_up->execute()){
                        //$msg="PO Has Been Saved Successfully";
                        $invimg=date('Y-m-d')."-".substr(mt_rand(),0,10).".png";     
                        $add_data="insert into ag_sells_order_cart_repo(ag_sells_invoice_no,ag_customer_name,ag_sells_payment_type,ag_sells_amount_paid,ag_so_receipt_no,ag_sells_pending_amt,ag_so_invoice_date,ag_so_receipt_img,ag_no_of_items,ag_sells_order_cart_repo_status)
                        values(:ag_sells_invoice_no,:ag_customer_name,:ag_sells_payment_type,:ag_sells_amount_paid,:ag_so_receipt_no,:ag_sells_pending_amt,:ag_so_invoice_date,:ag_so_receipt_img,:ag_no_of_items,:ag_sells_order_cart_repo_status)";
                        $add_data=$con->prepare($add_data,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $add_data->bindParam(':ag_sells_invoice_no',$ag_sells_invoice_no);
                        $add_data->bindParam(':ag_customer_name',$ag_customer_name);
                        $add_data->bindParam(':ag_sells_payment_type',$ag_sells_payment_type);
                        $add_data->bindParam(':ag_so_receipt_no',$ag_so_receipt_no);
                        $add_data->bindParam(':ag_sells_amount_paid',$ag_sells_amount_paid);
                        $add_data->bindParam(':ag_sells_pending_amt',$ag_sells_pending_amt);
                        $add_data->bindParam(':ag_so_invoice_date',$ag_so_invoice_date);
                        $add_data->bindParam(':ag_so_receipt_img',$invimg);
                        $add_data->bindParam(':ag_no_of_items',$ag_no_of_items);
                        $add_data->bindParam(':ag_sells_order_cart_repo_status',$ag_sells_order_cart_repo_status);
                        if($add_data->execute()){
                            if($ag_sells_pending_amt != 0){
                                $up_customer="update ag_customer set ag_customer_pending_amt=0 where ag_customer_no=:ag_customer_no";
                                $customer_up=$con->prepare($up_customer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $customer_up->bindParam(':ag_customer_no',$ag_customer_no);
                                $customer_up->execute();
                            }

                            if($ac_amt >= $ag_sells_cust_pay){
                                $rt_amt=$ac_amt-$ag_sells_cust_pay;
                                $up_customer="update ag_customer set ag_customer_pending_amt=ag_customer_pending_amt+:rt_amt where ag_customer_no=:ag_customer_no";
                                $customer_up=$con->prepare($up_customer,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $customer_up->bindParam(':rt_amt',$rt_amt);
                                $customer_up->bindParam(':ag_customer_no',$ag_customer_no);
                                $customer_up->execute();
                            }
                            
                            $get_last_po="select * from ag_sells_order_cart where ag_sells_invoice_no=:ag_sells_invoice_no";
                            $last_po_get=$con->prepare($get_last_po);
                            $last_po_get->bindParam(':ag_sells_invoice_no',$ag_sells_invoice_no);
                            $last_po_get->setFetchMode(PDO::FETCH_ASSOC);
                            $last_po_get->execute();
                            while($rw_last_po=$last_po_get->fetch()):
                                $ag_part_no=$rw_last_po['ag_part_no'];
                                $ag_po_qty=$rw_last_po['ag_sells_qty'];
                                
                                $up_part="update ag_part set ag_part_qty=ag_part_qty-'$ag_po_qty' where ag_part_no='$ag_part_no'";
                                $part_up=$con->prepare($up_part);
                                $part_up->execute();
                                        
                            endwhile;
                            $path="../images/so_receipt/$invimg";
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
    }
       echo json_encode($msg);
    }
    if(isset($_POST['pos_price'])){
        $ag_sells_order_id=encrypt_decrypt('decrypt', $_POST['data_pos_price']);;
        $ag_sells_price=$_POST['pos_price'];

        $upqty="update ag_sells_order_cart set ag_sells_price=:ag_sells_price where ag_sells_order_id =:ag_sells_order_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_sells_price',$ag_sells_price);
        $qtyup->bindParam(':ag_sells_order_id',$ag_sells_order_id);
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
    if(isset($_POST['pos_sales_price'])){
        $ag_sells_order_id=encrypt_decrypt('decrypt', $_POST['data_part_sell_id']);
        $ag_po_sale_price=$_POST['pos_sales_price'];

        $upqty="update ag_sells_order_cart set ag_po_sale_price=:ag_po_sale_price where ag_sells_order_id=:ag_sells_order_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_sale_price',$ag_po_sale_price);
        $qtyup->bindParam(':ag_sells_order_id',$ag_sells_order_id);
        $qtyup->execute();
    }
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
    if(isset($_POST['selectedBrands'])) {
        $selectedBrands = $_POST['selectedBrands'];
        // Modify the query below to fetch the relevant vehicle models based on the selected brands
        $get_vehicle = "SELECT * FROM ag_vehicle WHERE ag_brand_no IN (" . implode(',', $selectedBrands) . ")";
        $vehicle_get = $con->prepare($get_vehicle, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
        $vehicle_get->execute();
        
        while ($rw_vehicle = $vehicle_get->fetch()):
          echo "<option value='" . $rw_vehicle['ag_vehicle_no'] . "'>" . $rw_vehicle['ag_vehicle_model_name'] . "</option>";
        endwhile;
    }
    if(isset($_POST['part_add'])) {
        $ag_part_no = substr(mt_rand(), 0, 10);
        $part_get = $con->prepare("select * from ag_part order by 1 desc limit 1");
        $part_get->setFetchMode(PDO::FETCH_ASSOC);
        $part_get->execute();
        $count_part = $part_get->rowCount();
        if ($count_part == 0) {
            $ag_part_code = "AGP_01";
        } else {
            $rw_part = $part_get->fetch();
            $code = $rw_part['ag_part_code'];
            $ex = explode('_', $code);
            $ag_part_code = "AGP_" . ($ex[1] + 1);
        }
        
        $ag_brand_nos = $_POST['vehicle_brand']; // Array of selected brand IDs
        $ag_vehicle_nos = $_POST['vehicle_model']; // Array of selected model IDs

        $ag_brand_nos = $_POST['vehicle_brand'];
        $ag_brand_no = implode(',', $ag_brand_nos);

        $ag_vehicle_nos = $_POST['vehicle_model'];
        $ag_vehicle_no = implode(',', $ag_vehicle_nos);

        $ag_partname_no = $_POST['partname'];
        $partname_get="select * from ag_partname where ag_partname_no=:ag_partname_no";
        $get_partname=$con->prepare($partname_get);
        $get_partname->bindParam(':ag_partname_no', $ag_partname_no);
        $get_partname->setFetchMode(PDO::FETCH_ASSOC);
        $get_partname->execute();
        $rw_partname = $get_partname->fetch();

        $ag_part_name = $rw_partname['ag_partname_name'];
        $ag_part_company = $_POST['mg_company'];
        $ag_part_purchase_price=0;
        $ag_part_selling_price = 0;
        $ag_part_qty = 0;
        $ag_part_alert_qty = 0;
        $ag_part_cat = $_POST['part_cat'];
        $ag_part_hsn = $_POST['part_hsn'];
        $ag_part_img = $_FILES['part_img']['tmp_name'];
        $ag_part_status = $_POST['part_status'];
    
        if ($ag_part_status == "Active") {
            $ag_part_status = 1;
        } else {
            $ag_part_status = 2;
        }
        
        $invimg = date('Y-m-d') . "-" . substr(mt_rand(), 0, 10) . ".png";
        $ag_part_date = date('Y-m-d');
    
        $add_data = "INSERT INTO ag_part(ag_part_no, ag_part_code, ag_part_name,ag_part_company,ag_part_purchase_price,ag_part_selling_price,ag_part_qty,ag_part_alert_qty, ag_part_hsn, ag_part_cat, ag_part_img, ag_part_status, ag_part_date) 
                    VALUES(:ag_part_no, :ag_part_code, :ag_part_name, :ag_part_company,:ag_part_purchase_price,:ag_part_selling_price,:ag_part_qty,:ag_part_alert_qty, :ag_part_hsn, :ag_part_cat, :ag_part_img, :ag_part_status, :ag_part_date)";
        
        $data_add = $con->prepare($add_data, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $data_add->bindParam(':ag_part_no', $ag_part_no);
        $data_add->bindParam(':ag_part_code', $ag_part_code);
        //$data_add->bindParam(':ag_brand_no', $ag_brand_no);
       // $data_add->bindParam(':ag_vehicle_no', $ag_vehicle_no);
        $data_add->bindParam(':ag_part_name', $ag_part_name);
        $data_add->bindParam(':ag_part_company', $ag_part_company);
        $data_add->bindParam(':ag_part_purchase_price', $ag_part_purchase_price);
        $data_add->bindParam(':ag_part_selling_price', $ag_part_selling_price);
        $data_add->bindParam(':ag_part_qty', $ag_part_qty);
        $data_add->bindParam(':ag_part_alert_qty', $ag_part_alert_qty);
        $data_add->bindParam(':ag_part_cat', $ag_part_cat);
        $data_add->bindParam(':ag_part_hsn', $ag_part_hsn);
        $data_add->bindParam(':ag_part_img', $invimg);
        $data_add->bindParam(':ag_part_status', $ag_part_status);
        $data_add->bindParam(':ag_part_date', $ag_part_date);
    
        if ($data_add->execute()) {
            $path = "../images/part/$invimg";
            move_uploaded_file($_FILES['part_img']['tmp_name'], $path);
    
            // Get the ID of the inserted part
            $part_id = $con->lastInsertId();
            $msg="$part_id";
            
            // Convert $ag_brand_nos to an array if it's a string
            if (is_string($ag_brand_nos)) {
                $ag_brand_nos = explode(',', $ag_brand_nos);
            }
             // Convert $ag_vehicle_nos to an array if it's a string
             if (is_string($ag_vehicle_nos)) {
                $ag_vehicle_nos = explode(',', $ag_vehicle_nos);
            }
            // Insert selected brands and models into the ag_part table
            foreach ($ag_vehicle_nos as $vehicle_id) {
                $get_vehicle="select * from ag_vehicle where ag_vehicle_no='$vehicle_id'";
                $vehicle_get=$con->prepare($get_vehicle);
                $vehicle_get->setFetchMode(PDO::FETCH_ASSOC);
                $vehicle_get->execute();
                $rw_vehicle=$vehicle_get->fetch();
                $ag_brand_no=$rw_vehicle['ag_brand_no'];
                $ag_part_repo_status=1;

                $insert_bridge = "INSERT INTO ag_part_repo(ag_part_id,ag_brand_no,ag_vehicle_no,ag_part_company,ag_part_name,ag_part_repo_status) 
                                    VALUES(:ag_part_id, :ag_brand_no, :ag_vehicle_no, :ag_part_company, :ag_part_name,:ag_part_repo_status)";
                $data_bridge = $con->prepare($insert_bridge, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $data_bridge->bindParam(':ag_part_id', $part_id);
                $data_bridge->bindParam(':ag_brand_no', $ag_brand_no);
                $data_bridge->bindParam(':ag_vehicle_no', $vehicle_id);
                $data_bridge->bindParam(':ag_part_company', $ag_part_company);
                $data_bridge->bindParam(':ag_part_name', $ag_part_name);
                $data_bridge->bindParam(':ag_part_repo_status', $ag_part_repo_status);
                $data_bridge->execute();
            }
            
            $msg = "Data Added Successfully";
        } else {
            $msg = "Something Went Wrong";
        }
    
        echo json_encode($msg);
    }
    if(isset($_POST['customer_change'])){
        $customer_no=$_POST['customer_change'];
        if($customer_no == ""){
            $pending_amount=0;
        }else{
            $get_retail="select * from ag_customer where ag_customer_no='$customer_no'";
            $retail_get=$con->prepare($get_retail);
            $retail_get->setFetchMode(PDO::FETCH_ASSOC);
            $retail_get->execute();
            $rw_retail=$retail_get->fetch();
            $pending_amount=$rw_retail['ag_customer_pending_amt'];
        }
        echo $pending_amount;
    }
    if(isset($_POST['sale_remove'])){
        $ag_sells_order_id =encrypt_decrypt('decrypt', $_POST['sale_remove']);
        $delete_item="delete from ag_sells_order_cart where ag_sells_order_id=:ag_sells_order_id";
        $item_delete=$con->prepare($delete_item,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $item_delete->bindParam(':ag_sells_order_id',$ag_sells_order_id);
        if($item_delete->execute()){
            echo "Deleted Successfully";
        }else{
            echo "Something Went Wrong";
        }
    }
?>