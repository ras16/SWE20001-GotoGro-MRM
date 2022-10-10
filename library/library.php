<?php
// ================================
// CONFIGURATION START
// ================================
define('PATH__ROOT', '../../');
define('PATH__IMAGES', '../../images/');
define('PATH__AJAX', './includes/ajax/');
define('PATH__PAGES', './includes/pages/');
define('PATH__THEMES', '/includes/themes/');
define('PATH__JS', '../themes/js/');

define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'gotogro_mrm');
define('USE_PCONNECT', 'false');
define('STORE_SESSIONS', 'mysql');
define('DB_CHARSET', "utf8mb4"); // utf8
define('DB_TIMEZONE', "SET time_zone = '+8:00'");
define('DB_TIMEZONE_COUNTRY', "Asia/Kuala_Lumpur");

define('ROBOT', '');

define('SECURITY_CODE', 'WE ARE THE BEST');
define("CIPHER_METHOD", "AES-256-CBC");
// Encryption and Decryption Key
define("KEY", "WE ARE THE BEST AGAIN 666");
// ================================
// CONFIGURATION END
// ================================

// =============================================================

// ================================
// DATABASE START
// ================================
function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link')
{
    global $$link;
    if (USE_PCONNECT == 'true') {
        $server = 'p:' . $server;
    }
    $$link = mysqli_connect($server, $username, $password, $database);
    if (!mysqli_connect_errno()) {
        mysqli_set_charset($$link, 'utf8');
    }
    @mysqli_query($$link, 'set session sql_mode=""');
    return $$link;
}
function tep_db_close($link = 'db_link')
{
    global $$link;
    return mysqli_close($$link);
}
function tep_query($query, $link = 'db_link')
{
    global $$link;
    $result = mysqli_query($$link, $query);
    return $result;
}
function tep_fetch_object($db_query)
{
    return mysqli_fetch_object($db_query);
}
function tep_fetch_array($db_query)
{
    return mysqli_fetch_array($db_query, MYSQLI_ASSOC);
}
function tep_num_rows($db_query)
{
    return mysqli_num_rows($db_query);
}
function tep_data_seek($db_query, $row_number)
{
    return mysqli_data_seek($db_query, $row_number);
}
function tep_insert_id($link = 'db_link')
{
    global $$link;
    return mysqli_insert_id($$link);
}
function tep_free_result($db_query)
{
    return mysqli_free_result($db_query);
}
function tep_fetch_fields($db_query)
{
    return mysqli_fetch_field($db_query);
}
function tep_output($string)
{
    return htmlspecialchars($string);
}
function tep_input($string, $link = 'db_link')
{
    global $$link;
    return mysqli_real_escape_string($$link, $string);
}
function tep_affected_rows($link = 'db_link')
{
    global $$link;
    return mysqli_affected_rows($$link);
}
function tep_get_server_info($link = 'db_link')
{
    global $$link;
    return mysqli_get_server_info($$link);
}
// ================================
// DATABASE END
// ================================

// =============================================================

// ================================
// GENERAL START
// ================================
function redirect($url, $parameters = '')
{
    header("Location: $url$parameters");
}
function alert($string)
{
    return "<script>alert('" . $string . "')</script>";
}
function script($string)
{
    return "<script>" . $string . "</script>";
}
function createToken($value)
{
    return md5(SECURITY_CODE . $value);
}

function encrypt($string)
{
    // This function encrypts the data passed into it and returns the cipher data with the IV embedded within it.
    // The initialization vector (IV) is appended to the cipher data with 
    // the use of two colons serve to delimited between the two.
    $encryptionKey = base64_decode(KEY);
    $initializationVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length(CIPHER_METHOD));
    $encryptedText = openssl_encrypt($string, CIPHER_METHOD, $encryptionKey, 0, $initializationVector);
    return base64_encode($encryptedText . '::' . $initializationVector);
}

function decrypt($string)
{
    // This function decrypts the cipher data (with the IV embedded within) passed into it 
    // and returns the clear text (unencrypted) data.
    // The initialization vector (IV) is appended to the cipher data by the EncryptThis function (see above).
    // There are two colons that serve to delimited between the cipher data and the IV.
    $encryptionKey = base64_decode(KEY);
    list($encrypted_Data, $initializationVector) = array_pad(explode('::', base64_decode($string), 2), 2, null);
    return openssl_decrypt($encrypted_Data, CIPHER_METHOD, $encryptionKey, 0, $initializationVector);
}

