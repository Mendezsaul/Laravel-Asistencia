$(document).ready(function(){
    $("#correo").change(function(){
        var valor= $(this).val();
        //alert($(this).val());
        if(valor==0){
            $("#input-content-id").css({
                border:'1px solid rgba(153, 153, 153, 0.54)'
            }).animate({
                borderWidth:1
            },500);
        }else{
            $("#input-content-id").css({
                border:'1px solid #2f1764'
            }).animate({
                borderWidth:1.3
            },400);
        }
        
    });
});
