<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_parts'])){
        $by_name=check_data($_POST['by_name']);
        $from_date=check_data($_POST['from_date']);
        $to_date=check_data($_POST['to_date']);

         $query = "SELECT * FROM ag_po_cart WHERE ag_part_name LIKE '%$by_name%'";

            if (!empty($from_date) && !empty($to_date)) {
                $query .= " AND ag_po_date BETWEEN '$from_date' AND '$to_date'";
            }

        $get_part = $con->prepare($query);
        $get_part->setFetchMode(PDO::FETCH_ASSOC);
        $get_part->execute();
        $count_part=$get_part->rowCount();
        if($count_part == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
        $i=1;$sub_total=0;
        while($rw_part=$get_part->fetch()):
           $total=$rw_part['ag_po_price']*$rw_part['ag_po_qty'];
            echo"<tr>
                <td>".$i++."</td>
                <td>".$rw_part['ag_part_name']."</td>
                <td>".$rw_part['ag_mg_company_name']."</td>
                <td>".$rw_part['ag_po_qty']."</td>
                <td >".$rw_part['ag_po_price']."</td>
                <td>".$rw_part['ag_po_sale_price']."</td>
                <td>".$rw_part['ag_po_discount']."</td>
                <td>".$rw_part['ag_po_tax']."</td>
                <td>".$rw_part['ag_po_date']."</td>
                <td style='text-align:right'>$total</td>
            </tr>";
            $sub_total+=$total;
        endwhile;
    }
        echo"<tr>
                <td colspan='10' style='text-align:right'><b>Total:$sub_total</b></td>
            </tr>
        ";
    }
?>