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
        <title>Apna garage | City</title>
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
                        <form class='form small_width_form' id='add_city'>
                            <h2>Add City <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <p>Select state</p>
                                <div class='input'>
                                    <i class='fa-solid fa-user'></i>
                                    <select name='state' required>
                                        <option value="">Select State</option>
                                        <?php echo get_state(); ?>
                                    </select>
                                </div>
                                <p>Enter City Name</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='city_name' placeholder='* Only Characters Allowed' title='Enter City Name' required/>
                                </div>
                                <input type='hidden' name='city_add' /> 
                               
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_city' type='submit' name='add_city'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
                <input type='text' class='search_input by_name' onkeyup='get_city()' placeholder='Search By Name ' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th style='text-align:center'>Action</th>
                        </tr>
                    </thead>
                    <tbody class='get_city_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
 <script>
    get_city();
    function get_city() {
        var get_city = "Get City";
        var by_name = $('.by_name').val();    
        $.ajax({
            url: 'assets/city_jscript.php',
            method: 'post',
            data: {get_city: get_city,by_name: by_name},
            success: function(data) {
            $('.get_city_table').html(data);
            }
        });
    }
    $(document).on('submit','#add_city',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/city_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_city').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                $('.details_open').removeAttr("open");
                $('.add_city').removeAttr('disabled');
                $('.form').find('input').val('');
                get_city();
            }
        });
    });
    $(document).on('click','.city_open',function(){
        var city_open_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/city_jscript.php',
            method:'post',
            data:{city_open_table:city_open_table},
            success:function(data){
                $('.city_open_table').html(data);
            }
        });
    });
    $(document).on('submit','#city_up',function(e){
            e.preventDefault();
            $.ajax({
                url:'assets/city_jscript.php',
                type:'post',
                dataType:'json',
                cache: false,
                contentType: false,
                processData: false,
                data:new FormData(this),
                beforeSend:function(){
                    $('.city_up').attr('disabled','disabled');
                },
                success:function(data){
                    alert(data);
                    $('.city_up').removeAttr('disabled');
                    $('.details_open').removeAttr("open");
                    get_city();
                }
            });
        });            
</script>