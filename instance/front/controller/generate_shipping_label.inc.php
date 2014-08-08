<?php

$order_id = $_REQUEST['order_id'];
$api = new apiZazzle();
$url = $api->generateLabel($order_id);

_R($url);
die;
