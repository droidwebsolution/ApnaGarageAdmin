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
        <title>Apna garage | Sales Order Report</title>
        <link rel='stylesheet' href='css/style.css' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    </head>
    <body>
        <?php
            include("addons/header.php");
            include("addons/sidebar.php");
            include("addons/apna_garage.php");
            include("addons/logic.php");
        ?>
        <div id='container'>
            <div class='search_filter'>
                <input type='text' class='search_input by_name' title='Search By Part Name' onkeyup='get_parts()' placeholder='Search By Part Code, Name, Brand, Model & Category' />
                <input type='date' class='search_input from_date' title='Search By From Date' onkeyup='get_parts()' placeholder='Search By From Date' />
                <input type='date' class='search_input to_date' title='Search By To Date' onkeyup='get_parts()' placeholder='Search By To Date' />
                <button class="pop_up_submit" id="apply_filters">Apply Filters</button>
            </div>
            <div class='table_container'>
                    <table class='item_table'  cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Part Name</th>
                                <th>Menufecture Company</th>
                                <th>Quantity</th>
                                <th>Sale Price</th>
                                <th>Purchase Price</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Sale Date</th>
                                <th style='text-align:right'>Total</th>
                            </tr>
                        </thead>
                        <tbody class='get_parts_table'></tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    $(document).ready(function() {
        get_parts();

        $('#apply_filters').on('click', function() {
            get_parts();
        });
    });
    function get_parts() {
        var get_parts = "Get Parts";
        var by_name = $('.by_name').val();
        var from_date = $('.from_date').val();
        var to_date = $('.to_date').val();
             $.ajax({
            url: 'assets/sales_report_jscript.php',
            method: 'post',
            data: {get_parts:get_parts,by_name:by_name,from_date:from_date,to_date:to_date},
            success: function(data) {
                $('.get_parts_table').html(data);
            }
        });
    }
</script>