<?php

/**
 * Can you please re-arrange the table columns to be in this order:
  Order Date, Order ID, Ship To, Order Items, Artwork, Packing Sheet, Weight, Shipping Label, Messages, Updates.
 */
$urlArgs = _cg("url_vars");
$orders = q("select * from orders where archive = '1' order by order_date DESC LIMIT 0,10");

if ($_REQUEST['removeArchive'] == 1) {
    $order_ids = "'" . implode("','", $_REQUEST['orderIds']) . "'";
    $query = "update orders set archive = '0' where order_id in ({$order_ids}) ";
    q($query);
    die("Good");
}

#Get Next Pre data
if ($_REQUEST['Nextrecord']) {
    $limit = $_REQUEST['Limit'];
  $orders = q("select * from orders where archive = '1' order by order_date DESC LIMIT {$limit},10");

    include _PATH . "instance/front/tpl/new_orders_data.php";

    die;
}
#Count data in database
$data = q("select * from orders where archive = '1' order by order_date DESC");
$length = Order::GetdataFromdb($data);



//d($orders);
$jsInclude = "orders.js.php";
_cg("page_title", "Archived Orders");
?>