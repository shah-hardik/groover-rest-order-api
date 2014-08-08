<?php

/**
 * File to sync the system manually
 * 
 * @since August 6, 2014
 * @authr Hardik Shah <hardiks059@gmail.com>
 * 
 */
d("Starting Manual Sync");

$api = new apiZazzle();
$api->importOrders();
$api->ListOrderMessages();


d("Manual Sync completed");
die;


