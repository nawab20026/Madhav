<?php 
include "header.php";
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";
include "../phnpe/index.php";
?>
<?php




if(isset($_POST['Verify'])){
    

    
    $no =$_REQUEST['phonepe_mobile'];
    
   
    if ($userdata['phonepe_connected']=="Yes"){
        
         
        // Show SweetAlert2 error message
      echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
Swal.fire({
icon: "error",
title: "Merchant Already Connected !!",
showConfirmButton: true, // Show the confirm button
confirmButtonText: "Ok!", // Set text for the confirm button
allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
}).then((result) => {
if (result.isConfirmed) {
window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
}
});
</script>';
exit;



}
    
     $sendotpresult=sentotp(1,$no,0,0,0);
      //  echo $sendotpresult;
        
              $json0=json_decode($sendotpresult,1);
$otpSended=$json0["otpSended"];
$phoneNumber=$json0["phoneNumber"];
$token=$json0["token"];
$device=$json0["device"];

   
   
   
if($otpSended == 'true'){
    
    
    
    
   // Show SweetAlert2 success message
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        title: "Your OTP Has Been Sent!!",
        text: "Please click Ok button!!",
        icon: "success",
        confirmButtonText: "Ok"
    });
</script>';

}


else{
    
          // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "OTP Error!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';
exit;
}
   
   
?>


<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">UPI Settings</h4>
						<div class="row row-card-no-pd">
							<div class="col-md-12">

<form method="POST" action="phonepe_verify.php" class="mb-2">


            
<div class="row" id="merchant">
   
    <div class="col-md-4 mb-2"> 
        <label>Enter OTP</label> 
        <input type="number" name="otp" placeholder="Enter OTP" class="form-control"  required=""> 
    </div>
    
    <input type="hidden" class="form-control" id="number" name="number" value="<?php echo $no; ?>">
    <input type="hidden" class="form-control" id="number" name="upi" value="<?php echo ''; ?>">
    <input type="hidden" name="user_token" value="<?php echo htmlspecialchars($userdata['user_token'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>
<input type="hidden" name="no" value="<?php echo htmlspecialchars($phoneNumber, ENT_QUOTES, 'UTF-8'); ?>"><br><br>
<input type="hidden" name="otp_toekn" value="<?php echo htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>"><br><br>
<input type="hidden" name="device_data" value="<?php echo htmlspecialchars($device, ENT_QUOTES, 'UTF-8'); ?>"><br><br>

    


    <div class="col-md-4 mb-2"> 
        <label>&nbsp;</label> 
        <button type="submit" name="verifyotp" class="btn btn-primary btn-block">Verify OTP</button> 
    </div>
</div>

</form>	

























<?php




}else{
    
    
    // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "'.$respMessage.'!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "upisettings" when the user clicks the confirm button
        }
    });
</script>';

    //exit;
    
    
    
    
    
    
   
}



            ?>