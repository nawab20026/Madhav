<?php
include "header.php";


?>
<div class="main-panel">
				<div class="content">
					<div class="container-fluid">

						<h4 class="page-title">My Profile</h4>	
										
						<div class="row row-card-no-pd">							
							<div class="col-md-12">
								<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="col-md-4 mb-3">
        <label>Instance ID</label>
        <input type="text" placeholder="Username" value="<?php echo htmlspecialchars($userdata['instance_id'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>Mobile Number</label>
        <input type="text" name="mobile" placeholder="Mobile Number" value="<?php echo htmlspecialchars($userdata['mobile'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control input-solid" required readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($userdata['email'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control input-solid" required readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>Name</label>
        <input type="text" placeholder="Name" value="<?php echo htmlspecialchars($userdata['name'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>Company Name</label>
        <input type="text" placeholder="Company Name" value="<?php echo htmlspecialchars($userdata['company'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>PAN Number</label>
        <input type="text" placeholder="PAN Number" value="<?php echo htmlspecialchars($userdata['pan'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <label>Aadhaar Number</label>
        <input type="text" placeholder="Aadhaar Number" value="<?php echo htmlspecialchars($userdata['aadhaar'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-8 mb-3">
        <label>Location</label>
        <input type="text" placeholder="Location" value="<?php echo htmlspecialchars($userdata['location'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" readonly>
    </div>
    <div class="col-md-4 mb-3">
        <button type="submit" name="update" class="btn btn-primary btn-block">Save</button>
    </div>
</form>

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
<script src="assets/js/rechpay.js?1697765827"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-20','',utr_number);
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
<script src="assets/js/bharatpe.js?1697765827"></script>