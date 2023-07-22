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
        <title>Apna garage | Manufecture Company</title>
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
                        <form class='form small_width_form' id='add_mg_company'>
                            <h2>Add Menufecture Comapny <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                
                                <p>Enter Manufecture Company</p>
                                <div class='input'>
                                    <i class="fa-solid fa-copyright"></i>
                                    <input type='text' name='mg_company_name' placeholder='* Only Characters Allowed' title='Enter Manufecture Company' required />
                                </div>
                                <input type='hidden' name='mg_company_add' /> 
                               
                                <center>
                                    <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                    <button class='pop_up_submit add_mg_company' type='submit' name='add_mg_company'><i class='fa-solid fa-save'></i> Save</button>
                                    <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </details>
                <input type='text' class='search_input by_name' onkeyup='get_mg_company()' placeholder='Search By Name ' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Menufecture Company Code.</th>
                            <th>Menufecture Company Name</th>
                            <th style='text-align:center'>Action</th>
                        </tr>
                    </thead>
                    <tbody class='get_mg_company_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
 <script>
    get_mg_company();
    function get_mg_company() {
        var get_mg_company = "Get menufecture company";
        var by_name = $('.by_name').val();    
        $.ajax({
            url: 'assets/mg_company_jscript.php',
            method: 'post',
            data: {get_mg_company: get_mg_company,by_name: by_name},
            success: function(data) {
            $('.get_mg_company_table').html(data);
            }
        });
    }
    $(document).on('submit','#add_mg_company',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/mg_company_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_mg_company').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
                //$('.details_open').removeAttr("open");
                $('.add_mg_company').removeAttr('disabled');
                $('.form').find('input').val('');
                get_mg_company();
            }
        });
    });
    $(document).on('click','.mg_company_open',function(){
        var mg_company_open_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/mg_company_jscript.php',
            method:'post',
            data:{mg_company_open_table:mg_company_open_table},
            success:function(data){
                $('.mg_company_open_table').html(data);
            }
        });
    });
    $(document).on('submit','#mg_company_up',function(e){
            e.preventDefault();
            $.ajax({
                url:'assets/mg_company_jscript.php',
                type:'post',
                dataType:'json',
                cache: false,
                contentType: false,
                processData: false,
                data:new FormData(this),
                beforeSend:function(){
                    $('.mg_company_up').attr('disabled','disabled');
                },
                success:function(data){
                    alert(data);
                    $('.mg_company_up').removeAttr('disabled');
                    $('.details_open').removeAttr("open");
                    get_mg_company();
                }
            });
        });          
</script>