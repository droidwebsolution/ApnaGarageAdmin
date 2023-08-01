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
        <style>
            @media print {
            @page { margin: 0 0.2cm 0.2cm 0.2cm;  /*size:80mm;*/ }
				body *{visibility: hidden}
				.all_orders, .all_orders *{visibility: visible}
				.all_orders{position: absolute; left: 0; top:0; width:100%}
				.all_orders tr th{font-size: 14px !important;}
				.all_orders tr td{font-size: 14px !important;}
				.pop_up{height: 100% !important; position: absolute !important; top:0; left:0; width:100% !important;}
				.form{min-height:auto; max-height: 100% !important; width:100% !important;}
				.pop_up > .form *{visibility: visible}
				.pop_up > .form{position: absolute; left: 0; top:0; width:100%}
				.pop_up_margin{margin-top:10px !important}
				.pop_up_margin img{width:55px !important; height: 55px !important; object-fit: contain; float: right}
				.print_logo_title{float:left; line-height: 55px; display: block !important}
				table{max-height: 100% !important; margin:0px 0px !important; width:100% !important; border-collapse:separate !important; border-bottom: 1px solid #000}
				table tr{page-break-inside:avoid; page-break-after:auto}
    			thead {display:table-header-group}
   				tfoot {display:table-footer-group}
				table tr th{border-top:1px solid #000 !important; box-shadow: none !important; position: relative !important; border-collapse: separate; border-radius: 0px !important}
				table tr th, table tr td{border:1px solid #000 !important; padding:5px !important; height:auto !important; font-size: 10px !important; font-weight: 900 !important; color:#000 !important; box-sizing: border-box !important}
				table tr td{min-width: 0.2cm !important;}
				.table_container p{font-size:12px !important}
                .form h2{font-size:14px;}
                .sub_total_print{border-top:1px solid #000 !important; border-bottom:1px solid #000 !important;}
				.print_p{padding:5px !important; margin-top:11px !important; font-size: 12px !important; font-weight: 900 !important; border-radius: 5px; margin-bottom:10px; border:1px solid #000}
				.sum{height:auto !important; line-height: normal !important; font-size: 10px !important; font-weight: 900 !important;}
				button, h2, header, #sidebar, .hidden_td, #search_filter, #crumb, .form h2 span i{display: none}
			}
        </style>
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
                <table class='item_table all_orders'  cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Date</th>
                            <th>Invoice No.</th>
                            <th>Retailer Name</th>
                            <th>Payment Type</th>
                            <th>Receipt No</th>
                            <th>No Of Parts</th>
                            <th style='text-align:center'>View Invoice</th>
                            <th>Subtotal</th>
                            <th>Previous Balance</th>
                            <th style='min-width:120px; text-align:right'>Net Total</th>
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