<?php include "jquery_ui.php"; ?>
<?php include "paggingDataTable.php"; ?>
<?php //include "jquery_timepicker.php";     ?>
<script type="text/javascript" >

    var searchParams = {};
    $(document).ready(function() {
        $("#table").dataTable({
            "ordering": false,
            "info": false
        });


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
</script>
