<?php
    session_start();
    if(!isset($_SESSION['adsesmail'])){
        header("Location:logout.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apna garage | All PO</title>
        <link rel='stylesheet' href='css/style.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    </head>
    <body>
        <?php
            include("addons/header.php");
            include("addons/sidebar.php");
            include("addons/apna_garage.php");
        ?>
           <div id='container'>
           <input type='text' class='search_input by_name' onkeyup='get_city()' placeholder='Search By Name ' />
           <div class='table_container'>
                <table class='item_table'  cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Invoice No.</th>
                            <th>Retailer Name</th>
                            <th>Payment Mode</th>
                            <th>Payment Type</th>
                            <th>Receipt No</th>
                            <th>Amount Paid</th>
                            <th>No Of Parts</th>
                            <th>Sub Total</th>
                            <th style='text-align:center'>View Invoice</th>
                        </tr>
                    </thead>
                    <tbody class='get_po_table'></tbody>
                </table>
            </div>
           </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_all_po();
    function get_all_po() {
        var get_all_po = "Get All PO";
        var by_name = $('.by_name').val();    
        $.ajax({
            url: 'assets/po_jscript.php',
            method: 'post',
            data: {get_all_po: get_all_po,by_name: by_name},
            success: function(data) {
            $('.get_po_table').html(data);
            }
        });
    }
    $(document).on('click','.po_open',function(){
        var po_open_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/po_jscript.php',
            method:'post',
            data:{po_open_table:po_open_table},
            success:function(data){
                $('.po_open_table').html(data);
            }
        });
    });
</script>