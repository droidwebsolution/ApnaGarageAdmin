<?php
    $con=new pdo("mysql:host=Localhost;dbname=apna_g;charset=utf8","root","");
   
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>