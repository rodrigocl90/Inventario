


    <?php ?>



@extends('administrador.index')

@section('headder')
 <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

 
   
   <nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Información de perfil Usuario</li>
 

  </ol></nav>




@stop
@section('contenido')

<style type="text/css">
  
    .read{ background: white !important;

     }


.blue{

    border-style: 1px; solid;
  font-size: 15px;
}
.green{color: green;}
label{
  text-align:left !important;
  font-size: 12px !important;
  font-weight: 200px !important;

}


.roles{background:#00a9a5 !important;color: white !important;
 border:none;
        border-width:0 !important;
        text-align: center !important;
}
.centro
{
   text-align: center !important;
align-content: center !important; 

 }
</style>





  <div class="row">



  <div class="col-sm-2">
    
  </div>



  <div class="col-sm-7 blue border responsive" style="background:white;">
 <div class="well form-horizontal">
  <div class="well well-lg" "><h4 style="font-family:verdana; color:white;"><span class="badge badge-info">Información de perfil de de Usuario</span></h4></div>
<div class="row">

    <div class="col-sm-4">
         <div class="form-group">
                         @if (Auth::user()->gender==='h')
                     <img  style="height:180px;width:200px; display:block;margin:auto;" src="{{asset('img/hombre1.png')}}" class="img-circle img-responsive" alt="User Image">
                  @endif
                  @if (Auth::user()->gender==='m')
                     <img  style="height:180px;width:200px; display:block;margin:auto;" src="{{asset('img/mujer1.jpg')}}" class="img-circle img-responsive" alt="User Image">
                  @endif     
      </div>
  </div>
<!-- Example single danger button -->
<div class="pull-right">
  <button type="button" align="right" class="btn label-info dropdown-toggle fa fa-cog" style="background:brown;color:white;" data-toggle="dropdown" >
    Configuración
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('logs.mylogs')}}">Ver sesiones Iniciadas</a>
    <a class="dropdown-item" href="{{route('changePassword')}}">Cambiar Contraseña</a>
 
  </div>
</div>
  
   
                            </div>

                    
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">NOMBRE USUARIO:</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="NameUser" name="NameUser" class="read form-control" value="{{Auth::user()->name}}" type="text" readonly></div>

                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">NOMBRES DEL USUARIO:</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span><input id="firstname" name="firstname" class="read form-control" required="true" value="{{Auth::user()->first_name}}" type="text" readonly=""></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">APELLIDOS DEL USUARIO:</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span><input id="last_name" name="last_name"  class="read form-control" value="{{Auth::user()->last_name}}" type="text" readonly=""></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">EMAIL:</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email"  class="read form-control" value="{{Auth::user()->email}}" type="text" readonly></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Nº MÓVIL:</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span><input id="phone" name="phone" placeholder="phone" class="read form-control"  value="{{Auth::user()->phone}}" type="text" readonly></div>
                            </div>
                         </div>
                         <div class="form-group">
                            
                            <div class="col-md-8 inputGroupContainer">
                              
                                <h4 align="center"><span class="label label-success" align=center>Roles Asignados</span></h4>
                                @foreach(Auth::user()->roles as $role)
                               <br>
                                {{ Form::text('tmailz',$role->display_name , ['class' => 'centro roles read  form-control ','readonly']) }}

                                @endforeach
                         
                            </div>
                            </div>
                         </div>
                       
                
                      </fieldset>
                   </div>





</div>
 
  


  <div class="col-sm-3">
    

  </div>

</div>




@stop