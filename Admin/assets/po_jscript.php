<?php
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_all_po'])){
        $by_name=check_data($_POST['by_name']);
        $po_get=$con->prepare("select * from ag_po_cart_repo where ag_retailer_name like '%$by_name%' order by 1 desc");
        $po_get->setFetchMode(PDO::FETCH_ASSOC);
        $po_get->execute();
        $count_po=$po_get->rowCount();
        if($count_po == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_po=$po_get->fetch()):
               $net_total=$rw_po['ag_po_amount_paid']+$rw_po['ag_po_pending_amt'];
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".date('d-m-Y',strtotime($rw_po['ag_po_invoice_date']))."</td>
                        <td>".$rw_po['ag_po_invoice_no']."</td>
                        <td>".$rw_po['ag_retailer_name']."</td>
                        <td>";
                        if($rw_po['ag_po_payment_type'] == 1){
                            echo "Cash";
                        }elseif($rw_po['ag_po_payment_type'] == 2){
                            echo "Online";
                        }else{
                            echo "Cheque";
                        }
                       echo "</td>
                        <td>".$rw_po['ag_po_receipt_no']."</td>
                        <td>".$rw_po['ag_no_of_items']."</td>
                        <td style='text-align:center'>
                            <details class='details_open' style='display:inline-block'>
                                <summary class='pop_up_open pop_up_summary po_open' data-id='".encrypt_decrypt('encrypt', $rw_po['ag_po_invoice_no'])."'><i class='fas fa-eye'></i> View</summary>
                                <div class='pop_up po_open_table'></div>
                            </details>
                        </td>
                        <td>".number_format($rw_po['ag_po_amount_paid'],2)."</td>
                        <td>".number_format($rw_po['ag_po_pending_amt'],2)."</td>
                        <td style='text-align:right'>".number_format($net_total,2)."</td>
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
                <span style='text-align:left;margin-left:20px;'>Invoice No:$ag_po_invoice_no</span>
                <span style='text-align:center'>Invoice Date:".$rw_po_view['ag_po_invoice_date']." </span>
                <span style='text-align:right'>Due Date:".$rw_po_view['ag_po_invoice_due_date']." </span>
                <span style='text-align:right'> <i class='fa-solid fa-xmark close_pop_up' title='Close'></i> </span>
            
            </h2>
            <div class='form_container'>
                <div class='table_container'>";
                echo"<p style='font-size:16px;font-weight:bold'>Bill From:<br/><p>
                <p style='font-size:16px;font-weight:bold'>".$rw_po_view['ag_retailer_name']."<p>
                <p style='font-size:14px;'>Shop No:".$rw_po_view['ag_retailer_house_no']."<p>
                <p style='font-size:14px;'>Mobile:".$rw_po_view['ag_retailer_company_phone']." </p>
                <p style='font-size:14px;'>Area:".$rw_po_view['ag_retailer_area']." </p>
                <p style='font-size:14px;'> City: ".$rw_po_view['ag_retailer_city']."</p>
                <p style='font-size:14px;'> State: ".$rw_po_view['ag_retailer_state']."</p>
                <p style='font-size:14px;'> Pincode: ".$rw_po_view['ag_retailer_pincode']."</p>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Items</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th style='text-align:right'>Net Amount</th>
                        </tr>
                    </thead>
                    <tbody class=''>";
                    $ag_po_invoice_no=encrypt_decrypt('decrypt', $_POST['po_open_table']);
                    $get_po="select ct.*,rp.* from ag_po_cart ct inner join ag_po_cart_repo rp on ct.ag_po_invoice_no=rp.ag_po_invoice_no where ct.ag_po_invoice_no=:ag_po_invoice_no";
                    $po_get=$con->prepare($get_po);
                    $po_get->bindParam(':ag_po_invoice_no',$ag_po_invoice_no);
                    $po_get->setFetchMode(PDO::FETCH_ASSOC);
                    $po_get->execute();
                    $i=1;$stotal=0; $total_discount=0; $total_tax=0; $total_qty=0; $amt=0;
                    while($rw_po_view=$po_get->fetch()):
                        $po_price=$rw_po_view['ag_po_price']*$rw_po_view['ag_po_qty'];
                        $dis_amt=($po_price*$rw_po_view['ag_po_discount']/100);
                        $tax=($po_price-$dis_amt)*$rw_po_view['ag_po_tax']/100;
                        $subtotal=($po_price-$dis_amt)+$tax;
                        echo"<tr>
                                <td>".$i++."</td>
                                <td>".$rw_po_view['ag_part_name']."</td>
                                <td><i class='fa-solid fa-indian-rupee-sign'></i> ".$rw_po_view['ag_po_price']."</td>
                                <td>".$rw_po_view['ag_po_qty']."</td>
                                <td><i class='fa-solid fa-indian-rupee-sign'></i> ".number_format($po_price,2)."</td>
                                <td>".$rw_po_view['ag_po_discount']."% (<i class='fa-solid fa-indian-rupee-sign'></i> ".number_format($dis_amt,2).")</td>
                                <td>".$rw_po_view['ag_po_tax']."% (<i class='fa-solid fa-indian-rupee-sign'></i> ".number_format($tax,2).")</td>
                                <td style='text-align:right'><i class='fa-solid fa-indian-rupee-sign'></i> ".number_format($subtotal,2)."</td>
                            </tr>";
                        $stotal+=$subtotal;
                        $total_discount+=$dis_amt;
                        $total_tax+=$tax;
                        $total_qty+=$rw_po_view['ag_po_qty'];
                        $amt+=$po_price;
                    endwhile;
                    $get_po="select * from ag_po_cart_repo where ag_po_invoice_no=$ag_po_invoice_no";
                    $po_get=$con->prepare($get_po);
                    $po_get->setFetchMode(PDO::FETCH_ASSOC);
                    $po_get->execute();
                    $rw_po=$po_get->fetch();
                    $cust_pay=$rw_po['ag_po_cust_pay'];
                    $pending_amt=$rw_po['ag_po_pending_amt'];
                    $net_pay=$amt+$pending_amt;
                    echo"<tr>
                            <td colspan='8' style='text-align:right'>
                                <b><br />
                                    Basic Total: ".number_format($amt,2)."<br /><br />
                                    Previous Balance: ".number_format($pending_amt,2)."<br /><br />
                                    Net Payment: ".number_format($net_pay,2)."<br /><br />
                                    We Paid: ".number_format($cust_pay,2)."<br /><br />
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class='pop_up_submit' type='button' onclick='window.print()' name=''><i class='fa-solid fa-print'></i> Print</button>
            <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>

        </div>
        </form>";

    }
?>
