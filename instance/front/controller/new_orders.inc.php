<?php

$urlArgs = _cg("url_vars");

//$api = new apiZazzle();
//$api->getOrders();


$orders = q("select * from orders ");


$jsInclude = "new_orders.js.php";
_cg("page_title", "New Orders");
?>