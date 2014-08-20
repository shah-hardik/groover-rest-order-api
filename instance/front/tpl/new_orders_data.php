<?php foreach ($orders as $each_order): ?>
    <tr id="row_<?php print $each_order['order_id']; ?>">
        <td><input type="checkbox" class="chkAll" value="<?php print $each_order['order_id'] ?>" /></td>
        <td><?php print date("d/m/Y", strtotime($each_order['order_date'])) ?></td>
        <td><?php print $each_order['order_id'] ?></td>
        <td>
            <strong><?php print $each_order['Name'] ?></strong> <br /><br />
            <?php print $each_order['Address1'] ?> <br />
            <?php print $each_order['Address2'] ?> <br />
            <?php print $each_order['City'] ?>, <?php print $each_order['State'] ?>, <?php print $each_order['Zip'] ?> <br />
            <?php print $each_order['Country'] ?> <br />
            <?php print $each_order['Phone'] ?> <br />
            <?php print $each_order['Email'] ?> <br />
        </td>
        <td>
            <?php $items = getOrderItems($each_order['order_id']); ?>
            <table class="table table-no-hover table-bordered table-condensed ">
                <?php foreach ($items as $each_item): ?>
                    <tr>
                        <td>
                            <?php $previews = q("select * from order_print_files where order_id = '{$each_order['order_id']}' AND line_item_id = '{$each_item['LineItemId']}' AND file_type = 'preview' "); ?>
                            <?php foreach ($previews as $each_preview): ?>
                                <div class="">
                                    <div style="text-align:center;font-size:9px;margin-bottom:10px;border-bottom:1px dotted #DADADA"><?php print strtoupper($each_preview['file_description']) ?> </div>
                                    <div style="text-align: center"><img src='<?php print $each_preview['file_url']        ?>' width="100" /></div>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>
                                                                            <div><!--<?php print $each_item['LineItemId'] ?></div>
                                                                            <div><?php print $each_item['Description'] ?></div>
                                                                            <div><?php print $each_item['Quantity'] ?>--></div>
                            <div style="border-bottom:1px dotted #DADADA;margin-bottom:20px;padding-bottom:10px;">
                                <div><strong>Item ID:</strong> <?php print $each_item['LineItemId'] ?></div>
                                <div><strong>Description:</strong> <?php print $each_item['Description'] ?></div>
                                <div><strong>Quantity:</strong> <?php print $each_item['Quantity'] ?></div>
                            </div>
                            <div style="">
                                <?php $previews = q("select * from order_print_files where order_id = '{$each_order['order_id']}' AND line_item_id = '{$each_item['LineItemId']}' AND file_type = 'print' "); ?>
                                <?php foreach ($previews as $each_preview): ?>
                                    <div style="margin-bottom:5px">
                                        <a class="label label-warning" style="cursor:pointer;font-size:10px;" target='_blank' href='<?php print $each_preview['file_url'] ?>'><i class="fa fa-download">&nbsp;</i><?php print ucwords($each_preview['file_description']) ?> Artwork Download</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </td>
        <td>
            <?php $packing_sheets = q("select * from order_print_files where order_id = '{$each_order['order_id']}' and file_type = 'packingSheet' "); ?>
            <?php foreach ($packing_sheets as $each_packing): ?>
                <div style="cursor:pointer;clear:both;margin-bottom:7px" onclick="window.open('<?php print $each_packing['file_url'] ?>');" class=""><i class="fa fa-print">&nbsp;</i> Sheet - <?php print $each_packing['file_description'] ?></div>
            <?php endforeach; ?>
        </td>
        <td>
            <div class="row">
                <div class="col-lg-9">
                    <input class="form-control " type="text"  placeholder="Weight" id="weight_<?php print $each_order['id'] ?>" value="<?php print $each_order['weight'] ? $each_order['weight'] : "0.1"  ?>" />
                </div>
            </div>
            <button style="margin-top:4px" class="btn btn-success btn-small" type="button" value="Save" onclick="saveWeight(<?php print $each_order['id'] ?>);" > Save </button>
        </td>
        <td>
            <a class="label label-default" target='_blank' href="<?php print _U ?>generate_shipping_label?type=Label&order_id=<?php print $each_order['order_id'] ?>" style="cursor:pointer;font-size:10px;"><i class="fa fa-print">&nbsp;</i>Print Shipping Label</a> <br /><br />
            <?php if ($each_order['CountryCode'] != 'us'): ?>
                <a class="label label-default" target='_blank' href="<?php print _U ?>generate_shipping_label?type=CommercialInvoice&order_id=<?php print $each_order['order_id'] ?>" style="cursor:pointer;font-size:10px;"><i class="fa fa-print">&nbsp;</i>Print Commercial Invoice</a>
            <?php endif; ?>
        </td>
        <td>
            <?php $messages = q("select * from order_messages where order_id = '{$each_order['order_id']}' order by message_date desc "); ?>
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $each_message): ?>
                    <div style='magin:3px 0px;border-bottom:1px dotted #ECECEC'><?php print $each_message['message'] ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <span style="color:red;font-size:small;"></span>
            <?php endif; ?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <?php $cr++; ?>    
<?php endforeach; ?>