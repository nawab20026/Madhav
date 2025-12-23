<?php


// Function to sanitize user input
function sanitizeInput($input) {
    if (is_string($input)) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    } else {
        // Handle non-string input here (e.g., arrays, objects, etc.) if needed.
        return $input;
    }
}

  // Function to generate a random instance_id
  function generateRandomInstanceId($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = 'I'; // Fixed 'I' as the first character

    // Generate a random string with the specified length - 7 (for the time part and additional digit)
    for ($i = 1; $i < $length - 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Get the current time in seconds since the epoch
    $currentTime = time();

    // Take the last 6 digits from the current time and append them to the random string
    $lastSixDigits = substr(strval($currentTime), -6);
    $randint = rand(100, 900);
    
    return $randomString . $randint . $lastSixDigits;
}



function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


function curlGet($url) {
    // Initialize cURL session
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url); // Set the URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification (for testing)
    
    // Execute the cURL session and store the result in $response
    $response = curl_exec($ch);
    
    // Check for cURL errors
    if(curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }
    
    // Close the cURL session
    curl_close($ch);
    
    // Return the response
    return $response;
}




function getXbyY($query) {
    
    $con = connect_database();
    $result = $con->query($query) or die($query . " " . mysqli_error($con));

    for ($set = array(); 
    $row = $result->fetch_assoc(); 
    $set[] = $row);

    $con->close();
    return $set;
}

function setXbyY($query) {
    $con = connect_database();
    $result = $con->query($query) or die($query . " " . mysqli_error($con));
    $con->close();
    return $result;
}

###################################################################
//Start of function to get todays date
##################################################################

function todaysDate() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    $tdate = $tdate . " " . date('H:i:s');
    return $tdate;
}

###################################################################
//End of function to get todays date
##################################################################
###################################################################
//Start of function to convert date format to dd-mm-yyyy
##################################################################

function format_date($date) {
    $dd = explode(" ", $date);
    $dd1 = explode("-", $dd[0]);

    $new_date = $dd1[2] . "-" . $dd1[1] . "-" . $dd1[0] . "<br />" . $dd[1];
    return $new_date;
}

###################################################################
//End of function to convert date format to dd-mm-yyyy
##################################################################
###################################################################
//Start of function to convert date format to dd-mm-yyyy
##################################################################

function format_date1($date) {
    $dd = explode(" ", $date);
    $dd1 = explode("-", $dd[0]);

    $new_date = $dd1[2] . "-" . $dd1[1] . "-" . $dd1[0] . " " . $dd[1];
    return $new_date;
}

###################################################################
//End of function to convert date format to dd-mm-yyyy
##################################################################
####################################################################
//Start of function to convert date format to dd-mm-yyyy
##################################################################

function format_date_without_time($date) {
    $dd = explode(" ", $date);
    return $dd[0];
}

###################################################################
//End of function to convert date format to dd-mm-yyyy
##################################################################
###################################################################
//Start of function to convert date format to dd-mm-yyyy
##################################################################

function format_date_without_br($date) {
    $dd = explode(" ", $date);
    $dd1 = explode("-", $dd[0]);

    $new_date = $dd1[2] . "-" . $dd1[1] . "-" . $dd1[0] . " " . $dd[1];
    return $new_date;
}

###################################################################
//End of function to convert date format to dd-mm-yyyy
##################################################################
###################################################################
//Start of function to get todays date
##################################################################

function today_date_limit($tdate1) {
    if ($tdate == "") {
        $tdate1 = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    }
    $tdate['start_time'] = $tdate1 . " 00:00:00";
    $tdate['end_time'] = $tdate1 . " 23:59:59";
    return $tdate;
}

###################################################################
//End of function to get todays date
##################################################################
#

function getDates($ldate) {
    //$ldate2 = explode(" ", $ldate);
    $ldate1 = explode("/", $ldate);
    $id = $ldate1[1];

    switch ($id) {
        case 2:
            $monthNAME = "Feb";
            return $api_id;
        case 3:
            $monthNAME = "Mar";
            return $api_id;
        case 4:
            $monthNAME = "Apr";
            return $api_id;
        case 5:
            $monthNAME = "May";
            return $api_id;
        case 6:
            $monthNAME = "Jun";
            return $api_id;
        case 7:
            $monthNAME = "Jul";
            return $api_id;
        case 8:
            $monthNAME = "Aug";
            return $api_id;
        case 9:
            $monthNAME = "Sept";
            return $api_id;
        case 10:
            $monthNAME = "Oct";
            return $api_id;
        case 11:
            $monthNAME = "Nov";
            return $api_id;
        case 12:
            $monthNAME = "Dec";
            return $api_id;
        default:
            $monthNAME = "Jan";
            return $api_id;
    }

    // $rdate = $ldate1[2] . "-" . $ldate1[1] . "-" . $ldate1[0] . " " . $ldate2[1];
    $rdate = $ldate1[2] . "-" . $monthNAME . "-" . $ldate1[0];
    return $rdate;
}

###################################################################
//End of getdate function
##################################################################
###################################################################
//Start of function to get todays date
##################################################################

function todaysDate_only() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("y")));
    return $tdate;
}

###################################################################
//End of function to get todays date
##################################################################
###################################################################
//Start of function to get date only leaving time back
##################################################################

function format_date_only($date) {
    $dd = explode(" ", $date);
    $dd1 = explode("-", $dd[0]);
    $tdate = $dd1[2] . "/" . $dd1[1] . "/" . $dd1[0];
    return $tdate;
}

###################################################################
//End of function to get date only leaving time back
##################################################################
###################################################################
//Start of function to get todays date
##################################################################

function yesterday_date() {
    $tdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("y")));
    return $tdate;
}

###################################################################
//End of function to get todays date
##################################################################
###################################################################
//Start of function to get start of month
##################################################################

function month_start() {
    $tdate = date("Y") . "-" . date("m") . "-01 00:00:00";
    return $tdate;
}

###################################################################
//End of function to get start of month
##################################################################
#######################################################################################
//To print the values for testing
#######################################################################################

function pt($val) {
    echo "<pre>";
    print_R($val);
    echo "</pre>";
}

#######################################################################################
//End of function To send mail attachments
#######################################################################################
###############################################################
//Start of function to get unique reference number
###############################################################

function reference_number() {
    $rand = rand(0, 9);
    $ref_number = abs(crc32(time()));
    $ref_number = $ref_number . "" . $rand;
    return $ref_number;
}

###############################################################
//End of function to get unique reference number
###############################################################

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {

    $file = $path . "/" . $filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));

    $uid = md5(uniqid(time()));

    $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message . "\r\n\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $header .= $content . "\r\n\r\n";
    $header .= "--" . $uid . "--";

    // Messages for testing only, nobody will see them unless this script URL is visited manually
    if (mail($mailto, $subject, "", $header)) {
        //echo "Message sent!";
    } else {
        //echo "ERROR sending message.";
    }
}

###################################################################
//Start of function to for sendign attachments
##################################################################
###################################################################

##################################################################
###############################################################
//function to upload files with thumbnails
###############################################################

function uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark) {
//echo "<pre>";print_r($_SERVER);
    $destinationname = $source . "/" . $destination;
    $target_filename = up_load_file($tmpfile, $destinationname);

    if ($thumbnail == 1) {
        $thumbnailfile = $source . "/thumbs/" . $destination;
        list($width, $height, $type, $attr) = getimagesize($destinationname);
        if ($width > $height) {
            $denominator = $width / $newsize;
        } else {
            $denominator = $height / $newsize;
        }

        $newWIDTH = floor(($width / $denominator));
        $newHEIGHT = floor(($height / $denominator));

        image_resize($destinationname, $thumbnailfile, $newWIDTH, $newHEIGHT);
    }
}

###################################################################
//End of upload function
##################################################################
###############################################################
//function to upload files
###############################################################

function up_load_file($source_file, $target_file) {
    $file_ext = substr(basename($target_file), strrpos(basename($target_file), "."));
    $dir_path = dirname($target_file);
    $base_name = basename($source_file);
    if (file_exists($target_file)) {
        $target_file = $dir_path . "/" . substr($base_name, 0, -4) . $file_ext;
    }

    if (!file_exists($target_file)) {
        copy($source_file, $target_file);
    } else {
        return false;
    }
    return basename($target_file);
}

###################################################################
//End of upload function
##################################################################
###################################################################
//Start of function to  create thumbnail
##################################################################

function image_resize($src, $dst, $width, $height) {

    if (!list($w, $h) = getimagesize($src)) {
        return "Unsupported picture type!";
    }

    $type = strtolower(substr(strrchr($src, "."), 1));
    if ($type == 'jpeg') {
        $type = 'jpg';
    }

    switch ($type) {
        case 'bmp':$img = imagecreatefromwbmp($src);
            return $api_id;
        case 'gif':$img = imagecreatefromgif($src);
            return $api_id;
        case 'jpg':$img = imagecreatefromjpeg($src);
            return $api_id;
        case 'png':$img = imagecreatefrompng($src);
            return $api_id;
        default:return "Unsupported picture type!";
    }

    $new = imagecreatetruecolor($width, $height);

    // preserve transparency
    if ($type == "gif" or $type == "png") {
        imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
        imagealphablending($new, false);
        imagesavealpha($new, true);
    }

    imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

    switch ($type) {
        case 'bmp':imagewbmp($new, $dst);
            return $api_id;
        case 'gif':imagegif($new, $dst);
            return $api_id;
        case 'jpg':imagejpeg($new, $dst);
            return $api_id;
        case 'png':imagepng($new, $dst);
            return $api_id;
    }
    return true;
}

###################################################################
//end of function to create thumbnail
##################################################################
##############################################################
//function to upload files with thumbnails
###############################################################

function uploadimagepreview($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark) {
    $destinationname = $source . "/" . $destination;

    if ($thumbnail == 1) {

        $thumbnailfile = $source . "/preview/" . $destination;

        list($width, $height, $type, $attr) = getimagesize($destinationname);
        if ($width > $height) {
            $denominator = $width / $newsize;
        } else {
            $denominator = $height / $newsize;
        }

        $newWIDTH = floor(($width / $denominator));
        $newHEIGHT = floor(($height / $denominator));

        image_resize($destinationname, $thumbnailfile, $newWIDTH, $newHEIGHT);
    }
}

###################################################################
//End of getdate function
##################################################################
#######################################################################################
//Function to check sql injections
#######################################################################################

function parameters_check() {
    //  pt($_POST);
    $test_arr = array();
    $posted_values = $_POST;
    $count_post = count($_POST);
    $con = connect_database();
    foreach ($posted_values as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($con, $_POST[$key]);

        $test_arr[] = strtolower($value);
    }

    for ($i = 0; $i < count($test_arr); $i++) {
        $i1 = strrpos($test_arr[$i], "Select");
        if (strpos($test_arr[$i], 'select') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }

        if (strpos($test_arr[$i], 'insert') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'delete') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'update') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'show') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
    }

    $get_values = $_GET;
    $count_get = count($_GET);

    foreach ($get_values as $key => $value) {
        $_GET[$key] = mysqli_real_escape_string($con, $_GET[$key]);
        $test_arr[] = strtolower($value);
    }

    for ($i = 0; $i < count($test_arr); $i++) {
        $i1 = strrpos($test_arr[$i], "Select");
        if (strpos($test_arr[$i], 'select') !== false) {

            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }

        if (strpos($test_arr[$i], 'insert') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'delete') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'update') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
        if (strpos($test_arr[$i], 'show') !== false) {
            $result['error'] = "Unauthorized Access";
            echo json_encode($result);
            die();
        }
    }
}

#######################################################################################
//End of Function to check sql injections
#######################################################################################
#######################################################################################
//Start of function to create user defined password
#######################################################################################

function cpassword($password) {
    
    return $password;
}

#######################################################################################
//End of function to create user defined password
#######################################################################################
#######################################################################################
//Start of function to create user defined create_username
#######################################################################################

function create_username($type) {
    $sql = "Select count(user_id) as total from users where user_type ='" . $type . "' ";
    $res = getXbyY($sql);

    if ($res[0]['total'] > 0) {
        $tt = $res[0]['total'] + 1;
        if ($type == 'Master Distributor') {
            $user_name = "MD" . $tt;
        } else if ($type == 'Distributor') {
            $user_name = "DT" . $tt;
        } else if ($type == 'Retailer') {
            $user_name = "RT" . $tt;
        } else if ($type == 'API User') {
            $user_name = "AU" . $tt;
        } else {
            $user_name = $type . "" . $tt;
        }
    } else {
        if ($type == 'Master Distributor') {
            $user_name = "MD01";
        } else if ($type == 'Distributor') {
            $user_name = "DT01";
        } else if ($type == 'Retailer') {
            $user_name = "RT01";
        } else if ($type == 'API User') {
            $user_name = "AU01";
        } else {
            $user_name = $type . "01";
        }
    }
    return $user_name;
}

################################################################################
//End of function to create user defined create_username
################################################################################

###############################################################
// Start of function to Send sms
##############################################################

function sendsms_payzoom($mobile, $message) {
    $o11 = new stdClass();

    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");

    if ($o11->api_id == "6") {
        
        $message = $message;
		$curl = curl_init();
        $url = $o11->api_domain . "authorization=" . $o11->api_key . "&sender_id=" . $o11->md_key . "&message=".urlencode($message)."&language=english&route=" . $o11->corporate_id . "&numbers=".urlencode($mobile);
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
         //pt($url);die;
        curl_close($ch);
		//pt($response);die;
    } else {
        return "Nothing to do";
    }
}

// ##############################################################
// End of function to send sms
#################################################################
###############################################################
// Start of function to Send sms
##############################################################

function sendsms_msg91($mobile, $message) {


    $o11 = new stdClass();

    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("11", "api", "api_id");

//$mobile = "91".$mobile;

    if ($o11->api_id == 11) {
        $url = $o11->api_domain . "?mobiles=" . $mobile . "&authkey=" . $o11->api_key . "&route=4&sender=abhipay&message=" . $message . "&country=91";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        /*
          if ($err) {
          echo "cURL Error #:" . $err;
          } else {
          echo $response;
         */

        $o11->api_balance = $o11->api_balance - 1;
        $updater = new TypeUpdater($dbName);
        $o11->api_id = $updater->update_object($o11, "api");
    } else {
        return "Nothing to do";
    }
}

// ##############################################################
// End of function to send sms
#################################################################
#################################################################
// Start of function to differentiate user_type
####################################################################
function user_type_colors($user_type) {
    if ($user_type == "Admin") {
        $colors['bgcolor'] = "#f16530";
        $colors['color'] = "#fff";
    } else {
        $colors['bgcolor'] = "#fff";
        $colors['color'] = "#858796";
    }

    return $colors;
}

####################################################################
// End of function to differentiate user_type
###############################################################
####################################################################
// Start of function to get status of user
###############################################################

function status($is_active) {
    if ($is_active == 1) {
        $status = "<span class='fa_approve' >Active</span>";
    } else {
        $status = "<span class='fa_reject' >Blocked</span>";
    }
    return $status;
}

function status_papa($status, $id, $type, $table, $parent_id, $table_id) {

    if ($status == 'Yes' || $status == '1') {
        $status = "<label class='switch'>
        <input type='checkbox' value='' checked='checked'  >
        <span class='slider round span_margin' onclick=\"change_status_setting('" . $status . "','" . $id . "','" . $type . "','" . $table . "','" . $parent_id . "','" . $table_id . "')\">On</span>
        </label>";
    } else {
        $status = "<label class='switch'>
        <input type='checkbox' value=''  >
        <span class='slider round span_margin_block' onclick=\"change_status_setting('" . $status . "','" . $id . "','" . $type . "','" . $table . "','" . $parent_id . "','" . $table_id . "')\">Off</span>
        </label>";
    }
    return $status;
}

###############################################################
// End of function to get status of user
###############################################################
###############################################################
//Start of function to list api's in dropdown
###############################################################

function api_list($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select api_id, api_name from api where is_active = 1 order by api_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['api_id'] . "' ";
        if ($res[$i]['api_id'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['api_name'] . "</option>";
    }

    return $sstring;
}

###############################################################
//End of function to list api's in dropdown
###############################################################
###############################################################
//Start of function get api name from id
###############################################################

function get_api_name($api_id) {
    if ($api_id > 0) {
        $sql = "Select api_name from api where api_id = " . $api_id;
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            return $res[0]['api_name'];
        } else {
            return "Any";
        }
    } else {
        return "Any";
    }
}

###############################################################
//End of function get api name from id
###############################################################
###############################################################
//Start of function to list service in dropdown
###############################################################

function service_list($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select service_id, service_name from services where is_active = 1 order by service_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['service_id'] . "' ";
        if ($res[$i]['service_id'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['service_name'] . "</option>";
    }

    return $sstring;
}

###############################################################
//End of function to list services in dropdown
###############################################################
###############################################################
//Start of function to list service in get_service_id
###############################################################

function get_service_id($id) {

    $sql = "Select service_id from services where  service_name='" . $id . "'";
    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows > 0) {
        $sstring = $res[0]['service_id'];
    } else {
        $sstring = '0';
    }

    return $sstring;
}

###############################################################
//End of function to list services in dropdown
###############################################################
###############################################################
//Start of function get service name from id
###############################################################

function get_service_name($service_id) {
    if ($service_id > 0) {
        $sql = "Select service_name from services where service_id = " . $service_id;
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            return $res[0]['service_name'];
        } else {
            return "Any";
        }
    } else {
        return "Any";
    }
}

###############################################################
//End of function get service name from id
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function service_provider_list($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from providers where is_active = 1 order by provider";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['provider_id'] . "' ";
        if ($res[$i]['provider_id'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['provider'] . " [" . $res[$i]['service'] . "]</option>";
    }

    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function get provider name from id
###############################################################

function get_provider_name($provider_id) {
    if ($provider_id > 0) {
        $sql = "Select provider from providers where provider_id = " . $provider_id;
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            return $res[0]['provider'];
        } else {
            return "Any";
        }
    } else {
        return "Any";
    }
}

###############################################################
//End of function get provider name from id
###############################################################
###############################################################
//Start of function get provider name from id
###############################################################

function get_circle_name($provider_id) {
    if ($provider_id > 0) {
        $sql = "Select circle_name from service_circles where service_circle_id = " . $provider_id;
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            return $res[0]['circle_name'];
        } else {
            return "Any";
        }
    } else {
        return "Any";
    }
}

###############################################################
//End of function get provider name from id
###############################################################
###############################################################
//Start of function to list user_type in drop downs.
###############################################################

