<?php //include "new_orders_filter.php";                                ?>
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
            <table class="table table-no-hover" id="table" style="font-family:verdana;font-size:11px" >
                <thead>
                    <tr>
                        <th><input type="checkbox"  onclick="doCheckAll(this.checked)"/></th>
                        <th>Order Info</th>
                       
                       <th>Ship To</th>
                       
                        <th style="text-align: center">Order Items</th>
                        <th>Packing Sheet</th>
                        <th>Weight</th>
                        <th>Shipping Label</th>
                        <th>Messages</th>
                         <th></th>
                   <!--     <th>Updates</th>-->
                    </tr>
                </thead>
                <tbody id="orderlistId">
                    <?php include "new_orders_data.php"; ?>
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
        <button class="btn btn-warning" onclick="doArchive()"><i class="fa fa-archive">&nbsp;</i> Archive Selected </button>
    </div>
</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<?php include_once('message.php') ?>
<?php include_once('genericPopup.php') ?>
<?php include $subTpl; ?>