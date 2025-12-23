<!DOCTYPE html>
<html>
<head>
    
    
     
     
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Your Website Name</title>
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
		  <p>This Your Website Name does not provide any Payment Gateway services, UPI Accounts, or UPI Merchant Accounts.</p>
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
      <div class="col-xl-6">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="assets/img/hdfc.png" style="width: 185px;" alt="logo">
                  <h6 class="mt-4 mb-4 pb-1">Please login to your account.</h6>
                </div>

<?php
include "config.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Password submitted by the user

    $query = "SELECT * FROM users WHERE mobile = '$username'";
    $run = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($run);

    if (mysqli_num_rows($run) > 0) {
        $hashFromDatabase = $row['password']; // Get the stored bcrypt hash from the database
        $acc_lock = $row['acc_lock'];
        $acc_ban = $row['acc_ban'];
        $byteuserid= $row['id'];

        if ($acc_ban == 'on') {
            // Account is banned, don't allow login
           echo '
<script>
    Swal.fire({
        title: "Account Locked!",
        text: "Please contact the administrator.",
        icon: "error",
        confirmButtonText: "Ok"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index"; // Redirect to the index page
        }
    });
</script>';
exit;
        }

        if (password_verify($password, $hashFromDatabase)) { // Check if the submitted password matches the stored bcrypt hash
            session_start(); // Start the PHP session
            $_SESSION['username'] = $username; // Set the username in the session
            $_SESSION['user_id']=$byteuserid;
            // Reset the acc_lock value on successful login
            $query = "UPDATE users SET acc_lock = 0 WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            // Generate a random CSRF token
            $csrf_token = bin2hex(random_bytes(32)); // Generate a 32-byte random token

            // Store the CSRF token in the session
            $_SESSION['csrf_token'] = $csrf_token;

            // Display a success message to the user
            echo '
            <script>
                Swal.fire({
                    title: "Login Successful!",
                    text: "Redirecting to the dashboard...",
                    icon: "success",
                    confirmButtonText: "Ok"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "dashboard"; // Replace with your desired redirect URL
                    }
                });
            </script>';
            exit;
        } else {
            // Wrong password, increment acc_lock value
            $acc_lock++;
            $query = "UPDATE users SET acc_lock = $acc_lock WHERE mobile = '$username'";
            mysqli_query($conn, $query);

            // Check if the account should be locked
            if ($acc_lock >= 3) {
                // Account is locked due to too many failed attempts
                echo '
<script>
    Swal.fire({
        title: "Account Locked!",
        text: "Too many failed login attempts. Please contact the administrator.",
        icon: "error",
        confirmButtonText: "Ok"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index"; // Redirect to the index page
        }
    });
</script>';
exit;
            } else {
                echo '
<script>
    Swal.fire({
        title: "Invalid Password!",
        text: "Please try again.",
        icon: "error",
        confirmButtonText: "Ok"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index"; // Redirect to the index page
        }
    });
</script>';
exit;

            }
        }
    } else {
        // Username does not exist
        echo '
<script>
    Swal.fire({
        title: "Username Does not Exist!",
        text: "Please try again.",
        icon: "error",
        confirmButtonText: "Ok"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index"; // Redirect to the index page
        }
    });
</script>';
exit;

    }
} else {
    // Handle the case when the form is not submitted
}
?>



                <form method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="form-outline mb-4">
  <label class="form-label" for="username">Mobile Number</label>
  <input type="text" id="username" name="username" class="form-control" placeholder="Mobile Number" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required/>
</div>


                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                  </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit">Login</button>
                    <a class="text-muted" href="forgotpassword">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 mr-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="location='register'">Register</button>
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
<!--<script src="assets/js/core/jquery.3.2.1.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>-->
<!--<script src="assets/js/core/popper.min.js"></script>-->
<!--<script src="assets/js/core/bootstrap.min.js"></script>-->
<!--<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>-->
<!--<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>-->
<!--<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>-->
<!--<script src="assets/js/ready.min.js"></script>-->
<script>
$( document ).ready(function() {
$('#disclaimer').modal({backdrop: 'static', keyboard: false})  
$("#disclaimer").modal("show");
});
</script>
</html>			