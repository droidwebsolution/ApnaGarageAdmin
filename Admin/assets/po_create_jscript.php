<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_po_vehicle'])){
        $gstr=$_POST['get_po_vehicle'];
        $rstr='Get PO Vehicle';
        $pos_search=$_POST['pos_search'];
        if($gstr == $rstr){
            $gtinv="select * from ag_vehicle where ag_vehicle_model_name like'%$pos_search%'";
            $invgt=$con->prepare($gtinv,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $invgt->setFetchMode(PDO::FETCH_ASSOC);
            $invgt->execute();
            $item_count=$invgt->rowCount();
            if($item_count == 0){
                echo"<tr><td colspan='3'>No Items Found</td></tr>";
            }else{
                $i=1;
                while($rwinv=$invgt->fetch()):
                    $i_no=$rwinv['ag_vehicle_no'];
                    $i_name=$rwinv['ag_vehicle_model_name'];
                    $status=$rwinv['ag_vehicle_status'];
                    if($status == 1){
                        echo"<tr class='pos_item' data-pos='".encrypt_decrypt('encrypt', $i_no)."' style='cursor:pointer'>
                                <td>".$i++."</td>
                                <td>".$rwinv['ag_vehicle_code']."</td>
                                <td style='text-align:left'>".$rwinv['ag_vehicle_model_name']."</td>
                            </tr>";
                    }
                endwhile;
            }
        }
    }
    if(isset($_POST['pos_add'])){
        $ag_po_status=0;
        $ag_vehicle_no=encrypt_decrypt('decrypt', $_POST['pos_add']);
        $chsl="select * from ag_po_cart where ag_vehicle_no=:ag_vehicle_no and ag_po_status=:ag_po_status";
        $slch=$con->prepare($chsl,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $slch->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $slch->bindParam(':ag_po_status',$ag_po_status);
        $slch->setFetchMode(PDO::FETCH_ASSOC);
        $slch->execute();
        $cnslch=$slch->rowCount();
        $ag_po_qty=1;
        $ag_po_price=100; //need to change;
        $get_item="select * from ag_vehicle where ag_vehicle_no=:ag_vehicle_no";
        $item_get=$con->prepare($get_item,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $item_get->bindParam(':ag_vehicle_no',$ag_vehicle_no);
        $item_get->setFetchMode(PDO::FETCH_ASSOC);
        $item_get->execute();
        $rw_item=$item_get->fetch();
        $ag_vehicle_code=$rw_item['ag_vehicle_code'];
        $ag_vehicle_model_name=$rw_item['ag_vehicle_model_name'];
        
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
            $discount='0';
            $ag_retailer_no=0; //need to change
            $ag_po_part_no=0;
            $ag_po_date=date('Y-m-d');
            $sladd="insert into ag_po_cart(ag_retailer_no,ag_po_invoice_no,ag_po_part_no,ag_vehicle_no,ag_vehicle_name,ag_po_qty,ag_po_price,ag_po_date,ag_po_status)values(:ag_retailer_no,:ag_po_invoice_no,:ag_po_part_no,:ag_vehicle_no,:ag_vehicle_name,:ag_po_qty,:ag_po_price,:ag_po_date,:ag_po_status)";
            $addsl=$con->prepare($sladd,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $addsl->bindParam(':ag_retailer_no',$ag_retailer_no);
            $addsl->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
            $addsl->bindParam(':ag_po_part_no',$ag_po_part_no);
            $addsl->bindParam(':ag_vehicle_no',$ag_vehicle_no);
            $addsl->bindParam(':ag_vehicle_name',$ag_vehicle_model_name);
            $addsl->bindParam(':ag_po_qty',$ag_po_qty);
            $addsl->bindParam(':ag_po_price',$ag_po_price);
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
                            <th>Vehicle Name</th>
                            <th>Part Name</th>
                            <th>Part Qty</th>
                            <th>Part Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>";
            $i=1; $stotal=0;
            while($rwsl=$slgt->fetch()):
                $ag_vehicle_no=$rwsl['ag_vehicle_no'];
                $subtotal=$rwsl['ag_po_price']*$rwsl['ag_po_qty'];
                $get_part="select * from ag_part where ag_vehicle_no=:ag_vehicle_no";
                $part_get=$con->prepare($get_part);
                $part_get->bindParam(':ag_vehicle_no',$ag_vehicle_no);
                $part_get->setFetchMode(PDO::FETCH_ASSOC);
                $part_get->execute();
                echo"<tr style='border-bottom:1px solid #17202A'>
                        <td><h5 class='sale_remove' id='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' style='color:#DC143C; font-weight:600; font-size:14px; cursor:pointer' title='Remove'><i class='fas fa-trash-alt' id='print_hidden'></i> <span style='color:#000'>".$i++."</span></h5></td>
                        <td style='width:250px'>".$rwsl['ag_vehicle_name']."</td>
                        <td>
                            <select>
                                <option value=''>Select Part</option>";
                                while($rw_part=$part_get->fetch()):
                                    echo"<option value='".$rw_part['ag_part_no']."-".$rwsl['ag_po_cart_id']."'>".$rw_part['ag_part_name']."</option>";
                                endwhile;
                            echo"</select>
                        </td>
                        <td><input style='width:100px' class='pos_qty' type='number' step='.01' value='".$rwsl['ag_po_qty']."' data-pos-qty='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' title='Item Quantity' /></td>
                        <td><input style='width:100px' type='text' class='pos_price' value='".number_format($rwsl['ag_po_price'],2)."' data-pos-price='".encrypt_decrypt('encrypt', $rwsl['ag_po_cart_id'])."' title='Item Price' /></td>
                        <td style='text-align:right; border-right:1px solid #000 !important'>".number_format($subtotal,2)."</td>
                    </tr>";
                $stotal+=$subtotal;
            endwhile;
            echo"<tr>
                    <td colspan='6' style='text-align:right'>
                        Basic Total: ".number_format($stotal,2)."<br /><br />
                        Gross Total: <span id='grand_total'>".number_format($stotal,2)."</span><br />
                    </td>
                </tr>";
            echo"</tbody>
            </table>";
        }
    }
    if(isset($_POST['pos_qty'])){
        $ag_po_cart_id=encrypt_decrypt('decrypt', $_POST['data_pos_qty']);;
        $ag_po_qty=$_POST['pos_qty'];

        $upqty="update ag_po_cart set ag_po_qty=:ag_po_qty where ag_po_cart_id=:ag_po_cart_id";
        $qtyup=$con->prepare($upqty,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $qtyup->bindParam(':ag_po_qty',$ag_po_qty);
        $qtyup->bindParam(':ag_po_cart_id',$ag_po_cart_id);
        $qtyup->execute();
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