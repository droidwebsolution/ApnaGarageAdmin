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
        <title>Apna garage | SO</title>
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
                <input type='text' class='search_input pos_search' onkeyup="get_po_part()" placeholder='Search By Part Code, Name, Category' title='Search By Part Code, Name, Category'/>
                <select class='search_input by_brand refresh_serach_brand' onchange='get_po_part()'>
                    <option value=''>Search By Brand</option>
                    <?php echo get_brand(); ?>
                </select>
                <select class='search_input by_model refresh_serach_model' onchange='get_po_part()'>
                    <option value=''>Search By Model</option>
                    <?php echo get_vehicle(); ?>
                </select>
				<details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary' style='background:#ef7d19;color:#000'><i class="fa-solid fa-circle-plus"></i> Add Customer</summary>
                    <div class='pop_up'>
                        <form class='form small_width_form' id='add_customer'>
                            <h2>Add Customer <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                
                                <p>Enter Customer Name</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='customer_name' placeholder='* Only Characters Allowed' title='Enter customer Name' required />
                                </div>
                                <input type='hidden' name='customer_add' /> 
                                <p>Enter Customer Phone No</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='tel' name='customer_phone' placeholder='* Enter Phone No' title='Enter customer Name' required />
                                </div>
                                <p>Enter Customer Address</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='customer_address' placeholder='* Enter Address Details' title='Enter customer Name' required />
                                </div>
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_customer' type='submit' name='add_customer'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
            </div>
            <div class='pos_left'>
                <div class='table_container refresh_add'>
                    <ul class='get_po_part'>
                    </ul>
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
    get_po_part();
    get_pos_items();
    function number_format (number, decimals, dec_point, thousands_sep) {
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
    function get_po_part(){
		var get_po_part='Get PO Parts';
		var pos_search=$('.pos_search').val();
		var by_brand = $('.by_brand').val();
        var by_model = $('.by_model').val();
		$.ajax({
			method:'post',
			url:'assets/so_create_jscript.php',
			data:{get_po_part:get_po_part,pos_search:pos_search,by_brand:by_brand,by_model:by_model},
			success:function(data){
				$('.get_po_part').html(data);
			}
		});
	}
    $(document).on('click','.sale_item_add',function(){
		var so_add=$(this).attr('data-id');
		$.ajax({
			url:'assets/so_create_jscript.php',
			type:'post',
			cache: false,
			data:{so_add:so_add},
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
			url:'assets/so_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_qty:pos_qty,data_pos_qty:data_pos_qty,data_part_qty:data_part_qty},
			success:function(data){
				get_pos_items();
			}
		});
	});
   
	$(document).on('change','.pos_sales_price', function(){
		var pos_sales_price=$(this).val();
		var data_part_sell_id=$(this).attr("data-part-sell-price");
		$.ajax({
			type:'post',
			url:'assets/so_create_jscript.php',
			data:{pos_sales_price:pos_sales_price,data_part_sell_id:data_part_sell_id},
			success:function(data){
				get_pos_items();
			}
		});
	});
	$(document).on('change','.pos_discount', function(){
		var pos_discount=$(this).val();
		var data_pos_discount=$(this).attr("data-pos-discount");
		$.ajax({
			url:'assets/so_create_jscript.php',
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
			url:'assets/so_create_jscript.php',
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
			url:'assets/so_create_jscript.php',
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
			url:'assets/so_create_jscript.php',
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
			url:'assets/so_create_jscript.php',
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
			url:'assets/so_create_jscript.php',
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
            url:'assets/so_create_jscript.php',
            method:'post',
            data:{change_search_brand:change_search_brand},
            success:function(data){
                $('.refresh_serach_model').html(data);
            }
        });
    }); 
	
	$(document).on('change','.r_state',function(){
        var change_state=$(this).val();
        $.ajax({
            url:'assets/retailer_jscript.php',
            method:'post',
            data:{change_state:change_state},
            success:function(data){
                $('.r_city').html(data);
            }
        });
    });   
	$(document).ready(function() {
        $('.multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
          nonSelectedText: 'Select Brand',
          //buttonClass:'<div class="input_container"></div>',
          //buttonContainer: '<div class="input"></div>',
          onChange: function(option, checked, select) {
            // var selectedBrands = $('#multiple-checkboxes').val(); // Get the selected brand values
            // refreshModel(selectedBrands); // Call the function to update the model select options
            refreshModel(); 
        }
        });
        $('.refresh_model').multiselect({
            includeSelectAllOption: true,
            nonSelectedText: 'Select Model',
            buttonClass:'<div class="input"></div>',
            //buttonContainer: '<div class="input"></div>',
        });
    });
    function refreshModel() {
        var selectedBrands = $('.multiple-checkboxes').val(); // Get the selected brand values
        $.ajax({
            url: 'assets/po_create_jscript.php',
            method: 'post',
            data: {selectedBrands: selectedBrands},
            success: function(data) {
            $('.refresh_model').html(data);
            $('.refresh_model').multiselect('rebuild');
             // Rebuild the model select dropdown
            }
        });
    }
	$(document).on('submit','#add_customer',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/so_create_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_customer').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                //$('.details_open').removeAttr("open");
                $('.add_customer').removeAttr('disabled');
                $('.form').find('input').val('');
                get_pos_items();
            }
        });
    });
	$(document).on('change','.customer',function(){
        var customer_change=$(this).val();
        $.ajax({
            url:'assets/so_create_jscript.php',
            method:'post',
            data:{customer_change:customer_change},
            success:function(data){
                $('#pending_payment').html(data);
                var basic_total=$('#grand_total').text().split(",").join("");
                var pending_payment=$('#pending_payment').text();
                var net_total=parseInt(basic_total)+parseInt(pending_payment);
                $('#net_payment').text(number_format(net_total,'2',));
                $('#cust_pay').val(number_format(net_total,'2',))
            }
        });
    });
	$(document).on('click','.sale_remove',function(){
		var sale_remove=$(this).attr("id");
		$.ajax({
			url:'assets/so_create_jscript.php',
			type:'post',
			cache: false,
			data:{sale_remove:sale_remove},
			success:function(data){
				alert(data)
                get_pos_items();
			}
		});
	});
   
</script>