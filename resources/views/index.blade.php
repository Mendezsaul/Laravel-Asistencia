<!DOCTYPE html>
<html>
<head>
	<title>Seguimiento | Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="utf-8">
    <script src="js/border_login.js"></script>
    <script>
    $(document).ready(function(){
        var link=null;
        var contenedor=$("#input-content-id");
        //alert(link);
        $('select option[value=""]').attr("selected", true);
        $(document).on("click","#id-a",function(e){
            e.preventDefault();
            if(link!=null){
                location.href=link;
            }else{
                contenedor.css({
                border:'1px solid #e43a3abf'
            }).animate({
                borderWidth:1.2
            },'fast');
            }
        });

        $(document).on("change","#correo",function(){
        var id=$(this).val();
        
        if(id!=""){
            link='informacion/'+id;
        }else{
            link=null;
        }
        //alert(id +" "+link);
    });
    });
    
    
    </script>   
</head>
<body>
   <div class="bg-blue remove_float">
   </div>
    <div class="content-mother">
        <div class="content_width col-xs-11 remove-float center-block white border-radius-8">
        <h2 class="text-center">Informacion y registro de ingreso y/o salida</h2>
            <div class="input-content" id="input-content-id">
                <select class="input-content-input" id="correo" name="usuario">
                    <option value="">Seleccione algun usuario</option>
                    @foreach($info as $key)
                        <option value="{{$key->id_personal}}">{{$key->nombres}} {{$key->apellidos}}</option>
                    @endforeach
                </select>
            </div>
            <a id='id-a' href=""><button class="input-content-submit small-top-space">Ingresar</button></a>    
   </div>
    </div> 
</body>
</html>