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
                                        <select name='part_brand'>
                                            <option value="">Select Brand</option>
                                            <?php echo get_brand(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Model</p>
                                    <div class='input'>
                                        <i class="fa-sharp fa-regular fa-motorcycle"></i>
                                        <select name='part_model'>
                                            <option value="">Select Model</option>
                                            <?php echo get_vehicle(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Select Category</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-list"></i>
                                        <select name='part_cat' >
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
                                        <input type='text' name='part_name' placeholder="Part Name eg.foot rest"  />
                                    </div>
                                </div>
                                
                                <input type='hidden' name='part_add' />
                                <div class='input_container'>
                                    <p>Enter HSN</p>
                                    <div class='input'>
                                        <i class="fa-brands fa-digital-ocean"></i>
                                        <input type='text' name='part_hsn' placeholder="Only Digits Allowed" />
                                    </div>
                                </div>
                                <div class='input_container'>
                                    <p>Choose Part Image</p>
                                    <div class='input'>
                                        <i class="fa-solid fa-image"></i>
                                        <input type='file' name='part_img' />
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
                <input type='text' class='search_input by_name' onkeyup='get_parts()' placeholder='Search By Part Name and code' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
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
                $('.details_open').removeAttr("open");
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
                
</script>