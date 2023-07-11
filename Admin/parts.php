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
        <title>Apna garage | Parts</title>
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
                <details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary'><i class="fa-solid fa-circle-plus"></i> Add New</summary>
                    <div class='pop_up'>
                        <form class='form min_width_form' id='add_part' enctype='multipart/form-data'>
                            <h2>Add Parts <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                               
                            <div class='input_container'>
                                    <p>Select Brand</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-copyright"></i>
                                        <select name='vehicle_brand' required class="refresh_brand"></select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Model</p>
                                    <div class='input'>
                                        <i class="fa-sharp fa-regular fa-motorcycle"></i>
                                        <select name='vehicle_model' required class="refresh_model"></select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Category</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-list"></i>
                                        <select name='part_cat' required >
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
                                        <input type='text' name='part_name' placeholder="Part Name eg.foot rest" required />
                                    </div>
                                </div>
                                
                                <input type='hidden' name='part_add' />
                                <div class='input_container'>
                                    <p>Enter HSN</p>
                                    <div class='input'>
                                        <i class="fa-brands fa-digital-ocean"></i>
                                        <input type='text' name='part_hsn' placeholder="Only Digits Allowed" required/>
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
                <details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary'><i class="fa-solid fa-circle-plus"></i> Add Brand</summary>
                    <div class='pop_up'>
                        <form class='form small_width_form' id='add_brand'>
                            <h2>Add Brand <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                
                                <p>Enter Brand Name</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='brand_name' placeholder='* Enter Brand Name' title='Enter Brand Name' required/>
                                </div>
                                <input type='hidden' name='brand_add' /> 
                                <p>Selct Category</p>
                                <div class='input'>
                                    <i class="fa-solid fa-list"></i>
                                    <select name='brand_category'>
                                        <option value='Bike'>Bike</option>
                                        <!-- <option value='Car'>Car</option>
                                        <option value='Auto Rikshaw'>Auto Rikshaw</option> -->
                                    </select>
                                </div>
                                <p>Select Image</p>
                                <div class='input'>
                                    <i class="fa-solid fa-image"></i>
                                    <input type='file' name='brand_img' required>
                                </div>
                                <p>Select Status</p>
                                <div class='input'>
                                    <i class="fa-sharp fa-solid fa-battery-full"></i>
                                    <select name='brand_Status'>
                                        <option value='Active'>Active</option>
                                        <option value='In Active'>In Active</option>
                                    </select>
                                </div>
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_brand' type='submit' name='add_brand'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
                <details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary refresh_add' onclick="get_vehicle_part()"><i class="fa-solid fa-circle-plus"></i> Add Vehicle</summary>
                    <div class='pop_up'>
                        <form class='form min_width_form' id='add_vehicle' enctype='multipart/form-data'>
                            <h2>Add Vehicle <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <div class='input_container'>
                                    <p>Select Brand</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-copyright"></i>
                                        <select name='vehicle_brand' required class="refresh_brand"></select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Model Type</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-t"></i>
                                        <select name='model_type' required>
                                            <option value="Scooter">Scooter</option>
                                            <option value="Motorcycle">Motorcycle</option>
                                            <option value="Street Bike">Street Bike</option>
                                            <option value="Cruisers">Cruisers</option>
                                            <option value="Adventure Tourers">Adventure Tourers</option>
                                            <option value="Dirt Bike">Dirt Bike</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Fuel</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-gas-pump"></i>
                                        <select name='vh_fuel' required>
                                            <option value="Petrol">Petrol</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Electric">Electric</option>
                                            <option value="CNG">CNG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle Model Name</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-bicycle"></i>
                                        <input type='text' name='model_name' placeholder="Model Name" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle Manufacture Year</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-y"></i>
                                        <input type='text' name='mg_yr' placeholder="Manufacture Year" required/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle CC</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-c"></i>
                                        <input type='text' name='vh_cc' placeholder="Model CC" required/>
                                    </div>
                                </div>
                                <input type='hidden' name='vehicle_add' />
                                <div class='input_container'>
                                    <p>Select Image</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-image"></i>
                                        <input type='file' name='vehicle_img' >
                                    </div>
                                </div>    
                                <!--<div class='input_container'>
                                    <p>Select Part</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <select name='part' class="vehicle_part_name">
                                            <option value="">Select Part</option>
                                            
                                        </select>
                                    </div>
                                </div> 
                                <div class="input_container">
                                    <h3 class='pop_up_open pop_up_summary vehicle_part_add'><i class='fa-solid fa-pen-to-square'></i> Add Parts</h3>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Date</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='date' name='vh_date' />
                                    </div>
                                </div> --><br clear="all">                            
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_vehicle' type='submit' name='add_vehicle'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center><br clear="all" />
                                <!-- <table class="item_table" cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Part Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class='vehicle_part_table'></tbody>
                                </table> -->
                            </div>
                        </form>
                    </div>
                </details>
                <input type='text' class='search_input by_name' title='Search By Part Code, Name, Brand, Model & Category' onkeyup='get_parts()' placeholder='Search By Part Code, Name, Brand, Model & Category' />
            </div>
            <div class='table_container'>
                <table class='item_table'  cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Part Code</th>
                            <th>Brand Name</th>
                            <th>Model Name</th>
                            <th>Category</th>
                            <th>Part Name</th>
                            <th>Part HSN</th>
                            <th>Image</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th style='text-align:center'>Edit</th>
                        </tr>
                    </thead>
                    <tbody class='get_parts_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_parts();
    function get_parts() {
        var get_parts = "Get Parts";
        var by_name = $('.by_name').val();
        $.ajax({
            url: 'assets/parts_jscript.php',
            method: 'post',
            data: {get_parts:get_parts,by_name:by_name},
            success: function(data) {
                $('.get_parts_table').html(data);
            }
        });
    }
    $(document).on('submit','#add_part',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/parts_jscript.php',
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
                $('.form').find('input').val('');
                get_parts();
            }
        });
    });
    $(document).on('submit','#part_up',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/parts_jscript.php',
            type:'post',
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            data:new FormData(this),
            beforeSend:function(){
                $('.part_up').attr('disabled','disabled');
            },
            success:function(data){
                alert(data);
                $('.part_up').removeAttr('disabled');
                $('.details_open').removeAttr("open");
            
                get_parts();
            }
        });
    });
    $(document).on('click','.up_open',function(){
        var part_up_open=$(this).attr("data-id");
        $.ajax({
            url:'assets/parts_jscript.php',
            method:'post',
            data:{part_up_open:part_up_open},
            success:function(data){
                $('.part_open_table').html(data);
            }
        });
    });
    $(document).on('change','.part_brand',function(){
        var change_brand=$(this).val();
        $.ajax({
            url:'assets/parts_jscript.php',
            method:'post',
            data:{change_brand:change_brand},
            success:function(data){
                $('.part_model').html(data);
            }
        });
    }); 
    $(document).on('click','.refresh_add',function(){
        var refresh_brand="Refresh Brand"
        $.ajax({
            url:'assets/parts_jscript.php',
            method:'post',
            data:{refresh_brand:refresh_brand},
            success:function(data){
                $('.refresh_brand').html(data);
            }
        });
    });
    $(document).on('click','.refresh_add',function(){
        var refresh_model="Refresh Model"
        $.ajax({
            url:'assets/parts_jscript.php',
            method:'post',
            data:{refresh_model:refresh_model},
            success:function(data){
                $('.refresh_model').html(data);
            }
        });
    });
</script>
