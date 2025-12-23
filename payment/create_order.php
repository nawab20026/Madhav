<?php

include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";
include "../auth/config.php";

function RandomNumber($length) {
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= mt_rand(0, 9);
    }
    return $str;
}

function GenRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateUniqueToken() {
    $token = time() . bin2hex(random_bytes(16)) . rand(1, 50);
    return hash('sha256', $token);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    $json = array("status" => "Access Denied", "msg" => "Unauthorized Access");
    print_r(json_encode($json, TRUE));
    exit(); // Stop further script execution
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $customer_mobile = $_POST['customer_mobile'];
    $user_token = $_POST["user_token"];
    $amount = $_POST["amount"];
    $order_id = $_POST["order_id"];
    $redirect_url = $_POST["redirect_url"];
    $remark1 = $_POST["remark1"];
    $remark2 = $_POST["remark2"];

    $byteorderid = "BYTE" . rand(1111, 9999) . time();

    if ($amount == '') {
        echo json_encode(array("status" => "FAILURE", "msg" => "Please Enter Amount Data"));
        exit;
    } else {
        if ($order_id == '') {
            echo json_encode(array("status" => "false", "message" => "Please Enter Order_id Data"));
            exit;
        } else {
            if ($user_token == '') {
                echo json_encode(array("status" => "false", "message" => "Please Enter User_token Data"));
                exit;
            }
            
            // New validation for order_id
        $check_order_id_query = "SELECT * FROM orders WHERE order_id='$order_id' AND user_token='$user_token'";
        $existing_order_result = getXbyY($check_order_id_query);

        if (!empty($existing_order_result)) {
            echo json_encode(array("status" => "false", "message" => "Order ID already exists for this user"));
            exit;
        }

            else {

                $slq_pbbyt = "SELECT * FROM users where user_token='$user_token'";
                $res_pslq_pbbyt = getXbyY($slq_pbbyt);
                $bydb_unq_user_id=$res_pslq_pbbyt[0]['id'];
                $bydb_order_hdfc_conn = $res_pslq_pbbyt[0]['hdfc_connected'];
                $bydb_order_phonepe_conn = $res_pslq_pbbyt[0]['phonepe_connected'];
                $bydb_order_paytm_conn=$res_pslq_pbbyt[0]['paytm_connected'];
                $bydb_order_bharatpe_conn=$res_pslq_pbbyt[0]['bharatpe_connected'];
                $bydb_order_googlepay_conn=$res_pslq_pbbyt[0]['googlepay_connected'];

                if ($bydb_order_hdfc_conn == "Yes") {

                    $slq_p = "SELECT * FROM hdfc where user_token='$user_token'";
                    $res_p = getXbyY($slq_p);
                    $db_seassion = $res_p[0]['seassion'];
                    $db_DEVICE_ID = $res_p[0]['device_id'];
                    $tidlist = $res_p[0]['tidlist'];
                    $hdfc_number = $res_p[0]["number"];
                    

                    $url = "https://$server/HDFCSoft/sesion.php?no=$hdfc_number&device=$db_DEVICE_ID";
                    $responseSEASION = file_get_contents($url);
                    $json = json_decode($responseSEASION, true);
                    $status = $json["status"];
                    $sessionId = $json["sessionId"];

                    $diss = RandomNumber(18);

                    $sql = "UPDATE hdfc SET seassion='$sessionId' WHERE number='$hdfc_number'";
                    setXbyY($sql);

                    $txn_data = file_get_contents("https://5upi.gamekall.in/HDFCSoft/payrequest.php?sessionid=$db_seassion&cnumber=$customer_mobile&amount=$amount&no=$customer_mobile&tidList=$tidlist&dis=$diss");
                    $exampl = 'sessionid=' . $db_seassion . '&tidList=' . $tidlist . '';
                    $json = json_decode($txn_data, true);
                    $mTxnid = $json["mTxnid"];
                    $upiLink = $json["upiLink"];

                    if ($mTxnid == '') {
                        echo json_encode(array("status" => "false", "message" => "HDFC Merchant Not Linked"));
                        exit;
                    } else {
                        $today = date('Y-m-d');
                        $slq_p = "SELECT * FROM users where user_token='$user_token'";
                        $res_p = getXbyY($slq_p);
                        $expire_date = $res_p[0]['expiry'];

                        if ($expire_date >= $today) {
                            $order_id2 = base64_encode($order_id);
                            $gateway_txn1 = rand(1000000000, 9999999999);

                            $disst = RandomNumber(8);
                            $ne = base64_encode($exampl);
                            $r = $disst;
                            $rool = md5($r);

                            $gateway_txn = base64_encode($gateway_txn1);
                            $method = 'HDFC';
                            $currentTimestamp = date('Y-m-d H:i:s');

                            $sql = "INSERT INTO orders (gateway_txn, amount, order_id, status, user_token, utr, plan_id, customer_mobile, redirect_url, method, HDFC_TXNID, upiLink, description, create_date, remark1, remark2, user_id)
    VALUES ('$gateway_txn1', '$amount', '$order_id','PENDING', '$user_token', '', '', '$customer_mobile', '$redirect_url', '$method', '$mTxnid', '$upiLink', '$diss', '$currentTimestamp', '$remark1', '$remark2', '$bydb_unq_user_id')";

setXbyY($sql);


                            echo json_encode(array("status" => true, "message" => "Order Created Successfully", "result" => array("orderId" => $order_id, "payment_url" => "https://" . $server . "/payment/pay.php?data=" . $order_id2 . "&" . $rool . "&" . $ne)));
                            exit;
                        } else {
                            echo json_encode(array("status" => "false", "message" => "Your Plan Expired Please Renew"));
                            exit;
                        }
                    }
                }// <-- Close the HDFC block here

                
                //phonepe else if logic start
                elseif ($bydb_order_phonepe_conn == "Yes") {
                    $today = date('Y-m-d');
                    $slq_p = "SELECT * FROM users where user_token='$user_token'";
                    $res_p = getXbyY($slq_p);
                    $expire_date = $res_p[0]['expiry'];

                    if ($expire_date >= $today) {
                        // Generate a unique payment link token
                        $link_token = generateUniqueToken();

                        $cxrtoday = date("Y-m-d H:i:s");

                        // Insert the link_token into the payment_links table with the current date and time
                        $sql_insert_link = "INSERT INTO payment_links (link_token, order_id, created_at) VALUES ('$link_token', '$order_id', '$cxrtoday')";
                        setXbyY($sql_insert_link);

                        // Construct the payment link
                        $payment_link = "https://5upi.gamekall.in/payment2/instant-pay/" . $link_token;

                        $order_id2 = base64_encode($order_id);
                        $gateway_txn = uniqid();
                        $currentTimestamp = date('Y-m-d H:i:s');

                        $sql = "INSERT INTO orders (gateway_txn, amount, order_id, status, user_token, utr, plan_id, customer_mobile, redirect_url, Method, byteTransactionId, create_date, remark1, remark2, user_id)
VALUES ('$gateway_txn', '$amount', '$order_id', 'PENDING', '$user_token', '', '', '$customer_mobile', '$redirect_url', 'PhonePe', '$byteorderid', '$currentTimestamp', '$remark1', '$remark2', '$bydb_unq_user_id')";

setXbyY($sql);



                        echo json_encode(array("status" => true, "message" => "Order Created Successfully", "result" => array("orderId" => $order_id, "payment_url" => $payment_link)));
                        exit;
                    } else {
                        echo json_encode(array("status" => "false", "message" => "Your Plan Expired Please Renew"));
                        exit;
                    }
                } // <-- Close the phonepe block here
                
                //paytm else if logic start
                elseif ($bydb_order_paytm_conn == "Yes") {
                    $today = date('Y-m-d');
                    $slq_p = "SELECT * FROM users where user_token='$user_token'";
                    $res_p = getXbyY($slq_p);
                    $expire_date = $res_p[0]['expiry'];

                    if ($expire_date >= $today) {
                        // Generate a unique payment link token
                        $link_token = generateUniqueToken();

                        $cxrtoday = date("Y-m-d H:i:s");

                        // Insert the link_token into the payment_links table with the current date and time
                        $sql_insert_link = "INSERT INTO payment_links (link_token, order_id, created_at) VALUES ('$link_token', '$order_id', '$cxrtoday')";
                        setXbyY($sql_insert_link);

                        // Construct the payment link
                        $payment_link = "https://5upi.gamekall.in/payment3/instant-pay/" . $link_token;

                        $order_id2 = base64_encode($order_id);
                        $gateway_txn = uniqid();
                        $currentTimestamp = date('Y-m-d H:i:s');
                        $bytetxn_ref_id = GenRandomString().time();	
                       $sql = "INSERT INTO orders (paytm_txn_ref, gateway_txn, amount, order_id, status, user_token, utr, plan_id, customer_mobile, redirect_url, Method, byteTransactionId, create_date, remark1, remark2, user_id)
VALUES ('$bytetxn_ref_id', '$gateway_txn', '$amount', '$order_id', 'PENDING', '$user_token', '', '', '$customer_mobile', '$redirect_url', 'Paytm', '$byteorderid', '$currentTimestamp', '$remark1', '$remark2', '$bydb_unq_user_id')";

setXbyY($sql);



                        echo json_encode(array("status" => true, "message" => "Order Created Successfully", "result" => array("orderId" => $order_id, "payment_url" => $payment_link)));
                        exit;
                    } else {
                        echo json_encode(array("status" => "false", "message" => "Your Plan Expired Please Renew"));
                        exit;
                    }
                } // <-- Close the paytm block here
                
                
                  //Bharatpe else if logic start
                elseif ($bydb_order_bharatpe_conn == "Yes") {
                    $today = date('Y-m-d');
                    $slq_p = "SELECT * FROM users where user_token='$user_token'";
                    $res_p = getXbyY($slq_p);
                    $expire_date = $res_p[0]['expiry'];

                    if ($expire_date >= $today) {
                        // Generate a unique payment link token
                        $link_token = generateUniqueToken();

                        $cxrtoday = date("Y-m-d H:i:s");

                        // Insert the link_token into the payment_links table with the current date and time
                        $sql_insert_link = "INSERT INTO payment_links (link_token, order_id, created_at) VALUES ('$link_token', '$order_id', '$cxrtoday')";
                        setXbyY($sql_insert_link);

                        // Construct the payment link
                        $payment_link = "https://5upi.gamekall.in/payment4/instant-pay/" . $link_token;

                        
                        $gateway_txn = uniqid();
                        $currentTimestamp = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO orders (gateway_txn, amount, order_id, status, user_token, utr, plan_id, customer_mobile, redirect_url, Method, byteTransactionId, create_date, remark1, remark2, user_id)
VALUES ('$gateway_txn', '$amount', '$order_id', 'PENDING', '$user_token', '', '', '$customer_mobile', '$redirect_url', 'Bharatpe', '$byteorderid', '$currentTimestamp', '$remark1', '$remark2', '$bydb_unq_user_id')";

setXbyY($sql);



                        echo json_encode(array("status" => true, "message" => "Order Created Successfully", "result" => array("orderId" => $order_id, "payment_url" => $payment_link)));
                        exit;
                    } else {
                        echo json_encode(array("status" => "false", "message" => "Your Plan Expired Please Renew"));
                        exit;
                    }
                } // <-- Close the Bharatpe block here
                
                 //GooglePay else if logic start
                elseif ($bydb_order_googlepay_conn == "Yes") {
                    $today = date('Y-m-d');
                    $slq_p = "SELECT * FROM users where user_token='$user_token'";
                    $res_p = getXbyY($slq_p);
                    $expire_date = $res_p[0]['expiry'];

                    if ($expire_date >= $today) {
                        // Generate a unique payment link token
                        $link_token = generateUniqueToken();

                        $cxrtoday = date("Y-m-d H:i:s");

                        // Insert the link_token into the payment_links table with the current date and time
                        $sql_insert_link = "INSERT INTO payment_links (link_token, order_id, created_at) VALUES ('$link_token', '$order_id', '$cxrtoday')";
                        setXbyY($sql_insert_link);

                        // Construct the payment link
                        $payment_link = "https://5upi.gamekall.in/payment5/instant-pay/" . $link_token;

                        
                        $gateway_txn = uniqid();
                        $currentTimestamp = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO orders (gateway_txn, amount, order_id, status, user_token, utr, plan_id, customer_mobile, redirect_url, Method, byteTransactionId, create_date, remark1, remark2, user_id)
VALUES ('$gateway_txn', '$amount', '$order_id', 'PENDING', '$user_token', '', '', '$customer_mobile', '$redirect_url', 'Googlepay', '$byteorderid', '$currentTimestamp', '$remark1', '$remark2', '$bydb_unq_user_id')";

setXbyY($sql);



                        echo json_encode(array("status" => true, "message" => "Order Created Successfully", "result" => array("orderId" => $order_id, "payment_url" => $payment_link)));
                        exit;
                    } else {
                        echo json_encode(array("status" => "false", "message" => "Your Plan Expired Please Renew"));
                        exit;
                    }
                } // <-- Close the GooglePay block here
                
                
                
                elseif ($bydb_order_hdfc_conn == "No" || $bydb_order_phonepe_conn == "No" || $bydb_order_paytm_conn == "No" || $bydb_order_bharatpe_conn == "No" || $bydb_order_googlepay_conn == "No") {
                         echo json_encode(array("status" => "false", "message" => "Merchant Not Linked"));
                         exit;
                    } 
            }
        }
    }
}
?>
