<?php

/**
 * File to sync the system manually
 * 
 * @since August 6, 2014
 * @authr Hardik Shah <hardiks059@gmail.com>
 * 
 */
d("Starting Manual Sync");
_errors_on();

$api = new apiZazzle();
$api->importOrders();

//$api_message = new apiZazzle();
//$api_message->ListOrderMessages();


d("Manual Sync completed");
die;


