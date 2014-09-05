<?php //include "new_orders_filter.php";                                  ?>

<div class="panel panel-default ">
    <div class="panel-heading col-md-12 col-lg-12">

        <div style="float:left;padding-top:8px"><b>List of Archived Orders</b>
        <span id="next_page_no" class="hide">0</span>
            <span id="countdata" class="hide"><?php print $length; ?></span>

            <span id="prebtn" class="btn btn-default" onclick="getPrerecord();"><i class="fa fa-chevron-left"></i></span>
	    <span id="nextbtn" class="btn btn-default" onclick="getNextrecord();"><i class="fa fa-chevron-right"></i></span>&nbsp;

        </div> 
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
                        <th><input type="checkbox"  onclick="doCheckAll(this.checked)"/></th>
                        <th></th>
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
                    <?php include "new_orders_data.php";?>
                </tbody>
            </table>
        <?php else: ?>
            <div>No Archived Orders available</div>
        <?php endif; ?>
    </div>
    
     <div class="panel-heading col-md-12 col-lg-12">

        <div style="float:left;padding-top:8px"><b>List of Archived Orders</b>
        <span id="next_page_no" class="hide">0</span>
            <span id="countdata" class="hide"><?php print $length; ?></span>

            <span id="prebtndown" class="btn btn-default" onclick="getPrerecord();"><i class="fa fa-chevron-left"></i></span>
	    <span id="nextbtndown" class="btn btn-default" onclick="getNextrecord();"><i class="fa fa-chevron-right"></i></span>&nbsp;

        </div> 
        <div style="float:right"></div> 
        <div class="clearfix"></div>
    </div>
</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div class="row">
    <div  class="col-md-12 col-lg-12 ">
        <button class="btn btn-warning" onclick="doUnArchive()"><i class="fa fa-archive">&nbsp;</i> Move to New Orders</button>
    </div>
</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<div  class="col-md-12 col-lg-12 ">&nbsp;</div>

<?php include_once('message.php') ?>
<?php include_once('genericPopup.php') ?>
<?php include $subTpl; ?>