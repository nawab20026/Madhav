<?php
include "../auth/config.php";



// Sanitizing the parameters retrieved using $_GET
$no = $_GET['no'];
$session = $_GET['session'];

$txn_data = file_get_contents('https://'.$server.'/HDFCSoft/userdtl.php?no='.$no.'&sessionid='.$session.''); 

$data = json_decode($txn_data, true);
$dynamicNumber = key($data['terminalInfo'][0]);

function todaysDate() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    return $tdate;
}
$date=todaysDate();


 $txn_data = file_get_contents('https://'.$server.'/HDFCSoft/miniStatement.php?&count=10&no='.$no.'&tidList='.$dynamicNumber.'&sessionid='.$session.'&startDate='.$date.'&endDate='.$date.''); 
echo $txn_data;


/*$rowf = json_decode($txn_data, true);
if($rowf['status'] == 'Success'){
$upi_id = $rowf['transactionParams'][0]['paymentApp'];
echo $upi_id;
}else{
    echo $rowf['status'];
}*/