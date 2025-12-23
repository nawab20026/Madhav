<?php
function connect($ff){

// API URL
$url = 'https://hdfcmmp.mintoak.com/OneAppAuth/getKey';
//$sessionid = rand();
// Data to be sent in the POST request
$headers = array("Host: hdfcmmp.mintoak.com","motoken: ","sessionid: $sessionid","accept-encoding: gzip","user-agent: okhttp/4.9.1","deviceid: 5e0808b030960aee","content-length: 0");

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, 1);
///curl_setopt($ch, CURLOPT_POSTFIELDS, $);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and store the response
$response = curl_exec($ch);

return  $response;   
}
echo connect($dd);

?>