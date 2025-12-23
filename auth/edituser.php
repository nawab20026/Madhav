<?php 
include "header.php"; 
include "config.php"; 

$mobileno =  $_REQUEST['mobileno'];
$qyt = "SELECT * FROM users WHERE mobile='$mobileno'";
$act = mysqli_query($conn, $qyt);
$day = mysqli_fetch_array($act);

if (isset($_REQUEST['update'])) {
    
    
    
    
    $mobilex =  $_REQUEST['mobile'];
    $email =  $_REQUEST['email'];
    $password =  $_REQUEST['password'];
    $name =  $_REQUEST['name'];
    $company =  $_REQUEST['company'];
    $pin =  $_REQUEST['pin'];
    $pan =  $_REQUEST['pan'];
    $aadhaar =  $_REQUEST['aadhaar'];
    $location =  $_REQUEST['location'];
    $exp =  $_REQUEST['date'];
    
    $key = md5(rand(00000000, 99999999));
    $pass = password_hash($password, PASSWORD_BCRYPT);

    $upgc = "UPDATE users SET name='$name', email='$email', company='$company', pin='$pin', pan='$pan', aadhaar='$aadhaar', location='$location', expiry='$exp' WHERE mobile='$mobilex'";
    $resvp = mysqli_query($conn, $upgc);

    $msg = "Dear $name thanks For Registering Us
    Your Username = $mobile
    Your Password = $password
    Thanks & Regards
    IMB Shop";
    $encodedMsg = urlencode($msg);

    if($resvp){
        //file_get_contents("https://wamsg.tk/wa.php?api_key=Wn62PIQ09X8BiY7iOtnEmgBCFFTDM3&sender=918145511275&number=91$mobile&message=$encodedMsg");
        
        
         
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "User Update Successfull!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "dashboard"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
    
        
    } else {
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "User Update Failed!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "userlist"; // Redirect to "userlist" when the user clicks the confirm button
        }
    });
</script>';
exit;
    }
}
?>

<div class="main-panel">
				<div class="content">
					<div class="container-fluid">

						<h4 class="page-title">Edit User</h4>	
										
						<div class="row row-card-no-pd">							
							<div class="col-md-12">

<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    
    <div class="col-md-6 mb-2">
        <label>Mobile Number</label>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="number" name="mobile" value="<?php echo htmlspecialchars($day['mobile'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Mobile Number" class="form-control" onkeypress="if(this.value.length==10) return false;" required="" readonly />
    </div>
   
    <div class="col-md-6 mb-2">
        <label>Email Address</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($day['email'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Email Address" class="form-control" required="" />
    </div>
    
    <div class="col-md-6 mb-2">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($day['name'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Name" class="form-control" required="" />
    </div>
    
    <div class="col-md-6 mb-2">
        <label>Company</label>
        <input type="text" name="company" value="<?php echo htmlspecialchars($day['company'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Company" class="form-control" required="" />
    </div>
    
    <div class="col-md-6 mb-2">
        <label>Area Pin</label>
        <input type="text" name="pin" value="<?php echo htmlspecialchars($day['pin'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Area Pin" class="form-control" required="" />
    </div>
    
    <div class="col-md-6 mb-2">
        <label>PAN Number</label>
        <input type="text" name="pan" value="<?php echo htmlspecialchars($day['pan'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter PAN Number" class="form-control" onkeypress="if(this.value.length==10) return false;" required="" />
    </div>
    
    <div class="col-md-6 mb-2">
        <label>Aadhaar Number</label>
        <input type="number" name="aadhaar" value="<?php echo htmlspecialchars($day['aadhaar'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Aadhaar Number" class="form-control" onkeypress="if(this.value.length==12) return false;" required="" />
    </div>
    
    <div class="col-md-3 mb-2">
        <label>Expiry Date</label>
        <input type="date" id="from_date" name="date" value="<?php echo htmlspecialchars($day['date'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="DD-MM-YYYY" class="form-control datepicker">
    </div>
    
    <div class="col-md-12 mb-2">
        <label>Location</label>
        <input type="text" name="location" value="<?php echo htmlspecialchars($day['location'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Location" class="form-control" required="" />
    </div>
    
    <div class="col-md-12 mb-2 mt-2">
        <button type="submit" name="update" class="btn btn-primary btn-sm">Update Now</button>
    </div>
</form>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script>
$( document ).ready(function() {
$('#disclaimer').modal({backdrop: 'static', keyboard: false})  
$("#disclaimer").modal("show");
});
</script>
<script>
$(document).ready(function () {
$( ".datepicker" ).datepicker({
  dateFormat: "dd-mm-yy"
});
});
</script>

<!-- Mirrored from upigetway.com/auth/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->
</html>			