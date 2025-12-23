<?php
require "../auth/config.php";

$cxrurl=$_SERVER["SERVER_NAME"];
// Query to fetch data where status=Active
$sql = "SELECT device_id, pin, number FROM hdfc WHERE status = 'Active'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the data into variables
    while ($row = mysqli_fetch_assoc($result)) {
        $PIN = $row['pin'];
        $deviceid = $row['device_id'];
        $no = $row['number'];

        $url = "https://{$cxrurl}/HDFCSoft/sesion.php?no=$no&device=$deviceid";
        $responseSEASION = file_get_contents($url);
        $json = json_decode($responseSEASION, true);
        $status = $json["status"];
        $sessionId = $json["sessionId"];
        $loginName = $json["loginName"];
        
        echo "<br>";
        echo "cronjob runned successfully"; //$sessionId we will use this session id to pin.php for vadilate
        echo "<br>";

        $sqlw = "UPDATE hdfc SET seassion='$sessionId' WHERE number='$no'";
        $rod = mysqli_query($conn, $sqlw);

        if ($status == 'Success') {
            $url = "https://{$cxrurl}/HDFCSoft/pin.php?&pin=$PIN&no=$no&sessionid=$sessionId";
            $response = file_get_contents($url);
            $json = json_decode($response, true);
            $status = $json["status"];
            
        }
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
