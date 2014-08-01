<?php include "jquery_ui.php"; ?>
<?php include "paggingDataTable.php"; ?>
<?php include "jquery_timepicker.php"; ?>
<script type="text/javascript" >
  
 var searchParams = {};
    $(document).ready(function() {
         $("#table").dataTable();
        
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
    function _doLoadFilter() {

        showWait();
        
        $.ajax({
            url: _U + 'new_orders',
            data: {customFilter: 1,to_date_val: $("#to_date").val(),from_date_val: $("#from_date").val()},
            success: function(r) {
                hideWait();
                $("#orderlistId").html(r);
            }
        });
    }

</script>