function user_types($id) {
    $sql = "Select * from user_types where is_active = 1 order by user_type";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_type']) {
            $sstring .= "<option value='" . $res[$i]['user_type'] . "' selected = 'selected'>" . $res[$i]['user_type'] . "</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_type'] . "' >" . $res[$i]['user_type'] . "</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list user_type in drop downs.
###############################################################


###############################################################
//for color combination list
###############################################################
function color_combinations($color) {
    $sql = "Select * from color_combinations where is_active = 1 order by color_combinations";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($color == $res[$i]['css_field']) {
            $sstring .= "<option value='" . $res[$i]['css_field'] . "' selected = 'selected'>" . $res[$i]['color_combinations'] . "</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['css_field'] . "' >" . $res[$i]['color_combinations'] . "</option>";
        }
    }

    return $sstring;
}
###############################################################
//end of function of color combination
###############################################################


###############################################################
//Start of function to list users in dropdown
###############################################################

function user_list_dropdown($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where is_active = 1 order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_id']) {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "' selected required='required'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list users in dropdown
###############################################################
###############################################################
//Start of function to list users in dropdown
###############################################################

function user_list_dropdown_retailer($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where is_active = 1 and user_type = 'Retailer' order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_id']) {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "' selected required='required'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list users in dropdown
###############################################################

function user_list_dropdown_team($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where (user_type='Admin' or user_type ='Distributor'  or user_type ='Master Distributor') and is_active = 1 order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_id']) {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "' selected required='required'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        }
    }

    return $sstring;
}

###############################################################
//Start of function to list users in dropdown
###############################################################

function dt_list_dropdown($id, $user_id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where is_active = 1 and parent_id = '" . $id . "' order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($user_id == $res[$i]['user_id']) {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "' required='required'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list users in dropdown
###############################################################
###############################################################
//Start of function to list admin in dropdown
###############################################################

function admin_list_dropdown($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where is_active = 1 and user_type = 'admin' order by user_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_id']) {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "' required='required'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list users in dropdown
###############################################################
###############################################################
//Start of function to list user plans in drop down
###############################################################

function user_plans_dropdown($id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select * from user_plans where is_active = 1 order by plan_name";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['user_plan_id']) {
            $sstring .= "<option value = '" . $res[$i]['user_plan_id'] . "' selected = 'selected'>" . $res[$i]['plan_name'] . "</option>";
        } else {
            $sstring .= "<option value = '" . $res[$i]['user_plan_id'] . "' >" . $res[$i]['plan_name'] . "</option>";
        }
    }
    return $sstring;
}

function user_plans($user_plan_id) {
    if ($user_plan_id == "") {
        $user_plan_id = 0;
    }
    $sql = "Select plan_name from user_plans where user_plan_id = " . $user_plan_id;
    $res = getXbyY($sql);

    return $res[0]['plan_name'];
}

###############################################################
//End of function to list user plans in drop down
###############################################################
###############################################################
//Start of function to list providers in drop down
###############################################################

function get_provider_list_by_service($provider_id, $service_id) {
    if ($provider_id == "") {
        $provider_id = 0;
    }
    if ($service_id == "") {
        $service_id = 0;
    }


    $sql = "Select provider_id, provider from providers where is_active = 1 and service_id = " . $service_id . " order by provider";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($provider_id == $res[$i]['provider_id']) {
            $sstring .= "<option value='" . $res[$i]['provider_id'] . "' selected = 'selected'>" . $res[$i]['provider'] . "</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['provider_id'] . "'>" . $res[$i]['provider'] . "</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list providers in drop down
###############################################################
###############################################################
//Start of function to list circles in dropdown
###############################################################

function get_circle_list($id) {
    if ($id == "") {
        $id = "None";
    }
    $sql = "Select * from service_circles where is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['circle_name']) {
            $sstring .= "<option value='" . $res[$i]['circle_name'] . "' selected = 'selected'>" . $res[$i]['circle_name'] . "</option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['circle_name'] . "'>" . $res[$i]['circle_name'] . "</option>";
        }
    }

    return $sstring;
}

###############################################################
//End of function to list circles in dropdown
###############################################################
###############################################################
//Start of Function to set check operator info
###############################################################

function planapi_mobile_info($mobile, $str) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");

    $url = $o11->api_domain . "?format=json&token=" . $o11->api_key . "&mobile=" . $str;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $values = json_decode($output);
    $oinfo = $output;
    $oinfo = $values;
    pt($oinfo);
    $sql = "Select * from api_provider_code where provider_code = '" . $values->Operator . "' and api_id = 4";
    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows > 0) {
        $oinfo['provider_id'] = $res[0]['provider_id'];
        $oinfo['provider'] = $res[0]['provider'];
        $oinfo['circle'] = $values->Circle;
    } else {
        $oinfo['provider_id'] = "";
        $oinfo['provider'] = "";
        $oinfo['circle'] = "";
    }

    user_mobiles($mobile, $oinfo['provider'], $oinfo['provider_id'], $oinfo['circle']);

    return $oinfo;
}

###############################################################
//End of Function to set check operator info
###############################################################
###############################################################
//Start of function to get api provider code
###############################################################

function get_api_provider_code($id, $api_name) {
    if ($id == "") {
        $id = 0;
    }
    if ($api_name == "") {
        $api_name = "";
    }
    $sql = "Select * from api_provider_code where provider_id = " . $id . " and is_active = 1 and api_name = '" . $api_name . "'";

    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows == 1) {
        $provider_code = $res[0]['provider_code'];
    } else {
        $provider_code = "";
    }

    return $provider_code;
}

###############################################################
//End of function to get api provider code
###############################################################
###############################################################
//Start of function to get offers from mplan
###############################################################

function mplan_plans($operator, $circle) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("5", "api", "api_id");

    $url = $o11->api_domain . "plans.php?apikey=" . $o11->api_key . "&cricle=" . $circle . "&operator=" . $operator;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $values = json_decode($output);

    return $values;
}

###############################################################
//End of function to get offers from mplan
###############################################################
###############################################################
//Start of function to get dth plans from mplan
###############################################################

function mplan_plans_dth($operator) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("5", "api", "api_id");

    $url = $o11->api_domain . "dthplans.php?apikey=" . $o11->api_key . "&operator=" . $operator;
    //$url = $o11->api_domain . "dthplans.php?apikey=" . $o11->api_key . "&operator=Tata%20Sky";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $values = json_decode($output);

    return $values;
}

###############################################################
//End of function to get dth plans from mplan
###############################################################
###############################################################
//Start of function to  recharge select api
###############################################################
function select_whitelabel_api($user_id){
  $sql = "Select * from api where user_id ='".$user_id."' order by rand() ";
  $res = getXbyY($sql);
  $row = count($res);

  return $res[0]['api_id'];
}

