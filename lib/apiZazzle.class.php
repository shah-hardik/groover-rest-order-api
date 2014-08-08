<?php

/**
 *  Zazzle API Client
 *  
 *  // https://vendor.zazzle.com/v100/api.aspx?method=listneworders&vendorid=hanson&hash=6454defaaf54a5da925fdbdb7419bd57
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
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

    /**
     * ackcall Call definition
     * https://vendor.zazzle.com/v100/api.aspx?method=ackorder&vendorid=myvendorid&orderid=143123456123456&hash=9a7cb40c3f3ba8c9b42a73ad1969b37a
     */
    public function ackOrder($order_id, $type = 'new') {
        $this->params['method'] = 'ackorder';
        $this->params['orderid'] = $order_id;
        $this->params['type'] = $type;
        $this->params['action'] = 'accept';
        $this->params['hash'] = md5($this->vendorid . $order_id . 'new' . $this->secret);

        $content = $this->doCall($this->prepareApiUrl());
    }

    public function ListOrderMessages() {
        $this->params['method'] = 'listordermessages';
        $content = $this->doCall($this->prepareApiUrl());
        $xmlData = simplexml_load_string($content);

        $messages = $xmlData->xpath("//Response/Result/Messages/Message");
        foreach ($messages as $each_message) {
            $insert_data = array();
            $insert_data['order_id'] = $each_message->OrderId;
            $insert_data['message'] = $each_message->Text;
            $insert_data['message_date'] = $each_message->MessageDate;
            qi("order_messages", $insert_data);
            $this->ackOrder($each_message->OrderId, 'message');
        }
    }

    public function importOrders() {
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

            $orderDataArray = array(
                'order_id' => $orderId,
                'order_date' => $orderDate,
                'packing_sheet_url' => $each_order->PackingSheet->Page->Front->Url,
                'Address1' => $each_order->ShippingAddress->Address1,
                'Address2' => $each_order->ShippingAddress->Address2,
                'Address3' => $each_order->ShippingAddress->Address3,
                'Name' => $each_order->ShippingAddress->Name,
                'Name2' => $each_order->ShippingAddress->Name2,
                'City' => $each_order->ShippingAddress->City,
                'State' => $each_order->ShippingAddress->State,
                'Country' => $each_order->ShippingAddress->Country,
                'CountryCode' => $each_order->ShippingAddress->CountryCode,
                'Zip' => $each_order->ShippingAddress->Zip,
                'Email' => $each_order->ShippingAddress->Email,
                'Type' => $each_order->ShippingAddress->Type
            );

            $this->ackOrder($orderId);

            $orderExists = qs("select order_id from orders where order_id = '{$orderId}' ");
            if (empty($orderExists)) {
                $orderId = qi("orders", $orderDataArray);
            } else {
                qu("orders", $orderDataArray, " order_id = '{$orderId}' ");
            }

            $lineItems = $each_order->LineItems->LineItem;

            foreach ($lineItems as $each_item) {
                $itemData = array(
                    'LineItemId' => $each_item->LineItemId,
                    'OrderId' => $each_item->OrderId,
                    'LineItemType' => $each_item->LineItemType,
                    'Quantity' => $each_item->Quantity,
                    'Description' => $each_item->Description,
                    'Attributes' => $each_item->Attributes,
                    'Price' => $each_item->Price,
                    'ProductId' => $each_item->ProductId,
                    'PrintFiles' => $each_item->PrintFiles->PrintFile->Url,
                    'Previews' => $each_item->Previews->PreviewFile->Url
                );

                $itemExists = qs("select LineItemId from order_items where LineItemId = '{$itemData['LineItemId']}' ");
                if (!empty($itemExists)) {
                    qu("order_items", $itemData, " LineItemId = '{$itemData['LineItemId']}' ");
                } else {
                    qi("order_items", $itemData);
                }
            }
        }

        die;
    }

    /**
     * https://vendor.zazzle.com/v100/api.aspx?
     * method=getshippinglabel&
     * vendorid=myvendorid&
     * orderid=143123456123456&
     * weight=0.7&
     * format=ZPL&
     * hash=9a7cb40c3f3ba8c9b42a73ad1969b37a
     * 
     * MD5 (Vendor ID+orderid+weight+format+Secret Key)
     */
    public function generateLabel($order_id) {
        $orderData = qs("select * from  orders where order_id = '{$order_id}' ");
        $weight = $orderData['weight'];

        $weight = $weight ? $weight : '0.1';

        $this->params['method'] = 'getshippinglabel';
        $this->params['orderid'] = $order_id;
        $this->params['format'] = 'PDF';
        $this->params['weight'] = $weight;
        $this->params['hash'] = md5($this->vendorid . $order_id . $weight . "PDF" . $this->secret);

        $content = $this->doCall($this->prepareApiUrl());



        $xmlData = simplexml_load_string($content);
        $labelData = $xmlData->xpath("//Response/Result/ShippingInfo/ShippingDocuments/ShippingDocument");

        foreach ($labelData as $value) {
            $url = $value->Url;
        }

        return $url;
    }

}
