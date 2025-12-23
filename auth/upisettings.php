<?php include "header.php"; ?>

<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">UPI Settings</h4>
						<div class="row row-card-no-pd">
							<div class="col-md-12">
<?php
if (isset($_POST['delete'])) {

    

    $merchant_type = mysqli_real_escape_string($conn, $_POST['merchant_type']);
    $token = $userdata['user_token'];

    // Initialize the delete and update queries
    $del = "";
    $update = "";

    // Construct the delete and update queries based on merchant type
    if ($merchant_type == 'hdfc') {
        $del = "DELETE FROM hdfc WHERE user_token = '$token'";
        $update = "UPDATE users SET hdfc_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'phonepe') {
        $del = "DELETE FROM phonepe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET phonepe_connected = 'No' WHERE user_token = '$token'";
        
        // Add a query to delete from the store_id table as well
        $del_store_id = "DELETE FROM store_id WHERE user_token = '$token'";
        mysqli_query($conn, $del_store_id);
    } elseif ($merchant_type == 'paytm') {
        $del = "DELETE FROM paytm_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET paytm_connected = 'No' WHERE user_token = '$token'";
    } elseif ($merchant_type == 'bharatpe') {
        $del = "DELETE FROM bharatpe_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET bharatpe_connected = 'No' WHERE user_token = '$token'";
    }  elseif ($merchant_type == 'googlepay') {
        
        $del = "DELETE FROM googlepay_tokens WHERE user_token = '$token'";
        $update = "UPDATE users SET googlepay_connected = 'No' WHERE user_token = '$token'";
        
    }

    // Execute the delete query
    $res_del = mysqli_query($conn, $del);

    // Execute the update query
    $res_update = mysqli_query($conn, $update);

    if ($res_del && $res_update) {
        // Show SweetAlert2 success message
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
        echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Has been Deleted Successfully!",
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings";
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
        title: "Merchant Not Deleted! Contact Admin",
        showConfirmButton: true,
        confirmButtonText: "Ok!",
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "upisettings";
        }
    });
</script>';
        exit;
    }
}
?>






<?php

