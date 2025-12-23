<?php
include "header.php";
// Function to sanitize user input
    function sanitizeInput($input) {
        if (is_string($input)) {
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        } else {
            // Handle non-string input here (e.g., arrays, objects, etc.) if needed.
            return $input;
        }
    }
    

if(isset($_POST['verifyotp'])) {
   $bbbyteuserid=$_SESSION['user_id'];
    
  $bbytepaytmuserid=  $userdata['user_token'];
  $bbytepaytmusermid = sanitizeInput($_POST["MID"]);
  $bbytepaytmuserupiid = sanitizeInput($_POST["UPI"]);
  
     $sqlUpdateUser = "UPDATE users SET paytm_connected='Yes' WHERE user_token='$bbytepaytmuserid'";
    $resultUpdateUser = mysqli_query($conn, $sqlUpdateUser);
    
   $sqlw = "UPDATE paytm_tokens SET MID='$bbytepaytmusermid', Upiid='$bbytepaytmuserupiid', status='Active', user_id=$bbbyteuserid WHERE user_token='$bbytepaytmuserid'";
$result = mysqli_query($conn, $sqlw);


   if ($result) {
       
  
    
     
    // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Paytm Hasbeen Connected Successfully!",
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
    
    
} else {
    // Query failed
  //  echo "Error: " . mysqli_error($conn);
  
   // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Please Try Again Later!!",
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

if(isset($_POST['Verify'])) {
    
    if ($userdata['paytm_connected']=="Yes"){
        
         
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

    $paytm_mobile = sanitizeInput($_POST["paytm_mobile"]);

    // Now, you can use the $paytm_mobile variable as needed
?>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Paytm UPI Settings</h4>
                <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">
                            <div class="row" id="merchant">
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter Merchant ID</label> 
                                    <input type="text" name="MID" placeholder="Enter Merchant ID" class="form-control" required=""> 
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter Number</label> 
                                    <input type="number" name="Number" placeholder="Enter Number" value="<?php echo $paytm_mobile; ?>" class="form-control" required=""> 
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>Enter UPI</label> 
                                    <input type="text" name="UPI" placeholder="Enter UPI" class="form-control" required="" value="dummy@Paytm">
                                </div>
                                <div class="col-md-4 mb-2"> 
                                    <label>&nbsp;</label> 
                                    <button type="submit" name="verifyotp" class="btn btn-primary btn-block">Verify Paytm</button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} // End of if(isset($_POST['Verify']))

?>
