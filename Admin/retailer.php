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
        <title>Apna garage | Retailer</title>
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
                <input type='text' class='search_input by_name' onkeyup='get_retailer()' placeholder='Search By Company Name & code' />
                <!-- <input type='text' class='search_input by_name' onkeyup='get_vehicle()' placeholder='Search By Name' /> -->
            </div>
            <div class='table_container'>
                <table class='item_table big_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Retailer Code</th>
                            <th>Company Name</th>
                            <th>Owner Name</th>
                            <th>Company Mobile No</th>
                            <th>Company Alt Mobile No</th>
                            <th>Company Email Id</th>
                            <th>Company Website</th>
                            <th>Company GST No</th>
                            <th>Company TIN No</th>
                            <th>Contact Person Name</th>
                            <th>Contact Person Phone</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Registration Date</th>
                            <th style='text-align:center'>Remaing To Pay</th>
                            <th style='text-align:center'>Action</th>
                            <th style='text-align:center'>History</th>
                        </tr>
                    </thead>
                    <tbody class='get_retailer_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    get_retailer();
    function get_retailer() {
        var get_retailer = "Get Retailer";
        var by_name = $('.by_name').val();
        $.ajax({
            url: 'assets/retailer_jscript.php',
            method: 'post',
            data: {get_retailer:get_retailer,by_name:by_name},
            success: function(data) {
                $('.get_retailer_table').html(data);
            }
        });
    }
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
                get_retailer();
            }
        });
    });
    $(document).on('click','.retailer_open',function(){
        var retailer_open_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/retailer_jscript.php',
            method:'post',
            data:{retailer_open_table:retailer_open_table},
            success:function(data){
                $('.retailer_open_table').html(data);
            }
        });
    });
    $(document).on('click','.retailer_history_open',function(){
        var retailer_history_table=$(this).attr("data-id");
        $.ajax({
            url:'assets/retailer_jscript.php',
            method:'post',
            data:{retailer_history_table:retailer_history_table},
            success:function(data){
                $('.retailer_history_table').html(data);
            }
        });
    });
    $(document).on('submit','#retailer_up',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/retailer_jscript.php',
            type:'post',
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            data:new FormData(this),
            beforeSend:function(){
                $('.retailer_up').attr('disabled','disabled');
            },
            success:function(data){
                alert(data);
                $('.retailer_up').removeAttr('disabled');
                $('.details_open').removeAttr("open");
                get_retailer();
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
    $(document).on('submit','#add_pending_amount',function(e){
        e.preventDefault();
        $.ajax({
            url:'assets/retailer_jscript.php',
            method:'post',
            cache:false,
            contentType:false,
            processData:false,
            dataType:'json',
            beforeSend:function(){
                $('.add_pending_amount').attr('disabled','disabled');
            },
            data:new FormData(this),
            success:function(data){
                alert(data);
               // $('.details_open').removeAttr("open");
                $('.add_pending_amount').removeAttr('disabled');
                $('.form').find('input').val('');
                get_retailer();
            }
        });
    });
</script>