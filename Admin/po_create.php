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
                    <summary class='pop_up_open pop_up_summary' style='background:#ef7d19;color:#000'><i class="fa-solid fa-circle-plus"></i> Add Retailer</summary>
                    <div class='pop_up'>
                        <form class='form min_width_form' id='add_retailer' enctype='multipart/form-data'>
                            <h2>Add Retailer <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <div class='input_container'>
                                    <p>Enter Retailer Company Name</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-copyright"></i>
                                        <input type='text' name='r_company_name' placeholder="Company Name" required />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Retailer Owner Name</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='r_owner_name' placeholder="owner Name" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Company Phone No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-phone"></i>
                                        <input type='tel' name='r_company_phone' placeholder="Enter Digits Only" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Company Alternate Phone No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-phone"></i>
                                        <input type='tel' name='r_company_alt_phone' placeholder="Enter Digits Only" />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Company Email Id</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type='email' name='r_company_email' placeholder="Enter Comapny Email" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Website Link</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-browser"></i>
                                        <input type='text' name='r_company_web' placeholder="Enter webisite formate"/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Company GST No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-n"></i>
                                        <input type='text' name='r_company_gst' placeholder="Enter GST No" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter TIN No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-n"></i>
                                        <input type='text' name='r_company_tin' placeholder="Enter TIN no" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Contact Person Name</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='r_contact_person_name' placeholder="Enter Contact Person Name" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Contact Person Phone No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-phone"></i>
                                        <input type='tel' name='r_contact_person_phone' placeholder="Enter Contact Person Phone No" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select state</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-city"></i>
                                        <select name='r_state' class='r_state'>
                                            <option value="">Select State</option>
                                            <?php echo get_state(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select City</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-city"></i>
                                        <select name='r_city' class='r_city'>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Area</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-city"></i>
                                        <input type='text' name='r_area' placeholder="Enter Area" required/>
                                    </div>
                                </div>
                                <input type='hidden' name='retailer_add' />
                                <div class='input_container'>
                                    <p>Enter Shop No</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-n"></i>
                                        <input type='text' name='r_house_no' placeholder="Enter Shop No"/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter PinCode</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-n"></i>
                                        <input type='text' name='r_pincode' placeholder="Enter Pin-code"/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Registration Date</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type='date' name='r_register_date' placeholder="Enter Date" />
                                    </div>
                                </div>
                                <br clear="all">                            
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> RESET</button>
                                    <button class='pop_up_submit add_retailer' type='submit' name='add_retailer'><i class='fa-solid fa-save'></i> ADD</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> CANCEL</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
				<details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary refresh_add' style='background:#ef7d19;color:#000'><i class="fa-solid fa-circle-plus"></i> Add Part</summary>
                    <div class='pop_up'>
                        <form class='form min_width_form' id='add_part' enctype='multipart/form-data'>
                            <h2>Add Parts <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <div class='input_container'>
                                    <p>Select Brand</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-copyright"></i>
                                        <select name='vehicle_brand[]' required class="refresh_brand multiple-checkboxes" multiple="multiple">
                                            <?php  echo get_brand(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Model</p>
                                    <div class='input'>
                                        <i class="fa-sharp fa-regular fa-motorcycle"></i>
                                        <select name='vehicle_model[]' required class="refresh_model" multiple="multiple"></select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Category</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-list"></i>
                                        <select name='part_cat' required>
                                            <option value='Oil'>Oil</option>
                                            <option value='Spare'>Spare</option>
                                            <option value='Accessories'>Accessories</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Part Name</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                        <select name='partname' required  class="refresh_partname">
                                            <option value="">Select part Name</option>
                                            <?php echo get_partname(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Menufecture Company Name</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-copyright"></i>
                                        <select name='mg_company' required class="refresh_mg_company">
                                            <option value="">Select Menufecture Company</option>
                                            <?php echo get_mg_company(); ?>
                                        </select>
                                    </div>
                                </div>
                                <input type='hidden' name='part_add' />
                                <div class='input_container'>
                                    <p>Enter HSN</p>
                                    <div class='input'>
                                        <i class="fa-brands fa-digital-ocean"></i>
                                        <input type='text' name='part_hsn' placeholder="Enter HSN number" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Choose Part Image</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-image"></i>
                                        <input type='file' name='part_img' required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Status</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-battery-full"></i>
                                        <select name='part_status' value='".$rw_part['ag_part_status']."'>
                                            <option value='Active'>Active</option>
                                            <option value='InActive'>InActive</option>
                                        </select>
                                    </div>
                                </div>    
                                <br clear="all">                            
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_part' type='submit' name='add_part'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
            </div>
            <div class='pos_left'>
                <div class='table_container refresh_add'>
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
    $(document).on('change','.pos_alert_qty', function(){
		var pos_alert_qty=$(this).val();
		//var data_pos_qty=$(this).attr("data-pos-qty");
		var data_part_qty=$(this).attr("data-part-qty");
		$.ajax({
			url:'assets/po_create_jscript.php',
			type:'post',
			cache: false,
			data:{pos_alert_qty:pos_alert_qty,data_part_qty:data_part_qty},
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
			url:'assets/po_create_jscript.php',
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
	$(document).on('submit','#add_retailer',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/retailer_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_retailer').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
               // $('.details_open').removeAttr("open");
                $('.add_retailer').removeAttr('disabled');
                $('.form').find('input').val('');
                get_pos_items();
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
	$(document).on('submit','#add_part',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/po_create_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_part').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                //$('.details_open').removeAttr("open");
                $('.add_part').removeAttr('disabled');
                $('#add_part').trigger("reset");
                get_po_part();
            }
        });
    });
    $(document).on('change','.retailer',function(){
        var retailer_change=$(this).val();
        $.ajax({
            url:'assets/po_create_jscript.php',
            method:'post',
            data:{retailer_change:retailer_change},
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
			url:'assets/po_create_jscript.php',
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