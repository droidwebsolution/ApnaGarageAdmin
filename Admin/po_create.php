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
        <title>Apna garage | Retailer</title>
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
            include("addons/logic.php");
        ?>
        <div id='container'>
            <div class='search_filter'>
                <input type='text' class='search_input pos_search' placeholder='Search By Vehicle Name' />
					<select name='retailer' class='retailer'>
						<option value="">Select Retailer</option>
						<?php echo get_retailer(); ?>
					</select>
            </div>
            <div class='pos_left'>
                <div class='table_container'>
                    <table class='item_table' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Vehicle Code</th>
                                <th>Vehicle</th>
                            </tr>
                        </thead>
                        <tbody class='get_po_vehicle'></tbody>
                    </table>
                </div>
            </div>
            <div class='pos_right'>
                <div class="table_container pos_table"></div>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_po_vehicle();
    get_pos_items();
    function get_po_vehicle(){
		var get_po_vehicle='Get PO Vehicle';
		var pos_search=$('.pos_search').val();
		$.ajax({
			method:'post',
			url:'assets/po_create_jscript.php',
			data:{get_po_vehicle:get_po_vehicle,pos_search:pos_search},
			success:function(data){
				$('.get_po_vehicle').html(data);
			}
		});
	}
    $(document).on('click','.pos_item',function(){
		var pos_add=$(this).attr('data-pos');
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_add:pos_add},
			success:function(data){
				get_po_vehicle();
				get_pos_items();
			}
		});
	});
    $(document).on('change','.pos_qty', function(){
		var pos_qty=$(this).val();
		var data_pos_qty=$(this).attr("data-pos-qty");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_qty:pos_qty,data_pos_qty:data_pos_qty},
			success:function(data){
				get_pos_items();
			}
		});
	});
    function get_pos_items(){
		var get_pos_items='Get POS Items';
		$.ajax({
			method:'post',
			url:'assets/po_create_jscript.php',
			data:{get_pos_items:get_pos_items},
			success:function(data){
				$('.pos_table').html(data);
			}
		});
	}
    $(document).on('change','.pos_price', function(){
		var pos_price=$(this).val();
		var data_pos_price=$(this).attr("data-pos-price");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_price:pos_price,data_pos_price:data_pos_price},
			success:function(data){
				get_pos_items();
			}
		});
	});
</script>