function dateToSql($value)
{
    if ($value == "" || $value == "00-00-0000") {
        $result = "0000-00-00 00:00:00";
    } else {
        $result = date("Y-m-d", strtotime($value));
    }
    return $result;
}
function dateFromSql($value, $time = '')
{
    if ($value == "" || $value == "0000-00-00" || $value == "1970-01-01" || $value == "0000-00-00 00:00:00" || $value == "1970-01-01 00:00:00") {
        $result = "-";
    } else {
        if ($time == 'TIME') {
            $result = date("d.m.Y H:i:s", strtotime($value));
        } else {
            $result = date("d.m.Y", strtotime($value));
        }
    }
    return $result;
}
function timeTo24Hours($value)
{
    $new_time = DateTime::createFromFormat('h:i A', $value);
    return $new_time->format('H:i:s');
}
function msgHighlight($stat, $moduleTitle, $fadeOut = '')
{
    switch ($stat) {
        case "created":
            $msgTitle = "New " . $moduleTitle . " Created!";
            $msgContent = "You may edit the " . $moduleTitle . " anytime in the future.";
            $msgHighlightBox = "success";
            break;
        case "duplicate":
            $msgTitle = "Duplicate " . $moduleTitle . " Found!";
            $msgContent = "There is a same " . $moduleTitle . " exist in the system.";
            $msgHighlightBox = "failed";
            break;
        case "duplicateonspotevent":
            $msgTitle = "Duplicate Lucky On The Spot events Found!";
            $msgContent = "There is a Lucky On The Spot event exist in the Campaign.";
            $msgHighlightBox = "failed";
            break;
        case "duplicateemail":
            $msgTitle = "Duplicate Email Found & Updated!";
            $msgContent = "There is a same email address exist in the system. The contact information has updated.";
            $msgHighlightBox = "success";
            break;
        case "duplicatephone":
            $msgTitle = "Duplicate Phone Found & Updated!";
            $msgContent = "There is a same phone number exist in the system. The contact information has updated.";
            $msgHighlightBox = "success";
            break;
        case "updated":
            $msgTitle = "" . $moduleTitle . " Updated!";
            $msgContent = "The " . $moduleTitle . " has successfully updated.";
            $msgHighlightBox = "success";
            break;
        case "deleted":
            $msgTitle = "" . $moduleTitle . " Deleted!";
            $msgContent = "The " . $moduleTitle . " has successfully deleted.";
            $msgHighlightBox = "success";
            break;
        case "nodefaultdelete":
            $msgTitle = "" . $moduleTitle . " cannot be Deleted!";
            $msgContent = "The default " . $moduleTitle . " cannot be deleted.";
            $msgHighlightBox = "failed";
            break;
        case "lastrecord":
            $msgTitle = "" . $moduleTitle . " cannot be Deleted!";
            $msgContent = "The last " . $moduleTitle . " cannot be deleted.";
            $msgHighlightBox = "failed";
            break;
        case "campaignbackdate":
            $msgTitle = "You can only create a " . $moduleTitle . " on Future Date!";
            $msgContent = "You cannot create a " . $moduleTitle . " on back date. It must be created for future date.";
            $msgHighlightBox = "failed";
            break;
        case "emailverifylink":
            $msgTitle = "New email verification link has resend!";
            $msgContent = "Every email should go through the proper email verification in order to send them the email peacefully.";
            $msgHighlightBox = "success";
            break;
        case "contactimported":
            $msgTitle = "Contact List has Successfully Imported!";
            $msgContent = "The contact list has successfully import into the group.";
            $msgHighlightBox = "success";
            break;
        case "contactimportedzero":
            $msgTitle = "No Contact has Imported!";
            $msgContent = "No contact has import into the group.";
            $msgHighlightBox = "failed";
            break;
        case "invalidpassword":
            $msgTitle = "You have entered an Invalid Password!";
            $msgContent = "The valid password is requires in order to perform the higher level action.";
            $msgHighlightBox = "failed";
            break;
        case "freepackagelimit":
            $msgTitle = $moduleTitle;
            $msgContent = "Upgrade your package to have more auto engagements. <a href=\"subscription\" style=\"color:#ffffff;text-decoration:underline;\">View Package</a>";
            $msgHighlightBox = "failed";
            break;
        case "brandsetup":
            $msgTitle = "Setup your company information and logo.";
            $msgContent = "Try to keep your brand name short and simple to make it easy to remember. <a href=\"organization-setting\" style=\"color:#ffffff;text-decoration:underline;\">Click here</a>";
            $msgHighlightBox = "failed";
            break;
        case "accountverify":
            $msgTitle = "Check your email to verify your account.";
            $msgContent = "Please verify your account from the email you received. <a href=\"index&accountverify=1\" style=\"color:#ffffff;text-decoration:underline;\">Click here to Resend</a>";
            $msgHighlightBox = "failed";
            break;
        case "really365birthday_toomany":
            $msgTitle = "Birthday greetings like a spam.";
            $msgContent = "You have multiple birthday greetings in different sending 'day'. Your memberss will receive too many email and the possibility they mark your email as spam is high.";
            $msgHighlightBox = "failed";
            break;
        case "incomplete_form":
            $msgTitle = "No data is inserted into the system.";
            $msgContent = "Please check again the form input.";
            $msgHighlightBox = "failed";
            break;
    }
    switch ($msgHighlightBox) {
        case "success":
            $result = '<div id="alert" class="alert alert-block alert-success">
              <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading"><i class="fa fa-check-square"></i> ' . $msgTitle . '</h4>
              <p>' . $msgContent . '</p>
            </div>';
            if ($fadeOut != "NO") {
                $result .= '<script>
                window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
                }, 4000);
                </script>';
            }
            break;
        case "failed":
            $result = '<div id="alert" class="alert alert-block alert-danger">
              <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading"><i class="fa fa-exclamation-circle"></i> ' . $msgTitle . '</h4>
              <p>' . $msgContent . '</p>
            </div>';
            if ($fadeOut != "NO") {
                $result .= '<script>
                window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
                }, 4000);
                </script>';
            }
            break;
    }
    return $result;
}
function forceLogout()
{
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 1000);
            setcookie($name, '', time() - 1000, '/');
        }
    }
}
// ================================
// GENERAL END
// ================================

// =============================================================

// ================================
// INITIATE START
// ================================
$conn = tep_db_connect();
mysqli_set_charset($conn, DB_CHARSET);
tep_query("SET time_zone = '+8:00'");
session_start();
// ================================
// INITIATE END
// ================================
?>