if(isset($_POST['addmerchant'])){
    
    
   
    $bbbytemerchant = mysqli_real_escape_string($conn, $_POST['merchant_name']);
    
    if ($bbbytemerchant=="hdfc"){
    $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
    $data = "INSERT INTO hdfc(id, number, seassion, device_id, user_token, pin, upi_hdfc, UPI, tidlist, status, mobile) VALUES ('','$no','','','" . $userdata['user_token'] . "','','','','', 'Deactive','$mobile')";
    $insert = mysqli_query($conn, $data);
    }
    
    elseif ($bbbytemerchant=="phonepe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO phonepe_tokens (user_token, phoneNumber, userId, token, refreshToken, name, device_data)
        VALUES ('$bbbytetokken', '$no', '', '', '', '', '')";
$insert = mysqli_query($conn, $data);


    }
    elseif ($bbbytemerchant=="paytm"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO paytm_tokens (user_token, phoneNumber, MID, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }
    
    elseif ($bbbytemerchant=="bharatpe"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO bharatpe_tokens (user_token, phoneNumber, token, cookie, merchantId)
        VALUES ('$bbbytetokken', '$no', '', '', '')";
$insert = mysqli_query($conn, $data);
     }
     
     elseif ($bbbytemerchant=="googlepay"){
        $no = mysqli_real_escape_string($conn, $_POST['c_mobile']);
        $bbbytetokken=$userdata['user_token'];
        
        $data = "INSERT INTO googlepay_tokens (user_token, phoneNumber, Instance_Id, Upiid)
        VALUES ('$bbbytetokken', '$no', '','')";
        $insert = mysqli_query($conn, $data);


    }
    
    
        
    
    
    if($insert){
        
        
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "Congratulations! Your Merchant Hasbeen Added Successfully!",
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
        
    
        
        
    }else{
        
        // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Opps Sorry Merhcant Adding Failure!",
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

    }
}

?>




							<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-2">


            
								<div class="row" id="merchant">
								    <div class="col-md-4 mb-2">
    									<label>Merchant Name</label>
    									<select type="number" name="merchant_name" class="form-control" onchange="get_merchant(this.value,'#merchant')" required>
    									    <option value="hdfc">HDFC Vyapar</option>
    									    <option value="phonepe">Phonepe</option>
    									    <option value="paytm">Paytm</option>
    									    <option value="bharatpe">BharatPe</option>
    									    <option value="googlepay">Google Pay</option>
    									    <option value="paytm">Paytm</option>
    									    <option value="bharatpe">BharatPe</option>
    									    <option value="googlepay">Google Pay</option>
    									   
    									</select>
    								</div>
    								<div class="col-md-4 mb-2"> 
        								<label>Cashier Mobile Number</label> 
        								<input type="number" name="c_mobile" placeholder="Enter Mobile Number" class="form-control" onkeypress="if(this.value.length==10) return false;" required=""> 
    								</div>
                                    <div class="col-md-4 mb-2"> 
        								<label>&nbsp;</label> 
        								
        								<button type="submit" name="addmerchant" class="btn btn-primary btn-block">Add Merchant</button> 
        							</div>
								</div>
								
							</form>	

<?php
$token = $userdata['user_token'];
$fetchData = "
    SELECT 'hdfc' AS merchant_type, id, number, date, status FROM hdfc WHERE user_token = '$token' 
    UNION ALL 
    SELECT 'phonepe' AS merchant_type, sl AS id, phoneNumber AS number, date, status FROM phonepe_tokens WHERE user_token = '$token'
    UNION ALL
    SELECT 'paytm' AS merchant_type, id, phoneNumber AS number, date, status FROM paytm_tokens WHERE user_token = '$token'
    UNION ALL
    SELECT 'bharatpe' AS merchant_type, id, phoneNumber AS number, date, status FROM bharatpe_tokens WHERE user_token = '$token'
    UNION ALL
    SELECT 'googlepay' AS merchant_type, id, phoneNumber AS number, date, status FROM googlepay_tokens WHERE user_token = '$token'";


$ssData = mysqli_query($conn, $fetchData);
//if (!$ssData) {
    //die("Error in query execution: " . mysqli_error($conn));
//}

                    ?>


							<div class="table-responsive">
                        <h5>All Merchants</h5>
                        <table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Merchant Type</th>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Last Sync</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($ssData) > 0) {
                                    while ($merchant = mysqli_fetch_array($ssData)) {
                                        $class = ($merchant['status'] == 'Active') ? 'badge badge-success' : 'badge badge-danger';
                                ?>
                                        <tr>
                                            <td>#</td>
                                            <td><?php echo !empty($merchant['merchant_type']) ? htmlspecialchars($merchant['merchant_type'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                            <td><?php echo !empty($merchant['id']) ? htmlspecialchars($merchant['id'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                            <td><?php echo !empty($merchant['number']) ? htmlspecialchars($merchant['number'], ENT_QUOTES, 'UTF-8') : ''; ?></td>
                                            <td>
                                                <button style="height: 50px; width: 200px" class="badge badge-info">
                                                    <?php echo !empty($merchant['date']) ? htmlspecialchars($merchant['date'], ENT_QUOTES, 'UTF-8') : ''; ?>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="<?php echo htmlspecialchars($class, ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php echo htmlspecialchars($merchant['status'], ENT_QUOTES, 'UTF-8'); ?>
                                                </button>
                                            </td>
                                            <td>
                            <?php
                            if ($merchant['merchant_type'] == 'hdfc') {
                                // HDFC specific actions
                                ?>
                                <form action="send_hdfcotp" method="post">
                                    <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <button class="btn btn-info btn-xs mb-2 mt-1" name="Verify">Verify</button>
                                </form>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="hdfc_mobile" value="<?php echo $merchant['number']; ?>">
                                    <input type="hidden" name="merchant_type" value="hdfc">
                                    
                                    <button class="btn btn-danger btn-xs mb-2 mt-1" name="delete">Delete</button>
                                </form>
                                <?php
                            } elseif ($merchant['merchant_type'] == 'phonepe') {
                                // Phonepe specific actions
                                ?>
                                <form action="send_phonepeotp" method="post">
                                    <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <button class="btn btn-info btn-xs mb-2 mt-1" name="Verify">Verify</button>
                                </form>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="phonepe_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <input type="hidden" name="merchant_type" value="phonepe">
                                    <button class="btn btn-danger btn-xs mb-2 mt-1" name="delete">Delete</button>
                                </form>
                                <?php
                            } elseif ($merchant['merchant_type'] == 'paytm') {
                                // Paytm specific actions
                                ?>
                                <form action="send_paytmotp" method="post">
                                    <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <button class="btn btn-info btn-xs mb-2 mt-1" name="Verify">Verify</button>
                                </form>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="paytm_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <input type="hidden" name="merchant_type" value="paytm">
                                    <button class="btn btn-danger btn-xs mb-2 mt-1" name="delete">Delete</button>
                                </form>
                                <?php
                            } elseif ($merchant['merchant_type'] == 'bharatpe') {
                                // Bharatpe specific actions
                                ?>
                                <form action="send_bharatpeotp" method="post">
                                    <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <button class="btn btn-info btn-xs mb-2 mt-1" name="Verify">Verify</button>
                                </form>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="bharatpe_mobile" value="<?php echo $merchant['number']; ?>">
                                    
                                    <input type="hidden" name="merchant_type" value="bharatpe">
                                    <button class="btn btn-danger btn-xs mb-2 mt-1" name="delete">Delete</button>
                                </form>
                                <?php
                            } elseif ($merchant['merchant_type'] == 'googlepay') {
                        ?>
                        <form action="send_googlepayotp" method="post">
                            <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
                            
                            <button class="btn btn-info btn-xs mb-2 mt-1" name="Verify">Verify</button>
                        </form>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="googlepay_mobile" value="<?php echo $merchant['number']; ?>">
                            
                            <input type="hidden" name="merchant_type" value="googlepay">
                            <button class="btn btn-danger btn-xs mb-2 mt-1" name="delete">Delete</button>
                        </form>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>

</div>
</div>
</div>

<script>
function showInvalidPasswordAlert(id) {
    alert('Invalid Password for merchant with ID: ' + id);
}
</script>



					</div>
				</div>
</div>
</div>
</div>
</body>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/rechpay.js?1697738798"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-19','',utr_number);
}else{
Swal.fire('Enter Valid UTR Number!');	
}
}else{
location.href ='transactions';
}
}
</script>
</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $("#dataTable").DataTable();
});
</script>
<script src="assets/js/merchant.js?1697738798"></script>