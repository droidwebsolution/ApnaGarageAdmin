<?php
    session_start();
    if(!isset($_SESSION['adsesmail'])){
        header("Location:login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apna Garage</title>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" ></script>
    </head>
    <body>
      
            <!--Top menu -->
            <?php
                include("addons/header.php");
                include("addons/sidebar.php");
                include("addons/apna_garage.php");
                include("addons/logic.php");
            ?>
            <div id='container'>
                <div class="dcard" style='background: #253347;'>
                    <p>Present Stock Invest Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo get_expense(); ?></p>
                    <a href="sales_report.php"><i class="fa-solid fa-book"></i></a>
                </div>     
                <div class="dcard" style='background: #ef7d19;'>
                    <p>Total Selling Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo get_selling(); ?></p>
                </div>     
                <div class="dcard" style='background: #aaaaff;'>
                    <p>Total Retailer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php  echo get_retailer_count(); ?></p>
                </div>     
            </div>
    </body>
</html>
 <script src='js/comman.js'></script>

