<?php 
    include("../addons/apna_garage.php");
    include("../addons/logic.php");
    global $con;
    if(isset($_POST['get_service_cart'])){
        $get_service="select * from ag_service_parts where ag_service_part_status=0 and ag_service_type_status=1";
        $service_get=$con->prepare($get_service);
        $service_get->setFetchMode(PDO::FETCH_ASSOC);
        $service_get->execute();
        $count_service=$service_get->rowCount();
        if($count_service == 0){
            echo"<tr><td>No Records Found</td></tr>";
        }else{
            $i=1;
            while($rw_service=$service_get->fetch()):
                echo"<tr>
                        <td>".$i++."</td>
                        <td>".$rw_service['ag_part_no']."</td>
                    </tr>";
            endwhile;
        }
    }
    if(isset($_POST['add_labour_parts'])){
        $ag_part_no=$_POST['add_labour_parts'];
        $ag_service_type=$_POST['out_rate'];
        if($ag_service_type == 0){
            $ag_service_type_status=1;
        }else{
            $ag_service_type_status=2;
        }
        $ag_service_no=0;

        $get_service="select * from ag_service_parts where ag_service_part_status=0 and ag_part_no=:ag_part_no";
        $service_get=$con->prepare($get_service);
        $service_get->bindParam(':ag_part_no',$ag_part_no);
        $service_get->setFetchMode(PDO::FETCH_ASSOC);
        $service_get->execute();
        $count_service=$service_get->rowCount();
        if($count_service !== 0){}else{
            if($ag_part_no == 0 || $ag_part_no==''){}else{
                $add_part="insert into ag_service_parts(ag_service_no,ag_part_no,ag_service_part_status,ag_service_type_status)values(:ag_service_no,:ag_part_no,:ag_service_part_status,:ag_service_type_status)";
                $part_add=$con->prepare($add_part);
                $part_add->bindParam(':ag_service_no',$ag_service_no);
                $part_add->bindParam(':ag_part_no',$ag_part_no);
                $part_add->bindParam(':ag_service_part_status',$ag_service_no);
                $part_add->bindParam(':ag_service_type_status',$ag_service_type_status);
                $part_add->execute();
            }
        }

        
    }
?>