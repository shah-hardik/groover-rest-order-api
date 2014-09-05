<?php include "jquery_ui.php"; ?>
<?php include "paggingDataTable.php"; ?>
<?php //include "jquery_timepicker.php";                 ?>
<script type="text/javascript" >

    var searchParams = {};
    $(document).ready(function() {
//        $("#table").dataTable({
//            "ordering": false,
//            "info": false
//        });

 $('#prebtn').attr("disabled",true);
 $('#prebtndown').attr("disabled",true);
        searchParams = {
            filter: '<?php print $urlArgs[1] ?>',
            date: ''
        };
        $("#from_date").datepicker({
            changeMonth: true,
            changeYear: true,
            onSelect: function(e) {
                searchParams.date = e;
            }
        });
        $("#to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            onSelect: function(e) {
                searchParams.date = e;
            }
        });

        $(document).click(function() {
            $(".breakdowns").hide();
        });
    });
    function getNextrecord(){
         $("#prebtn").attr('disabled',false);
         $("#prebtndown").attr('disabled',false);
        var page_no = $("#next_page_no").html();
        $("#next_page_no").html(parseInt(page_no) + parseInt(10));
        page_no = $("#next_page_no").html();
	
      if(page_no > $("#countdata").html())
          {
             $("#nextbtn").attr('disabled',true);
             $("#nextbtndown").attr('disabled',true);
          }
        showWait();
        $.ajax({
            url:_U+'archived_orders',
            data:{Nextrecord:1,Limit:page_no},
            success:function(r){
                hideWait();
                $("#orderlistId").html(r);
                //$("#next_page_no").html(parseInt(page_no) + parseInt(10));
            }
        });
    }
    function getPrerecord(){
     $("#nextbtn").attr('disabled',false);
     $("#nextbtndown").attr('disabled',false);
        var page_no = $("#next_page_no").html();
        $("#next_page_no").html(parseInt(page_no) - parseInt(10));
        page_no = $("#next_page_no").html();
        if(page_no == 0){
           $("#prebtn").attr('disabled',true);
           $("#prebtndown").attr('disabled',true);
        }
        showWait();
        $.ajax({
            url:_U+'archived_orders',
            data:{Nextrecord:1,Limit:page_no},
            success:function(r){
                hideWait();
                $("#orderlistId").html(r);
                //$("#next_page_no").html(parseInt(page_no) - parseInt(10));
            }
        });
    }
    
    function saveWeight(id) {
        showWait('Please wait while we save weight..');
        var val = $("#weight_" + id).val();
        $.ajax({
            url: _U + 'new_orders',
            data: {generate: 1, val: val, id: id},
            success: function(r) {
                hideWait();
            }
        });
    }
    function _doLoadFilter() {

        showWait('Please wait while we filter your orders');

        $.ajax({
            url: _U + 'new_orders',
            data: {customFilter: 1, to_date_val: $("#to_date").val(), from_date_val: $("#from_date").val()},
            success: function(r) {
                hideWait();
                $("#orderlistId").html(r);
            }
        });
    }


    function doCheckAll(checked) {
        if (checked) {
            $(".chkAll:visible").prop("checked", "checked");
        } else {
            $(".chkAll").prop("checked", "");
        }
    }

    function doUpdateOrders() {
        showWait('Please wait while system retrieves new orders...');
        $.ajax({
            url: _U + 'new_orders',
            data: {newOrders: 1},
            success: function(r) {
                $("#_genericPopup .modal-body").html('<strong>Orders retrieved successfully. Now reloading</strong>');
                setTimeout(function() {
                    hideWait();
                }, 2000)
                location.reload();
            }
        });
    }

    function doArchive() {
        if ($(".chkAll:checked").length > 0) {
            var orderIds = [];
            $(".chkAll:checked").each(function(index, element) {
                orderIds.push($(element).val());
                $("#row_" + $(element).val()).hide();
            });
            showWait('Archiving the orders. ');
            $.ajax({
                type: 'post',
                url: _U + 'new_orders',
                data: {doArchive: 1, orderIds: orderIds},
                success: function(r) {
                    $("#_genericPopup .modal-body").html('<strong>Orders archived successfully. </strong>');
                    setTimeout(function() {
                        hideWait();
                    }, 2000)
                }
            });
        }
    }

    function doUnArchive() {
        if ($(".chkAll:checked").length > 0) {
            var orderIds = [];
            $(".chkAll:checked").each(function(index, element) {
                orderIds.push($(element).val());
                $("#row_" + $(element).val()).hide();
            });
            showWait('Removing orders from archive. ');
            $.ajax({
                type: 'post',
                url: _U + 'new_orders',
                data: {removeArchive: 1, orderIds: orderIds},
                success: function(r) {
                    $("#_genericPopup .modal-body").html('<strong>Orders removed from archived. </strong>');
                    setTimeout(function() {
                        hideWait();
                    }, 2000)
                }
            });
        }
    }


</script>