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
        <div class="wrapper">
            <!--Top menu -->
            <?php
                include("addons/header.php");
                include("addons/sidebar.php");
            ?>
        </div>
    </body>
</html>
 <script src='js/comman.js'></script>

