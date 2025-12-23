<?php

$json='{"status":"Success","respMessage":"Success","statusCode":"S101","terminalInfo":[{"39619366":{"city":"MALDA","location":"MALDA - BHIRABNATH ABASAN","address":"KHEJURIA NEW COLONY nh 34 kali temple , kali temple, MALDA, West Bengal-732215","mid":"719366","cid":"1751771","dba":"BIPLAB SARKAR","companyName":"BIPLAB SARKAR","accountNumber":"AQICAHheGvkgbzo7I4ho8ZnZTUzkwn83dQW9mrpkCtdzpsNmHAHVUjufvJvZv+O3XFdrqIqNAAAAbDBqBgkqhkiG9w0BBwagXTBbAgEAMFYGCSqGSIb3DQEHATAeBglghkgBZQMEAS4wEQQMRQNMf9LAfl/6VVlVAgEQgCkFAbMbdvlaaWl1+NL3bPfy6XTuK8Vs/odhCnVYHuBwAbF17qiKQgjk4A==","role":"owner","tidStatus":"Active","bankProduct":{"etbMdr":false,"OAR":false,"instantUpiSettlement":false,"V2P":false,"MAC":false,"etbOnboarding":false},"pinCode":"732215","segments":["399","492","387","418","433","457","409","248"],"roleStatus":"Active","moduleConsents":{"ETB Onboarding":true,"ETB MDR":true},"assetType":null,"tprogramOffered":null,"mccCode":"5311","payments":{"cards":null,"smsPay":{"status":"Active","providerName":"CCAvenue","providerId":1},"cash":{"status":"Active"},"upi":{"status":"Active","providerName":"HDFC","providerId":1,"vpa":null},"qr":{"status":"Active","providerName":"HDFC","providerId":1,"staticQRPath":null,"digitalStaticQRPath":"https://hdfcstaticqr-softcopy.s3.ap-south-1.amazonaws.com/DigitalStaticQR/39619366","staticQRStatus":2,"rupayPan":"6100030396193669","masterPassPan":"5220240396193661","mpan":"4403843961936604"},"payLater":{"status":"Active"}}}}]}
';
$data = json_decode($json, true);
$dynamicNumber = key($data['terminalInfo'][0]);
echo $dynamicNumber;


function todaysDate() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    return $tdate;
}
echo todaysDate();