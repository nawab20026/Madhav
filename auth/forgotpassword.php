<!DOCTYPE html>
<html>

<!-- Mirrored from upigetway.com/auth/forgotpassword by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:37 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>imb pay</title>
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
        <h5 class="modal-title" id="Disclaimer">❗ Disclaimer</h5>
      </div>
      <div class="modal-body">
		  <p>The imb pay does not provide any payment gateway services, UPI accounts, or UPI merchant accounts.</p>
		  <p>We only provide an API to generate a QR code for your UPI ID.</p>
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
                  <h6 class="mt-4 mb-4 pb-1">Forgot Password</h6>
                </div>

<?php
include "config.php";
if(isset($_POST['submit'])){
    // Sanitize input using mysqli_real_escape_string
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pan = mysqli_real_escape_string($conn, $_POST['pan']);

    $pass = rand(000000,999999);
    $password = password_hash($pass, PASSWORD_BCRYPT);


    $fetch = "SELECT * FROM users WHERE mobile='$username'";
    $res = mysqli_query($conn, $fetch);
    $row = mysqli_fetch_array($res);

    if(mysqli_num_rows($res) > 0){
        if($pan == $row['pan']){
            $update = "UPDATE users SET password='$password' WHERE mobile='$username'";
            $quer = mysqli_query($conn, $update);

            if($quer){
                $msg = "Dear " . $row['name'] . " Your New Password Below
                Your Password = $pass
                Thanks & Regards
                imb pay";
                $encodedMsg = urlencode($msg);
                
                //file_get_contents("https://wamsg.tk/wa.php?api_key=Wn62PIQ09X8BiY7iOtnEmgBCFFTDM3&sender=918145511275&number=91$username&message=$encodedMsg");

                echo '
    <script>
        Swal.fire({
            title: "Congratulations! Your New Password Sent to Your WhatsApp!!",
            text: "Your new password is: ' . $pass . '. Please Click Ok Button to proceed.",
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
                        title: "Opps! Something went wrong Please try again Later!!",
                        text: "Please Click Ok Button!!",
                        confirmButtonText: "Ok",
                        icon: "error"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "forgotpassword"; // Replace with your desired redirect URL
                        }
                    });
                </script>
                ';
                exit;
            }
        } else {
            echo '
            <script>
                Swal.fire({
                    title: "Provided Pan Does Not Match Or Exist!!",
                    text: "Please Click Ok Button!!",
                    confirmButtonText: "Ok",
                    icon: "error"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "forgotpassword"; // Replace with your desired redirect URL
                    }
                });
            </script>
            ';
            exit;
        }
    } else {
        echo '
        <script>
            Swal.fire({
                title: "Opps! Sorry Your Mobile Number Does Not Exist In Our Record!!",
                text: "Please Click Ok Button!!",
                confirmButtonText: "Ok",
                icon: "error"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "forgotpassword"; // Replace with your desired redirect URL
                }
            });
        </script>
        ';
        exit;
    }
} 
?>


                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="form-outline mb-4">
  <label class="form-label" for="username">Mobile Number</label>
  <input type="text" id="username" name="username" class="form-control" placeholder="Enter Mobile Number" 
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required/>
</div>



<div class="form-outline mb-4">
  <label>PAN Number</label>
  <input type="text" name="pan" placeholder="Enter PAN Number" class="form-control"
         pattern="[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}" title="Enter PAN number in the format: AAAAANNNNA"
         oninput="this.value = this.value.toUpperCase();" maxlength="10" required />
</div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit">Submit</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 mr-2">Already have an account?</p>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="location='index'">Login</button>
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

<!-- Mirrored from upigetway.com/auth/forgotpassword by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2023 17:52:40 GMT -->
</html>     