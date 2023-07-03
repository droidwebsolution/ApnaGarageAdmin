<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apna garage | Brand</title>
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
        ?>
           <div id='container'>
            <div class='search_filter'>
                <details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary'><i class="fa-solid fa-circle-plus"></i> Add New</summary>
                    <div class='pop_up'>
                        <form class='form small_width_form' id='add_brand'>
                            <h2>Add Brand <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <p>Enter Brand Code</p>
                                <div class='input'>
                                    <i class="fa-solid fa-code"></i>
                                    <input type='text' name='brand_code' placeholder='* your Brand code' />
                                </div>
                                <p>Enter Brand Name</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='brand_name' placeholder='* Only Characters Allowed' title='Enter Brand Name' />
                                </div>
                                <input type='hidden' name='brand_add' /> 
                                <p>Selct Category</p>
                                <div class='input'>
                                    <i class="fa-solid fa-list"></i>
                                    <select name='brand_category'>
                                        <option value=''>Bike</option>
                                        <option value=''>Car</option>
                                    <option>Auto Rikshaw</option>
                                    </select>
                                </div>
                                <p>Select Image</p>
                                <div class='input'>
                                    <i class="fa-solid fa-image"></i>
                                    <input type='file' name='brand_img'>
                                </div>
                                <p>Select Status</p>
                                <div class='input'>
                                    <i class="fa-sharp fa-solid fa-battery-full"></i>
                                    <select name='brand_Status'>
                                        <option value=''>Active</option>
                                        <option value=''>In Active</option>
                                    </select>
                                </div>
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_brand' type='submit' name='add_brand'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right pop_up_cancel'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
                <input type='text' class='search_input by_name' onkeyup='get_brand()' placeholder='Search By Name and code' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Brand code</th>
                            <th>Brand Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Satus</th>
                            <th style='text-align:center'>Action</th>
                        </tr>
                    </thead>
                    <tbody class='get_brand_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
 <script>
    get_brand();
    function get_brand() {
        var get_brand = "Get Subscription";
        var by_name = $('.by_name').val();    
        $.ajax({
            url: 'assets/company_jscript.php',
            method: 'post',
            data: {get_brand: get_brand,by_name: by_name},
            success: function(data) {
            $('.get_brand_table').html(data);
            }
        });
    }
    $(document).on('submit','#add_brand',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/company_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_brand').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                $('.details_open').removeAttr("open");
                $('.add_brand').removeAttr('disabled');
                $('.form').find('input').val('');
                get_brand();
            }
        });
    });
    $(document).on('click','.brand_open',function(){
        var brand_open_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/brand_jscript.php',
            method:'post',
            data:{brand_open_table:brand_open_table},
            success:function(data){
                $('.brand_open_table').html(data);
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
</script>