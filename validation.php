<?php
require("db.php");
require("email_validation.php");

$validator = new email_validation_class;
if (!function_exists("GetMXRR")) {
    $_NAMESERVERS = array();
    include("getmxrr.php");
}

$validator->timeout = 10;
$validator->data_timeout = 0;
$validator->localuser = "info";
$validator->localhost = "relation.net";
$validator->debug = 0;
$validator->html_debug = 0;
$validator->exclude_address = "";

/* preparing data */

$mails = $_POST['mails'];

$ids = '';
$bad_ids = '';
$mail_array = array();
$re = "/^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$/Ui";
foreach ($mails as &$item) {
    $email = $item;
    $item = array(
        'email' => $email,
        'valid' => false,
    );
    if (preg_match($re, $item['email'])) {
        $item['valid'] = true;
    } else {

    }
}

foreach ($mails as &$email) {
    if ($email['valid'] == false) {
        continue;
    }

    $result = $validator->ValidateEmailBox($email['email']);
    if ($result == 0) {
        $result = -2;
    }
}
