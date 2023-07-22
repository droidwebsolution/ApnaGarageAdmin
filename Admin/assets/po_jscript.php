<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_all_po'])){
        $by_name=check_data($_POST['by_name']);
        $po_get=$con->prepare("select acr.*,ac.* from ag_po_cart_repo acr left join ag_po_cart ac on acr.ag_po_invoice_no=ac.ag_po_invoice_no where ag_retailer_name like '%$by_name%' order by 1 desc");
        $po_get->setFetchMode(PDO::FETCH_ASSOC);
        $po_get->execute();
        $count_po=$po_get->rowCount();
        if($count_po == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_po=$po_get->fetch()):
               
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_po['ag_po_invoice_no']."</td>
                        <td>".$rw_po['ag_retailer_name']."</td>
                        <td>".$rw_po['ag_po_payment_mode']."</td>
                        <td>".$rw_po['ag_po_payment_type']."</td>
                        <td>".$rw_po['ag_po_receipt_no']."</td>
                        <td>".$rw_po['ag_po_amount_paid']."</td>
                        <td>".$rw_po['ag_no_of_items']."</td>
                        <td>11000</td>
                
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary po_open' data-id='".encrypt_decrypt('encrypt', $rw_po['ag_po_invoice_no'])."'><i class='fas fa-eye'></i> View</summary>
                                <div class='pop_up po_open_table'></div>
                            </details>
                        </td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['po_open_table'])){
        $ag_po_invoice_no=encrypt_decrypt('decrypt', $_POST['po_open_table']);
        $get_po="select ct.*,rp.* from ag_po_cart ct inner join ag_po_cart_repo rp on ct.ag_po_invoice_no=rp.ag_po_invoice_no where ct.ag_po_invoice_no=:ag_po_invoice_no";
        $po_get=$con->prepare($get_po);
        $po_get->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
        $po_get->setFetchMode(PDO::FETCH_ASSOC);
        $po_get->execute();
        $rw_po_view=$po_get->fetch();

            echo"<form class='form min_width_form' id='po_invoice'>
            <h2 style='text-align:left; display: flex; justify-content: space-between;'>
                <span style='text-align:left'>Invoice No:$ag_po_invoice_no</span>
                <span style='text-align:center'>Invoice Date:".$rw_po_view['ag_po_invoice_date']." </span>
                <span style='text-align:right'>Due Date:".$rw_po_view['ag_po_invoice_due_date']." </span>
            
            <i class='fa-solid fa-xmark close_pop_up' title='Close'></i>
            </h2>
            <div class='form_container'>
                <div class='table_container'>";
                echo"<p style='font-size:16px;font-weight:bold'>Bill From:<br/><p>
                <p style='font-size:16px;font-weight:bold'>".$rw_po_view['ag_retailer_name']."<p>
                <p style='font-size:14px;'>Shop No:<p>
                <p style='font-size:14px;'>Mobile: </p>
                <p style='font-size:14px;'> State: </p>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody class=''>";
                    $ag_po_invoice_no=encrypt_decrypt('decrypt', $_POST['po_open_table']);
                    $get_po="select ct.*,rp.* from ag_po_cart ct inner join ag_po_cart_repo rp on ct.ag_po_invoice_no=rp.ag_po_invoice_no where ct.ag_po_invoice_no=:ag_po_invoice_no";
                    $po_get=$con->prepare($get_po);
                    $po_get->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
                    $po_get->setFetchMode(PDO::FETCH_ASSOC);
                    $po_get->execute();
                    $i=1;$stotal=0; $total_discount=0; $total_tax=0;
                    while($rw_po_view=$po_get->fetch()):
                        $befor_tax=($rw_po_view['ag_po_price']*$rw_po_view['ag_po_qty'])-(($rw_po_view['ag_po_price']*$rw_po_view['ag_po_qty'])*$rw_po_view['ag_po_discount'])/100;
                        $discount_amt=(($rw_po_view['ag_po_price']*$rw_po_view['ag_po_qty'])*$rw_po_view['ag_po_discount'])/100;
                        $after_tax=$befor_tax+($befor_tax*$rw_po_view['ag_po_tax']/100);
                        $subtotal=$after_tax;
                        echo"<tr>
                            <td>".$i++."</td>
                            <td>".$rw_po_view['ag_part_name']."</td>
                            <td>".$rw_po_view['ag_po_qty']."</td>
                            <td>".$rw_po_view['ag_po_price']."</td>
                            <td>".$rw_po_view['ag_po_discount']."</td>
                            <td>".$rw_po_view['ag_po_tax']."</td>
                            <td>".number_format($subtotal,2)."</td>
                        </tr>";
                      
                    $stotal+=$subtotal;
                    $total_discount+=(($rw_po_view['ag_po_price']*$rw_po_view['ag_po_qty'])*$rw_po_view['ag_po_discount'])/100;
                    $total_tax+=$befor_tax*$rw_po_view['ag_po_tax']/100;
                    endwhile;
                    echo"<tr><td><b>SUB TOTAL</b></td><td></td><td></td><td></td>
                    <td colspan='' style='text-align:left'><br />
                    <i class='fa-solid fa-indian-rupee-sign'></i><b><span id='grand_total'>".number_format($total_discount,2)."</span></b><br /><br />
                    </td>
                    <td colspan='' style='text-align:left'><br />
                    <i class='fa-solid fa-indian-rupee-sign'></i><b><span id='grand_total'>".number_format($total_tax,2)."</span></b><br /><br />
                    </td>
                    <td colspan='' style='text-align:left'><br />
                    <i class='fa-solid fa-indian-rupee-sign'></i><b><span id='grand_total'>".number_format($stotal,2)."</span></b><br /><br />
                    </td>
                </tr>";
                echo"</tbody>
                </table>
               
            </div>
            <button class='pop_up_submit' type='submit' name=''><i class='fa-solid fa-print'></i> Print</button>
            <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

        </div>
        </form>";

    }
?>