function select_api($user_object, $wallet_object, $service_id, $counter) {

    $sql_route = "Select * from routes where is_active = 1 order by priority";
    $res_route = getXbyY($sql_route);
    $row_route = count($res_route);

    if ($counter == 0) {
        for ($i = 0; $i < $row_route; $i++) {

            if ($res_route[$i]['route_type'] == "Member") {
                $sql = "Select * from route_details where user_id = " . $user_object->user_id . " and is_active = 1 and route_type = 'Member' order by priority ASC";
                $res = getXbyY($sql);
                $rows = count($res);

                for ($j = 0; $j < $rows; $j++) {

                    if ($res[$j]['service_id'] == 0) {
                        if ($res[$j]['amount_check'] == "Yes") {
                            if ($wallet_object->amount >= $res[$j]['amount_from'] && $wallet_object->amount <= $res[$j]['amount_check']) {
                                if ($res[$j]['api_id'] > 0) {
                                    $api_id = $res[$j]['api_id'];
                                    return $api_id;
                                }
                            }
                        } else {
                            if ($res[$j]['api_id'] > 0) {
                                $api_id = $res[$j]['api_id'];
                                return $api_id;
                            }
                        }
                    } else {
                        if ($res[$j]['service_id'] == $service_id) {

                            if ($res[$j]['provider_id'] == 0) {
                                if ($res[$j]['amount_check'] == "Yes") {
                                    if ($wallet_object->amount >= $res[$j]['amount_from'] && $wallet_object->amount <= $res[$j]['amount_check']) {
                                        if ($res[$j]['api_id'] > 0) {
                                            $api_id = $res[$j]['api_id'];
                                            return $api_id;
                                        }
                                    }
                                } else {
                                    if ($res[$j]['api_id'] > 0) {
                                        $api_id = $res[$j]['api_id'];
                                        return $api_id;
                                    }
                                }
                            } else {
                                if ($res[$j]['provider_id'] == $wallet_object->provider_id) {

                                    if ($res[$j]['amount_check'] == "Yes") {
                                        if ($wallet_object->amount >= $res[$j]['amount_from'] && $wallet_object->amount <= $res[$j]['amount_check']) {
                                            if ($res[$j]['api_id'] > 0) {
                                                $api_id = $res[$j]['api_id'];
                                                return $api_id;
                                            }
                                        }
                                    } else {
                                        if ($res[$j]['api_id'] > 0) {
                                            $api_id = $res[$j]['api_id'];
                                            return $api_id;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if ($api_id > 0) {
                    return $api_id;
                }
            } else if ($res_route[$i]['route_type'] == "Service") {
                $sql = "Select * from services where service_id = " . $service_id . " and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);

                if ($rows == 1) {
                    if ($res[0]['api_id'] > 0) {
                        $api_id = $res[0]['api_id'];
                        return $api_id;
                    }
                }
            } else if ($res_route[$i]['route_type'] == "Operator") {
                $sql = "Select * from providers where provider_id = " . $wallet_object->provider_id . " and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);
                if ($rows == 1) {

                    if ($res[0]['api_id'] > 0) {
                        $api_id = $res[0]['api_id'];
                        return $api_id;
                    }
                }
            } else if ($res_route[$i]['route_type'] == "Plan") {
                $sql = "Select * from user_plans where user_plan_id = " . $user_object->plan_id . " and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);

                if ($rows == 1) {
                    if ($res[0]['api_id'] > 0) {
                        $api_id = $res[0]['api_id'];
                        return $api_id;
                    }
                }
            } else if ($res_route[$i]['route_type'] == "Amount") {
                $sql = "Select * from route_details where route_type = 'Amount' and is_active = 1 and amount_from <= '" . $wallet_object->amount . "' and amount_to >= '" . $wallet_object->amount . "' order by priority";
                $res = getXbyY($sql);
                $rows = count($res);

                for ($j = 0; $j < $rows; $j++) {
                    if ($res[$j]['api_id'] > 0) {
                        $api_id = $res[$j]['api_id'];
                        return $api_id;
                    }
                }

                if ($api_id > 0) {
                    return $api_id;
                }
            }
        }
    } else if ($counter = 1) {
        $api_id = $res_route[0]['api_2'];
    } else {
        $api_id = $res_route[0]['api_3'];
    }

    return $api_id;
}

###############################################################
//End of function to  recharge select api
###############################################################
function shake_recharge($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("14", "api", "api_id");
    //echo '<pre>'; print_r($o); die;
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {
            $url = $o11->api_domain . "Recharge.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password . "&Amount=" . $o->amount . "&OperatorCode=" . $provider_code . "&Number=" . $o->mobile_number . "&ClientId=" . $o->ref_number . "&CircleCode=" . $o->circle_id;
            //  pt($url);

            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);

            $err = curl_error($ch);
            curl_close($ch);
            $status = explode("|", $response);
            if ($status[0] != "") {
                if ($status[0] == "0") {
                    $result['status'] = 'Success';
                    $result['opid_id'] = $status[4];
                } else if ($status[0] == "1") {
                    $result['status'] = 'Pending';
                    $result['opid_id'] = $status[4];
                    //pending
                } else if ($status[0] == "2") {
                    $result['status'] = 'Failed';
                    $result['opid_id'] = $status[4];
                    //failed
                } else {
                    $result['status'] = 'Failed';
                }
            } else {
                $result['status'] = 'Failed';
            }

            $result['message'] = $status[5];
            $result['responsestaus'] = $status[5];
            $result['tnx_id'] = $status[2];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $response;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}
###############################################################
//Start of function to  recharge esay my wallet
###############################################################

function recharge_easymywallet($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {
            $url = $o11->api_domain . "Recharge.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password . "&Amount=" . $o->amount . "&OperatorCode=" . $provider_code . "&Number=" . $o->mobile_number . "&ClientId=" . $o->ref_number . "&CircleCode=" . $o->circle_id;
            //  pt($url);

            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);

            $err = curl_error($ch);
            curl_close($ch);
            $status = explode("|", $response);
            if ($status[0] != "") {
                if ($status[0] == "0") {
                    $result['status'] = 'Success';
                    $result['opid_id'] = $status[4];
                } else if ($status[0] == "1") {
                    $result['status'] = 'Pending';
                    $result['opid_id'] = $status[4];
                    //pending
                } else if ($status[0] == "2") {
                    $result['status'] = 'Failed';
                    $result['opid_id'] = $status[4];
                    //failed
                } else {
                    $result['status'] = 'Failed';
                }
            } else {
                $result['status'] = 'Failed';
            }

            $result['message'] = $status[5];
            $result['responsestaus'] = $status[5];
            $result['tnx_id'] = $status[2];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $response;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to get recharge my wallet
###############################################################
###############################################################
//Start of function to  Status esay my wallet
###############################################################

function status_easymywallet($order_id) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "RechargeStatus.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password . "&ClientId=" . $order_id;
        //  pt($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return $response;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to get Status Esay my wallet
###############################################################
###############################################################
//Start of function to  Status esay my wallet
###############################################################

function easymywallet_status($o1) {

    if ($o1->status == "Pending") {

        $o11 = new stdClass();
        $factory = new TypeFactory($dbName);
        $o11 = $factory->get_object("6", "api", "api_id");
        $url = $o11->api_domain . "RechargeStatus.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password . "&ClientId=" . $o1->ref_number;

        //$url = $o11->api_domain . "RechargeStatus.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_key . "&ClientId=" . $o1->ref_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $status = explode("|", $output);

        if ($status[0] == "0") {
            $result['status'] = 'Success';
            $result['error_msg'] = "Recharge Success";
        } else if ($status[0] == "1") {
            $result['status'] = 'Pending';
            $result['error_msg'] = "Recharge Pending";
        } else if ($status[0] == "2") {
            $result['status'] = 'Failed';
            $result['error_msg'] = "Recharge Failed";
        }

        $result['opid_id'] = $status[4];
        $result['message'] = $status[6];
        $result['responsestaus'] = $status[6];
        $result['tnx_id'] = $status[3];
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $output;
    } else {
        $result['error'] = "0";
        $result['error_msg'] = "Recharge " . $o1->status;
    }
    return $result;
}

###############################################################
//End of function to get Status Esay my wallet
###############################################################
###############################################################
//Start of function to  Balance esay my wallet
###############################################################

function balance_easymywallet() {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . " Balance.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password;
        //  pt($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $status = explode("|", $response);

        if ($status[0] != "") {
            if ($status[0] != "") {
                $result['status'] = 'Success';
                $result['code'] = '1';
            } else {
                $result['status'] = 'Failed';
                $result['code'] = '0';
            }
        } else {
            $result['status'] = 'Failed';
            $result['code'] = '0';
        }
        $result['balance'] = $status[1];
        $result['balance2'] = $status[2];
        $result['response'] = $response;
        return $result;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to get Status Esay my wallet
###############################################################
###############################################################
//Start of function to  Login JRI
###############################################################

function login_jri($id) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);

    $o11 = $factory->get_object($id, "api", "api_id");

    if ($o11->is_active == 1) {

        $security_key = $o11->security_key;
        $api_username = $o11->api_username;
        $api_domain = $o11->api_domain;
        $api_password = $o11->api_password;
        $value = md5($o11->api_username . $o11->api_password . $o11->md_key);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "" . $api_domain . "JRICorporateLogin.svc/securelogin/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"SecurityKey\":\"$security_key\",\"EmailId\":\"$api_username\",\"Password\":\"$api_password\",\"APIChkSum\":\"$value\"}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Postman-Token: 9c75277f-f5b2-4e68-9486-e603a854367c",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        $data = json_decode($response, true);

        curl_close($curl);

        return $data;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to Login Jri
###############################################################
###############################################################
//Start of function to Recharge Jri
###############################################################

function recharge_jri($o) {
    $o11 = new stdClass();
    $o12 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("7", "api", "api_id");
    if ($o11->is_active == 1) {

        $sql = "Select provider_code ,provider_id from api_provider_code where provider_id = " . $o->provider_id . " and is_active = 1 and api_id = '" . $o11->api_id . "'";
        $res = getXbyY($sql);
        if ($res[0]['provider_code'] != "") {
            $opcode = $res[0]['provider_code'];

//			if ($rtype == "Mobile") {
            //				$rtype = 'M';
            //			} else if ($rtype == "Dth") {
            //				$rtype = 'D';
            //			}
            $o12 = $factory->get_object($res[0]['provider_id'], "providers", "provider_id");

            if ($o12->service == "Postpaid") {
                $IsPostpaid = 'Y';
                $rtype = 'M';
            } else {
                $IsPostpaid = 'N';
                $rtype = 'M';
            }
            if ($o12->service == "DTH") {
                $IsPostpaid = 'N';
                $rtype = 'D';
            }
            $result['error'] = "0";
            $security_key = $o11->security_key;
            $api_domain = $o11->api_domain;

            $auk = $o11->api_key;
            $check_sum_vaue = md5($o11->corporate_id . $auk . $o->mobile_number . $o->amount . $o->ref_number . $o11->md_key);

            $o->recharge_url = $api_domain . "JRICorporateRecharge.svc/Instantrecharge" . "{\"CorporateId\":\"$o11->corporate_id\",\"SecurityKey\":\"$security_key\",\"AuthKey\":\"$auk\",\"Mobile\":\"$o->mobile_number\",\"Provider\":\"$opcode\",\"Location\":\"$o->circle_id\",\"Amount\":\"$o->amount\",\"ServiceType\":\"$rtype\",\"SystemReference\":\"$o->ref_number\",\"IsPostpaid\":\"$IsPostpaid\",\"APIChkSum\":\"$check_sum_vaue\",\"NickName\":\"abhipay\"}";

            $o->wallet_id = $updater->update_object($o, "wallet");

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "" . $api_domain . "JRICorporateRecharge.svc/Instantrecharge",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"CorporateId\":\"$o11->corporate_id\",\"SecurityKey\":\"$security_key\",\"AuthKey\":\"$auk\",\"Mobile\":\"$o->mobile_number\",\"Provider\":\"$opcode\",\"Location\":\"$o->circle_id\",\"Amount\":\"$o->amount\",\"ServiceType\":\"$rtype\",\"SystemReference\":\"$o->ref_number\",\"IsPostpaid\":\"$IsPostpaid\",\"APIChkSum\":\"$check_sum_vaue\",\"NickName\":\"papa_fast\"}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Postman-Token: e41c9e18-7c10-40a2-ba71-b11a1082b038",
                    "cache-control: no-cache",
                ),
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);
            $data = json_decode($response, true);

            if ($data['Status'] != "") {
                $status = explode("|", $data['Status']);

                if ($status[0] == "0 ") {
                    $result['status'] = 'Success';
                    $result['opid_id'] = $status[2];
                } else if ($status[0] == "1 ") {
                    $result['status'] = 'Pending';
                    $result['opid_id'] = $data['SystemReference'];
                    //pending
                } else if ($status[0] == "2 ") {
                    $result['status'] = 'Failed';
                    $result['opid_id'] = $data['SystemReference'];
                    //failed
                } else {
                    $result['status'] = 'Failed';
                }
            } else {
                $result['opid_id'] = $data['SystemReference'];
                $result['status'] = 'Failed';
            }
            $result['message'] = $data['Status'];
            $result['responsestaus'] = $data['Status'];
            $result['tnx_id'] = $data['TransactionReference'];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $response;
        } else {

            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
        return $result;
    } else {
        $data['status'] = "We are Updating. Please Wait";
        $data['error'] = "1";
        die(json_encode($data));
    }
}

###############################################################
//End of function to Recharge Jri
###############################################################
###############################################################
//Start of function to  StatusJRI
###############################################################

function status_jri($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("7", "api", "api_id");
    if ($o11->is_active == 1) {

        $security_key = $o11->security_key;
        $api_domain = $o11->api_domain;
        $auk = $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "" . $o11->api_domain . "JRICorporateRechargeStatus.svc/RechargeStatus",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"CorporateId\":\"$o11->corporate_id\",\"SecurityKey\":\"$security_key\",\"AuthKey\":\"$auk\",\"SystemReference\":\"$o1->ref_number\"}",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: 2408f3a2-a293-418d-893a-bec97d8d69fb",
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        if ($data['Status'] != "") {
            $status = explode("|", $data['Status']);

            if ($status[0] == "0 ") {
                $result['status'] = 'Success';
                $result['opid_id'] = $status[2];
            } else if ($status[0] == "1 ") {
                $result['status'] = 'Pending';
                $result['opid_id'] = $data['SystemReference'];
                //pending
            } else if ($status[0] == "2 ") {
                $result['status'] = 'Failed';
                $result['opid_id'] = $data['SystemReference'];
                //failed
            } else {
                $result['status'] = 'Failed';
            }
        } else {
            $result['opid_id'] = $data['SystemReference'];
            $result['status'] = 'Failed';
        }
        $result['message'] = $data['Status'];
        $result['responsestaus'] = $data['Status'];
        $result['tnx_id'] = $data['TransactionReference'];
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $response;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
    return $result;
}

###############################################################
//End of function to get StatusJRI
###############################################################
###############################################################
//Start of function to  StatusJRI
###############################################################

function jri_status($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("7", "api", "api_id");
    if ($o11->is_active == 1) {

        $security_key = $o11->security_key;
        $api_domain = $o11->api_domain;
        $auk = $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "" . $o11->api_domain . "JRICorporateRechargeStatus.svc/RechargeStatus",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"CorporateId\":\"$o11->corporate_id\",\"SecurityKey\":\"$security_key\",\"AuthKey\":\"$auk\",\"SystemReference\":\"$o1->ref_number\"}",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: 2408f3a2-a293-418d-893a-bec97d8d69fb",
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        return $response;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to get StatusJRI
###############################################################
###############################################################
###############################################################
//Start of function to  StatusJRI
###############################################################

function balance_jri($id) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object($id, "api", "api_id");

    if ($o11->is_active == 1) {

        $security_key = $o11->security_key;
        $corporate_id = $o11->corporate_id;
        $api_domain = $o11->api_domain;
        $auk = $o11->api_key;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "" . $api_domain . "JRICorporateRecharge.svc/GetCorporateCardBalance",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"CorporateId\":\"$corporate_id\",\"SecurityKey\":\"$security_key\",\"AuthKey\":\"$auk\"}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: ac38839b-63a9-2c44-dce4-c16d7c1a5d4f",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $result['Balance'] = $data['Balance'];
        $result['status'] = $data['Status'];
        $result['response'] = $response;
        return $result;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to get StatusJRI
###############################################################
################################################################
//Start of function to Recharge tiptopmoney
###############################################################

function recharge_tiptopmoney($o) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {
            $url = $o11->api_domain . "Recharge.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_key . "&Amount=" . $o->amount . "&OperatorCode=" . $provider_code . "&Number=" . $o->mobile_number . "&ClientId=" . $o->ref_number . "&CircleCode=" . $o->circle_id;

            $o->recharge_url = $url;

            $o->wallet_id = $updater->update_object($o, "wallet");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            //sendmail("navtejsb@gmail.com", "navtejsb@gmail.com", "API Response", $output);

            $status = explode("|", $output);

            if ($status[0] == "0") {
                $result['status'] = 'Success';
            } else if ($status[0] == "1") {

                $result['status'] = 'Failed';
            } else if ($status[0] == "2") {
                $result['status'] = 'Pending';
            }

            $result['opid_id'] = $status[2];
            $result['message'] = $status[6];
            $result['responsestaus'] = $status[6];
            $result['tnx_id'] = $status[3];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $output;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to Recharge tiptopmoney
###############################################################
################################################################
//Start of function to Recharge tiptopmoney
###############################################################

function recharge_shrimoney($o) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("12", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            $url = $o11->api_domain . "recharge?member_id=" . $o11->api_username . "&api_password=" . $o11->api_password . "&api_pin=" . $o11->api_key . "&opcode=" . $provider_code . "&number=" . $o->mobile_number . "&amount=" . $o->amount . "&request_id=" . $o->ref_number . "&FIELD1=&FIELD2=";

            $o->recharge_url = $url;

            $o->wallet_id = $updater->update_object($o, "wallet");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($output, true);
            if ($data['STATUS'] == "FAILED") {
                $result['status'] = 'Failed';
            } else if ($data['STATUS'] == "SUCCESS") {
                $result['status'] = 'Success';
            } else {
                $result['status'] = 'Pending';
            }

            $result['opid_id'] = $data['OPTXNID'];
            $result['message'] = $data['MESSAGE'];
            $result['responsestaus'] = $data['MESSAGE'];
            $result['tnx_id'] = $o->ref_number;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $output;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to Recharge tiptopmoney
###############################################################
################################################################
//Start of function to Recharge tiptopmoney
###############################################################

function balance_shrimoney($id) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object($id, "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "getbalance?member_id=" . $o11->api_username . "&api_password=" . $o11->api_password . "&api_pin=" . $o11->api_key . "&user_var1=&user_var2=&user_var3=";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output, true);
        $result['Balance'] = $data['BALANCE'];
        $result['status'] = $data['MESSAGE'];
        $result['response'] = "" . $output . "";
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to Recharge tiptopmoney
###############################################################
################################################################
//Start of function to balance tiptopmoney
###############################################################

function balance_tiptopmoney($id) {
    $o11 = new stdClass();
    $o12 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object($id, "api", "api_id");
    if ($o11->is_active == 1) {

        $api_username = $o11->api_username;
        $api_domain = $o11->api_domain;
        $auk = $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "" . $api_domain . "Balance.aspx",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Username\"\r\n\r\n" . $api_username . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Password\"\r\n\r\n" . $auk . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: f952cfd9-fb69-fe3e-7632-1e889cf28911",
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $data = explode("|", $response);

        $result['Balance'] = $data[1];
        $result['status'] = $data[0];
        $result['response'] = "" . $response . "";

        return $result;
    } else {
        $data['status'] = "We are Updating. Please Wait";
        $data['error'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to balance tiptopmoney
###############################################################
###############################################################
//Start of function to get roffers from mplan
###############################################################

function mplan_roffers($operator, $mobile, $service) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");

    $operator = str_replace(" ", "%20", $operator);

    if ($service == "prepaid") {
        $url = $o11->api_domain . "plans.php?apikey=" . $o11->api_key . "&offer=roffer&tel=" . $mobile . "&operator=" . $operator;
    } else if ($service == "dth") {
        $url = $o11->api_domain . "DthRoffer.php?apikey=" . $o11->api_key . "&offer=roffer&tel=" . $mobile . "&operator=" . $operator;
    } else if ($service == "dth_user_info") {
        $url = $o11->api_domain . "Dthinfo.php?apikey=" . $o11->api_key . "&offer=roffer&tel=" . $mobile . "&operator=" . $operator;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = json_decode($output);
    //$output = '{"tel":"3021781387","operator":"AirtelDTH","records":[{"rs":3965,"desc":"Pay for 11 month & get 1 Month FREE! of Value Sports SD plus + Rs 200 Cashback with Airtel Payments Bank!"},{"rs":2166,"desc":"Pay for 6 month & get 15 days FREE! of Value Sports SD plus + Rs 200 Cashback with Airtel Payments Bank!"}],"status":1}';

    return $output;
}

###############################################################
//End of function to get roffers from mplan
###############################################################
###############################################################
//Start of function to get roffers from mplan
###############################################################

function recharge_plan_roffers($operator, $mobile, $service) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("9", "api", "api_id");
    $url = $o11->api_domain . "PlansServices.asmx/BestOffer?UMobile=" . $o11->api_username . "&Token=" . $o11->api_key . "&number=" . $mobile . "&opcode=" . $operator;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $values = json_decode($output);

    return $values;
}

###############################################################
//End of function to get roffers from mplan
###############################################################
###############################################################
//Start of function to get roffers from mplan
###############################################################
function plan_api_roffers($operator, $mobile, $service) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("15", "api", "api_id");
    //pt($o11);
    //$url = $o11->api_domain . "/api/plans.php?apikey=" . $o11->api_username . "&offer=roffer&tel=" . $mobile . "&operator=" . $operator;
    $url = $o11->api_domain . "/api/Mobile/RofferCheck?apimember_id=" . $o11->api_username . "&api_password=" . $o11->api_key . "&mobile_no=" . $mobile . "&operator_code=" . $operator;
    //pt($url);die;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $values = json_decode($output);
//pt($values);
    return $values;
}

function plans_api($operator, $cricle) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("3", "api", "api_id");
    //pt($o11);
    $url = $o11->api_domain . "/api/plans.php?apikey=" . $o11->api_username . "&cricle=" . $cricle . "&operator=" . $operator;
    $url = str_replace(" ","%20",$url);
    //pt($operator);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $values = json_decode($output,1);
//pt($values);
    return $values;
}
function plans_api_ezytm($operator, $cricle) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("15", "api", "api_id");
    //pt($o11);
   // $url = $o11->api_domain . "/api/plans.php?apikey=" . $o11->api_username . "&cricle=" . $cricle . "&operator=" . $operator;
    //$url = str_replace(" ","%20",$url);
    //pt($operator);
$url = $o11->api_domain . "/api/Mobile/Operatorplan?apimember_id=" . $o11->api_username . "&api_password=" . $o11->api_key . "&cricle=" . $cricle . "&operatorcode=" . $operator;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $values = json_decode($output,1);
//pt($values);
    return $values;
}
function fetch_dth_info($mobile, $api_code) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");
    //$url = $o11->api_domain . "/api/Dthinfo.php?apikey=" . $o11->api_username . "&offer=roffer&tel=" . $mobile . "&operator=" . $api_code;
    $url = $o11->api_domain . "/api/Mobile/DTHINFOCheck?apimember_id=" . $o11->api_username . "&api_password=" . $o11->api_key . "&Opcode=" . $api_code . "&mobile_no=" . $mobile;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    
    curl_close($ch);

    $values = json_decode($output);
//pt($url);die;
    return $values;
}
function mplan_bill_info_app($provider_id, $mobile) {
    //pt($provider_id);
    //pt($mobile);die;
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");
	//pt($o11);die;
	$provider_code = get_api_provider_code($provider_id, $o11->api_name);
	//pt($provider_code);die;
    if ($o11->is_active == 1) {
		//pt($provider_code);die;
        $url = $o11->api_domain . "electricinfo.php?apikey=" . $o11->api_username . "&offer=roffer&tel=" . $mobile . "&operator=" . $provider_code;
      // pt($url);die;
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $circleinfo = curl_exec($ch);
//pt($circleinfo);die;
        curl_close($ch);
        return $circleinfo;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}
function dth_operator($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("3", "api", "api_id");
    $url = "http://operatorcheck.mplan.in/api/dthoperatorinfo.php?apikey=" . $o11->api_username . "&tel=" . $mobile;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $values = json_decode($output);
    return $values;
}
function dth_plans($operator) {
    //$operator = "Dish TV";
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("2", "api", "api_id");
    //pt($o11);
    $url = $o11->api_domain . "/api/dthplans.php?apikey=" . $o11->api_username . "&operator=" . $operator;
    $url = str_replace(" ","%20",$url);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $values = json_decode($output,1);
   // pt($url);
    //	pt($output);
    //	die;
    return $values;
}
###############################################################
//End of function to get roffers from mplan
###############################################################
###############################################################


function user_mobiles($mobile_number, $provider, $provider_id, $cirlce) {
    $o6 = new stdClass();
    $factory = new TypeFactory($db);
    $insertor = new TypeInsertor($db);
    $updater = new TypeUpdater($db);

    $o6->mobile_number = $mobile_number;

    $sql_check = "Select user_mobile_id from user_mobiles where mobile_number = '" . $o6->mobile_number . "'";
    $res_check = getXbyY($sql_check);
    $row_check = count($res_check);

    if ($row_check == 1) {
        $o6 = $factory->get_object($res_check[0]['user_mobile_id'], "user_mobiles", "user_mobile_id");

        if ($o6->provider != $provider || $o6->circle != $cirlce) {
            $o6->provider = $provider;
            $o6->provider_id = $provider_id;
            $o6->circle = $cirlce;

            $o6->user_mobile_id = $updater->update_object($o6, "user_mobiles");
        }
    } else {
        $o6->provider = $provider;
        $o6->provider_id = $provider_id;
        $o6->circle = $cirlce;
        $o6->is_active = 1;

        $o6->user_mobile_id = $insertor->insert_object($o6, "user_mobiles");
    }
}

###############################################################
//End of function to update insert user mobiles
###############################################################
###############################################################
//start of function to get transaction type class
###############################################################

function transaction_type($type) {
    if ($type == "API Top up" || $type == "Recieve Money" || $type == "Commission" || $type == "Refund" || $type=='Payment Gateway') {
        $class = "green";
    } else {
        $class = "red";
    }

    return $class;
}

###############################################################
//end of function to get transaction type class
###############################################################
###############################################################
//Start of function get provider name with service from id
###############################################################

function get_provider_name_by_service($provider, $service) {
    if ($service == "") {
        $service = "Prepaid";
    }
    $service = ucwords(($service));
    if ($provider != "") {
        $sql = "Select provider_id from providers where provider = '" . $provider . "' and service = '" . $service . "' and is_active = 1";
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            return $res[0]['provider_id'];
        } else {
            return "Any";
        }
    } else {
        return "Any";
    }
}

###############################################################
//End of function get provider name with service from id
###############################################################
###############################################################
//Start of function to check transaction diff between for same user
###############################################################

function user_time_diff($user_id) {
    $sql = "Select transaction_date from wallet where user_id = " . $user_id . " order by wallet_id desc limit 0,1";
    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows == 1) {
        $ct = strtotime(todaysDate());
        $lt = strtotime($res[0]['transaction_date']);

        $diff = $ct - $lt;

        if ($diff < 2) {
            $rr = rand(0, 9);
            sleep($rr);
            $diff = user_time_diff($user_id);
        } else {
            return $diff;
        }
    } else {
        $diff = 5;
        return $diff;
    }
}

###############################################################
//End of function to check transaction diff between for same user
###############################################################
###############################################################
//Start of function to insert values into wallet
###############################################################

function wallet_insert($o1, $o6) {
    $o7 = new stdClass();
    $o8 = new stdClass();
    $o9 = new stdClass();
    $factory = new TypeFactory($db);
    $insertor = new TypeInsertor($db);
    $updater = new TypeUpdater($db);

      $o9->user_id = $o1->user_id;
      $o9->ctime = todaysDate();
      $o9->is_active = 1;

      $o9->time_diff_id = $insertor->insert_object($o9, "time_diff");
      $tt = user_time_diff($o1->user_id);

    $o1 = $factory->get_object($o1->user_id, "users", "user_id");
    //$o6 = new stdClass();

    if ($o6->transaction_type == "Recieve Money" || $o6->transaction_type == "Refund" || $o6->transaction_type == "Commission" || $o6->transaction_type=='Payment Gateway'|| $o6->transaction_type=='UPI') {
        $flag = 1;
    } else {
        $flag = 0;
    }

    if ($o1->amount_balance < $o6->amount && $flag != 1) {
        $o6->wallet_id = 0;
        $o6->api_id = 0;
        $o6->status = "Failed";

        return $o6;
    } else {

        if ($o6->transaction_type == "Recharge") {
            $amount_verify = $o1->amount_balance - $o1->commission_amount;

            if ($o6->amount <= $amount_verify) {
                $o6->wallet_type = "Wallet";
            } else if ($o6->amount <= $o1->commission_amount) {
                $o6->wallet_type = "Commission";
            } else {
                $o6->wallet_type = "Mixed";
            }
        }

        if ($o6->api_id > 0) {
            $o7 = $factory->get_object($o6->api_id, "api", "api_id");
            $o6->api_old_balance = $o7->api_balance;
            $o6->api_name = $o7->api_name;
        }
        if ($o6->transaction_type == "API Top up" || $o6->transaction_type == "Refund" || $o6->transaction_type == "Commission") {
            $o6->api_new_balance = round($o6->api_old_balance + $o6->api_amount, 2);
        } else {
            $o6->api_new_balance = round($o6->api_old_balance - $o6->api_amount, 2);
        }

        $o6->user_old_balance = $o1->amount_balance;

        if ($o6->transaction_type == "Recieve Money" || $o6->transaction_type == "Refund" || $o6->transaction_type == "Commission" || $o6->transaction_type=='Payment Gateway' || $o6->transaction_type=='UPI') {
            $o6->user_new_balance = round($o6->user_old_balance + $o6->amount, 2);
        } else {
            $o6->user_new_balance = round($o6->user_old_balance - $o6->amount, 2);
        }

        $o6->user_id = $o1->user_id;
        $o6->white_label_user_id = $o1->white_label_id;
        $o6->parent_user_id = $o1->parent_id;
        $o6->user_name = $o1->user_name . " " . $o1->name;
        $o6->transaction_date = todaysDate();
        $o6->month_year = date("F") . "-" . date('Y');
        if ($o6->provider_id > 0) {
            $o8 = $factory->get_object($o6->provider_id, "providers", "provider_id");
            $o6->provider_name = $o8->provider;
            $o6->provider_type = $o8->service;
        }
        $o6->disputed = "No";
        $o6->created_at = todaysDate();
        $o6->updated_at = todaysDate();
        if ($o6->parent_id > 0) {
            $o6->ref_number = parent_reference_no($o6->parent_id);
        } else {

            $o6->ref_number = reference_number();
        }
        $o6->recharge_url = "";
        $o6->response_url = "";
        $o6->ip_address = $_SERVER['REMOTE_ADDR'];
        $o6->is_active = 1;
        if ($o6->transaction_type == "API Top up") {
            $o6->transaction_details = $o6->api_name . " API Top Up with Rs. " . $o6->api_amount;
        } else if ($o6->transaction_type == "Send Money") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Money Transfer to " . $o6->user_1_name;
        } else if ($o6->transaction_type == "Recieve Money") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Money Recieved From " . $o6->user_1_name;
        } else if ($o6->transaction_type == "Recharge") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Recharge For " . $o6->mobile_number;
        } else if ($o6->transaction_type == "Reverse") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Money Taken Back By " . $o6->user_1_name;
        } else if ($o6->transaction_type == "Commission") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Commission Earned For Recharge";
        } else if ($o6->transaction_type == "Refund") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Refund for Recharge";
        } else if ($o6->transaction_type == "R Offer Check") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " R Offer Check for Number: " . $o6->mobile_number;
        } else if ($o6->transaction_type == "User Info Check") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " User Info Check for Number: " . $o6->mobile_number;
        } else if ($o6->transaction_type == "Plan Purchase") {
            $o6->transaction_details = "Rs. " . $o6->total_amount . " Charged for Purchasing Plan";
        }else if ($o6->transaction_type == "Payment Gateway") {
             $o6->transaction_details = "Rs. " . $o6->total_amount . " Money Recieved From Payment Gateway by " . $o6->order_id;;
        }else if ($o6->transaction_type == "UPI") {
             $o6->transaction_details = "Rs. " . $o6->total_amount . " Money Recieved From UPI by " . $o6->order_id;;
        }




        if ($o6->cash_credit == "Credit") {
            $o6->comment = "Credit Update";
        } else {
            $o6->comment = $o6->transaction_details;
        }

        if ($o6->transaction_type == "Commission") {
            if ($o1->tds > 0) {
                $o6->tds = round(($o1->tds / 100) * $o6->amount, 2);
                $o6->amount = $o6->amount - $o6->tds;

                $o6->user_new_balance = round($o6->user_new_balance - $o6->tds, 2);

                $o6->transaction_details = "Rs. " . $o6->amount . " Commission Earned For Recharge";
            } else {
                $o6->tds = 0;
            }

            if ($o1->gst > 0) {
                $sql_actual_amount = "Select amount from wallet where wallet_id = " . $o6->parent_id;
                $res_actual_amount = getXbyY($sql_actual_amount);

                if ($res_actual_amount[0]['amount'] > 0) {
                    $actual_amount = $res_actual_amount[0]['amount'] - $o6->amount;

                    $gst_100 = $o1->gst + 100;

                    $o6->gst = round(($actual_amount / $gst_100) * $o1->gst, 2);
                } else {
                    $actual_amount = 0;
                }
                $o6->comment = $res_actual_amount[0]['amount'];
            } else {
                $o1->gst = 0;
            }
        }
        if ($o6->transaction_type == "Recharge") {
            if ($o6->api_id > 0) {
                $sql_api = "select * from api_provider where api_id='" . $o6->api_id . "' and provider_id='" . $o6->provider_id . "' and is_active ='1'";
                $res_api = getXbyY($sql_api);
                $row_api = count($res_api);

                if ($row_api > 0) {
                    if ($res_api[0]['commission_amount'] > 0) {
                        $o6->api_amount = $o6->total_amount - $res_api[0]['commission_amount'];
                    } else {
                        $api_comm = ($o6->api_amount * $res_api[0]['commission_percentage']) / 100;
                        $o6->api_amount = $o6->total_amount - $api_comm;
                    }
                }
            }
        }
        $o6->total_commission = $o6->commission_rt;
        $o6->commission_earned = ($o6->total_amount - $o6->api_amount ) - $o6->total_commission;

        $o6->wallet_id = $insertor->insert_object($o6, "wallet");

        if ($o6->api_id > 0) {
            $o7->api_balance = $o6->api_new_balance;
            $o7->api_id = $updater->update_object($o7, "api");
        }

        if ($o6->transaction_type != "API Top up") {
            $o1->amount_balance = $o6->user_new_balance;
            if ($o6->cash_credit == "Credit") {
                $o1->credit_amount = $o1->credit_amount + $o6->amount;
            }

            if ($o6->transaction_type == "Commission") {
                $o1->commission_amount = round($o1->commission_amount + $o6->amount, 2);
            }

            if ($o6->transaction_type == "Recharge") {
                if ($o6->wallet_type == "Commission") {
                    $o1->commission_amount = round($o1->commission_amount - $o6->amount, 2);
                } else if ($o6->wallet_type == "Mixed") {
                    $wd = $o6->amount - $amount_verify;
                    $o1->commission_amount = round($o1->commission_amount - $wd, 2);
                }
            }

            $o1->user_id = $updater->update_object($o1, "users");

            /*

              if ($o6->transaction_type == "Recieve Money" || $o6->transaction_type == "Refund" || $o6->transaction_type == "Commission") {
              $update_user = "Call user_balance($o6->user_id,$o6->amount, $o6->wallet_id)";
              } else {
              $uamount = 0 - $o6->amount;
              $update_user = "Call user_balance($o6->user_id,$uamount, $o6->wallet_id)";
              }

              $rr = setXbyY($update_user);
             */
        }

        insert_notifications($o6->user_id, $o6->transaction_details);
        return $o6;
    }
}

###############################################################
//End of function to initialize wallet values
###############################################################
###############################################################
//Start of function to add notifications into system
###############################################################

function insert_notifications($user_id, $notification) {
    $o6 = new stdClass();

    $o6->user_id = $user_id;
    $o6->notification = $notification;
    $o6->notification_date = todaysDate();
    $o6->is_read = "No";
    $o6->is_active = "1";

    $insertor = new TypeInsertor($db);
    $o6->notification_id = $insertor->insert_object($o6, "notifications");
}

###############################################################
//End of function to add notifications into system
###############################################################
###############################################################
//Start of function to list last 12 months
###############################################################

function last_12_months() {
    for ($i = 0; $i < 12; $i++) {
        $dd = date("F-Y", mktime(0, 0, 0, date("m") - $i, "01", date("y")));
        $months[$i]['month'] = $dd;
        $months[$i]['amount'] = 0;
    }

    return $months;
}

###############################################################
//End of function to list last 12 months
###############################################################
###############################################################
//Start of function to list passed months of current financial year
###############################################################

function month_current_financial_year() {
    for ($i = 0; $i < 12; $i++) {
        $dd = date("F-Y", mktime(0, 0, 0, date('4') + $i, "01", date("y")));
        $months[$i]['month'] = $dd;
        $months[$i]['amount'] = 0;
    }

    return $months;
}

###############################################################
//End of function to list passed months of current financial year
###############################################################
###############################################################
//Start of function to run recharge api
###############################################################
/*
function run_api($o) {
	
    if ($o->api_id == "1") {
        $result['error'] = "0";
        $result['status'] = "Pending";
    } else if ($o->api_id == 15) {
        $result = recharge_roundpay_api($o);
    } else if ($o->api_id == 10) {
        $result = recharge_roundpay($o);
	} else if ($o->api_id == 13) {
        $result = recharge_Mrobotics($o);
	} else if ($o->api_id == 18) {
        $result = recharge_smile($o);
    }
	

//    if ($o->api_id == 8) {
    //        $result = recharge_tiptopmoney($o);
    //    } else if ($o->api_id == 7) {
    //        $result = recharge_jri($o);
    // }
    // else if ($o->api_id == 10) {
    //        $result = recharge_3g($o);
    //    } else if ($o->api_id == 6) {
    //        $result = recharge_easymywallet($o);
    //    } else if ($o->api_id == 12) {
    //        $result = recharge_shrimoney($o);
    //    } else if ($o->api_id == "13") {
    //        $result = recharge_Mrobotics($o);
    //    } else if ($o->api_id == "14") {
    //        $result = recharge_realrobo($o);
    //    } else if ($o->api_id == "1") {
    //        $result['error'] = "0";
    //        $result['status'] = "Pending";
    //    }
    return $result;
}
*/

function run_api($o) {

    $o12 = new stdClass();
    $updater = new TypeUpdater($db);
    
     



    $factory = new TypeFactory($dbName);
    
    
    $o12 = $factory->get_object($o->api_id, "api", "api_id");
    
 

    if ($o12->is_active == "1") {
         $provider_code = get_api_provider_code($o->provider_id, $o->api_name);

        $result['error'] = 0;
        if ($provider_code != "") {

           $o8 = $factory->get_object($o->provider_id, "providers", "provider_id");
           
           if ($o->provider_id == '104') {
            $type1 = "true";
        } else {
            $type1 = "false";
        }

            if ($o->service_id =="4") {
                $type ="DTH";
            }else if ($o->service_id =="2") {
                $type ="PP";
            }else{
                  $type ="RR";
            }

        $api_url = $o12->api_domain;
        $api_url = str_replace('mmm', '' . $o->mobile_number . '', $api_url);
        $api_url = str_replace('ooo', '' . $provider_code . '', $api_url);
        $api_url = str_replace('aaa', '' . $o->total_amount . '', $api_url);
        $api_url = str_replace('rrr', '' . $o->ref_number . '', $api_url);
        $api_url = str_replace('sstv', '' . $type1 . '', $api_url);
        $api_url = str_replace('TYPE', '' . $type . '', $api_url);

        if ($o12->method == "POST") {
         
          $api_url = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url);
          $url = explode("?", $o12->api_domain);
          $api_url_hit = str_replace('mmm', '' . $o->mobile_number . '', $url[1]);
          $api_url_hit = str_replace('ooo', '' . $provider_code . '', $api_url_hit);
          $api_url_hit = str_replace('aaa', '' . $o->total_amount . '', $api_url_hit);
          $api_url_hit = str_replace('rrr', '' . $o->ref_number . '', $api_url_hit);
          $api_url_hit = str_replace('sstv', '' . $type1 . '', $api_url_hit);
          $api_url = str_replace('TYPE', '' . $type . '', $api_url_hit);

          if ($o12->api_key != "") {
            $api_url_hit = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url_hit);
        }


 
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url[0]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_url_hit);
        $circleinfo = curl_exec($ch);
        curl_close($ch);

    } else {
  
        if ($o12->api_key != "") {
            $api_url = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
       // curl_setopt($ch, CURL_HTTP_VERSION_1_1,);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST ,"GET",);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($circleinfo, true);
    }
            // pt($circleinfo);

    $ref_value = $o12->refid_value;
    $op_id = $o12->operator_id;
    $remain = $o12->remain_balance;
    $format_data = $o12->format;
    $lapu_no = $o12->lapu_no;
    if ($o12->format == 'TEXT' && $o12->api_id == '7') {

        $data = explode(',', $circleinfo);
    } else if ($o12->format == 'XML') {
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $circleinfo);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $url = simplexml_load_string($fileContents);
        $url = json_encode($url);
        $data = json_decode($url, true);
    } elseif (strtoupper($o12->format) == 'JSON' || $o12->format == '') {
        $data = json_decode($circleinfo, true);
    }

    $status_name = $o12->status_name;
    $remark = $o12->remark;
    if ($o12->api_name == 'Luxmi Recharge') {

        $res_refid = $data['message'][$ref_value];
        $res_opid = $data['message'][$op_id];
        $res_remain = $data['message'][$remain];
        $res_status = $data['message'][$status_name];
    } else if ($o12->api_id == "1111111111111111111111111111" || $o12->api_id == "11111111111111111111111111111111") {

        if ($data['StatusCode'] == "1") {
            $res_refid = $data['Data'][$ref_value];
            $res_opid = $data['Data'][$op_id];
            $res_remain = $data['Data'][$remain];
            $res_status = $data['Data'][$status_name];
        } else if ($data['StatusCode'] == "2") {
            $res_status = "Pending";
        } else if ($data['StatusCode'] == "0") {
            $res_status = "Failure";
        } else {
            $res_status = "Pending";
        }

        $response_info['data']['resText'] = $data['Message'];
    } else if ($o12->api_id == "1111111111111111111111111111111111111111") {

        if ($data[0] == "Your Request have been Success") {
            $res_status = "Success";

             $res_refid_ex = explode(":", $data[2]);
            $res_refid = $res_refid_ex[1];
             $res_opid_ex = explode(":", $data[7]);
            $res_opid =$res_opid_ex[1];
            $res_remain_ex = explode(":",$data[3]);
            $res_remain = $res_remain_ex[1];
        }else if ($data[0] == "Your Request have been fail") {
$res_status = "Failed";
 $res_refid_ex = explode(":", $data[2]);
            $res_refid = $res_refid_ex[1];
             $res_opid_ex = explode(":", $data[7]);
            $res_opid =$res_opid_ex[1];
            $res_remain_ex = explode(":",$data[3]);
            $res_remain = $res_remain_ex[1];
        } else {
            $res_status = "Pending";
        }

        $response_info['data']['resText'] = $data['Message'];
    } else {
        $res_refid = $data[$ref_value];
        $res_opid = $data[$op_id];
        $res_remain = $data[$remain];
        $res_status = $data[$status_name];
        if ($lapu_no != '' || $lapu_no != 0) {
            $res_lapu = $data[$lapu_no];
        } else {
            $res_lapu = '';
        }
    }

    $result['tnx_id'] = $res_refid;
    if ($res_status == $o12->success_value) {
        $result['status'] = "Success";
    } else if ($res_status == $o12->pending_value) {
        $result['status'] = "Pending";
    } else if ($res_status == $o12->failed_value) {
        $result['status'] = "Failed";
    } else if ($res_status == "FAILED" || $res_status == "REFUND") {
        $result['status'] = "Failed";
    } else {
        $result['status'] = "Pending";
    }

    $result['url'] = $api_url;
    $result['opid_id'] = $res_opid;
    $result['message'] = $response_info['data']['resText'];
    $result['responsestaus'] = $response_info['data']['resText'];
    //$result['response'] = $circleinfo;
    $result['api_id'] = $o12->api_id;
    $result['api_name'] = $o12->api_name;
    $result['api_balance'] = $res_remain;
    $result['response'] = $circleinfo;
    if ($result['api_balance'] > 0) {
        $o12->api_balance = $result['api_balance'];
    }
    $o12->api_id = $updater->update_object($o12, "api");
    $o->recharge_url = $api_url;
    $o->wallet_id = $updater->update_object($o, "wallet");
} else {
    $result['status'] = "Failed";
    $result['comment'] = "Operator Down. Please try again.";
    $result['code'] = "0";
    $result['api_id'] = $o12->api_id;
    $result['api_name'] = $o12->api_name;
}

//start: 14 Feb 2020
     // sleep(10);
        if ($result['status'] == 'Failed') {
			$sql_backup_chk = "select * from providers where provider_id = '" . $o->provider_id . "' and is_active = 1 ";
     
    $res_backup_chk = getXbyY($sql_backup_chk);
    //pt($res_backup_chk);die;
    $o->api_id = $res_backup_chk[0]['beckup_api'];
	    $o12 = $factory->get_object($o->api_id, "api", "api_id");
    
 

    if ($o12->is_active == "1") {
         $provider_code = get_api_provider_code($o->provider_id, $o12->api_name);

        $result['error'] = 0;
        if ($provider_code != "") {

           $o8 = $factory->get_object($o->provider_id, "providers", "provider_id");
           
           

        $api_url = $o12->api_domain;
        $api_url = str_replace('mmm', '' . $o->mobile_number . '', $api_url);
        $api_url = str_replace('ooo', '' . $provider_code . '', $api_url);
        $api_url = str_replace('aaa', '' . $o->total_amount . '', $api_url);
        $api_url = str_replace('rrr', '' . $o->ref_number . '', $api_url);
        $api_url = str_replace('sstv', '' . $type1 . '', $api_url);
        $api_url = str_replace('TYPE', '' . $type . '', $api_url);

        if ($o12->method == "POST") {
         
          $api_url = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url);
          $url = explode("?", $o12->api_domain);
          $api_url_hit = str_replace('mmm', '' . $o->mobile_number . '', $url[1]);
          $api_url_hit = str_replace('ooo', '' . $provider_code . '', $api_url_hit);
          $api_url_hit = str_replace('aaa', '' . $o->total_amount . '', $api_url_hit);
          $api_url_hit = str_replace('rrr', '' . $o->ref_number . '', $api_url_hit);
          $api_url_hit = str_replace('sstv', '' . $type1 . '', $api_url_hit);
          $api_url = str_replace('TYPE', '' . $type . '', $api_url_hit);

          if ($o12->api_key != "") {
            $api_url_hit = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url_hit);
        }


 
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url[0]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $api_url_hit);
        $circleinfo = curl_exec($ch);
        curl_close($ch);

    } else {
  
        if ($o12->api_key != "") {
            $api_url = str_replace('ttt', '' . urlencode($o12->api_key) . '', $api_url);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
       // curl_setopt($ch, CURL_HTTP_VERSION_1_1,);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST ,"GET",);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($circleinfo, true);
    }
            // pt($circleinfo);

    $ref_value = $o12->refid_value;
    $op_id = $o12->operator_id;
    $remain = $o12->remain_balance;
    $format_data = $o12->format;
    $lapu_no = $o12->lapu_no;
    if ($o12->format == 'TEXT' && $o12->api_id == '7') {

        $data = explode(',', $circleinfo);
    } else if ($o12->format == 'XML') {
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $circleinfo);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $url = simplexml_load_string($fileContents);
        $url = json_encode($url);
        $data = json_decode($url, true);
    } elseif (strtoupper($o12->format) == 'JSON' || $o12->format == '') {
        $data = json_decode($circleinfo, true);
    }

    $status_name = $o12->status_name;
    $remark = $o12->remark;
    if ($o12->api_name == 'Luxmi Recharge') {

        $res_refid = $data['message'][$ref_value];
        $res_opid = $data['message'][$op_id];
        $res_remain = $data['message'][$remain];
        $res_status = $data['message'][$status_name];
    } else if ($o12->api_id == "1111111111111111111111111111" || $o12->api_id == "11111111111111111111111111111111") {

        if ($data['StatusCode'] == "1") {
            $res_refid = $data['Data'][$ref_value];
            $res_opid = $data['Data'][$op_id];
            $res_remain = $data['Data'][$remain];
            $res_status = $data['Data'][$status_name];
        } else if ($data['StatusCode'] == "2") {
            $res_status = "Pending";
        } else if ($data['StatusCode'] == "0") {
            $res_status = "Failure";
        } else {
            $res_status = "Pending";
        }

        $response_info['data']['resText'] = $data['Message'];
    } else if ($o12->api_id == "1111111111111111111111111111111111111111") {

        if ($data[0] == "Your Request have been Success") {
            $res_status = "Success";

             $res_refid_ex = explode(":", $data[2]);
            $res_refid = $res_refid_ex[1];
             $res_opid_ex = explode(":", $data[7]);
            $res_opid =$res_opid_ex[1];
            $res_remain_ex = explode(":",$data[3]);
            $res_remain = $res_remain_ex[1];
        }else if ($data[0] == "Your Request have been fail") {
$res_status = "Failed";
 $res_refid_ex = explode(":", $data[2]);
            $res_refid = $res_refid_ex[1];
             $res_opid_ex = explode(":", $data[7]);
            $res_opid =$res_opid_ex[1];
            $res_remain_ex = explode(":",$data[3]);
            $res_remain = $res_remain_ex[1];
        } else {
            $res_status = "Pending";
        }

        $response_info['data']['resText'] = $data['Message'];
    } else {
        $res_refid = $data[$ref_value];
        $res_opid = $data[$op_id];
        $res_remain = $data[$remain];
        $res_status = $data[$status_name];
        if ($lapu_no != '' || $lapu_no != 0) {
            $res_lapu = $data[$lapu_no];
        } else {
            $res_lapu = '';
        }
    }

    $result['tnx_id'] = $res_refid;
    if ($res_status == $o12->success_value) {
        $result['status'] = "Success";
    } else if ($res_status == $o12->pending_value) {
        $result['status'] = "Pending";
    } else if ($res_status == $o12->failed_value) {
        $result['status'] = "Failed";
    } else {
        $result['status'] = "Pending";
    }

    $result['url'] = $api_url;
    $result['opid_id'] = $res_opid;
    $result['message'] = $response_info['data']['resText'];
    $result['responsestaus'] = $response_info['data']['resText'];
    //$result['response'] = $circleinfo;
    $result['api_id'] = $o12->api_id;
    $result['api_name'] = $o12->api_name;
    $result['api_balance'] = $res_remain;
    $result['response'] = $circleinfo;
    if ($result['api_balance'] > 0) {
        $o12->api_balance = $result['api_balance'];
    }
    $o12->api_id = $updater->update_object($o12, "api");
    $o->recharge_url = $api_url;
    $o->wallet_id = $updater->update_object($o, "wallet");
} else {
    $result['status'] = "Failed";
    $result['comment'] = "Operator Down. Please try again.";
    $result['code'] = "0";
    $result['api_id'] = $o12->api_id;
    $result['api_name'] = $o12->api_name;
}

} else {
    $result['error_msg'] = "We are Updating. Please Wait...";
    $result['error'] = "2";
}
            //$backup_api_result = backup_api($o);
            //pt($backup_api_result);die;
            if ($result['status'] == 'Failed') {
                $result['status'] = "Failed";
            }
        }
