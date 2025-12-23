<?php
include "header.php";

?>
<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Transactions</h4>
						<div class="row row-card-no-pd">
							<div class="col-md-12">
							<form class="row mb-4">
								<div class="col-md-3 mb-2">
									<label>From Date</label>
									<input type="text" id="from_date" value="" placeholder="DD-MM-YYYY" class="form-control datepicker" readonly>
								</div>
								<div class="col-md-3 mb-2">
									<label>To Date</label>
									<input type="text" id="to_date" value="" placeholder="DD-MM-YYYY" class="form-control datepicker" readonly>
								</div>
								<div class="col-md-4 mb-2">
									<label>Search</label>
									<input type="text" id="search_input" placeholder="Search By Txn ID / Bank RRN / Order ID" class="form-control">
								</div>
								<div class="col-md-2 mb-2">
									<label>&nbsp;</label>
									<button type="button" id="search" class="btn btn-primary btn-block" onclick="search_txn($('#from_date').val(),$('#to_date').val(),$('#search_input').val())">Search</button>
								</div>
							</form>	
							<div class="table-responsive">
								<table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer Mobile</th>
												<th>TransactionId</th>
												<th>Date Time</th>
												<th>Merchant</th>
												<th>Gateway Txn</th>
												<th>Bank RRN</th>
												<th>Order ID</th>
												<th>Amount</th>
												<th>Status</th>
												
											</tr>
										</thead>
										<tbody>
<?php
if($userdata['role'] == 'User'){
$token = $userdata['user_token'];


$query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = '$token' ORDER BY `create_date` DESC";
$query_run = mysqli_query($conn, $query);


if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        
      
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['byteTransactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";

        ?>
        <td class="badge badge-dark" style="width:70px;"><?php echo htmlspecialchars($row['method']); ?></td>
        <?php
        echo "<td>" . htmlspecialchars($row['gateway_txn'], ENT_QUOTES, 'UTF-8') . "</td>";
        ?>
        <?php
        echo "<td>" . htmlspecialchars($row['utr'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";


        //$sts = $row['status'];
        if($row['status']=="SUCCESS"){
            $sts = 'Success';
            $cls = "badge badge-success";
        }else{
            $sts = 'Pending';
            $cls = "badge badge-warning";
        }
        echo "<td><button class='$cls'>" . $sts . "</button></td>";
        echo "</tr>";
    }
} else {
    echo "Error in query: ";
    //echo "Error in query: " . mysqli_error($conn); 
}
}

//admin ke lie echo 

else{
    $token = $userdata['user_token'];


$query = "SELECT `id`, `transactionId`, `date`, `mobile`, `UTR`, `description`, `order_id`, `amount`, `status` FROM `reports` ";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        
      
        
        echo "<tr>";
       echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo "<td>" . htmlspecialchars($row['mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";

        ?>
        <td class="badge badge-dark" style="width:70px;">HDFC</td>
        <?php
        echo "<td>" . htmlspecialchars($row['UTR'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

        //$sts = $row['status'];
        if($row['status']==3){
            $sts = 'Success';
            $cls = "badge badge-success";
        }else{
            $sts = 'Pending';
            $cls = "badge badge-warning";
        }
        echo "<td><button class='$cls'>" . $sts . "</button></td>";
        echo "</tr>";
    }
} else {
    echo "Error in query: ";
    //echo "Error in query: " . mysqli_error($conn); 
}
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