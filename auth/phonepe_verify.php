<?php 
include "header.php";
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";
include "../phnpe/index.php";
?>
<?php
if(isset($_POST['verifyotp'])){
    
    // Use $_POST to retrieve data

$otp = sanitizeInput($_POST["otp"]);
$numbero = sanitizeInput($_POST["no"]);
$upi = sanitizeInput($_POST["upi"]);
$otp_toekn = sanitizeInput($_POST["otp_toekn"]);
$device_data = sanitizeInput($_POST["device_data"]);



$user_token = sanitizeInput($_POST['user_token']);
        // Now $user_token contains the value from the hidden input field

     ##########otpverfy####################3
        $otpferfyy=sentotp("2",$numbero,$otp,$otp_toekn,$device_data);
      // echo $otpferfyy;
       
       
$json0=json_decode($otpferfyy,1);
              //db save value
 $message=$json0["message"];
 $messages=$json0["messages"];
 $phoneNumber=$json0["number"];
 $userId=$json0["userId"];
 $token=$json0["token"];
$refreshToken=$json0["refreshToken"];
$name=$json0["name"];
$device_datar=$json0["device_data"];
//save db end//
  $b=json_decode($otpferfyy);
  
 // echo $otpferfyy;
######################################3

if($message=="success"){
$sql = "UPDATE users SET upi_id='$upi' WHERE user_token='$user_token'";
setXbyY($sql); 






$sql = "DELETE FROM phonepe_tokens WHERE user_token='$user_token'";
if ($conn->query($sql) === TRUE) {}

$bbbyteuserid=$_SESSION['user_id'];

$sql = "INSERT INTO phonepe_tokens (user_token, phoneNumber, userId, token, refreshToken, name, device_data, user_id)
VALUES ('$user_token', '$phoneNumber', '$userId', '$token', '$refreshToken', '$name', '$device_data', $bbbyteuserid)";
if ($conn->query($sql) === TRUE) {}


    $i=0;
echo '<center><h2>Select Your Store</h2>';
while($b->{'userGroupNamespace'}->{'All'}[$i]->{'merchantName'})

{
    
  echo  $unitId = ($b->{'userGroupNamespace'}->{'All'}["$i"]->{'merchantName'});
     $roleName = ($b->{'userGroupNamespace'}->{'All'}["$i"]->{'roleName'});
      $groupValue = ($b->{'userGroupNamespace'}->{'All'}["$i"]->{'userGroupNamespace'}->{'groupValue'});
       $groupId = ($b->{'userGroupNamespace'}->{'All'}["$i"]->{'userGroupNamespace'}->{'groupId'});


//echo "<center><b><font color='#0A9B26' size='3'><br>$unitId<br>$roleName<br>$groupValue<br>$groupId</font><br></center>";

echo"<center><br><form action='store' method='POST'>
<input  type='hidden' name='unitId' value='$unitId'>
<input  type='hidden' name='roleName' value='$roleName'>
<input  type='hidden' name='groupValue' value='$groupValue'>
<input  type='hidden' name='groupId' value='$groupId'>
<input  type='hidden' name='user_token' value='$user_token'>

<button  id='$unitId' name='$unitId' class='btn btn-primary mb-2'>$unitId</button>
</form>
</center>
<br><br>";
    
    $i++;
}





}
    
    
    
    
    
    else {
    
 // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Incorrect OTP, Please try again later",
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
    
}