// end
// $result['error_msg'] = "We are Updating. Please Wait";
//  $result['error'] = "0";
} else {
    $result['error_msg'] = "We are Updating. Please Wait...";
    $result['error'] = "2";
}

return $result;
}

###############################################################
//End of function to run recharge api
###############################################################

###############################################################
//start of function for recharge backup api
###############################################################

function backup_api($o) {
   
    $sql_backup_chk = "select * from providers where provider_id = '" . $o->provider_id . "' and is_active = 1 ";
     
    $res_backup_chk = getXbyY($sql_backup_chk);
    //pt($res_backup_chk);die;
    $o->api_id = $res_backup_chk[0]['beckup_api'];
    $result = run_api($o);
    //pt($result);
    return $result;
}

###############################################################
//End of function for recharge backup api
###############################################################


###############################################################
//Start of function to get commission amount
###############################################################
function set_commission($wallet_object, $user_object, $service) {

    if ($user_object->user_id > 0) {

        if ($user_object->parent_id > 0) {
            $o11 = new stdClass();
            $o1 = new stdClass();
            $factory = new TypeFactory($dbName);
            $updater = new TypeUpdater($dbName);
            $o11 = $factory->get_object($user_object->parent_id, "users", "user_id");
            
                $sql = "Select * from user_plan_service where user_plan_id = " . $o11->plan_id . " and provider_id = " . $wallet_object->provider_id . " and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);
                if ($rows > 0) {

                    $amount = $wallet_object->total_amount;
					//if ($o11->user_type == "Master Distributor") {
							if ($res[0]['type_md'] == "Commission Percentage") {

								$commission_amount_md = round(($res[0]['commission_amount_md'] / 100) * $amount, 4);
							} else if ($res[0]['type_md'] == "Commission Flat") {
								$commission_amount_md = $res[0]['commission_amount_md'];
							}
					//} 
					//if ($o11->user_type == "Distributor") {
							if ($res[0]['type_dt'] == "Commission Percentage") {

								$commission_amount_dt = round(($res[0]['commission_amount_dt'] / 100) * $amount, 4);
							} else if ($res[0]['type_dt'] == "Commission Flat") {
								$commission_amount_dt = $res[0]['commission_amount_dt'];
							}
					//} 
					//if ($o11->user_type == "Retailer") {
						if ($res[0]['type_rt'] == "Commission Percentage") {

							$commission_amount = round(($res[0]['commission_amount_rt'] / 100) * $amount, 4);
						} else if ($res[0]['type_rt'] == "Commission Flat") {
							$commission_amount = $res[0]['commission_amount_rt'];
						}
					//}
				

                    $commission_api_amount = 0;

                    $wallet_object->transaction_type = "Commission";
                    $wallet_object->cash_credit = "Cash";
                    $wallet_object->api_amount = $commission_api_amount;
                    $wallet_object->amount = $commission_amount_dt;
                    //$wallet_object->amount_d = $commission_amount_dt;
                    //$wallet_object->amount_md = $commission_amount_md;
                    $wallet_object->commission_rt = 0;
                    $wallet_object->status = "Success";

                    $o1 = $factory->get_object($wallet_object->wallet_id, "wallet", "wallet_id");

                    $o1->total_commission = $o1->commission_rt + $commission_amount;
                    $o1->commission_earned = ($o1->total_amount - $o1->api_amount ) - $o1->total_commission;
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
					
					//echo '<pre>'; print_r($wallet_object); 	die;
					
                    //$w_id = wallet_insert($user_object, "0", " ", $wallet_object->api_id, "Commission", "Cash", $commission_api_amount, $commission_amount, $wallet_object->provider_id, $wallet_object->mobile_number, "Success", "Web", $wallet_object->circle_id, $wallet_object->circle, $wallet_object->wallet_id);
                    $w_id = wallet_insert($o11, $wallet_object);
					$wallet_object->amount = $commission_amount_md;
					$parent_id = $o11->parent_id;
					unset($o11);
					$o11 = new stdClass();
					 $o11 = $factory->get_object($parent_id, "users", "user_id");
                    $w_id = wallet_insert($o11, $wallet_object);
					
                }
            
        }
    }
}

