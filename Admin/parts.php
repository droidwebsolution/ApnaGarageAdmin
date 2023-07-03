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
                                        <input type='text' name='model_name'  />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle Model Type</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='model_type'/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle Menufecture Year</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='mg_yr' />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle CC</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='vh_cc'/>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Vehicle Fuel</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='text' name='vh_fuel' />
                                    </div>
                                </div>
                                <input type='hidden' name='item_add' />
                                <div class='input_container'>
                                    <p>Choose Vehicle Image</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='file' name='vh_img' />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Enter Date</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <input type='date' name='vh_date' />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Status</p>
                                    <div class='input'>
                                        <i class='fa-solid fa-user'></i>
                                        <select name='vehicle_status'>
                                            <option value="">Select Status</option>
                                            <option value='Active'>Active</option>
                                            <option value='InActive'>InActive</option>
                                        </select>
                                    </div>
                                </div><br clear="all">                            
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
                            <th style='text-align:center'>Edit</th>
                            <th>Status</th>
                            <th>Part Code</th>
                            <th>Part HSN</th>
                            <th>Part Name</th>
                            <th>Image</th>
                            <th>Brand Name</th>
                            <th>Part Qty</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th style='text-align:center'>Category</th>
                            <th>Added Date</th>
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
    // $(document).on('submit','#subs_up',function(e){
    //         e.preventDefault();
    //         $.ajax({
    //             url:'assets/subs_jscript.php',
    //             type:'post',
    //             dataType:'json',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             data:new FormData(this),
    //             beforeSend:function(){
    //                 $('.subs_up').attr('disabled','disabled');
    //             },
    //             success:function(data){
    //                 alert(data);
    //                 $('.subs_up').removeAttr('disabled');
    //                 $('.details_open').removeAttr("open");
                
    //                 get_subs();
    //             }
    //         });
    //     });
    // $(document).on('click','.subs_delete',function(){
    //         var subs_delete=$(this).attr("data-id");
    //         if(confirm('Are You Sure?')){
    //         $.ajax({
    //             url:'assets/subs_jscript.php',
    //             method:'post',
    //             data:{subs_delete:subs_delete},
    //             success:function(data){
    //                 get_subs();
    //             }
    //         });
    //         }else{
    //                 return false;
    //             }
    //     });
    // $(document).on('click','.up_open',function(){
    //     var subs_up_open=$(this).attr("data-id");
    //     $.ajax({
    //         url:'assets/subs_jscript.php',
    //         method:'post',
    //         data:{subs_up_open:subs_up_open},
    //         success:function(data){
    //             $('.up_open_table').html(data);
    //         }
    //     });
    // });
                
</script>