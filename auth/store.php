<?php 


include "header.php";

include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";
include "../phnpe/index.php";
?>
<?php

$bbbyteuserid=$_SESSION['user_id'];

$user_token = $_POST["user_token"];
$unitId = $_POST["unitId"];
$roleName = $_POST["roleName"];
$groupValue = $_POST["groupValue"];
$groupId = $_POST["groupId"];


$slq_p = "SELECT * FROM phonepe_tokens where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $device_data = $res_p[0]['device_data'];
$name = $res_p[0]['name']; 
 $refreshToken = $res_p[0]['refreshToken'];
 $phoneNumber = $res_p[0]['phoneNumber']; 
$token = $res_p[0]['token']; 
$userId = $res_p['userId'];
$user_token = $res_p[0]['user_token']; 


  $updatemarchn=sentotp("3",$token,$device_data,$groupId,0);
       // echo $updatemarchn;
               $json0=json_decode($updatemarchn,1);
 $message=$json0["message"];
 $token=$json0["token"];
  $refreshToken=$json0["refreshToken"];
 $groupValue=$json0["groupValue"];
 
 if($message=="success"){
     
      // //////////updating data/////////
$sql = "UPDATE phonepe_tokens SET refreshToken='$refreshToken' WHERE user_token='$user_token'";
setXbyY($sql);
$sql = "UPDATE users SET phonepe_connected='Yes' WHERE user_token='$user_token'";
setXbyY($sql);
$sql = "UPDATE phonepe_tokens SET status='Active' WHERE user_token='$user_token'";
setXbyY($sql);
$sql = "UPDATE phonepe_tokens SET token='$token' WHERE user_token='$user_token'";
setXbyY($sql);

/////////////////////////
// //////////taking store data//////
      $sql = "DELETE FROM store_id WHERE user_token='$user_token'";
if ($conn->query($sql) === TRUE) {}


$sql = "INSERT INTO store_id (user_token, unitId, roleName, groupValue, groupId, user_id)
VALUES ('$user_token', '$unitId', '$roleName', '$groupValue', '$groupId', $bbbyteuserid)";
   
if ($conn->query($sql) === TRUE) {
    
    // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Your Store Data & Phonepe Connected Successfully",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    

}
     
 }
 
 else{
     
       // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: " Please try again later",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';
exit;
     
 }