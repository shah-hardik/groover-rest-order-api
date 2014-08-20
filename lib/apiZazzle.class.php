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
    public $vendorid = 'groverallman';
    public $secret = '7648b70dac74f090a990451dcfc39a98';
    public $vendorid_dev = 'hanson';
    public $secret_dev = '3f9bf3904b4e6609d46ff6964d8193ac';
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

        //$content = $this->doCall($this->prepareApiUrl());
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

        d($orders);
        die;

        foreach ($orders as $each_order) {

            $order_id = $orderId = $each_order->OrderId;
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
                qu("orders", $orderDataArray, " id = '{$orderExists['id']}' ");
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
//                    'PrintFiles' => $each_item->PrintFiles->PrintFile->Url,
//                    'Previews' => $each_item->Previews->PreviewFile->Url
                );

                $printFiles = ((array) $each_item->PrintFiles->xpath('PrintFile'));
                $previewFiles = (array) $each_item->Previews->xpath('PreviewFile');
                $packingSheets = (array) $each_order->PackingSheet->xpath('Page');


                foreach ($printFiles as $each_file) {
                    $query = "select * from order_print_files where order_id = '{$order_id}' and line_item_id = '{$each_item->LineItemId}' AND file_type = 'print' AND file_description = '{$each_file->Description}' ";
                    $print_file_data = qs($query);

                    $print_file_db_data = array();
                    $print_file_db_data['file_description'] = $each_file->Description;
                    $print_file_db_data['file_url'] = $each_file->Url;
                    $print_file_db_data['file_type'] = 'print';
                    $print_file_db_data['order_id'] = $order_id;
                    $print_file_db_data['line_item_id'] = $each_item->LineItemId;

                    //d($print_file_db_data);

                    if (empty($print_file_data)) {
                        qi('order_print_files', $print_file_db_data);
                    } else {
                        qu('order_print_files', $print_file_db_data, " id =  '{$print_file_data['id']}'  ");
                    }
                }


                foreach ($previewFiles as $each_file) {
                    $query = "select * from order_print_files where order_id = '{$order_id}' and line_item_id = '{$each_item->LineItemId}' AND file_type = 'preview' AND file_description = '{$each_file->Description}' ";
                    $preview_file_data = qs($query);

                    $preview_file_db_data = array();
                    $preview_file_db_data['file_description'] = $each_file->Description;
                    $preview_file_db_data['file_url'] = $each_file->Url;
                    $preview_file_db_data['file_type'] = 'preview';
                    $preview_file_db_data['order_id'] = $order_id;
                    $preview_file_db_data['line_item_id'] = $each_item->LineItemId;

                    if (empty($preview_file_data)) {
                        qi('order_print_files', $preview_file_db_data);
                    } else {
                        qu('order_print_files', $preview_file_db_data, " id =  '{$preview_file_data['id']}'  ");
                    }
                }

                foreach ($packingSheets as $each_file) {
                    $query = "select * from order_print_files where order_id = '{$order_id}' AND file_type = 'packingSheet' AND file_description = '{$each_file->PageNumber}' ";
                    $packing_file_data = qs($query);

                    $packing_file_db_data = array();
                    $packing_file_db_data['file_description'] = $each_file->PageNumber;
                    $packing_file_db_data['file_url'] = $each_file->Url;
                    $packing_file_db_data['file_type'] = 'packingSheet';
                    $packing_file_db_data['order_id'] = $order_id;

                    if (empty($packing_file_data)) {
                        qi('order_print_files', $packing_file_db_data);
                    } else {
                        qu('order_print_files', $packing_file_db_data, " id =  '{$packing_file_data['id']}'  ");
                    }
                }

                $itemExists = qs("select LineItemId from order_items where LineItemId = '{$itemData['LineItemId']}' ");
                if (!empty($itemExists)) {
                    qu("order_items", $itemData, " LineItemId = '{$itemExists['id']}' ");
                } else {
                    qi("order_items", $itemData);
                }
            }
        }
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
    public function generateLabel($order_id, $type = 'Label') {
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

        $url = "";
        foreach ($labelData as $value) {
            if ($value->Type == $type) {
                $url = $value->Url;
            }
        }

        return $url;
    }

}
