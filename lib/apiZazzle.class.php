<?php

/**
 *  Zazzle API Client
 *  
 *  // https://vendor.zazzle.com/v100/api.aspx?method=listneworders&vendorid=hanson&hash=6454defaaf54a5da925fdbdb7419bd57
 * 
 * @author Dave Jay<dave.jay90@gmail.com>
 * @since July 23, 2014
 * @version 1.0
 * 
 * 
 */
class apiZazzle extends apiCore {

    public $apiEndpoint = 'api.aspx';
    public $apiURL = 'https://vendor.zazzle.com/v100/';
    public $vendorid = 'hanson';
    public $secret = '3f9bf3904b4e6609d46ff6964d8193ac';
    public $params = array();

    public function __construct() {
        $this->params['vendorid'] = $this->vendorid;
        $this->params['hash'] = md5($this->vendorid . $this->secret);
    }

    public function getOrders() {
        $this->params['method'] = 'listneworders';

        if (!$_SESSION['payload']) {
            $_SESSION['payload'] = $content = $this->doCall($this->prepareApiUrl());
        }
        $content = $_SESSION['payload'];
        $xmlData = simplexml_load_string($content);

        $orders = $xmlData->xpath("//Response/Result/Orders/Order");

        foreach ($orders as $each_order) {
            $orderId = $each_order->OrderId;
            $orderDate = date('Y-m-d H:i:s', strtotime($each_order->OrderDate));
            qi("orders", array('order_id' => $orderId, 'order_date' => $orderDate));
        }
        print "D";
        die;
    }

}
