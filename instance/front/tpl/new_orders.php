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
                            <th><input type="checkbox"  /></th>
                            <th>Order Detail</th>
                            <th>Order ID</th>
                            <th>Preview</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Quantity</th>
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
                                <td><?php print date("d/m/Y",strtotime($each_order['order_date'])) ?></td>
                                <td><?php print $each_order['order_id'] ?></td>
                                <td><img src="https://vendor.zazzle.com/v100/api.aspx?method=getpreviewfile&itemid=169894766938730106&area=outside&hash=96588e2addf05491dfd715a0bd2e9ab9" width="50" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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