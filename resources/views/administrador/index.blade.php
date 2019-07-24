<!DOCTYPE html>
<html lang="en">
  <head>

     <title>PLATAFORMA WEB</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{asset('img/mujers.png')}}">
<style>
 
.arr-right .breadcrumb-item+.breadcrumb-item::before {
 
  content: "›";
 
  vertical-align:top;
 
  color: #408080;
 
  font-size:35px;
 
  line-height:18px;
 
}
 
</style>
      



  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Plataforma web</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
       
        </li>
        <!--Notification Menu-->
        <li class="dropdown">


        </li>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-user fa-lg"></i> Mi perfil</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i>Salir</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">


  
      <ul class="app-menu">
      @permission(['categorias'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Almacen</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
         @permission(['categorias'])
            <li><a class="treeview-item" href="{{route('categorias.index')}}"><i class="icon fa fa-user"></i> Categoría</a></li>
     @endpermission

 @permission(['productos'])
            <li><a class="treeview-item" href="{{route('productos.index')}}"><i class="icon fa fa-user"></i> Productos</a></li>
     @endpermission


          </ul>
        </li>
        




@permission(['clientes'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money "></i><span class="app-menu__label">Ventas</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
         @permission(['clientes'])
            <li><a class="treeview-item" href="{{route('salidas.create')}}"><i class="icon fa fa-user"></i>Ingreso ventas</a></li>
     @endpermission

   @permission(['clientes'])
            <li><a class="treeview-item" href="{{route('clientes.index')}}"><i class="icon fa fa-user"></i>Clientes</a></li>
     @endpermission


 @permission(['clientes'])
            <li><a class="treeview-item" href="{{route('salidas.index')}}"><i class="icon fa fa-user"></i>Lista de Ventas</a></li>
     @endpermission


          </ul>
        </li>
        




        @permission(['proveedores'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Compras</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
         @permission(['proveedores'])
            <li><a class="treeview-item" href="{{route('proveedores.index')}}"><i class="icon fa fa-user"></i>Proveedores</a></li>
     @endpermission

 @permission(['proveedores'])
            <li><a class="treeview-item" href="{{route('entradas.create')}}"><i class="icon fa fa-user"></i>Ingreso de Productos</a></li>
     @endpermission



 @permission(['proveedores'])
            <li><a class="treeview-item" href="{{route('entradas.index')}}"><i class="icon fa fa-user"></i>Lista de Compras</a></li>
     @endpermission

          </ul>
        </li>







     
        @permission(['user-update','user-delete','user-list','user-create','role-update','role-delete','role-list','role-create'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Usuarios</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
         @permission(['user-update','user-delete','user-list','user-create'])
            <li><a class="treeview-item" href="{{route('users.index')}}"><i class="icon fa fa-user"></i> Usuarios</a></li>
     @endpermission


@permission(['role-update','role-delete','role-list','role-create'])
            <li><a class="treeview-item" href="{{route('roles.index')}}"><i class="icon fa fa-cog""></i>Roles</a></li>
          @endpermission


          </ul>
        </li>


      @permission(['logs-list-viever','logs-list'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Logs</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
       @permission(['logs-list'])
            <li><a class="treeview-item" href="{{route('logs.logslist')}}"><i class="icon fa fa fa-arrow-circle-o-right"></i>Log Usuarios</a></li>
      @endpermission

 @permission(['logs-list-viever'])

            <li><a class="treeview-item" href="{{route('log-viewer::logs.list')}}" target="_blank" rel="noopener"><i class="icon fa fa fa-user"></i>Logs sistema</a></li>
          @endpermission


          </ul>
        </li>



@permission(['backup-admin'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Base de datos</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
       @permission(['backup-admin'])
            <li><a class="treeview-item" href="{{route('backup.list')}}"><i class="icon fa fa-cloud-download"></i>Respaldo de Base de Datos</a></li>
      @endpermission


          </ul>
        </li>




@permission(['empresa'])
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building"></i><span class="app-menu__label">Empresa</span>
          <i class="treeview-indicator fa fa-angle-right"></i></a>
             @endpermission


          <ul class="treeview-menu">
       @permission(['empresa'])
            <li><a class="treeview-item" href="{{route('empresa.index')}}"><i class="icon fa fa-building"></i>Perfil</a></li>
      @endpermission


          </ul>
        </li>



     
      </ul>
    </aside>
    <main class="app-content" style="background: white">
  
           @yield('headder')
     
        <!-- Main content -->
       

          @yield('contenido')
    </main>


      <!-- Essential javascripts for application to work-->
   
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{asset('js/plugins/pace.min.js')}}"></script>
    <!-- Page specific javascripts-->
    <script type="{{asset('text/javascript')}}" src="js/plugins/chart.js"></script>



  </body>
</html>