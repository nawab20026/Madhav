<?php include "header.php"; ?>
<?php
if (isset($_POST['delete'])) {
    
    
    
    
    $mb = mysqli_real_escape_string($conn,$_POST['mobileno']);
    $del = "DELETE FROM `users` WHERE mobile='$mb'";
    $rpt = mysqli_query($conn, $del);

    if ($rpt) {
        
        
        // Show SweetAlert2 success message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "success",
        title: "User Deleted Successfully!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "userlist"; // Redirect to "dashboard" when the user clicks the confirm button
        }
    });
</script>';

    exit;
        

   
    } else {
       // $error = mysqli_error($conn); 
        
         // Show SweetAlert2 error message
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>';
echo '<script>
    Swal.fire({
        icon: "error",
        title: "User Delete Failure!!",
        showConfirmButton: true, // Show the confirm button
        confirmButtonText: "Ok!", // Set text for the confirm button
        allowOutsideClick: false, // Prevent the user from closing the popup by clicking outside
        allowEscapeKey: false // Prevent the user from closing the popup by pressing Escape key
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "userlist"; // Redirect to "dashboard" when the user clicks the confirm button
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
						<h4 class="page-title">Manage User</h4>
						<div class="row row-card-no-pd">
							<div class="col-md-12">
								
							<div class="table-responsive">
								<table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>User Name</th>
												<th>User Type</th>
												<th>Email</th>
												<th>Shop Name</th>
												<th>Mobile No</th>
												<th>Pan No</th>
												<th>Aadhaar No</th>
												<th>Address</th>
												<th>Expire Date</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
<?php
$token = $userdata['user_token'];


$query = "SELECT `id`, `name`, `mobile`, `role`, `password`, `email`, `company`, `pin`, `pan`, `aadhaar`, `location`, `user_token`, `expiry`, `callback_url` FROM `users` WHERE role='User'";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        
      
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td class='btn btn-primary'>" . htmlspecialchars($row['role'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['company'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['pan'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['aadhaar'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['expiry'], ENT_QUOTES, 'UTF-8') . "</td>";

     ?>
     
     <td>        <div class="row">
    <div class="col">
        <form action="edituser.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="mobileno" value="<?php echo $row['mobile']; ?>">
            <button class="btn btn-success" name="edituser">Edit</button>
        </form>
    </div>

    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="mobileno" value="<?php echo $row['mobile']; ?>">
            <button class="btn btn-danger" name="delete">Delete</button>
        </form>
    
</div>

        </td>
     
     
     
     <?php
        echo "</tr>";
    }
} else {
    echo "Error in query: " . mysqli_error($conn); 
}
?>
											
										</tbody>
									</table>
							</div>
							</div>
						</div>
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
<script src="assets/js/rechpay.js?1697912979"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-21','',utr_number);
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

<link href="https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script>
$(document).ready(function () {
$( ".datepicker" ).datepicker({
  dateFormat: "dd-mm-yy"
});
});
</script>
<script src="assets/js/merchant.js?1697912979"></script>				
<script type="text/javascript">
$(document).ready(function () {
//$("#search").click();
});	
</script>