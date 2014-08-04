<?php //include "new_orders_filter.php";   ?>
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
                <tbody id="orderlistId">
                    <?php foreach ($orders as $each_order): ?>
                        <tr id="<?php print $each_task['id']; ?>">
                            <td><input type="checkbox" class="chkAll" /></td>
                            <td><?php print date("d/m/Y", strtotime($each_order['order_date'])) ?></td>
                            <td><?php print $each_order['order_id'] ?></td>
                            <td>
                                <?php $items = getOrderItems($each_order['order_id']); ?>
                                <table class="table table-no-hover table-bordered table-condensed">
                                    <?php foreach ($items as $each_item): ?>
                                        <tr>
                                            <td><!--<img src="<?php print $each_item['Previews'] ?>" width="50" />--> </td>
                                            <td><?php print $each_item['LineItemId'] ?></td>
                                            <td><?php print $each_item['Description'] ?></td>
                                            <td><?php print $each_item['Quantity'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
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
                                <span style="cursor:pointer;font-size:10px;" onclick="window.open('<?php print $each_order['packing_sheet_url'] ?>');" class="label label-success"><i class="fa fa-print">&nbsp;</i>Print</span>
                            </td>
                            <td>
                                <span class="label label-warning" style="cursor:pointer;font-size:10px;"><i class="fa fa-download">&nbsp;</i>Download</span>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <input class="form-control " type="text"  placeholder="Weight" id="weight_<?php print $each_order['id'] ?>" value="<?php print $each_order['weight'] ?>" />
                                    </div>
                                </div>

                                <button style="margin-top:4px" class="btn btn-success btn-small" type="button" value="Save" onclick="saveWeight(<?php print $each_order['id'] ?>);" > Save </button>

                            </td>
                            <td><span class="label label-default" style="cursor:pointer;font-size:10px;"><i class="fa fa-print">&nbsp;</i>Print</span></td>
                            <td>messages</td>
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