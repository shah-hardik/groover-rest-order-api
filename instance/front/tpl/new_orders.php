<?php //include "new_orders_filter.php";                       ?>
<div class="row">
    <div  class="col-md-12 col-lg-12 ">
        <button class="btn btn-success" onclick="doUpdateOrders()"><i class="fa fa-refresh">&nbsp;</i> Get New Orders</button>
        <button class="btn btn-warning"><i class="fa fa-random">&nbsp;</i> Check for Order Updates</button>
    </div>
</div>
<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div class="panel panel-default ">
    <div class="panel-heading col-md-12 col-lg-12">

        <div style="float:left;padding-top:8px"><b>List of New Orders</b></div> 
        <div style="float:right"></div> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <?php
        $cr = 1;
        if (!empty($orders)):
            ?>
            <table class="table table-hover" id="table" style="font-family:verdana;font-size:11px" >
                <thead>
                    <tr>
                        <th><input type="checkbox" onclick="doCheckAll(this.checked)"/></th>
                        <th>Order Date</th>
                        <th>Order ID</th>
                        <th>Ship To</th>
                        <th style="text-align: center">Order Items</th>
                        <th>Packing Sheet</th>
                        <th>Weight</th>
                        <th>Shipping Label</th>
                        <th>Messages</th>
                        <th>Updates</th>
                    </tr>
                </thead>
                <tbody id="orderlistId">
                    <?php foreach ($orders as $each_order): ?>
                        <tr id="<?php print $each_task['id']; ?>">
                            <td><input type="checkbox" class="chkAll" /></td>
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
                                <table class="table table-no-hover table-bordered table-condensed">
                                    <?php foreach ($items as $each_item): ?>
                                        <tr>
                                            <td>
                                                <?php $previews = q("select * from order_print_files where order_id = '{$each_order['order_id']}' AND file_type = 'preview' "); ?>
                                                <?php foreach ($previews as $each_preview): ?>
                                                    <div class="col-lg-2">
                                                        <div style="border-bottom:1px dotted #DADADA"><?php print strtoupper($each_preview['file_description']) ?> </div>
                                                        <div><img src='<?php print $each_preview['file_url'] ?>' width="100" /></div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
												<div><!--<?php print $each_item['LineItemId'] ?></div>
												<div><?php print $each_item['Description'] ?></div>
												<div><?php print $each_item['Quantity'] ?>--></div>
												<div><?php $previews = q("select * from order_print_files where order_id = '{$each_order['order_id']}' AND file_type = 'print' "); ?>
                                                <?php foreach ($previews as $each_preview): ?>
                                                    <div style="margin-bottom:5px">
                                                        <a class="label label-warning" style="cursor:pointer;font-size:10px;" target='_blank' href='<?php print $each_preview['file_url'] ?>'><i class="fa fa-download">&nbsp;</i><?php print ucwords($each_preview['file_description']) ?> Artwork Download</a>
                                                    </div>
                                                <?php endforeach; ?></div>
											</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                            <td>
                                <span style="cursor:pointer;font-size:10px;" onclick="window.open('<?php print $each_order['packing_sheet_url'] ?>');" class="label label-success"><i class="fa fa-print">&nbsp;</i>Print</span>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <input class="form-control " type="text"  placeholder="Weight" id="weight_<?php print $each_order['id'] ?>" value="<?php print $each_order['weight'] ? $each_order['weight'] : "0.1" ?>" />
                                    </div>
                                </div>
                                <button style="margin-top:4px" class="btn btn-success btn-small" type="button" value="Save" onclick="saveWeight(<?php print $each_order['id'] ?>);" > Save </button>
                            </td>
                            <td><a class="label label-default" target='_blank' href="<?php print _U ?>generate_shipping_label?order_id=<?php print $each_order['order_id'] ?>" style="cursor:pointer;font-size:10px;"><i class="fa fa-print">&nbsp;</i>Print</a></td>
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
                </tbody>
            </table>
        <?php else: ?>
            <div>No Orders available</div>
        <?php endif; ?>
    </div>
</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div class="row">
    <div  class="col-md-12 col-lg-12 ">
        <button class="btn btn-success"><i class="fa fa-plus">&nbsp;</i> Create Production Sheet From Selected </button>
        <button class="btn btn-warning"><i class="fa fa-archive">&nbsp;</i> Archive Selected </button>
    </div>
</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<?php include_once('message.php') ?>
<?php include_once('genericPopup.php') ?>
<?php include $subTpl; ?>