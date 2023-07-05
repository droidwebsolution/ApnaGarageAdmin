<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apna garage | Vehicle</title>
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
                    <form class='form min_width_form' id='add_vehicle' enctype='multipart/form-data'>
                        <h2>Add Vehicle <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                        <div class='form_container'>
                            <div class='input_container'>
                                <p>Select Brand</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='vehicle_brand'>
                                        <option value="">Select Brand</option>
                                        <?php echo get_brand(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Vehicle Model Name</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='text' name='model_name' placeholder="Model Name" />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Select Model Type</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='vehicle_type'>
                                        <option value="">Scooter</option>
                                        <option value="">Bike</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class='input_container'>
                                <p>Enter Vehicle Menufecture Year</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='text' name='mg_yr' placeholder="Menufecture Year" />
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Enter Vehicle CC</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='text' name='vh_cc' placeholder="Model CC"/>
                                </div>
                            </div>
                            <div class='input_container'>
                                <p>Select Fuel</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='vh_fuel'>
                                        <option value="">Petrol</option>
                                        <option value="">Diesel</option>
                                        <option value="">Electric</option>
                                        <option value="">CNG</option>
                                    </select>
                                </div>
                            </div>
                            <input type='hidden' name='vehicle_add' />
                            <div class='input_container'>
                                <p>Select Part</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='part'>
                                        <option value="">Select Part</option>
                                        <?php echo get_parts(); ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="input_container">
                                <details class='details_open' style='display:inline-block;margin-top:22px'>
                                    <summary class='pop_up_open pop_up_summary part_add_open'><i class='fa-solid fa-pen-to-square'></i> Add Parts</summary>
                                    <div class='pop_up Part_add_open_table'></div>
                                </details>
                            </div>
                            <!-- <div class='input_container'>
                                <p>Enter Date</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <input type='date' name='vh_date' />
                                </div>
                            </div> --><br clear="all">                            
                            <center>
                                <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                <button class='pop_up_submit add_vehicle' type='submit' name='add_vehicle'><i class='fa-solid fa-save'></i> Save</button>
                            </center>
                        </div>
                    </form>
                </div>
                </details>
                <input type='text' class='search_input by_name' onkeyup='get_vehicle()' placeholder='Search By Name and code' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Model Name</th>
                            <th>Model Type</th>
                            <th>Brand Name</th>
                            <th>Menufecture Year</th>
                            <th>Vehicle CC</th>
                            <th style='text-align:center'>Parts</th>
                            <th>Fuel Type</th>
                            <th>Image</th>
                            <th>Added Date</th>
                            <th style='text-align:center'>Action</th>
                        </tr>
                    </thead>
                    <tbody class='get_vehicle_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_vehicle();
    function get_vehicle() {
        var get_vehicle = "Get Vehicle";
        var by_name = $('.by_name').val();
        $.ajax({
            url: 'assets/vehicle_jscript.php',
            method: 'post',
            data: {get_vehicle:get_vehicle,by_name:by_name},
            success: function(data) {
                $('.get_vehicle_table').html(data);
            }
        });
    }
    $(document).on('submit','#add_vehicle',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/vehicle_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_vehicle').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                $('.details_open').removeAttr("open");
                $('.add_vehicle').removeAttr('disabled');
                $('.form').find('input').val('');
                get_vehicle();
            }
        });
    });

    $(document).on('click','.up_open',function(){
        var vehicle_up_open=$(this).attr("data-id");
        $.ajax({
            url:'assets/vehicle_jscript.php',
            method:'post',
            data:{vehicle_up_open:vehicle_up_open},
            success:function(data){
                $('.vehicle_open_table').html(data);
            }
        });
    });
    $(document).on('click','.part_add_open',function(){
        var part_add_open=$(this).attr("data-id");
        $.ajax({
            url:'assets/vehicle_jscript.php',
            method:'post',
            data:{part_add_open:part_add_open},
            success:function(data){
                $('.part_add_open_table').html(data);
            }
        });
    });
                
</script>