/*function set_commission($wallet_object, $user_object, $service) {

    if ($user_object->user_id > 0) {

        if ($user_object->parent_id > 0) {
            $o11 = new stdClass();
            $o1 = new stdClass();
            $factory = new TypeFactory($dbName);
            $updater = new TypeUpdater($dbName);
            $o11 = $factory->get_object($user_object->parent_id, "users", "user_id");
            if ($o11->user_type == "Distributor") {
                $sql = "Select * from user_plan_service where user_plan_id = " . $o11->plan_id . " and provider_id = " . $wallet_object->provider_id . " and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);
                if ($rows > 0) {

                    $amount = $wallet_object->total_amount;
                    if ($res[0]['type_dt'] == "Commission Percentage") {

                        $commission_amount = round(($res[0]['commission_amount_dt'] / 100) * $amount, 4);
                    } else if ($res[0]['type_dt'] == "Commission Flat") {
                        $commission_amount = $res[0]['commission_amount_dt'];
                    }

                    $commission_api_amount = 0;

                    $wallet_object->transaction_type = "Commission";
                    $wallet_object->cash_credit = "Cash";
                    $wallet_object->api_amount = $commission_api_amount;
                    $wallet_object->amount = $commission_amount;
                    $wallet_object->commission_rt = 0;
                    $wallet_object->status = "Success";

                    $o1 = $factory->get_object($wallet_object->wallet_id, "wallet", "wallet_id");

                    $o1->total_commission = $o1->commission_rt + $commission_amount;
                    $o1->commission_earned = ($o1->total_amount - $o1->api_amount ) - $o1->total_commission;
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
                    //$w_id = wallet_insert($user_object, "0", " ", $wallet_object->api_id, "Commission", "Cash", $commission_api_amount, $commission_amount, $wallet_object->provider_id, $wallet_object->mobile_number, "Success", "Web", $wallet_object->circle_id, $wallet_object->circle, $wallet_object->wallet_id);
                    $w_id = wallet_insert($o11, $wallet_object);
                }
            }
        }
    }
}
*/
###############################################################
//End of function to get commission amount
###############################################################
###############################################################
//Start of function to check tiptopmoney status
###############################################################

function tiptopmoney_status($o1) {
    //http://tiptopmoney.in/RechargeApi/RechargeStatus.aspx?Username=11900&Password=457f56c559&ClientId=36168730134

    if ($o1->status == "Pending") {

        $o11 = new stdClass();
        $factory = new TypeFactory($dbName);
        $o11 = $factory->get_object("8", "api", "api_id");

        $url = $o11->api_domain . "RechargeStatus.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_key . "&ClientId=" . $o1->ref_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $status = explode("|", $output);

        if ($status[0] == "0") {
            $result['status'] = 'Success';
            $result['error_msg'] = "Recharge Success";
        } else if ($status[0] == "1") {
            $result['status'] = 'Failed';
            $result['error_msg'] = "Recharge Failed";
        } else if ($status[0] == "2") {
            $result['status'] = 'Pending';
            $result['error_msg'] = "Recharge Pending";
        }

        $result['opid_id'] = $status[2];
        $result['message'] = $status[6];
        $result['responsestaus'] = $status[6];
        $result['tnx_id'] = $status[3];
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $output;
    } else {
        $result['error'] = "0";
        $result['error_msg'] = "Recharge " . $o1->status;
    }
    return $result;
}

###############################################################
//End of function to check tiptopmoney status
###############################################################
###############################################################
//Start of function to check tiptopmoney status
###############################################################

function status_tiptopmoney($o1) {
    //http://tiptopmoney.in/RechargeApi/RechargeStatus.aspx?Username=11900&Password=457f56c559&ClientId=36168730134

    if ($o1->status == "Pending") {

        $o11 = new stdClass();
        $factory = new TypeFactory($dbName);
        $o11 = $factory->get_object("8", "api", "api_id");

        $url = $o11->api_domain . "RechargeStatus.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_key . "&ClientId=" . $o1->ref_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

//		$status = explode("|", $output);
        //
		//		if ($status[0] == "0") {
        //			$result['status'] = 'Success';
        //			$result['error_msg'] = "Recharge Success";
        //		} else if ($status[0] == "1") {
        //			$result['status'] = 'Failed';
        //			$result['error_msg'] = "Recharge Failed";
        //		} else if ($status[0] == "2") {
        //			$result['status'] = 'Pending';
        //			$result['error_msg'] = "Recharge Pending";
        //		}
        //
		//		$result['opid_id'] = $status[2];
        //		$result['message'] = $status[6];
        //		$result['responsestaus'] = $status[6];
        //		$result['tnx_id'] = $status[3];
        //		$result['api_id'] = $o11->api_id;
        //		$result['api_name'] = $o11->api_name;
        return $output;
    } else {
        $result['error'] = "0";
        $result['error_msg'] = "Recharge " . $o1->status;
    }
    return $result;
}

