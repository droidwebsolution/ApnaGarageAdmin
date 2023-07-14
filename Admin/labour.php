<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apna garage | Labour </title>
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
                    <summary class='pop_up_open pop_up_summary refresh_add' onclick="get_service_cart()"><i class="fa-solid fa-circle-plus"></i> Add New</summary>
                    <div class='pop_up'>
                        <div class='form min_width_form'>
                            <h2>Add Labour <i class='fa-solid fa-xmark close_pop_up' title='Close'></i></h2>
                            <div class='form_container'>
                                <div class='tabs'>
                                    <!-- in service tab start -->
                                    <input type='radio' id='in_service' name='service_tab' checked='checked'>
                                    <label for='in_service'>In Service</label>
                                    <form id='labor_in_service' class='content'>
                                        <div class='input_container'>
                                            <p>Select Brand</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-copyright"></i>
                                                <select name='vehicle_brand'  class="refresh_brand"></select>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Select Model</p>
                                            <div class='input'>
                                                <i class="fa-sharp fa-regular fa-motorcycle"></i>
                                                <select name='vehicle_model'  class="refresh_model"></select>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Labour Name</p>
                                            <div class='input'>
                                                <i class="fa-brands fa-servicestack"></i>
                                                <input type='text' name='labour_name' placeholder="Labour Name" />
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Labour Rate</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-rupee-sign"></i>
                                                <input type='text' name='labour_rate' placeholder="Labour Rate" />
                                            </div>
                                        </div>
                                        <input type='hidden' name='out_rate' value='0' class='out_rate' />
                                        <div class='input_container'>
                                            <p>Select Tax</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-rupee-sign"></i>
                                                <select name='labour_tax' required>
                                                    <option value="12%">12%</option>
                                                    <option value="18%">18%</option>
                                                    <option value="20%">20%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Total Amount</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-rupee-sign"></i>
                                                <input type='text' name='total' readonly style='cursor:not-allowed' placeholder="Toatl Amount" />
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Before Tax Rate</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-rupee-sign"></i>
                                                <input type='text' name='before_tax' placeholder="Before Tax Rate" />
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Select Part</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                                <select name='labour_part' class='labour_part'>
                                                    <option value=''>Select labour</option>
                                                    <?php echo get_parts(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="input_container">
                                            <br/>
                                            <button class='pop_up_submit add_labour_parts' type='button' name='add_labour_parts'>Add Parts</button>
                                        </div><br clear="all" />
                                        <center>
                                            <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                            <button class='pop_up_submit add_vehicle' type='submit' name='add_vehicle'><i class='fa-solid fa-save'></i> Save</button>
                                            <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                        </center>
                                        <div class="table_container">
                                            <table class="item_table" cellspacing='0'>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Part Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody class='service_part_table'></tbody>
                                            </table>
                                        </div>
                                    </form>
                                    <!-- in service tab end -->
                                    <!-- out service tab start -->
                                    <input type='radio' id='out_service' name='service_tab'>
                                    <label for='out_service'>Out Service</label>
                                    <form id='labor_out_service' class='content'>
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
                                            <p>Enter Labour Name</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-bicycle"></i>
                                                <input type='text' name='labour_name' placeholder="Labour Name" required/>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Labour Rate</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-bicycle"></i>
                                                <input type='text' name='labour_rate' placeholder="Labour Rate" required/>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Select Tax</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-gas-pump"></i>
                                                <select name='labour_tax' required>
                                                    <option value="12%">12%</option>
                                                    <option value="18%">18%</option>
                                                    <option value="20%">20%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Total Amount</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-bicycle"></i>
                                                <input type='text' name='total' placeholder="Toatl Amount" required/>
                                            </div>
                                        </div>
                                        <div class='input_container'>
                                            <p>Enter Before Tax Rate</p>
                                            <div class='input'>
                                                <i class="fa-solid fa-y"></i>
                                                <input type='text' name='before_tax' placeholder="Before Tax Rate" required/>
                                            </div>
                                        </div><br clear="all" />
                                        <center>
                                            <button class='pop_up_submit' type='reset'><i class='fa-solid fa-rotate-right'></i> Reset</button>
                                            <button class='pop_up_submit add_vehicle' type='submit' name='add_vehicle'><i class='fa-solid fa-save'></i> Save</button>
                                            <button class='pop_up_submit close_submit' type='button'><i class='fa-solid fa-xmark' title='Close'></i> Cancel</button>
                                        </center>
                                    </form>
                                    <!-- out service tab end -->
                                </div><br clear="all">                            
                            </div>
                        </div>
                    </div>
                </details>
                <details class='details_open' style='display:inline-block'>
                    <summary class='pop_up_open pop_up_summary' style='background:rgb(0,0,0,0.5)'><i class="fa-solid fa-circle-plus"></i> Add Brand</summary>
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
                <input type='text' class='search_input by_name' onkeyup='get_vehicle()' placeholder='Search By Any Column' />
            </div>
            <div class='table_container'>
                <table class='item_table' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Labour code.</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Labour Name</th>
                            <th>Rate</th>
                            <th>Out Rate</th>
                            <th>Part 1</th>
                            <th>Part 2</th>
                            <th>Part 3</th>
                            <th>Part 4</th>
                            <th style='text-align:center'>Action</th>
                        </tr>
                    </thead>
                    <tbody class='get_labour_table'></tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<script>
    function get_service_cart(){
        var get_service_cart="Get Service Cart";
        $.ajax({
            url:'assets/labour_jscript.php',
            method:'post',
            data:{get_service_cart:get_service_cart},
            success:function(data){
                $('.service_part_table').html(data);
            }
        });
    }
    $(document).on('click','.add_labour_parts',function(){
        var add_labour_parts=$('.labour_part').val();
        var out_rate=$('.out_rate').val();
        $.ajax({
            url:'assets/labour_jscript.php',
            method:'post',
            data:{add_labour_parts:add_labour_parts,out_rate:out_rate},
            success:function(data){
                $('.labour_part').val('');
                $('.out_rate').val('0');
                get_service_cart();
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