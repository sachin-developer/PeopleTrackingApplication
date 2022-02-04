<?php 
require_once('../header/uheader.php'); 
if(isset($_REQUEST['forgotsubmit'])){
    $errorArray = array();
      $valid = true;
  
    $email = $_REQUEST['email'];
  
    //Email validation
    if(strlen($email)<=0){
      $emailHelp = "<small id='emailHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill correct Email Id...!</small>";
      array_push($errorArray,"email");
      $valid = false;
    } 
  
    // Fetching User Data From DB
    if(count($errorArray)<=0 || $valid == true){
    $checkLogin = "SELECT * FROM `admin` WHERE `email` = '$email'";
    $result = mysqli_query($connection,$checkLogin);
    $user = mysqli_num_rows($result);
    if($user>0 && $user<2){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $salt = substr(str_shuffle($str_result), 0, 4);
        $key = password_hash($salt,PASSWORD_BCRYPT);
        $setCount = "INSERT INTO pwdrecovery(email,expire_count,hash_key)
        VALUES('$email',1,'$key')";

        $RunQuery = mysqli_query($connection,$setCount);
        if($RunQuery){

            $to_email = $email;
            $subject = "Password Recovery";
            $body = "<a href='http://localhost/People%20Tracking%20App/user/<?= $ResetPassword?email=$email&key=$salt?>'>Click To Reset The Password</a>";
            $headers = "From:fsd68team@yahoo.com";
          
            if ( mail($to_email, $subject, $body, $headers)) {
                $success = "Password Recovery Link successfully sent to $to_email...";
            } else {
                $fail = "Password Recovery Link sending failed...";
            }


        }else{
            echo "Crypting Error Raised Tray Again";
        }

    }else{
        echo("We didn't found email");
    }
   
  }
  }
?>
            <div class="row loginForm" style="margin-top:150px">
                <div class="col-md-12 login-form-1" >
                    <h3>Enter email to reset password</h3>
                    <form method="POST" action="<?php $_SERVER["PHP_SELF"]?>">
                        <div class="form-group">
                            <input type="text" name='email' class="form-control" placeholder="Your Email *"  />
                            <?php if(isset($emailHelp)){ echo $emailHelp;}?>
                          </div>
                        <div class="form-group">
                            <input type="submit" name="forgotsubmit" class="btnSubmit" value="Submit" />
                        </div>
                        <div class="form-group">
                            <a href="<?= $Login?>" class="ForgetPwd">Cancel!</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
            if(isset($success)){
                echo "<h1>$success</h1>";
            }
            if(isset($fail)){
                echo "<h1>$fail</h1>";
            }

            ?>
        <?php require_once('../header/footer.php'); ?>
