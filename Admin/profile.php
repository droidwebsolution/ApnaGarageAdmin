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
            <form id='update_admin' method='post'>
                <h2>Update Your Credentials</h2>
                <div class='pop_up_margin'>
                    <p>Enter Your Current Password If You Want To Change Anything</p>
                    <div class='input'>
                        <i class='fas fa-th-list'></i>
                        <input type='password' name='admin_password' class='clear' placeholder='Enter Your Current Password' required>	
                    </div>
                    <p>Update Your Email</p>
                    <div class='input'>
                        <i class='fas fa-th-list'></i>
                        <input type='email' name='admin_email' placeholder='Enter Employee Email' value="<?php echo encrypt_decrypt('decrypt', $_SESSION['adsesmail']); ?>" required />
                    </div>
                    <p>Enter New Password If You Want To Change</p>
                    <div class='input'>
                        <i class='fas fa-th-list'></i>
                        <input type='password' name='admin_password1' class='clear' placeholder='Enter Employee Password'>	
                    </div>
                    <p>ReEnter New Password</p>
                    <div class='input'>
                        <i class='fas fa-th-list'></i>
                        <input type='password' name='admin_password2' class='clear' placeholder='ReEnter Employee Password'>
                    </div>
                    <center>
                        <button type='reset' style='font-weight:800; font-size:12px; height:40px; width:140px' class='update_admin pop_up_submit'><i class='fas fa-redo-alt'></i> Reset</button>
                        <button type='submit' name='update_admin' class='update_admin pop_up_submit' style='font-weight:800; font-size:12px; height:40px; width:140px'><i class='fas fa-save'></i> Update Admin</button>
                    </center>
                </div>
            </form>
        </div>
    </body>
</html>
<script src='js/comman.js'></script>
<?php
    if(isset($_POST['update_admin'])){
        $email=encrypt_decrypt('decrypt', $_SESSION['adsesmail']);
        $ag_admin_password=encrypt_decrypt('encrypt',$_POST['admin_password']);
        
        $ag_admin_email=$_POST['admin_email'];
        $new_pass1=$_POST['admin_password1'];
        $new_pass2=$_POST['admin_password2'];
        
        $check_cur_pass="select ag_admin_email,ag_admin_password from ag_admin where ag_admin_email=:ag_admin_email and ag_admin_password=:ag_admin_password limit 1";
        $cur_pass_check=$con->prepare($check_cur_pass,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $cur_pass_check->bindParam(':ag_admin_email',$ag_admin_email);
        $cur_pass_check->bindParam(':ag_admin_password',$ag_admin_password);
        $cur_pass_check->setFetchMode(PDO::FETCH_ASSOC);
        $cur_pass_check->execute();
        $count_emp=$cur_pass_check->rowCount();
        if($count_emp == 0){
            echo"<script>alert('You Entered Wrong Current Password')</script>";
        }else{
            if(empty($new_pass1) && empty($new_pass2)){
                $up_stat="update ag_admin set ag_admin_email=:ag_admin_email";
                $stat_up=$con->prepare($up_stat,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $stat_up->bindParam(':ag_admin_email',$ag_admin_email);
                if($stat_up->execute()){
                    echo"<script>alert('Email Has Been Updated Successfully')</script>";
                }else{
                    echo"<script>alert('Something Went Wrong Try Again')</script>";
                }
            }else{
                if($new_pass1 !== $new_pass2){
                    echo"<script>alert('Password Does Not Matched')</script>";
                }else{
                    if(mb_strlen($new_pass2) < 8){
                        echo"<script>alert('Password Must Be Greater Than 8 Characters')</script>";
                    }else{
                        $emp_pass=encrypt_decrypt('encrypt', $new_pass1);
                        $up_stat="update ag_admin set ag_admin_email=:ag_admin_email,ag_admin_password=:ag_admin_password";
                        $stat_up=$con->prepare($up_stat,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $stat_up->bindParam(':ag_admin_email',$ag_admin_email);
                        $stat_up->bindParam(':ag_admin_password',$emp_pass);
                        if($stat_up->execute()){
                            echo"<script>
                                    alert('Credentials Has Been Updated Successfully');
                                    window.open('logout.php','_self')
                                </script>";
                        }else{
                            echo"<script>alert('Something Went Wrong Try Again')</script>";
                        }
                    }
                }
            }
        }
    }
?>