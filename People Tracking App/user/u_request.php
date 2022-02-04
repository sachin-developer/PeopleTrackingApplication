<?php 
session_start();
require_once('../header/uheader.php'); 
if(!isset($_SESSION['email'])){
    header("Location:".$Login);
  }
if(isset($_REQUEST['submit'])){ // PHP Signup Validation Starts
    $errorArray = array();
    $valid = TRUE;
    $reason = $_REQUEST['reason'];
    $desc = $_REQUEST['description'];
    $from = $_REQUEST['from_date'];
    $to = $_REQUEST['to_date'];
    $file = $_FILES['doc']['tmp_name'];
    $fromLoc = $_REQUEST['from_location'];
    $toLoc = $_REQUEST['to_location'];
    $headCount = $_REQUEST['head_count'];

        if($headCount<=0){
            $headCount = 1;
        }

    //  Reason Validation
    if(strlen($reason)<=0){
        $reasonHelp = "<small id='reasonHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill proper reason...!</small>";
        array_push($errorArray,"reason");
        $valid = false;
      }
      if(strlen($desc)<=0){
        $descriptionHelp = "<small id='descriptionHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill proper description...!</small>";
        array_push($errorArray,"desc");
        $valid = false;
      }
      if(strlen($from)<=0){
        $fromDateHelp = "<small id='fromDateHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill proper from date...!</small>";
        array_push($errorArray,"from date");
        $valid = false;
      }
      if(strlen($to)<=0){
        $toDateHelp = "<small id='toDateHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill proper from date...!</small>";
        array_push($errorArray,"to date");
        $valid = false;
      }

      if(strlen($fromLoc)<=0){
        $fromLocationHelp = "<small id='fromLocationHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill from location...!</small>";
        array_push($errorArray,"from date");
        $valid = false;
      }
      if(strlen($toLoc)<=0){
        $toLocationHelp = "<small id='toLocationHelp' style='display:block;color:yellow;' class='form-text text-muted'>Make sure you fill to location...!</small>";
        array_push($errorArray,"to date");
        $valid = false;
      }
      
      // Inserting Data into DB
     if(count($errorArray)<=0 || $valid == true){
        $checkKey = "SELECT rf_key FROM request ORDER BY rf_key DESC LIMIT 1";
        $keyResult = mysqli_query($connection,$checkKey);
        $unique_keyCount = mysqli_fetch_array($keyResult);
        if($unique_keyCount > 0){
            $value =$unique_keyCount['rf_key'];
            $fetched_value = intval($value);
            $fetched_value = $fetched_value+1;
        }else{
           
            $fetched_value=100;
        }
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $salt = substr(str_shuffle($str_result), 0, 4);
        $rfid = $salt."-REQ-".$fetched_value;
        $userid = $_SESSION['userID'];
        if(TRUE){
        mkdir('../uploads/'.$rfid.'/');
        }
        $path = '../uploads/'.$rfid.'/';
        $count=0;
        foreach($_FILES['doc']['name'] as $key=>$val){
            move_uploaded_file($_FILES['doc']['tmp_name'][$key],$path.$rfid.'-'.$count.'.jpg');
            $count++;
        }
        date_default_timezone_set('Asia/Kolkata');
        $today = date('d-m-y h:i:s');
        $insertRequest = "INSERT INTO request(files,reason,description,status,from_date,to_date,rf_key,requested_on,rfid,user_id,from_location,to_location,head_count)
        VALUES('$file','$reason','$desc','PENDING','$from','$to','$fetched_value','$today','$rfid','$userid','$fromLoc','$toLoc','$headCount')";
        $success = mysqli_query($connection,$insertRequest);
        if ($success) {
          header("Location:".$Index);
      }else{
        echo "Please Enter Valid Details";
      }

     }

}
?>
            <div class="row requestForm" style="margin-top:150px">
                <div class="col-md-12 login-form-1" >
                    <h3>Raise a Request</h3>
                    <form method="POST" action="<?php $_SERVER["PHP_SELF"]?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" disabled id="name" name="name" class="form-control" placeholder="Name" value="<?= $_SESSION['name']?>" required  />
                            <?php if(isset($nameHelp)){ echo $nameHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email"  disabled id="email" name="email" class="form-control" placeholder="Email" value="<?= $_SESSION['email']?>"  required />
                            <?php if(isset($emailHelp)){ echo $emailHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <input type="text" id="reason" name="reason" class="form-control" placeholder="Reason for Permission"  required />
                            <?php if(isset($reasonHelp)){ echo $reasonHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea style="color:black;" name="description" id="description" cols="100" rows="10"></textarea>
                            <?php if(isset($descriptionHelp)){ echo $descriptionHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="from_date">From:</label>
                            <input type="date" id="from_date" name="from_date" class="form-control" min="<?= date("Y/m/d"); ?>"  required />
                            <?php if(isset($fromDateHelp)){ echo $fromDateHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="to_date">To:</label>
                            <input type="date" id="to_date" name="to_date" class="form-control"  min=""  required />
                            <?php if(isset($toDateHelp)){ echo $toDateHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="from_location">From Place:</label>
                            <input type="dtextate" id="from_location" name="from_location" class="form-control"  required />
                            <?php if(isset($fromLocationHelp)){ echo $fromLocationHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="to_location">To Place:</label>
                            <input type="text" id="to_location" name="to_location" class="form-control"   required />
                            <?php if(isset($toLocationHelp)){ echo $toLocationHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="head_count">Head Count:</label>
                            <input type="number" id="head_count" name="head_count" class="form-control" min=1   required />
                            <?php if(isset($headCountHelp)){ echo $headCountHelp;}?>
                        </div>
                        <div class="form-group">
                            <label for="files">Document:</label>
                            <input type="file" name="doc[]" id="files" multiple class="form-control" />
                            <?php if(isset($fileHelp)){ echo $fileHelp;}?>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="submit" value="Submit" />
                            <input type="reset" class="btn-warning" name="reset" value="Reset" />
                        </div>
                       
                    </form>
                </div>
            </div>
        <?php require_once('../header/footer.php'); ?>
