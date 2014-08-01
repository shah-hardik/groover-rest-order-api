<?php


$urlArgs = _cg("url_vars");

//$api = new apiZazzle();
//$api->importOrders();
//die;

$orders = q("select * from orders ");

if($_REQUEST['generate'] == 1){
    $id = $_REQUEST['val'];
    $value = $_REQUEST['label'];
    
   qu('orders', array(
                    'shipping' => _escape($value)
                        ), " id = '{$id}'");
    
}
if ($_REQUEST['customFilter']) {
    
    $todate = _escape(date('Y-m-d',strtotime($_REQUEST['to_date_val'])));
    $fromdate = _escape(date('Y-m-d',strtotime($_REQUEST['from_date_val'])));
   
    
    $orders = q("select * from orders where date(order_date) >= '{$fromdate}' AND date(order_date) <= '{$todate}'");

    include _PATH . "instance/front/tpl/new_orders_data.php";
    die;
}

//d($orders);
$jsInclude = "orders.js.php";
_cg("page_title", "New Orders");
?>