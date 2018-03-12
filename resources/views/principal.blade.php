<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <title>Horario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/principal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
<script>
    $(document).ready(function(){
         var contador=1;
         $('select option[value="{{$codigo[0]->id_personal}}"]').attr("selected", true);
        $(document).on("click",".bt-menu",function(){
            if(contador==1){
                $('nav').animate({
                    left:'0'
                });
                contador=0;
            }else{
                $('nav').animate({
                    left:'-100%'
                });
                contador=1;
            }
    });
        $(document).on("change","#select",function(){
            var id=$(this).val();
            if(id!=""){
              location.assign('./'+id)            }
        });

        function reloj() {
          var fecha = new Date();
          var horas=fecha.getHours();
          var minutos=fecha.getMinutes();
          var segundos=fecha.getSeconds();
          var dn= "a.m";
          if (horas>12){
            dn="p.m";
            horas=horas-12;
          }
          if (horas==0){
            horas=12;
          }
          if (minutos<=9){
            minutos="0"+minutos;
          }
          if (segundos<=9){
            segundos="0"+segundos;
          }
          $('#hora').html(horas+":"+minutos+":"+segundos+" "+dn);
        }
        setInterval(reloj,1000);
    });
    </script>
</head>
<body>
  <header class="bg-white">
      <div class="menu_bar">
        <div class="bt-menu"><span class="icon-list">X</span>Menu</div> 
      </div>
      <nav class="left-block">
              <ul>
                 <li><a href="/">INICIO</a></li>
                  <li><a href="">MIENBROS</a></li>
                  <li class="li-input">
                  <select class="input-content-input" id="select" name="usuario">
                    @foreach($info as $key)
                        <option value="{{$key->id_personal}}">{{$key->nombres}} {{$key->apellidos}}</option>
                    @endforeach
                </select>
                  <li><a href="login.php">ADMIN</a></li>
              </ul>
      </nav>
  </header>

  <div class="container">
  <div class="columna">
  <div class="col-sm-8" >
      <h4>Informacion del Practicante </h4>
      <hr>
      <?php
    $fecha1 = '08:00:00';
$fecha2 = '14:05:00';

function getMinuts($fecha1, $fecha2)
{
    $fecha1 = strtotime($fecha1);
    $fecha2 = strtotime($fecha2);
    return $dif_hora=round(($fecha2 - $fecha1)/3600,4);
}
//echo getMinuts($fecha1,$fecha2); 
      ?>
      <div class="columna">
          <div class="col-lg-7 border-light" id="grande">
          <ul>
          <li><span class="dato">Codigo: </span><span>{{$codigo[0]->id_personal}}</span></li>
            <li><span class="dato">Nombres y apellidos: </span><span>{{$codigo[0]->nombres}} {{$codigo[0]->apellidos}}</span></li>
            <li><span class="dato">DNI: </span><span>{{$codigo[0]->dni}}</span></li>
            <li><span class="dato">Sexo: </span><span>{{$codigo[0]->sexo}}</span></li>
            <li><span class="dato">Fecha Nacimiento: </span><span>{{$codigo[0]->fechanacimiento}}</span></li>
            <li><span class="dato">Domicilio: </span><span>{{$codigo[0]->direccion}}</span></li>
            <li><span class="dato">Instituto: </span><span>{{$codigo[0]->instituto}}</span></li>
            <li><span class="dato">Grupo: </span><span>{{$codigo[0]->id_grupo_fk}}</span></li>
             </ul>
          </div>
          <div class="col-lg-5 border-l text-center">
             <h3>Hora Actual<br>
             <span class="span" id="hora">  :&nbsp;&nbsp;&nbsp;&nbsp;:</span></h3>
          </div>
      </div>
  </div>
  <div class="col-sm-4" style="text-align: left;">
    <h4>Asistencia hoy</h4>
    <hr>
    <div class="border-light" id="grande">
      <ul>
    @foreach($llegaron as $key2)
    @if($key2->hora_salida!=null)
      <li><span class="block verde"><img src="{{asset('img/check.png')}}"> {{$key2->nombres}} {{$key2->apellidos}}</span></li>
    @else
      <li><span class="block rojo"><img src="{{asset('img/wait.png')}}"> {{$key2->nombres}} {{$key2->apellidos}}</span></li>
    @endif
    @endforeach
  </ul>
  </div>
  </div>

<div class="col-sm-8 large-top-space">
      <div class="columna">
        <h4>Registrar ingreso y/o salida</h4>
    <hr>
          <div class="col-lg-12 border-light" id="grande">
            <form action="./registro" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" name="id" value="{{$codigo[0]->id_personal}}">
            @if(count($registro)==1)
            <div class="col-lg-12 text-center" >
              <b>Ya se registró ingreso</b><span class="hora">Hora: {{$registro[0]->hora_ingreso}}</span>
            @if($registro[0]->hora_salida==null)
              <input type="submit" value="Registrar salida" class="disabled-false">
              </div>
            @else
          </div>
          <div class="col-lg-12 text-center">
              <b>Ya se registró salida</b><span class="hora">Hora: {{$registro[0]->hora_salida}}</span>
            </div>
            @endif
            @else
          <div class="col-lg-12 text-center">
            <input type="submit" value="Registrar ingreso" class="disabled-false">
            @endif
          </div>
          </form>
          </div>
      </div>
  </div>
  <div class="col-sm-3" style="text-align: left;">
  <!-- Contenido lateral-->
  </div>

  </div>
  </div>
</body>
</html>
