
<script type="text/javascript" >
    $(document).ready(function(){
        $("input").hover(function(){
            $("#loginGears").addClass("fa-spin");
        },function(){
            $("#loginGears").removeClass("fa-spin");
        });
    })
   function DeleteUser(url){
        delUrl = url;
        $("#myModal").modal("show");
    } 
</script>