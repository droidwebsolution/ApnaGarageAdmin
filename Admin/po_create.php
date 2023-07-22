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
        <title>Apna garage | PO</title>
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
                <input type='text' class='search_input pos_search' onkeyup="get_po_part()" placeholder='Search By Part Code, Name, Category' title='Search By Part Code, Name, Category'/>
                <select class='search_input by_brand refresh_serach_brand' onchange='get_po_part()'>
                    <option value=''>Search By Brand</option>
                    <?php echo get_brand(); ?>
                </select>
                <select class='search_input by_model refresh_serach_model' onchange='get_po_part()'>
                    <option value=''>Search By Model</option>
                    <?php echo get_vehicle(); ?>
                </select>
				
            </div>
            <div class='pos_left'>
                <div class='table_container'>
                    <table class='item_table' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Part Code</th>
                                <th>Part Name</th>
								<th>Brand & Model</th>
								<th>Category</th>
                            </tr>
                        </thead>
                        <tbody class='get_po_part'></tbody>
                    </table>
                </div>
            </div>
            <div class='pos_right'>
                <div class="table_container pos_table"></div>
				<div class="payment_container"></div>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_po_part();
    get_pos_items();
    function get_po_part(){
		var get_po_part='Get PO Parts';
		var pos_search=$('.pos_search').val();
		var by_brand = $('.by_brand').val();
        var by_model = $('.by_model').val();
		$.ajax({
			method:'post',
			url:'assets/po_create_jscript.php',
			data:{get_po_part:get_po_part,pos_search:pos_search,by_brand:by_brand,by_model:by_model},
			success:function(data){
				$('.get_po_part').html(data);
			}
		});
	}
    $(document).on('click','.pos_item',function(){
		var pos_add=$(this).attr('data-pos');
		var pos_brand=$(this).attr('data-brand');
		var pos_vehicle=$(this).attr('data-vehicle');
		var pos_part_name=$(this).attr('data-part');
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_add:pos_add,pos_brand:pos_brand,pos_vehicle:pos_vehicle,pos_part_name:pos_part_name},
			success:function(data){
				get_po_part();
				get_pos_items();
			}
		});
	});
    $(document).on('change','.pos_qty', function(){
		var pos_qty=$(this).val();
		var data_pos_qty=$(this).attr("data-pos-qty");
		var data_part_qty=$(this).attr("data-part-qty");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_qty:pos_qty,data_pos_qty:data_pos_qty,data_part_qty:data_part_qty},
			success:function(data){
				get_pos_items();
			}
		});
	});
	$(document).on('change','.pos_sale_price', function(){
		var pos_sale_price=$(this).val();
		var data_part_sell=$(this).attr("data-part-sell-price");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_sale_price:pos_sale_price,data_part_sell:data_part_sell},
			success:function(data){
				get_pos_items();
			}
		});
	});
	$(document).on('change','.pos_discount', function(){
		var pos_discount=$(this).val();
		var data_pos_discount=$(this).attr("data-pos-discount");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_discount:pos_discount,data_pos_discount:data_pos_discount},
			success:function(data){
				get_pos_items();
			}
		});
	});
	$(document).on('change','.pos_tax', function(){
		var pos_tax=$(this).val();
		var data_pos_tax=$(this).attr("data-pos-tax");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_tax:pos_tax,data_pos_tax:data_pos_tax},
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
	$(document).on('click','.po_part_brand_model_open',function(){
		//var count_po= 'Count po brands and tables';
		var data_count_id=$(this).attr("data-id");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{po_part_brand_model_open:data_count_id},
			success:function(data){
				$('.po_part_brand_model_table').html(data);
			}
		});
	});
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
	$(document).on('submit','#save_pos',function(e){
		e.preventDefault();
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			processData:false,
			contentType:false,
			dataType:'json',
			data:new FormData(this),
			beforeSend:function(){
				$('.save_pos').attr('disabled','disabled');
			},
			success:function(data){
				alert(data);
				$('.save_pos').removeAttr('disabled');
                $('#save_pos').trigger('reset');
				get_pos_items();
			}
		});
	});
	$(document).on('change','.refresh_serach_brand',function(){
        var change_search_brand=$(this).val();
        $.ajax({
            url:'assets/po_create_jscript.php',
            method:'post',
            data:{change_search_brand:change_search_brand},
            success:function(data){
                $('.refresh_serach_model').html(data);
            }
        });
    }); 
</script>