<!DOCTYPE html>
<html>

<!-- Mirrored from upigetway.com/auth/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    
    <script async src="../../pagead2.googlesyndication.com/pagead/js/fef8b.txt?client=ca-pub-6207141508432920"
     crossorigin="anonymous"></script>
     
     
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>IMB Shop</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/hdfc.png" type="image/*" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="../../rsms.me/inter/inter.css">
  <script type="text/javascript">if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
body{
  font-family: 'Inter', sans-serif;
  background: #f2f3f8 !important;
}

a{
 text-decoration: none !important;
}	
.card {
    border-radius: 5px !important;
}
</style>
<body>
<!-- Modal -->
<div class="modal fade" id="disclaimer" tabindex="-1" aria-labelledby="Disclaimer" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Disclaimer">❗ Disclaimer Notice</h5>
      </div>
      <div class="modal-body">
		  <p>This IMB Shop does not provide any Payment Gateway services, UPI Accounts, or UPI Merchant Accounts.</p>
		  <p>We only provide an API to Generate a QR code for your UPI ID.</p>
		  <p>We are not involved in any kind of transaction. Please read our terms and conditions before using our service.</p>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="$('body').html('');">Leave</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
      </div>
    </div>
  </div>
</div> 
<div class="container">

<section class="h-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="assets/img/hdfc.png" style="width: 185px;" alt="logo">
                  <h6 class="mt-1 mb-4 pb-1">Start with your free account today</h6>
                </div>
  
  
  <?php
include "config.php";



if (isset($_POST['create'])) {
    
    $mobile =  $_POST['mobile'];
    $email = $_POST['email'];

    $checkMobileQuery = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
    $checkMobileResult = mysqli_query($conn, $checkMobileQuery);

    $checkEmailQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkMobileResult) > 0) {
        echo '
    <script>
        Swal.fire({
            title: "Opps! Sorry Mobile Number Already Exist. Please use a different number",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        })
    </script>
';
exit;
    } elseif (mysqli_num_rows($checkEmailResult) > 0) {
        // The email already exists, display an error message
       echo '
    <script>
        Swal.fire({
            title: "Opps! Sorry Mobile Number Already Exist. Please use a different email",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        })
    </script>
';
exit;
    } else {
        // Proceed with user registration
        $password = $_POST['password'];
        $name = $_POST['name'];
        $company = $_POST['company'];
        $pin = $_POST['pin'];
        $pan = $_POST['pan'];
        $aadhaar = $_POST['aadhaar'];
        
        
        $checkpan = "SELECT * FROM `users` WHERE `pan` = '$pan'";
    $checkpanResult = mysqli_query($conn, $checkpan);

    $checkaadhar = "SELECT * FROM `users` WHERE `aadhaar` = '$aadhaar'";
    $checkAadharResult = mysqli_query($conn, $checkaadhar);

    if (mysqli_num_rows($checkpanResult) > 0) {
        echo '
    <script>
        Swal.fire({
            title: "Opps! Sorry Pan Number Already Exist. Please use a different pan number",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        })
    </script>
';
exit;
    } elseif (mysqli_num_rows($checkAadharResult) > 0) {
        // The email already exists, display an error message
       echo '
    <script>
        Swal.fire({
            title: "Opps! Sorry Aadhaar Number Already Exist. Please use a different Aadhaar Number",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        })
    </script>
';
exit;
    }else{  
        

        
        
        
        $location = $_POST['location'];
        $key = md5(rand(00000000, 99999999));
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $today = date("Y-m-d", strtotime("+3 days"));

         // Function to generate a random instance_id
function generateRandomInstanceId($length = 16) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = 'I'; // Fixed 'I' as the first character

  // Generate a random string with the specified length - 7 (for the time part and additional digit)
  for ($i = 1; $i < $length - 6; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }

  // Get the current time in seconds since the epoch
  $currentTime = time();

  // Take the last 6 digits from the current time and append them to the random string
  $lastSixDigits = substr(strval($currentTime), -6);
  $randint = rand(100, 900);
  
  return $randomString . $randint . $lastSixDigits;
}



        // Generate random instance_id and instance_secret
$instanceId = generateRandomInstanceId();


$register = "INSERT INTO `users`(`name`, `mobile`, `role`, `password`, `email`, `company`, `pin`, `pan`, `aadhaar`, `location`, `user_token`, `expiry`, `instance_id`) 
VALUES ('$name', '$mobile', 'User', '$pass', '$email', '$company', '$pin', '$pan', '$aadhaar', '$location', '$key', '$today', '$instanceId')";


$result = mysqli_query($conn, $register);


        $msg = "Dear $name thanks For Registering Us
        Your Username = $mobile
        Your Password = $password
        Thanks & Regards
        IMB Shop";
        $encodedMsg = urlencode($msg);

        if ($result) {
            
            echo '
    <script>
        Swal.fire({
            title: "Registration Successfull!!",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "success"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index"; // Replace with your desired redirect URL
            }
        });
    </script>
';
exit;
        } else {
             echo '
    <script>
        Swal.fire({
            title: "Rgistration Failed!!",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        })
    </script>
';
exit;
        }
    }
}
}
?>

  
  
  
                <form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="col-md-6 mb-2">
  <label>Mobile Number</label>
  <input type="text" name="mobile" placeholder="Enter Mobile Number" class="form-control"
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required />
</div>

    <div class="col-md-6 mb-2"><label>Password</label> <input type="password" name="password" placeholder="Enter Password" class="form-control" required="" /></div>
  
    <div class="col-md-6 mb-2">
  <label>Email Address</label>
  <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required />
</div>

    <div class="col-md-6 mb-2"><label>Name</label> <input type="text" name="name" placeholder="Enter Name" class="form-control" required="" /></div>
    <div class="col-md-6 mb-2"><label>Company</label> <input type="text" name="company" placeholder="Enter Company" class="form-control" required="" /></div>
    
    <div class="col-md-6 mb-2">
  <label>Area Pin</label>
  <input type="text" name="pin" placeholder="Area Pin" class="form-control"
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" required />
</div>

    <div class="col-md-6 mb-2">
  <label>PAN Number</label>
  <input type="text" name="pan" placeholder="Enter PAN Number" class="form-control"
         pattern="[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}" title="Enter PAN number in the format: AAAAANNNNA"
         oninput="this.value = this.value.toUpperCase();" maxlength="10" required />
</div>

    <div class="col-md-6 mb-2">
  <label>Aadhaar Number</label>
  <input type="text" name="aadhaar" placeholder="Enter Aadhaar Number" class="form-control"
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);" required />
</div>

    <div class="col-md-12 mb-2">
    <label>Location</label>
    <input type="text" name="location" placeholder="Enter Location" class="form-control" required="" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')" />
</div>

    <div class="col-md-12 mb-2 mt-2"><button type="submit" name="create" class="btn btn-primary btn-sm btn-block">Register</button>
    </div>
<div class="col-md-12 mb-2">
<div class="d-flex align-items-center justify-content-center mt-2">
  <p class="mb-0 mr-2">Already have an account?</p>
  <a href='index' class="btn btn-outline-danger btn-sm" >Login</a>
</div>
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

<!-- Mirrored from upigetway.com/auth/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->
</html>			