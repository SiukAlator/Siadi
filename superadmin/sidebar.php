<?php
/*Validación simple de usuario*/
include_once dirname(__FILE__) . '/Config.php';
if(!isset($_SESSION)) {
     session_start();
}
if (isset($_SESSION['TOKEN']))
{
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $ws_dashboard,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method_dashboard,
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "token: ".$_SESSION['TOKEN']
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $obj = json_decode($response, true);
    if ($obj['status']['code'] == '414' || $obj['status']['code'] == '500')
    {
        unset($_SESSION['TOKEN']);
        $uri .= $_SERVER['HTTP_HOST'];
        header('Location: '.$uri.URL_SADMIN.'/login');
        exit;
    }
    else if($obj['status']['code'] == '200')
    {

    }
  }
}
else {
  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
  } else {
    $uri = 'http://';
  }
  $uri .= $_SERVER['HTTP_HOST'];
  header('Location: '.$uri.URL_SADMIN.'/login');
  exit;
}
/*FIN Validación simple de usuario*/
 ?>

<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu">
        <li class="active">
            <a class="" href="index.html">
                <i class="icon_house_alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Condominios</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="form_validation.html">Agregar</a></li>
                <li><a class="" href="form_validation.html">Listar</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_profile"></i>
                <span>Usuarios</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="agregar_super_usuario.php">Agregar super usuario</a></li>
                <li><a class="" href="agregar_condominio.php">Agregar administrador</a></li>
                <li><a class="" href="agregar_condominio.php">Agregar empleado</a></li>
                <li><a class="" href="agregar_condominio.php">Agregar oficio-empleado</a></li>
                <li><a class="" href="agregar_condominio.php">Agregar residente</a></li>
                <li><a class="" href="listar_usuarios.php">Listar</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_calendar"></i>
                <span>Reservas</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="basic_table.html">Agendar</a></li>
                <li><a class="" href="basic_table.html">Listar</a></li>
                <li><a class="" href="basic_table.html">Solicitar</a></li>
                <li><a class="" href="basic_table.html">Listar solicitudes</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_mail"></i>
                <span>¿Problemas?</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="basic_table.html">Notificar</a></li>
                <li><a class="" href="basic_table.html">Listar</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_drawer"></i>
                <span>Áreas comunes</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="basic_table.html">Agregar</a></li>
                <li><a class="" href="basic_table.html">Listar</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_balance"></i>
                <span>Gastos comunes</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="basic_table.html">Ingresar</a></li>
                <li><a class="" href="basic_table.html">Listar</a></li>
                <li><a class="" href="basic_table.html">Exportar</a></li>
                <li><a class="" href="basic_table.html">Enviar</a></li>
                <li><a class="" href="basic_table.html">Realizar pago</a></li>
                <li><a class="" href="basic_table.html">Confirmar pago</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" class="">
                <i class="icon_genius"></i>
                <span>Planes</span>
                <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
                <li><a class="" href="basic_table.html">Crear</a></li>
                <li><a class="" href="basic_table.html">Listar</a></li>
                <li><a class="" href="basic_table.html">Realizar pago</a></li>
                <li><a class="" href="basic_table.html">Listar pagos</a></li>
            </ul>
        </li>
    </ul>
    <!-- sidebar menu end-->
</div>
