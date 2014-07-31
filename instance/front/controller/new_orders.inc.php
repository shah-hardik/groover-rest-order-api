<?php


$urlArgs = _cg("url_vars");

//$api = new apiZazzle();
//$api->importOrders();
//die;

$orders = q("select * from orders ");

//d($orders);
$jsInclude = "orders.js.php";
_cg("page_title", "New Orders");
?>