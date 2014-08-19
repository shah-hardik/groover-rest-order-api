<?php

/**
 * Can you please re-arrange the table columns to be in this order:
  Order Date, Order ID, Ship To, Order Items, Artwork, Packing Sheet, Weight, Shipping Label, Messages, Updates.
 */
$urlArgs = _cg("url_vars");
$orders = q("select * from orders order by order_date DESC ");

if ($_REQUEST['newOrders'] == 1) {
    $api = new apiZazzle();
    $api->importOrders();
    die("Good");
}
if ($_REQUEST['generate'] == 1) {
    $id = $_REQUEST['id'];
    $value = $_REQUEST['val'];

    qu('orders', array(
        'weight' => _escape($value)
            ), " id = '{$id}'");
    die;
}
if ($_REQUEST['customFilter']) {

    $todate = _escape(date('Y-m-d', strtotime($_REQUEST['to_date_val'])));
    $fromdate = _escape(date('Y-m-d', strtotime($_REQUEST['from_date_val'])));


    $orders = q("select * from orders where date(order_date) >= '{$fromdate}' AND date(order_date) <= '{$todate}'");

    include _PATH . "instance/front/tpl/new_orders_data.php";
    die;
}

//d($orders);
$jsInclude = "orders.js.php";
_cg("page_title", "New Orders");
?>