###############################################################
//End of function to check tiptopmoney status
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function recharge_3g($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("10", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            $service_msg = "number=" . $o->mobile_number . "&amount=" . $o->amount . "&reqID=" . $o->ref_number . "&option1=";
            $url = $o11->api_domain . "/recharge_prepaid.php?uname=" . urlencode($o11->api_username) . "&api_token=" . urlencode($o11->api_key) . "&operator=" . $provider_code . "&circle=" . $o->circle_id . "&" . $service_msg;

            $o->recharge_url = $url;

            $o->wallet_id = $updater->update_object($o, "wallet");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $circleinfo = curl_exec($ch);
            // pt($circleinfo);
            curl_close($ch);
            $data = json_decode($circleinfo, true);

            if ($data['status'] == "SUCCESS" || $data['status'] == "Success") {
                $result['tnx_id'] = $data['opref'];
                $result['status'] = "Success";
            } else if ($data['status'] == "FAILED" || $data['status'] == "Failed") {
                $result['tnx_id'] = $o->ref_number;
                $result['status'] = "Failed";
            } else if ($data['status'] == "PENDING" || $data['Status'] == "Pending") {
                $result['tnx_id'] = $data['opref'];
                $result['status'] = "Pending";
            } else {
                $result['tnx_id'] = $o->ref_number;
                $result['status'] = "Pending";
            }
            $result['opid_id'] = $data['opref'];
            $result['message'] = $data['error_msg'];
            $result['responsestaus'] = $data['error_msg'];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function recharge_roundpay($o) {
   // echo '<pre>'; print_r($o); die;
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("10", "api", "api_id");
   // echo '<pre>'; print_r($o11); die;
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            $url = $o11->api_domain . "API/TransactionAPI?UserID=" . $o11->api_username . "&Token=" . $o11->api_password . "&Account=" . $o->mobile_number . "&SPKey=" . $provider_code . "&Amount=" . $o->total_amount . "&APIRequestID=" . $o->ref_number . "&optional1=&fmt=Json";
            //echo '<pre>'; print_r($url); die;
            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $circleinfo = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($circleinfo, true);
            //echo '<pre>'; print_r($data); die;
            if ($data['status'] == 2) {
                $result['status'] = "Success";
            } else if ($data['status'] == 3 || $data['status'] == 4) {
                $result['status'] = "Failed";
            } else if ($data['status'] == 1) {
                $result['status'] = "Pending";
            } else {
                $result['status'] = "Pending";
            }
            $result['tnx_id'] = $data['rpid'];
            $result['opid_id'] = $data['opid'];
            $result['message'] = $data['msg'];
            $result['responsestaus'] = $data['msg'];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
function recharge_roundpay_api($o) {
   // echo '<pre>'; print_r($o); die;
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("15", "api", "api_id");
   // echo '<pre>'; print_r($o11); die;
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            $url = $o11->api_domain . "API/TransactionAPI?UserID=" . $o11->api_username . "&Token=" . $o11->api_password . "&Account=" . $o->mobile_number . "&SPKey=" . $provider_code . "&Amount=" . $o->total_amount . "&APIRequestID=" . $o->ref_number . "&optional1=&fmt=Json";
            //echo '<pre>'; print_r($url); die;
            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $circleinfo = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($circleinfo, true);
            //echo '<pre>'; print_r($data); die;
            if ($data['status'] == 2) {
                $result['status'] = "Success";
            } else if ($data['status'] == 3 || $data['status'] == 4) {
                $result['status'] = "Failed";
            } else if ($data['status'] == 1) {
                $result['status'] = "Pending";
            } else {
                $result['status'] = "Pending";
            }
            $result['tnx_id'] = $data['rpid'];
            $result['opid_id'] = $data['opid'];
            $result['message'] = $data['msg'];
            $result['responsestaus'] = $data['msg'];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}
#################################################################
//Start of function to recharge using 3g
###############################################################
###############################################################
//start of function to recharge_smile
###############################################################
function recharge_smile($o) {
   // echo '<pre>'; print_r($o); die;
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("18", "api", "api_id");
   // echo '<pre>'; print_r($o11); die;
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {
//RechargeApi/Recharge.aspx?Username=<username>&Password=<APIPassword
//>&Amount=<Amount>&OperatorCode=<operatorCode>&Number=<number>&ClientId=<your
//refId>&CircleCode=<circleCode>
            $url = $o11->api_domain . "RechargeApi/Recharge.aspx?Username=" . $o11->api_username . "&Password=" . $o11->api_password . "&Number=" . $o->mobile_number . "&OperatorCode=" . $provider_code . "&Amount=" . $o->total_amount . "&ClientId=" . $o->ref_number . "&CircleCode=12";
            //echo '<pre>'; print_r($url); die;
            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $circleinfo = curl_exec($ch);
            curl_close($ch);
            $data = explode('|', $circleinfo);
            //echo '<pre>'; print_r($data); die;
            if ($data[0] == 0) {
                $result['status'] = "Success";
            } else if ($data[0] == 1) {
                $result['status'] = "Failed";
            } else if ($data[0] == 2) {
                $result['status'] = "Pending";
            } else {
                $result['status'] = "Pending";
            }
            $result['tnx_id'] = $data[4];
            $result['opid_id'] = $data[3];
            $result['message'] = $data[6];
            $result['responsestaus'] = $data[5];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}
#################################################################
//END of function to recharge_smile
###############################################################
function recharge_ezulix($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");
    if ($o11->is_active == 1) {

        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {
            $o->ref_number = 1000000000 + $o->wallet_id;

            if ($o->provider_type == 'Prepaid' || $o->provider_type == 'DTH') {

                $url = $o11->api_domain . "recharge.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_password . "&number=" . $o->mobile_number . "&operator=" . $provider_code . "&circle=" . $o->circle_id . "&amount=" . $o->total_amount . "&usertx=" . $o->ref_number;
            } else if ($o->provider_type == 'Postpaid' || $o->provider_type == 'Landline') {
                $url = $o11->api_domain . "recharge.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_password . "&number=" . $o->mobile_number . "&operator=" . $provider_code . "&circle=" . $o->circle_id . "&amount=" . $o->total_amount . "&account=" . $o->mobile_number . "&usertx=" . $o->ref_number;
            }

            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "postman-token: 3ab6dfd3-4cfc-93c8-88b1-12f4cdd238b4",
                ),
            ));

            $circleinfo = curl_exec($curl);
            curl_error($curl);

            $data = explode(',', $circleinfo);

            // $data = json_decode($circleinfo, true);
            if ($data[1] == "Success") {
                $result['status'] = "Success";
            } else if ($data[1] == "Failure") {
                $result['status'] = "Failed";
            } else {
                $result['status'] = "Pending";
            }

            $result['tnx_id'] = $data[0];
            $result['opid_id'] = $data[3];
            $result['message'] = $data[2];
            $result['responsestaus'] = $data[2];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function recharge_cyrus($o) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("13", "api", "api_id");
    
    if ($o11->is_active == 1) {

        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            if ($o->provider_type == 'Prepaid' || $o->provider_type == 'DTH' || $o->provider_type == 'Stv') {

                $url = $o11->api_domain . "recharge.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_key . "&number=" . $o->mobile_number . "&operator=" . $provider_code . "&circle=" . $o->circle_id . "&amount=" . $o->total_amount . "&usertx=" . $o->ref_number . "&format=json";
            } else if ($o->provider_type == 'Postpaid' || $o->provider_type == 'Landline') {
                $url = $o11->api_domain . "recharge.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_key . "&number=" . $o->mobile_number . "&operator=" . $provider_code . "&circle=" . $o->circle_id . "&amount=" . $o->total_amount . "&account=" . $o->mobile_number . "&usertx=" . $o->ref_number . "&format=json";
            }
            $o->recharge_url = $url;
            $o->wallet_id = $updater->update_object($o, "wallet");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $circleinfo = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($circleinfo, true);

            if ($data['Status'] == "SUCCESS" || $data['Status'] == "Success") {
                $result['status'] = "Success";
            } else if ($data['Status'] == "FAILURE" || $data['Status'] == "Failure") {
                $result['status'] = "Failed";
            } else if ($data['Status'] == "PENDING" || $data['Status'] == "Pending") {
                $result['status'] = "Pending";
            } else {
                $result['status'] = "Pending";
            }
            $result['tnx_id'] = $data['ApiTransID'];
            $result['opid_id'] = $data['OperatorRef'];
            $result['message'] = $data['ErrorMessage'];
            $result['responsestaus'] = $data['ErrorMessage'];
            $result['response'] = $circleinfo;
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function recharge_status_roundpay($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("2", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "StatusCheck.aspx?userid=" . urlencode($o11->api_username) . "&pass=" . $o11->api_password . "&csagentid=" . $o->ref_number . "&fmt=Json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($circleinfo, true);

        if ($data['STATUS'] == "SUCCESS") {
            $result['status'] = "Success";
        } else if ($data['STATUS'] == "FAILED") {
            $result['status'] = "Success";
        } else if ($data['STATUS'] == "PENDING") {
            $result['status'] = "Pending";
        } else {
            $result['status'] = "Pending";
        }
        $result['tnx_id'] = $data['RPID'];
        $result['opid_id'] = $data['OPID'];
        $result['message'] = $data['MSG'];
        $result['responsestaus'] = $data['MSG'];
        $result['response'] = $circleinfo;
        $result['url'] = $url;
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using Cyrus
###############################################################

function recharge_status_cyrus($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("5", "api", "api_id");

    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "rechargestatus.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_key . "&transid=" . $o->api_number . "&format=Json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($circleinfo, true);
        if ($data['ErrorMessage'] == "Transaction Id does not exist") {
            $result['status'] = "Failed";
        } else {
            if ($data['Status'] == "SUCCESS" || $data['Status'] == "Success") {
                $result['status'] = "Success";
            } else if ($data['Status'] == "FAILURE" || $data['Status'] == "Failure") {
                $result['status'] = "Failed";
            } else if ($data['Status'] == "PENDING" || $data['Status'] == "Pending") {
                $result['status'] = "Pending";
            } else {
                $result['status'] = "Pending";
            }
        }

        $result['tnx_id'] = $data['ApiTransID'];
        $result['opid_id'] = $data['OperatorRef'];
        $result['message'] = $data['ErrorMessage'];
        $result['responsestaus'] = $data['ErrorMessage'];
        $result['response'] = $circleinfo;
        $result['url'] = $url;
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using Cyrus
###############################################################
#################################################################
//Start of function to recharge using ezulix
###############################################################

function recharge_status_ezulix($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");

    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "rechargestatus.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_password . "&transid=" . $o->ref_number;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);
        curl_close($ch);
        // $data = json_decode($circleinfo, true);
        $data = explode(',', $circleinfo);

        if ($data[0] == "Success") {
            $result['status'] = "Success";
        } else if ($data[0] == "FAILURE") {
            $result['status'] = "Failed";
        }
        $result['tnx_id'] = $data[1];
        $result['opid_id'] = $data[1];
        $result['message'] = "Recharge Status :" . $data[0];
        $result['responsestaus'] = "Recharge Status :" . $data[0];
        $result['response'] = $circleinfo;
        $result['url'] = $url;
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using ezulix
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function balance_cyrus($api_id) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object($api_id, "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "balance.aspx?memberid=" . urlencode($o11->api_username) . "&pin=" . $o11->api_key . "&format=Json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($circleinfo, true);
        // pt($data);

        $result['Balance'] = $data['Balance'];
        $result['Status'] = "Success";
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function balance_ezulix($api_id) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object($api_id, "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "balance.aspx?memberid=" . $o11->api_username . "&pin=" . $o11->api_password;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        // $data = json_decode($circleinfo, true);
        $data = explode(",", $circleinfo);

        $result['Balance'] = $data[0];
        $result['Status'] = "Success";
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to recharge using 3g
###############################################################

function balance_roundpay($api_id) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object($api_id, "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "ApiService.aspx?userid=" . urlencode($o11->api_username) . "&pass=" . $o11->api_password . "&Get=CB&fmt=Json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($circleinfo, true);

        $result['Balance'] = $data['STATUS'];
        $result['Status'] = "Success";
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
#################################################################
//Start of function to check status of transaction recharge_status_three_solution
###############################################################

function status_3g($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("10", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "/response.php?uname=" . $o11->api_username . "&api_token=" . $o11->api_key . "&reqID=" . $o1->ref_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);
        //pt($circleinfo);
        curl_close($ch);
        $data = json_decode($circleinfo, true);

        if ($data['status'] == "SUCCESS" || $data['status'] == "Success") {
            $result['tnx_id'] = $data['opref'];
            $result['status'] = "Success";
        } else if ($data['status'] == "FAILED" || $data['status'] == "Failed") {
            $result['tnx_id'] = $o->ref_number;
            $result['status'] = "Failed";
        } else if ($data['status'] == "PENDING" || $data['Status'] == "Pending") {
            $result['tnx_id'] = $data['opref'];
            $result['status'] = "Pending";
        } else {
            $result['tnx_id'] = $o->ref_number;
            $result['status'] = "Pending";
        }
        $result['opid_id'] = $data['opref'];
        $result['message'] = $data['error_msg'];
        $result['responsestaus'] = $data['error_msg'];
        $result['response'] = $circleinfo;
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        return $result;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to check status of transaction recharge_status_three_solution
###############################################################
#################################################################
//Start of function to check status of transaction recharge_status_three_solution
###############################################################

function threeg_status($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("10", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "/response.php?uname=" . $o11->api_username . "&api_token=" . $o11->api_key . "&reqID=" . $o1->ref_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $circleinfo = curl_exec($ch);
        //pt($circleinfo);
        curl_close($ch);
        $data = json_decode($circleinfo, true);

        return $circleinfo;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to check status of transaction recharge_status_three_solution
###############################################################
###############################################################
//Start of function to check balance check_three_solution
###############################################################

function balance_3g() {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("10", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "/check_balance.php?uname=" . $o11->api_username . "&api_token=" . $o11->api_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $circleinfo = curl_exec($ch);

        curl_close($ch);

        $response_info = json_decode($circleinfo, true);

        return $response_info;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to checkbalance check_three_solution
###############################################################
###############################################################
//Start of function to check balance check_three_solution
###############################################################

function balance_rech() {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "bal.php?format=json&token=" . $o11->api_key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $circleinfo = curl_exec($ch);

        curl_close($ch);
        $response_info = json_decode($circleinfo, true);

        $response['Balance'] = $response_info['data'][0]['bal'];

        return $response;
    } else {
        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }
}

###############################################################
//End of function to checkbalance check_three_solution
###############################################################
################################################################
//Start of function to recharge_rechapi function
###############################################################

function recharge_rechapi($o) {
    $o11 = new stdClass();

    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o11->api_name);

        $result['error'] = "0";
        if ($provider_code != "") {

            $url = $o11->api_domain . "/recharge.php?format=json&token=" . $o11->api_key . "&mobile=" . $o->mobile_number . "&amount=" . $o->total_amount . "&opid=" . $provider_code . "&urid=" . $o->ref_number . "&opvalue1=" . $code . "&opvalue2=" . $field;
            if ($o->wallet_id > 0) {
                $o->recharge_url = $url;
                $o->wallet_id = $updater->update_object($o, "wallet");
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 50);
            $circleinfo = curl_exec($ch);
// pt($circleinfo);
            curl_close($ch);
            $response_info = json_decode($circleinfo, true);
// print_r($response_info);
            if ($response_info['data']['status'] == "SUCCESS" || $response_info['data']['status'] == "Success") {

                $result['tnx_id'] = $response_info['data']['orderId'];

                $result['status'] = "Success";
            } else if ($response_info['data']['status'] == "FAILED" || $response_info['data']['status'] == "Failed") {
                $result['tnx_id'] = $o->ref_number;
                $result['status'] = "Failed";
            } else if ($response_info['data']['status'] == "PENDING" || $response_info['data']['status'] == "Pending") {
                $result['tnx_id'] = $response_info['data']['orderId'];

                $result['status'] = "Pending";
            } else {
                $result['tnx_id'] = $o->ref_number;
                $result['status'] = "Pending";
            }
            $result['opid_id'] = $response_info['data']['operatorId'];
            $result['message'] = $response_info['data']['resText'];
            $result['responsestaus'] = $response_info['data']['resText'];
            $result['response'] = $response_info['data']['resText'];

            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $circleinfo;
        } else {
            $result['status'] = "Failed";
            $result['error_msg'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }

    return $result;
}

###############################################################
//End of function to recharge_cyrus function
###############################################################
###############################################################
###############################################################
//Start of function to check status of transaction recharge_status_roundpay
###############################################################

function status_rechapi($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "/api_status.php?format=json&token=" . $o11->api_key . "&orderId=" . $o1->api_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        $circleinfo = curl_exec($ch);
        curl_close($ch);
        $response_info = json_decode($circleinfo, true);

        if ($response_info['data'][0]['status'] == "SUCCESS" || $response_info['data'][0]['status'] == "Success") {

            $result['tnx_id'] = $response_info['data'][0]['orderId'];

            $result['status'] = "Success";
        } else if ($response_info['data'][0]['status'] == "FAILED" || $response_info['data'][0]['status'] == "Failed") {
            $result['tnx_id'] = $o->ref_number;
            $result['status'] = "Failed";
        } else if ($response_info['data'][0]['status'] == "PENDING" || $response_info['data'][0]['status'] == "Pending") {
            $result['tnx_id'] = $response_info['data'][0]['orderId'];

            $result['status'] = "Pending";
        } else {
            $result['tnx_id'] = $o->ref_number;
            $result['status'] = "Pending";
        }
        $result['opid_id'] = $response_info['data'][0]['TransId'];
        $result['message'] = $response_info['data'][0]['resText'];
        $result['responsestaus'] = $response_info['data'][0]['resText'];
        $result['response'] = $response_info['data'][0]['resText'];

        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $circleinfo;
    } else {
        return "failed";
    }
    return $result;
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to check status of transaction recharge_status_roundpay
###############################################################

function rechapi_status($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "/api_status.php?format=json&token=" . $o11->api_key . "&orderId=" . $o1->api_number;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        $circleinfo = curl_exec($ch);
        curl_close($ch);
        //$data = json_decode($circleinfo, true);

        return $circleinfo;
    } else {
        return "failed";
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to get parentid reference number
###############################################################

function parent_reference_no($parent_id) {
    if ($parent_id == "") {
        $parent_id = 0;
    }
    $sql = "Select ref_number from wallet where wallet_id = " . $parent_id;
    $res = getXbyY($sql);

    return $res[0]['ref_number'];
}

###############################################################
//End of function to get parentid reference number
###############################################################
###############################################################
//Start of functoin to list payment mode in dropdown
###############################################################

function payment_mode_list($id) {
    if ($id == "") {
        $id = "0";
    }

    $sql = "Select * from payment_mode where is_active = 1 order by payment_mode";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        if ($id == $res[$i]['payment_mode'] || $res[$i]['payment_mode'] == "Cash") {
            $sstring .= "<option value='" . $res[$i]['payment_mode'] . "' selected='selected'>" . $res[$i]['payment_mode'] . " </option>";
        } else {
            $sstring .= "<option value='" . $res[$i]['account_name'] . "' >" . $res[$i]['payment_mode'] . "(" . $res[$i]['account_name'] . ") </option>";
        }
    }
    return $sstring;
}

###############################################################
//End of functoin to list payment mode in dropdown
###############################################################
//Start of function to get commission amount
###############################################################

function commission_amount($plan_id, $provider_id) {
    if ($plan_id == "") {
        $plan_id = 0;
    }
    if ($provider_id == "") {
        $provider_id = 0;
    }

    $sql = "Select * from user_plan_service where user_plan_id = " . $plan_id . " and provider_id = " . $provider_id . " and is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows == 1) {
        $comm['amount'] = $res[0]['type_rt'];
        $comm['percentage'] = $res[0]['commission_amount_rt'];
    } else {
        $comm['amount'] = 0;
        $comm['percentage'] = 0;
    }

    return $comm;
}

###############################################################
//End of function to get commission amount
###############################################################
###############################################################
//Start of function to generate random colors
###############################################################

function random_color_part() {
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return "#" . random_color_part() . random_color_part() . random_color_part();
}

###############################################################
//End of function to generate random colors
###############################################################
###############################################################
//Start of function to check revenue and turnover
###############################################################

function transaction_type_amount($transaction_type, $status) {

    if ($transaction_type == "Commission") {
        $dd['type'] = "revenue";
    } else if ($transaction_type == "Refund") {
        $dd['type'] = "refund";
    } else if ($transaction_type == "Recharge") {
        if ($status == "Success") {
            $dd['type'] = "success";
        } else if ($status == "Pending") {
            $dd['type'] = "pending";
        } else {
            $dd['type'] = "failed";
        }
    } else if ($transaction_type == "User Info Check") {
        $dd['type'] = "success1";
    } else {
        $dd['type'] = "success2";
    }
    return $dd;
}

###############################################################
//End of function to check revenue and turnover
###############################################################
###############################################################
//Start of function to add notifications into system
###############################################################

function get_tds_gst($plan_id, $operator_id, $amount, $tds, $gst) {

    $sql = "Select * from user_plan_service where user_plan_id = '" . $plan_id . "' and provider_id ='" . $operator_id . "'";
    $res = getXbyY($sql);
    $rows = count($res);
    if ($rows > 0) {
        $comm_amount = $res[0]['commission_amount'];
        $comm_percentage = $res[0]['commission_percentage'];
        $total_commission_amount = 0;
        $total_payable = 0;
        $gst_100 = 100 + ($gst);
        if ($comm_percentage > 0) {
            $total_commission_amount = round(($comm_percentage / 100) * ($amount), 2);
        } else {
            $total_commission_amount = $comm_amount;
        }

        $tds_amount = round(($tds / 100) * $total_commission_amount, 2);
        //gst_amount = roundToTwo((parseFloat(gst) / 100) * parseFloat(total_commission_amount));
        $total_payable = round($amount - $total_commission_amount, 2);
        $gst_amount = round(($total_payable) / ($gst_100) * ($gst), 2);
        $total_payable = round(($total_payable) + ($tds_amount), 2);
        $net_profit = 0;
        $net_profit = round(($total_commission_amount) - ($tds_amount));
    }
    $result['tds_amt'] = $tds_amount;
    $result['commission_amount'] = $total_commission_amount;
    $result['gst_amt'] = $gst_amount;
    $result['pay_amount'] = $total_payable;
    $result['net_profit'] = $net_profit;

    return $result;
}

###############################################################
//End of function to add notifications into system
###############################################################
###############################################################
//Start of function to add notifications into system
###############################################################

function get_commission($user_obj, $wallt_obj) {

    $sql = "Select * from user_plan_service where user_plan_id = '" . $user_obj->plan_id . "'  and is_active ='1' and  provider_id ='" . $wallt_obj->provider_id . "'";
    $res = getXbyY($sql);
    $rows = count($res);
    $total_commission_amount = 0;
    $total_payable = $wallt_obj->amount;
    $net_profit = 0;
    if ($rows > 0) {
        $type = $res[0]['type_rt'];
        $comm_percentage = $res[0]['commission_amount_rt'];
        $total_commission_amount = 0;
        $total_payable = 0;
        if ($type == "Commission Percentage") {
            $total_commission_amount = round(($comm_percentage / 100) * ($wallt_obj->amount), 2);
            $total_payable = round($wallt_obj->amount - $total_commission_amount, 2);
        } else if ($type == "Commission Flat") {
            $total_commission_amount = $comm_percentage;
            $total_payable = round($wallt_obj->amount - $total_commission_amount, 2);
        } else if ($type == "Surcharge Percentage") {
            $total_commission_amount = round(($comm_percentage / 100) * ($wallt_obj->amount), 2);
            $total_payable = round($wallt_obj->amount + $total_commission_amount, 2);
        } else if ($type == "Surcharge Flat") {
            $total_commission_amount = $comm_percentage;
            $total_payable = round($wallt_obj->amount + $total_commission_amount, 2);
        }

        $net_profit = $total_commission_amount;
    }

    $result['commission_amount'] = $total_commission_amount;
    $result['pay_amount'] = $total_payable;
    $result['net_profit'] = $net_profit;

    return $result;
}

function api_get_commission($o, $amount, $operator) {

    $sql = "Select * from user_plan_service where user_plan_id = '" . $o->plan_id . "'  and is_active ='1' and  provider_id ='" . $operator . "'";
    //pt($sql);  die;
    $res = getXbyY($sql);
    $rows = count($res);
    $total_commission_amount = 0;
    $total_payable = $amount;
    $net_profit = 0;
    if ($rows > 0) {
        $type = $res[0]['type_rt'];
        $comm_percentage = $res[0]['commission_amount_rt'];
        $total_commission_amount = 0;
        $total_payable = 0;
        if ($type == "Commission Percentage") {
            $total_commission_amount = round(($comm_percentage / 100) * ($amount), 2);
            $total_payable = round($amount - $total_commission_amount, 2);
        } else if ($type == "Commission Flat") {
            $total_commission_amount = $comm_percentage;
            $total_payable = round($amount - $total_commission_amount, 2);
        } else if ($type == "Surcharge Percentage") {
            $total_commission_amount = round(($comm_percentage / 100) * ($amount), 2);
            $total_payable = round($amount + $total_commission_amount, 2);
        } else if ($type == "Surcharge Flat") {
            $total_commission_amount = $comm_percentage;
            $total_payable = round($amount + $total_commission_amount, 2);
        }

        $net_profit = $total_commission_amount;
    }

    $result['commission_amount'] = $total_commission_amount;
    $result['pay_amount'] = $total_payable;
    $result['net_profit'] = $net_profit;
//pt($total_payable);  die;
    return $result;
}
###############################################################
//End of function to add notifications into system
###############################################################
###############################################################
//Start of function to recharge using recharge_roundpay
###############################################################

function recharge_Mrobotics($o) {
	//pt($o);die;
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("13", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($provider_code != "") {

            if ($o->provider_id == 7 || $o->provider_id == 3) {
                $type1 = "true";
            } else {
                $type1 = "false";
            }

            $url1 = $o11->api_domain . "recharge?api_token=" . $o11->api_key . "&mobile_no=" . $o->mobile_number . "&amount=" . $o->total_amount . "&company_id=" . $provider_code . "&order_id=" . $o->ref_number . "&is_stv=" . $type1 . "";
            $o->recharge_url = $url1;
            $o->wallet_id = $updater->update_object($o, "wallet");

            $url = $o11->api_domain . "recharge";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 40);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "api_token=" . $o11->api_key . "&mobile_no=" . $o->mobile_number . "&amount=" . $o->total_amount . "&company_id=" . $provider_code . "&order_id=" . $o->ref_number . "&is_stv=" . $type1 . "");
            $circleinfo = curl_exec($ch);

            curl_close($ch);
            $api_values = json_decode($circleinfo, true);

            if ($api_values['error'] == 1) {
                $result['status'] = "Failed";
                $result['message'] = $api_values['errorMessage'];
                $result['responsestaus'] = $api_values['errorMessage'];
                $result['response'] = $api_values['errorMessage'];
            } else {
                if ($api_values['status'] == "success") {

                    $result['status'] = "Success";
                } else if ($api_values['status'] == "failure") {

                    $result['status'] = "Failed";
                } else {

                    $result['status'] = "Failed";
                }
                $result['message'] = $api_values['response'];
                $result['responsestaus'] = $api_values['response'];
                $result['response'] = $api_values['response'];
            }
            $result['opid_id'] = $api_values['tnx_id'];
            $result['tnx_id'] = $api_values['tnx_id'];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $circleinfo;
        } else {
            $result['status'] = "Failed";
            $result['comment'] = "Operator Down. Please try again.";
            $result['code'] = "0";
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
        }
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
    }
    return $result;
}

###############################################################
//End of function to recharge using gateway1
###############################################################
###############################################################
//Start of function to check status of transaction recharge_status_aio
###############################################################

function recharge_status_Mrobotics($o1) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);

    if ($o1->status == "Pending") {
        $o11 = $factory->get_object("13", "api", "api_id");
        if ($o11->is_active == 1) {
            $url = $o11->api_domain . "order_id_status";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 40);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "api_token=" . $o11->api_key . "&order_id=" . $txid . "");
            $circleinfo = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($circleinfo, true);
            if ($api_values['error'] == 1) {
                $result['status'] = "Failed";
                $result['message'] = $api_values['errorMessage'];
                $result['responsestaus'] = $api_values['errorMessage'];
                $result['response'] = $api_values['errorMessage'];
            } else {
                if ($api_values['status'] == "success") {

                    $result['status'] = "Success";
                } else if ($api_values['status'] == "failure") {

                    $result['status'] = "Failed";
                } else {

                    $result['status'] = "Accepted";
                }
                $result['message'] = $api_values['response'];
                $result['responsestaus'] = $api_values['response'];
                $result['response'] = $api_values['response'];
            }
            $result['opid_id'] = $api_values['tnx_id'];

            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $circleinfo;
        } else {
            $result['error_msg'] = "We are Updating. Please Wait";
            $result['error'] = "1";
            return $result;
        }
    } else {
        $result['error_msg'] = "Status Already update";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to check status of transaction recharge_status_aio
###############################################################

function status_Mrobotics($txid) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("13", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "order_id_status";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api_token=" . $o11->api_key . "&order_id=" . $txid . "");
        $circleinfo = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($circleinfo, true);
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to check status of Realrobo
###############################################################

function recharge_realrobo($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("14", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";
        if ($o->provider_type == "Stv") {
            $type1 = "stv";
        } else {
            $type1 = "topup";
        }

        $url = $o11->api_domain . "" . $provider_code . "?key=" . $o11->api_key . "&uid=" . $o11->api_username . "&lapunumber=RANDOM&number=" . $o->mobile_number . "&amount=" . $o->amount . "&type=" . $type1 . "&reqID=" . $o->ref_number;

        $o->recharge_url = $url;

        $o->wallet_id = $updater->update_object($o, "wallet");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $api_values = json_decode($output, true);
        if ($api_values['Status'] == "Success") {
            $result['status'] = "Success";
        } else if ($api_values['Status'] == "Failed") {
            $result['status'] = "Failed";
        } else {
            $result['status'] = "Pending";
        }
        $result['message'] = $api_values['Message'];
        $result['responsestaus'] = $api_values['Message'];
        $result['opid_id'] = $api_values['Txid'];
        $result['tnx_id'] = $api_values['Txid'];
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $output;
        return $result;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to check status of Realrobo
###############################################################

function recharge_ezytm($o) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("12", "api", "api_id");
    if ($o11->is_active == 1) {
        $provider_code = get_api_provider_code($o->provider_id, $o->api_name);
        $result['error'] = "0";

        $url = $o11->api_domain . "GetMobileRecharge?Apimember_id=" . $o11->api_username . "&Api_password=" . $o11->api_password . "&Mobile_no=" . $o->mobile_number . "&Operator_code=" . $provider_code . "&Amount=" . $o->total_amount . "&Member_request_txnid=" . $o->ref_number . "&Circle=" . $o->circle_id;

        $o->recharge_url = $url;

        $o->wallet_id = $updater->update_object($o, "wallet");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $api_values = json_decode($output, true);
        if ($api_values['STATUS'] == "1") {
            $result['status'] = "Success";
        } else if ($api_values['STATUS'] == "3") {
            $result['status'] = "Failed";
        } else {
            $result['status'] = "Pending";
        }

        $result['message'] = $api_values['MESSAGE'];
        $result['responsestaus'] = $api_values['MESSAGE'];
        $result['opid_id'] = $api_values['OPTRANSID'];
        $result['tnx_id'] = $api_values['ORDERID'];
        $result['api_id'] = $o11->api_id;
        $result['api_name'] = $o11->api_name;
        $result['response'] = $output;
        return $result;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
################################################################
//Start of function to check status of transaction recharge_status_aio
###############################################################

function status_ezytm($txid) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("12", "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "GetStatus?Apimember_id=" . $o11->api_username . "&Api_password=" . $o11->api_password . "&Member_request_txnid=" . $txid;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $api_values = json_decode($output, true);

        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
################################################################
//Start of function to check status of transaction recharge_status_aio
###############################################################

function recharge_status_ezytm($o1) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);

    if ($o1->status == "Pending") {
        $o11 = $factory->get_object("12", "api", "api_id");
        if ($o11->is_active == 1) {
            $url = $o11->api_domain . "GetStatus?Apimember_id=" . $o11->api_username . "&Api_password=" . $o11->api_password . "&Member_request_txnid=" . $o1->ref_number;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $api_values = json_decode($output, true);

            if ($api_values['STATUS'] == "1") {
                $result['status'] = "Success";
            } else if ($api_values['STATUS'] == "3") {
                $result['status'] = "Failed";
            } else {
                $result['status'] = "Pending";
            }
            $result['message'] = $api_values['MESSAGE'];
            $result['responsestaus'] = $api_values['MESSAGE'];
            $result['opid_id'] = $api_values['OPTRANSID'];
            $result['tnx_id'] = $api_values['ORDERID'];
            $result['api_id'] = $o11->api_id;
            $result['api_name'] = $o11->api_name;
            $result['response'] = $output;
            return $result;
        } else {
            $result['error_msg'] = "We are Updating. Please Wait";
            $result['error'] = "1";
            return $result;
        }
    } else {
        $result['error_msg'] = "Status Already update";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to check status of Realrobo
###############################################################

function get_bbps_token($o) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://uat-accounts.payu.in/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "client_id=c0cd703c1a08d844c10c6d66dd13c4fbb0ff56dd85332ba6f3c2fdd5d1732b24&client_secret=0315f4bfb4201688993633b65e4fdbcbe6824f6355f74b87dcd5bb76d166e2af&grant_type=client_credentials&scope=read_billers",
        CURLOPT_HTTPHEADER => array(
            "authorization: bearer access_token",
            "content-type: application/x-www-form-urlencoded",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    //pt($response);
    $response = json_decode($response, true);
    return $response;
}

###############################################################
//End of function to check status of transaction 3g api
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function get_username_from_id($user_id) {
    if ($user_id == "") {
        $user_id = 0;
    }
    $sql = "Select user_name, name ,mobile from users where user_id = " . $user_id;
    $res = getXbyY($sql);

    return $res[0]['name'] . " <br/>" . $res[0]['mobile'];
}
function get_user_details($user_id){
  $sql = "Select name , mobile , user_type from users where user_id = " . $user_id;
  $res = getXbyY($sql);
  $rows = count($res);

  return $res[0]['name'] . "<br/>" . $res [0]['mobile'] . "<br/>" . $res[0]['user_type'];
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_money_join($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/SenderRegistration";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "api/DMR/SenderRegistration?key=" . $o11->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################
// function dezire_add_beneficiary($enc_data) {
//     $o11 = new stdClass();
//     $factory = new TypeFactory($dbName);
//     $updater = new TypeUpdater($dbName);
//     $o11 = $factory->get_object('16', "api", "api_id");
//     if ($o11->is_active == 1) {
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//             CURLOPT_URL => $o11->api_domain . "api/DMR/BeneficiaryRegistration?key=" . $o11->api_key,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => "",
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 30,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "POST",
//             CURLOPT_POSTFIELDS => "\"$enc_data\"",
//             CURLOPT_HTTPHEADER => array(
//                 "cache-control: no-cache",
//                 "content-type: application/json",
//                 "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
//             ),
//         ));
//         $response = curl_exec($curl);
//         $err = curl_error($curl);
//         curl_close($curl);
//         $api_values = json_decode($response, true);
//         $api_values['error'] = '0';
//         return $api_values;
//     } else {
//         $result['error_msg'] = "We are Updating. Please Wait";
//         $result['error'] = "1";
//         return $result;
//     }
// }
###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_send_money($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/PaymentTransaction?key=" . $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "api/DMR/PaymentTransaction?key=" . $o11->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        $api_values['url'] = $url;
        $api_values['response'] = $response;
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_ben_verify($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/VerifyNonRegisterBeneficiary?key=" . $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "api/DMR/VerifyNonRegisterBeneficiary?key=" . $o11->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        $api_values['url'] = $url;
        $api_values['response'] = $response;
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_forgot_pin($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/ForgotPIN?key=" . $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "api/DMR/ForgotPIN?key=" . $o11->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        $api_values['url'] = $url;
        $api_values['response'] = $response;
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_VerifyBeneficiary($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "api/DMR/VerifyBeneficiary?key=" . $o11->api_key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_money_login($enc_data) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/SenderLogin?key=" . $o11->api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "\"$enc_data\"",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_status($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "api/DMR/CheckPaymentStatus/" . $o1->ref_number . "/" . $o11->api_username . "?key=" . $o11->api_key;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: c5c0681e-fae9-f16d-dbff-9a6a6fc275ff",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        $api_values['response'] = $response;
        $api_values['url'] = $url;
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_get_balance($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "api/DMR/GetBalance/" . $o11->api_username . "?key=" . $o11->api_key;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: c5c0681e-fae9-f16d-dbff-9a6a6fc275ff",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        $api_values['response'] = $response;
        $api_values['Balance'] = $api_values['balance'];
        $api_values['url'] = $url;
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_money_sender_info($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/GetSenderDetails/senderID/merchantUserID?key=" . $o11->api_key . "&senderID=" . $o1->senderID . "&merchantUserID=" . $o1->merchantUserID;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "Get",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to get username from userid
###############################################################

function dezire_kycstatus_info($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object('16', "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "api/DMR/GetSenderDetails/senderID/merchantUserID?key=" . $o11->api_key . "&senderID=" . $o1->senderID . "&merchantUserID=" . $o1->merchantUserID;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "Get",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: dd890953-b04e-ff86-1999-e8567fc39907",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $api_values = json_decode($response, true);
        $api_values['error'] = '0';
        return $api_values;
    } else {
        $result['error_msg'] = "We are Updating. Please Wait";
        $result['error'] = "1";
        return $result;
    }
}

###############################################################
//End of function to get username from userid
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function ipay_beneficiary($id, $ben_id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select ipay_beneficiary_id, beneficiaryName ,accountNo from ipay_beneficiary where is_active = 1 and ipay_user_id = '" . $id . "' order by beneficiaryName";
    $res = getXbyY($sql);
    $rows = count($res);
    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['ipay_beneficiary_id'] . "' ";
        if ($res[$i]['ipay_beneficiary_id'] == $ben_id) {
            $sstring .= " selected='selected'";
        }

        $sstring .= ">" . $res[$i]['beneficiaryName'] . " [" . $res[$i]['accountNo'] . "]</option>";
    }
    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function rech_beneficiary($id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select rech_beneficiary_id, beneficiaryName ,beneficiaryAccountNumber from rech_beneficiary where is_active = 1 and rech_customer_id = '" . $id . "' order by beneficiaryName";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['rech_beneficiary_id'] . "' ";
        if ($res[$i]['rech_beneficiary_id'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['beneficiaryName'] . " [" . $res[$i]['beneficiaryAccountNumber'] . "]</option>";
    }

    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function dezire_state_list($id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select * from dezire_state where is_active = 1 order by state_name";
    $res = getXbyY($sql);
    $rows = count($res);
    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['state_ID'] . "' ";
        if ($res[$i]['state_ID'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['state_name'] . "</option>";
    }
    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function ipay_bank_list($id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select * from ipay_bank where is_active = 1 order by bank_name";
    $res = getXbyY($sql);
    $rows = count($res);
    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['bankID'] . "' ";
        if ($res[$i]['bankID'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['bank_name'] . "</option>";
    }
    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function rech_bank_list($id) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select * from ipay_bank where is_active = 1 order by bank_name";
    $res = getXbyY($sql);
    $rows = count($res);
    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['bankID'] . "' ";
        if ($res[$i]['bankID'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['bank_name'] . "</option>";
    }
    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to list providers with services in dropdown
###############################################################

function dezire_proof_list($id, $type) {
    if ($id == "") {
        $id = 0;
    }
    $sql = "Select * from dezire_proof where is_active = 1 and proof_type='" . $type . "' ";
    $res = getXbyY($sql);
    $rows = count($res);
    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $sstring .= "<option value='" . $res[$i]['proof_id'] . "' ";
        if ($res[$i]['proof_id'] == $id) {
            $sstring .= " selected='selected'";
        }
        $sstring .= ">" . $res[$i]['proof_name'] . "</option>";
    }
    return $sstring;
}

###############################################################
//End of function to list providers with services in dropdown
###############################################################
###############################################################
//Start of function to fetch bill
###############################################################

function fetch_bill($provider_id,$mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("4", "api", "api_id");
    $provider_code = get_api_provider_code($provider_id, $o11->api_name);
    if ($o11->is_active == 1) {
        $rand =rand(1111111111,9999999999);
        $cus_number ="9313606065";
        $url = $o11->api_domain . "/api/Mobile/BillCheck?memberid=" . $o11->api_username . "&api_password=" . $o11->api_key . "&Accountno=" . $mobile . "&Mobileno=" . $cus_number . "&AgentId=" . $rand . "&operator_code=" . $provider_code;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        pt($url);
        pt($response);die;
        //$data = json_decode($response, true);
        return $response;
    }
}

###############################################################
//End of function to fetch bill
###############################################################
###############################################################
//Start of function to fetch bill
###############################################################

function get_number_info($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "mob_details.php?format=json&token=" . $o11->api_key . "&mobile=" . $mobile;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 0785c8e5-4776-f28e-4a3a-915bb795e3ea",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);
        return $data;
    }
}

###############################################################
//End of function to fetch bill
###############################################################
###############################################################
//Start of function to fetch bill
###############################################################

function get_number_info_recharge_plan($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("9", "api", "api_id");
    if ($o11->is_active == 1) {
        $url = $o11->api_domain . "plansservices.asmx/HLRLookup?UMobile=" . $o11->api_username . "&Token=" . $o11->api_key . "&MSISDN=" . $mobile;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 0785c8e5-4776-f28e-4a3a-915bb795e3ea",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        return $data;
    }
}

###############################################################
//End of function to fetch bill
###############################################################
###############################################################
//Start of function to fetch bill
###############################################################

function get_number_info_planapi($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("15", "api", "api_id");
    $url = "http://planapi.in/api/Mobile/OperatorFetch?apimember_id=" . $o11->api_username . "&api_password=" . $o11->api_key . "&Mobileno=$mobile";
    // $url = $o11->api_domain . "plansservices.asmx/HLRLookup?UMobile=" . $o11->api_username . "&Token=" . $o11->api_key . "&MSISDN=".$mobile;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 0785c8e5-4776-f28e-4a3a-915bb795e3ea",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);

    return $data;
}

###############################################################
//End of function to fetch bill
###############################################################
//################################################################
//GET RECH Customer
//#######################eko#########################################

function rech_remitter_details($customerMobile) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "/moneyTransfer/cusDetails.php?format=json&token=" . $o11->api_key . "&customerMobile=" . $customerMobile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        $circleinfo = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($circleinfo, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of Get Ipay Customer
//################################################################
//################################################################
//Create RECH Customer
//#######################eko#########################################

function rech_customer($o1) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $o1->customerName = urlencode($o1->customerName);

        $url = $o11->api_domain . "moneyTransfer/customerRegistration.php?format=json&token=" . $o11->api_key . "&customerName=" . $o1->customerName . "&customerPincode=" . $o1->customerPincode . "&customerMobile=" . $o1->customerMobile;

        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
// pt($output);
        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of create Ipay Customer
//################################################################
//################################################################
//Create RECH Customer
//#######################eko#########################################

function rech_customer_ben($customerMobile, $beneficiaryName, $beneficiaryMobileNumber, $ifscCode, $beneficiaryAccountNumber) {

    $beneficiaryName = urlencode($beneficiaryName);
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");

    if ($o11->is_active == 1) {
        $token = $o11->api_key;

        $url = $o11->api_domain . "moneyTransfer/addBeneficiary.php?format=json&token=$token&customerMobile=$customerMobile&beneficiaryName=$beneficiaryName&beneficiaryMobileNumber=$beneficiaryMobileNumber&beneficiaryAccountNumber=$beneficiaryAccountNumber&ifscCode=$ifscCode";

        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of create Ipay Customer
//################################################################
//################################################################
//Create RECH Customer
//#######################eko#########################################

function rech_ben_validate($customerMobile, $beneficiary_id, $otp) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $token = $o11->api_key;

        $url = $o11->api_domain . "moneyTransfer/beneficiaryVerifiy.php?format=json&token=$token&customerMobile=$customerMobile&otp=$otp&beneficiaryId=$beneficiary_id";

        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of create Ipay Customer
//################################################################
//################################################################
//Create RECH Customer
//#######################eko#########################################

function send_rech_money($customerMobile, $transaction_amount, $benificiary_id, $agentid) {

    // $sql = "Select * from api where api_name = 'Rech Api' and is_active = '1'";
    // $res = getXbyY($sql, "array");
    // $rows = count($res);
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $token = $o11->api_key;

        $url = $o11->api_domain . "/moneyTransfer/sendMoney.php?format=json&token=$token&customerMobile=$customerMobile&amount=$transaction_amount&beneficiaryId=$benificiary_id&urid=$agentid";

        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of create Ipay Customer
//################################################################
//################################################################
//Create RECH Customer
//#######################eko#########################################

function rech_ben_acc_verify($customerMobile, $benificiary_acc, $ipay_ifsc, $ref_number) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $token = $o11->api_key;
        $url = $o11->api_domain . "moneyTransfer/beneficiaryValidate.php?format=json&token=$token&customerMobile=$customerMobile&beneficiaryAccountNumber=$benificiary_acc&ifscCode=$ipay_ifsc&urid=$ref_number";

        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End of create Ipay Customer
//################################################################
//Create Delete beneficiary

function rech_ben_remove($customerMobile, $beneficiaryId) {

    $sql = "Select * from api where api_name = 'Rech Api' and is_active = '1'";
    $res = getXbyY($sql, "array");
    $rows = count($res);
    if ($rows == 1) {
        $token = $res[0]['api_key'];

        $url = $res[0]['api_domain'] . "/moneyTransfer/deleteBeneficiary.php?format=json&token=$token&customerMobile=$customerMobile&beneficiaryId=$beneficiaryId";
        $url;
//die();
        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//End Delete Beneficiary
//################################################################
//Start Delete Beneficiary OTP
//################################################################
function rech_ben_remove_verify($customerMobile, $beneficiaryId, $otp) {

    $sql = "Select * from api where api_name = 'Rech Api' and is_active = '1'";
    $res = getXbyY($sql, "array");
    $rows = count($res);
    if ($rows == 1) {
        $token = $res[0]['api_key'];

        $url = $res[0]['api_domain'] . "/moneyTransfer/deleteBeneficiaryVerifiy.php?format=json&token=$token&customerMobile=$customerMobile&beneficiaryId=$beneficiaryId&otp=$otp";
//echo $url;
        //die();
        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//Start rech customer verification
//################################################################
function rech_verify_cutomer($Mobile, $otp) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("6", "api", "api_id");
    if ($o11->is_active == 1) {
        $token = $o11->api_key;

        $url = $o11->api_domain . "/moneyTransfer/customerVerify.php?format=json&token=" . $token . "&customerMobile=" . $Mobile . "&otp=" . $otp;
//echo $url;
        //die();
        $request_timeout = 60; // 60 seconds timeout
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
// pt($output);
        //$response_info = explode(",",$circleinfo);
        $data = json_decode($output, true);
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//end rech customer verification
//################################################################
//################################################################
//Start user_list
//################################################################

function get_request_users_list($id) {
    if ($id == "") {
        $id = 0;
    }

    $sql = "Select * from users where (user_id = '" . $id . "' or  parent_id =  '" . $id . "') and (user_type = 'DSE'  or user_type = 'Distributor' )and user_type !='Admin' and is_active = 1 order by user_id DESC";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {

        $sstring .= "<option value='" . $res[$i]['user_id'] . "'>" . $res[$i]['user_name'] . " [" . $res[$i]['name'] . "] [" . $res[$i]['mobile'] . "]</option>";
    }

    return $sstring;
}

//################################################################
//end user_list
//################################################################
//################################################################
//Start ipay oulet otp
//################################################################

function ipay_outlet_otp($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/outlet/registrationOTP",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"token\" : \"" . $o11->api_key . "\",\n  \"request\" : \n  {\n    \"mobile\" : \"" . $mobile . "\"\n  }\n}",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 102",
                "Content-Type: application/json",
                "Cookie: SERVERID=B",
                "Host: www.instantpay.in",
                "Postman-Token: 214fc65d-dcf4-46de-9ba3-8eca903afb60,a84d3b67-f835-4547-a9c0-7d8e45410288",
                "User-Agent: PostmanRuntime/7.17.1",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
// $err = curl_error($curl);
        $xml = simplexml_load_string($response);
        // pt($xml);
        $json = json_encode($xml);
        // pt($json);
        $array = json_decode($json, TRUE);
        if ($array['statuscode'] == 'TXN') {
            $data['data'] = $array['data']['mobile'];
            $data['error'] = $array['status'];
            $data['status'] = "1";
        } else {
            $data['error'] = $array;
            $data['status'] = "0";
        }
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}

//################################################################
//end ipay oulet otp
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_outlet_registration($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/outlet/registration",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\t\"token\" : \"" . $o11->api_key . "\",\r\n\t\"request\" : {\r\n\t\t\"mobile\" : \"" . $o1->mobile . "\",\r\n\t\t\"email\" : \"" . $o1->email . "\",\r\n\t\t\"company\" : \"" . $o1->company . "\",\r\n\t\t\"name\" : \"" . $o1->name . "\",\r\n\t\t\"pan\" : \"" . $o1->pan . "\",\r\n\t\t\"pincode\" : \"" . $o1->pincode . "\",\r\n\t\t\"address\" : \"" . $o1->address . "\",\r\n\t\t\"otp\" : \"" . $o1->otp . "\"\r\n}\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 277",
                "Content-Type: application/json",
                "Cookie: SERVERID=B",
                "Host: www.instantpay.in",
                "Postman-Token: e69552b0-09f4-4331-b5b0-5b8354b05e10,4bf48bcf-2dfe-4bbd-a122-2426d7212f87",
                "User-Agent: PostmanRuntime/7.17.1",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            $data['error'] = $err;
            $data['status'] = "1";
        } else {
            $data['error'] = $response;
            $data['status'] = "1";
        }
    } else {

        $data['error'] = "We are Updating. Please Wait";
        $data['status'] = "0";
        die(json_encode($data));
    }

    return $data;
}
//*********** Encryption Function *********************
function encrypt($plainText, $key) {
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = bin2hex($openMode);
    return $encryptedText;
}

//*********** Decryption Function *********************
function decrypt($encryptedText, $key) {
    $key = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = hextobin($encryptedText);
    $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    return $decryptedText;
}

//*********** Padding Function *********************
function pkcs5_pad($plainText, $blockSize) {
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}

//********** Hexadecimal to Binary function for php 4.0 version ********
function hextobin($hexString) {
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } else {
            $binString .= $packedString;
        }

        $count += 2;
    }
    return $binString;
}
//********** To generate ramdom String ********
function generateRandomString($length = 35) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//################################################################
//end ipay oulet Registration
//################################################################
//################################################################
//start ipay Login
//################################################################
function ipay_pay_login($mobile) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id"); 
    if ($o11->is_active == 1) {
    $request = '<?xml version="1.0" encoding="UTF-8"?>
			<dmtServiceRequest>
			<requestType>SenderDetails</requestType>
			 <senderMobileNumber>'.trim($mobile).'</senderMobileNumber>
			<txnType>IMPS</<txnType>
                        </dmtServiceRequest>';    
    $encrypt_xml_data = encrypt($request, trim($o11->security_key));
    $data['accessCode'] = trim($o11->api_key);
    $data['requestId'] = generateRandomString();    
    $data['encRequest'] = $encrypt_xml_data;
    $data['ver'] = '1.0';
    $data['instituteId'] =trim($o11->api_username);   
    $parameters = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, trim($o11->api_domain));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    //$response = $this->decrypt($result, $key);
    echo '<pre>'; print_r($result); die;
   






 

        curl_close($curl);

        $data = json_decode($response, true);
        $data['error'] = "0";
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//end ipay Login
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_register($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/remitter",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\":\"" . $o11->api_key . "\",\"request\": {\"mobile\": \"" . $o1->mobileNo . "\",\"name\":\"" . $o1->first_Name . "\",\"surname\":\"" . $o1->last_Name . "\",\"pincode\":\"" . $o1->pincode . "\",\"outletid\":" . $o11->security_key . "}}",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: 19b24633-ef91-4632-8b49-9ff4de6bf91b",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        $data['error'] = "0";
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_forget_pin($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/beneficiary_resend_otp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\":\"" . $o11->api_key . "\",\"request\": {\"remitterid\": \"" . $o1->beneficiaryid . "\",\"beneficiaryid\":\"" . $o1->merchantUserID . "\",\"surname\":\"" . $o1->last_Name . "\",\"pincode\":\"" . $o1->pincode . "\",\"outletid\":" . $o11->security_key . "}}",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: 19b24633-ef91-4632-8b49-9ff4de6bf91b",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        $data['error'] = "0";
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_remitter_validate($o1) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/remitter_validate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\":\"" . $o11->api_key . "\",\"request\": {\"remitterid\": \"" . $o1->merchantUserID . "\",\"mobile\":\"" . $o1->mobileNo . "\",\"otp\":\"" . $o1->PIN_user . "\",\"outletid\":" . $o11->security_key . "}}",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: 19b24633-ef91-4632-8b49-9ff4de6bf91b",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        $data['error'] = "0";
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_ben_verify($o1, $o2, $o3) {
    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/imps/account_validate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\":\"" . $o11->api_key . "\",\"request\": {\"remittermobile\": \"" . $o1->mobileNo . "\",\"account\":\"" . $o2->account . "\",\"ifsc\":\"" . $o2->ifsc . "\",\"agentid\":\"" . $o3->ref_number . "\" , \"outletid\":" . $o11->security_key . "}}",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: 19b24633-ef91-4632-8b49-9ff4de6bf91b",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);
        $data['error'] = "0";
        $data['response'] = $response;
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_send_money($o1, $o2, $o3) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {

        $url = $o11->api_domain . "/ws/dmi/transfer{\"token\": \"" . urlencode($o11->api_key) . "\",\"request\": {\"remittermobile\": \"" . $o2->mobileNo . "\",\"beneficiaryid\": \"" . $o3->beneficiary_ID . "\",\"agentid\": \"" . $o1->ref_number . "\",\"amount\": \"" . $o1->total_amount . "\",\"mode\": \"" . $o3->ifscType . "\"}}\r\n";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/transfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\": \"" . urlencode($o11->api_key) . "\",\"request\": {\"remittermobile\": \"" . $o2->mobileNo . "\",\"beneficiaryid\": \"" . $o3->beneficiary_ID . "\",\"agentid\": \"" . $o1->ref_number . "\",\"amount\": \"" . $o1->total_amount . "\",\"mode\": \"" . $o3->ifscType . "\"}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: bc57e61a-f590-2a05-9675-87da1de41758",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($response);

        $json = json_encode($xml);

        $data = json_decode($json, TRUE);
        $data['error'] = "0";
        $data['response'] = $response;
        $data['url'] = $url;
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_add_beneficiary($o1, $o2) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/beneficiary_register",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"token\"\t\t\t: \"" . $o11->api_key . "\",\n\t\"request\"\t\t: \n\t{\n\t\t\"remitterid\"\t: \"" . $o2->merchantUserID . "\",\n\t\t\"name\"\t\t\t: \"" . $o1->beneficiaryName . "\",\n\t\t\"mobile\"\t\t: \"" . $o1->mobileNo . "\",\n\t\t\"ifsc\"\t\t\t: \"" . $o1->ifscCode . "\",\n\t\t\"account\"\t\t: \"" . $o1->accountNo . "\"\n\t\t,\"outletid\":" . $o11->security_key . "\n\t}\n}",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: ea030139-aa6b-4a70-a533-5522cef513c8",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $data['error'] = "0";
        $data['response'] = $response;
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_del_ben_otp($o1, $o2) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/beneficiary_remove",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\": \"" . urlencode($o11->api_key) . "\",\"request\": {\"beneficiaryid\": \"" . $o2->beneficiary_ID . "\",\"remitterid\":\"" . $o1->merchantUserID . "\",\"outletid\": \"" . $o11->security_key . "\"}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: ea030139-aa6b-4a70-a533-5522cef513c8",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $data['error'] = "0";
        $data['response'] = $response;
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//################################################################
//start ipay oulet Registration
//################################################################
function ipay_del_ben($o1, $o2) {

    $o11 = new stdClass();
    $factory = new TypeFactory($dbName);
    $updater = new TypeUpdater($dbName);
    $o11 = $factory->get_object("8", "api", "api_id");
    if ($o11->is_active == 1) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $o11->api_domain . "/ws/dmi/beneficiary_remove_validate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"token\": \"" . urlencode($o11->api_key) . "\",\"request\": {\"beneficiaryid\": \"" . $o2->beneficiary_ID . "\",\"remitterid\":\"" . $o1->merchantUserID . "\",\"otp\":\"" . $o2->otp . "\",\"outletid\": \"" . $o11->security_key . "\"}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Postman-Token: ea030139-aa6b-4a70-a533-5522cef513c8",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $data['error'] = "0";
        $data['response'] = $response;
    } else {
        $data['error_msg'] = "We are Updating. Please Wait";
        $data['error'] = "1";
    }
    return $data;
}

//################################################################
//start ipay oulet Registration
//################################################################
//Start of function to check recharge status
//################################################################
function ipay_recharge_status($status) {
    if ($status == "Transaction Successful") {
        $rstatus = "Success";
    } else if ($status == "Transaction Under Process") {
        $rstatus = "Pending";
    } else if ($status == "Request Parameters are Invalid or Incomplete") {
        $rstatus = "Failed";
    } else if ($status == "User Access Denied") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Dealer Credentials") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Access Token") {
        $rstatus = "Failed";
    } else if ($status == "Dealer Account Blocked, Contact Helpdesk") {
        $rstatus = "Failed";
    } else if ($status == "Insufficient Dealer Balance") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Service Provider") {
        $rstatus = "Failed";
    } else if ($status == "Duplicate Dealer Transaction ID") {
        $rstatus = "Failed";
    } else if ($status == "Duplicate Transaction, Try after 15 Minutes") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Account Number") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Refill Amount") {
        $rstatus = "Failed";
    } else if ($status == "Denomination Temporarily Barred") {
        $rstatus = "Failed";
    } else if ($status == "Refill Barred Temporarily, Contact Service Provider") {
        $rstatus = "Failed";
    } else if ($status == "Service Provider Error, Try1 Later") {
        $rstatus = "Failed";
    } else if ($status == "Unknown Error Description, Contact Helpdesk ") {
        $rstatus = "Failed";
    } else if ($status == "Service Provider Downtime") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Error Code") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Response Type") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Transaction ID") {
        $rstatus = "Failed";
    } else if ($status == "Transaction Status Unavailable, Try Again") {
        $rstatus = "Failed";
    } else if ($status == "Internal Processing Error, Try Later") {
        $rstatus = "Failed";
    } else if ($status == "System Error, Try Later") {
        $rstatus = "Failed";
    } else if ($status == "Transaction Refund Processed, Wallet Credited") {
        $rstatus = "Failed";
    } else if ($status == "Outlet Unauthorized or Inactive") {
        $rstatus = "Failed";
    } else if ($status == "Outlet Data Incorrect") {
        $rstatus = "Failed";
    } else if ($status == "Transaction Dispute Error,Contact Helpdesk") {
        $rstatus = "Failed";
    } else if ($status == "Dispute Logged Successfully") {
        $rstatus = "Failed";
    } else if ($status == "Remitter Not Found") {
        $rstatus = "Failed";
    } else if ($status == "Remitter Already Registered") {
        $rstatus = "Failed";
    } else if ($status == "Invalid Verification Code or OTP") {
        $rstatus = "Failed";
    } else if ($status == "Invalid User Account") {
        $rstatus = "Failed";
    } else if ($status == "Service not Available") {
        $rstatus = "Failed";
    } else if ($status == "Unknown Error") {
        $rstatus = "Failed";
    } else if ($status == "Failure at Bank end") {
        $rstatus = "Failed";
    } else if ($status == "Transaction Refund Processed,Wallet Credited") {
        $rstatus = "Failed";
    } else if ($status == "Provider Error") {
        $rstatus = "Failed";
    } else if ($status == "Fare Has Changed") {
        $rstatus = "Failed";
    } else if ($status == "Insufficient Wallet Balance") {
        $rstatus = "Failed";
    } else {
        $rstatus = "Pending";
    }

    return $rstatus;
}

//################################################################
//End of function to check recharge status
//################################################################
//################################################################
//Start of function to userServices
//################################################################

function check_userServices($service_type, $o) {
    $sql_service = "Select * from services where service_name='" . $service_type . "' ";
    $res_serivce = getXbyY($sql_service);
    $row_service = count($res_serivce);

    if ($row_service > 0) {
        if ($res_serivce[0]['is_active'] == '1') {

            $sql_checkservice = "select * from user_services where user_id='" . $o->user_id . "' and service_name='".$service_type."' and is_active='1' and status='Yes' ";
            $res_checkservice = getXbyY($sql_checkservice);
            $row_checkservice = count($res_checkservice);

            if ($row_checkservice > 0) {
                $result['error']="1";
            } else {
                $result['error'] = 0;
            }
        } else {
            $result['error'] = 0;
        }
    } else {
        $result['error'] = 0;
    }

    return $result;
}

//################################################################
//End of function to userServices
//################################################################
?>
