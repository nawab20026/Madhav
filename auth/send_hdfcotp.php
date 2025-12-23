<?php include "header.php"; ?>
<?php
if(isset($_POST['Verify'])){
    
   
    if ($userdata['hdfc_connected']=="Yes"){
        
         
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

    
    function curlGet2($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }
    $no =$_REQUEST['hdfc_mobile'];
    $url = 'https://'.$server.'/HDFCSoft/login.php?no='.$no.'';
$response = curlGet2($url);
$json = json_decode($response,true);
$status=$json["status"];
$respMessage=$json["respMessage"];
$sessionId=$json["sessionId"];
$deviceid=$json["deviceid"];
if($status == 'Success'){
    
    
    
    
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



?>


<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">UPI Settings</h4>
						<div class="row row-card-no-pd">
							<div class="col-md-12">

<form method="POST" action="hdfc_verify.php" class="mb-2">


            
<div class="row" id="merchant">
   
    <div class="col-md-4 mb-2"> 
        <label>Enter OTP</label> 
        <input type="number" name="OTP" placeholder="Enter OTP" class="form-control"  required=""> 
    </div>
    <div class="col-md-4 mb-2"> 
        <label>Enter PIN</label> 
        <input type="number" name="PIN" placeholder="Enter PIN" class="form-control"  required=""> 
    </div>
    <input type="hidden" class="form-control" id="number" name="number" value="<?php echo $no; ?>">
    <input type="hidden" class="form-control" id="number" name="UPI" value="<?php echo ''; ?>">
    <input type="hidden" class="form-control" id="user_token" name="user_token" value="<?php echo $userdata['user_token']; ?>"><br><br>
    <input type="hidden" class="form-control" id="seassion" name="seassion" value="<?php echo $sessionId; ?>"><br><br>
    <input type="hidden" class="form-control" id="deviceid" name="deviceid" value="<?php echo $deviceid; ?>"><br><br>



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
}


            ?>