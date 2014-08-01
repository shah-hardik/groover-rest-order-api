<?php


$urlArgs = _cg("url_vars");

//$api = new apiZazzle();
//$api->importOrders();
//die;

$orders = q("select * from orders ");

if ($_REQUEST['customFilter']) {
    
    $todate = _escape(date('Y-m-d',strtotime($_REQUEST['to_date_val'])));
    $fromdate = _escape(date('Y-m-d',strtotime($_REQUEST['from_date_val'])));
   
    
    $orders = q("select * from orders where order_date BETWEEN '{$fromdate}' AND '{$todate}' ");

    include _PATH . "instance/front/tpl/new_orders_data.php";
    die;
}

//d($orders);
$jsInclude = "orders.js.php";
_cg("page_title", "New Orders");
?>