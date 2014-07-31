<div class="listAffiliates actionItem">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="float:left;padding-top:8px"><b>List of New Orders</b></div> 
            <div style="float:right">
            </div> 
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php
            $cr = 1;
            if (!empty($orders)):
                ?>
                <table class="table table-hover" id="table" >
                    <thead>
                        <tr>
                            <th><input type="checkbox" onclick="call();" /></th>
                            <th>Order Detail</th>
                            <th>Order ID</th>
                            <th style="text-align: center">Order Items</th>
                            <th>Ship To</th>
                            <th>Packing Sheet</th>
                            <th>Artwork</th>
                            <th>Weight</th>
                            <th>Shipping Label</th>
                            <th>Messages</th>
                            <th>Updates</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $each_order): ?>
                            <tr id="<?php print $each_task['id']; ?>">
                                <td><input type="checkbox"  /></td>
                                <td><?php print date("d/m/Y", strtotime($each_order['order_date'])) ?></td>
                                <td><?php print $each_order['order_id'] ?></td>
<!--                               <td>
                                    <?php $items = getOrderItems($each_order['order_id']);?>
                                    <table class="table table-no-hover table-bordered table-condensed">
                                        <?php foreach ($items as $each_item): ?>
                                            <tr>
                                                <td><img src="<?php print $each_item['Previews'] ?>" width="50" /></td>
                                                <td><?php print $each_item['LineItemId'] ?></td>
                                                <td><?php print $each_item['Description'] ?></td>
                                                <td><?php print $each_item['Quantity'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                                <td>
                                    <?php print $each_order['Name'] ?> <br />
                                    <?php print $each_order['Address1'] ?> <br />
                                    <?php print $each_order['Address2'] ?> <br />
                                    <?php print $each_order['City'] ?>, <?php print $each_order['State'] ?>, <?php print $each_order['Zip'] ?> <br />
                                    <?php print $each_order['Country'] ?> <br />
                                    <?php print $each_order['Phone'] ?> <br />
                                    <?php print $each_order['Email'] ?> <br />


                                </td>
                                <td>
                                    <span onclick="window.open('<?php print $each_order['packing_sheet_url'] ?>');" class="label label-success"><i class="fa fa-print">&nbsp;</i>Print</span>
                                </td>-->
                                <td></td>
                                <td></td>
                                <td>
                                    <span onclick="window.open('<?php print $each_order['packing_sheet_url'] ?>');" class="label label-success"><i class="fa fa-print">&nbsp;</i>Print</span>
                          
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
</div>
<?php include_once('message.php') ?>

<?php include $subTpl; ?>