<?php include "header.php";

// SQL query to count rows
$sql = "SELECT COUNT(*) AS count FROM reports WHERE mobile = '$mobile'";

// Execute the query
$result = $conn->query($sql);

if ($result === false) {
    $rowCount=0;
}
else{
    // Fetch the result
    $row = $result->fetch_assoc();
    
    // Get the count from the result
    $rowCount = $row['count'];
    
}



?>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard</h4>
<div class="alert alert-danger">
<span data-notify="icon" class="la la-bell"></span>
<button type="button" class="close" data-dismiss="alert">x</button>
<b>Note:</b> Pay Via Upi Button Will Only Work If Your Current Bank Account Joined In Merchant App Support It. Use Of Your Website Name In Any Manner That Is Unlawful, Gambling, Crypto Or Betting Is Strictly Prohibited. We Reserve The Right To Terminate Your Account And/or Block Your Access To Your Website Name If We Suspect Any Such Activity.
</div>		
<div class="hk-row">
    <div class="col-lg-12 col-sm-12">
        <div class="card card-sm">
            <div class="card-body">
                <a href="#" target="_blank">
                    <img class="img-fluid mx-auto d-block" src="../promotion_banner/wamsg.png">
                    </a>
                    </div>
                    </div>
                    </div>
                    </div>
<div class="row">
							
							
							
							
							
							
							
							
						
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-4">
												<div class="icon-big text-center">
													<i class="la la-shekel text-dark"></i>
												</div>
											</div>
											<div class="col-8 d-flex align-items-center ">
												<div class="numbers">
													<p class="card-category text-dark">Gateway Health</p>
													<h4 class="card-title">OK</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-4">
												<div class="icon-big text-center">
													<i class="la la-hourglass-end text-primary"></i>
												</div>
											</div>
											<div class="col-8 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category text-primary">Used Transactions</p>
													<h4 class="card-title"><?php echo $rowCount?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-4">
												<div class="icon-big text-center">
													<i class="la la-newspaper-o text-info"></i>
												</div>
											</div>
											<div class="col-8 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category text-info">Plan Expire Date</p>
													<h4 class="card-title"><?php echo htmlspecialchars($userdata['expiry'], ENT_QUOTES, 'UTF-8'); ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 hand" onclick="location='subscription'">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-4">
												<div class="icon-big text-center">
													<i class="la la-cart-plus text-info"></i>
												</div>
											</div>
											
											<?php
											
											$expiryDate = $userdata['expiry'];
$today = date('Y-m-d'); // Get today's date in 'YYYY-MM-DD' format

if (strtotime($expiryDate) >= strtotime($today)) {
    $status = "Active";
} else {
    $status = "Expired";
}



											?>
											
											
											<div class="col-8 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category text-info">Plan Purchased</p>
													<h4 class="card-title"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-card-no-pd">
							<div class="col-md-12">
								<h6 class="btn badge bg-danger text-white mb-4" style="width: 100%;font-size:20px; ">
									<i class="la la-bell"></i>
									<marquee style="color: white;margin-bottom: -8px;" onmouseover="this.stop();" onmouseout="this.start();" direction="left" height="25">HDFC Vyapar Gateway Single API, Single Plan, All Working Fine thank you Your Website Name
									</marquee>
								</h6>
							<div class="table-responsive">
								<table class="table table-sm table-hover table-bordered table-head-bg-warning" id="dataTable" width="100%">
										<thead>
											<tr>
												<th class="d-none">#</th>
												<th>Txn ID</th>
												<th>Date Time</th>
												<th>Merchant</th>
												<th>Customer</th>
												<th>Txn Note</th>
												<th>Bank ID</th>
												<th>Bank RRN</th>
												<th>Order ID</th>
												<th>Amount</th>
												<th>Status</th>
												<!--<th>Action</th>-->
											</tr>
										</thead>
										<tbody>
											
											
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
<script src="assets/js/rechpay.js?1697738474"></script>
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
<script src="assets/js/merchant.js?1697738474"></script>

