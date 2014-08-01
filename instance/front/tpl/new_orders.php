
<div  class="col-md-12 col-lg-12 ">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <b>Filter Order </b>
        </div>
        <div class="panel-body" id="filterdate">
            <form class="form-horizontal">
                <div class="col-lg-7">
                    
                    <div class="form-group">
                        <label for="inputquestion" class="col-lg-4 control-label">Select From Date</label>
                        <div class="col-lg-8">
                                 <div class="input-group">
                                    <input type="text" class="form-control input-sm"  id="from_date" name="from_date" data-toggle="tooltip"  data-original-title="From Date" value="<?php print $display_from; ?>" />
                                    <span  id="span_from" name="span_from" onclick="$('#from_date').datepicker('show');"  class="input-group-addon pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                     </div>
                    
                    <div class="form-group">
                        <label for="inputquestion" class="col-lg-4 control-label">Select To Date</label>
                        <div class="col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" id="to_date" name="to_date"  data-toggle="tooltip"  data-original-title="To Date" value="<?php print $display_to; ?>" >
                                    <span  id="span_to" name="span_to" onclick="$('#to_date').datepicker('show');"  class="input-group-addon pointer"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                               </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group " >

                        <div>
                            <button type="button" onclick="_doLoadFilter();"  class="btn btn-success">Search</button>
                            <button type="button" onclick="location.reload()"  class="btn btn-success">Reset</button>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-4">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="panel panel-default ">
  <div class="panel-heading col-md-12 col-lg-12">

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
                            <th><input type="checkbox"/></th>
                            <th></th>
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
                    <tbody id="orderlistId">
                        <?php foreach ($orders as $each_order): ?>
                            <tr id="<?php print $each_task['id']; ?>">
                                <td><input type="checkbox"  /></td>
                                <td><?php print $cr; ?></td>
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
                                <td><input class="form-control" type="text" name="shipping" id="shipping" />
                                    <br><br>
                                    <input class="btn btn-success btn-small" type="button" id="btn1" value="Generate Label" onclick="generate(<?php print $each_order['id'] ?>);"> </input>
                                </td>
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
<?php include_once('message.php') ?>

<?php include $subTpl; ?>
