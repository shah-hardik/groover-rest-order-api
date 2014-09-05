<?php


$urlArgs = _cg("url_vars");


if($_REQUEST['getack'] == 1)
{
   $order_id = $_REQUEST['id']; 
//   $orderslist = q("select * from orders where order_id = '{$id}' AND archive = '1' order by order_date DESC");
//    include _PATH . "instance/front/tpl/new_ack_data.php";
   
   $zazzle = new apiZazzle();
   $zazzle->ackOrder($order_id);
   
  die;
 
}

$orderslist = q("select * from orders where archive = '1' order by order_date DESC");

$jsInclude = "ack.js.php";
_cg("page_title", "Ack");
?>