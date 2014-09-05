<?php include "jquery_ui.php"; ?>
<?php include "paggingDataTable.php"; ?>
<?php //include "jquery_timepicker.php";                 ?>
<script type="text/javascript" >

    var searchParams = {};
    $(document).ready(function(){

   });     
    function sendack(id){
        
      $.ajax({
            url: _U + 'ack',
            data: {getack: 1,id: id},
            success: function(r) {
                hideWait();
//                $("#orderlistId").html(r);
//                $("#btn").hide();
            }
        });  
        
    }
    function saveWeight(id) {
        
        var val = $("#weight_" + id).val();
        $.ajax({
            url: _U + 'new_orders',
            data: {generate: 1, val: val, id: id},
            success: function(r) {
                hideWait();
                $("#orderlistId").html(r);
            }
        });
    }
    
    


</script>