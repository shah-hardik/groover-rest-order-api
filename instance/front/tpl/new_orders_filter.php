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