<?php

$order_id = $_REQUEST['order_id'];
$api = new apiZazzle();
$url = $api->generateLabel($order_id, $_REQUEST['type']);
if ($url) {
    _R($url);
    die;
}
else{
    print "No {$_REQUEST['type']} Available From Zazzle";
}
die;
