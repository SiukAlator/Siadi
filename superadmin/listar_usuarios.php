<?php
include_once dirname(__FILE__) . '/Config.php';
session_start();
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
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Siadi</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
    <?php
    
    if (isset($_SESSION['CODE_ERROR']))
    {


      if ($_SESSION['CODE_ERROR'] == '200')
      {
          echo "<script type='text/javascript'>alert('Usuario editado exitosamente');</script>";
      }
      else {
          echo "<script type='text/javascript'>alert('Error interno, favor intente nuevamente o contacte con el administrador: ".$_SESSION['CODE_ERROR']."');</script>";
      }

    }

    unset($_SESSION['CODE_ERROR']);
    ?>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <header class="header dark-bg">
        <?php
            include_once dirname(__FILE__) . '/header.php';
        ?>
      </header>
      <!--header end-->

      <!--sidebar start-->
      <aside>
        <?php
            include_once dirname(__FILE__) . '/sidebar.php';
        ?>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
        		  <div class="row">
        				<div class="col-lg-12">
        					<h3 class="page-header"><i class="fa fa-files-o"></i> Lista de usuarios</h3>
        					<ol class="breadcrumb">
        						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
        						<li><i class="icon_profile"></i>Usuarios</li>
        						<li><i class="fa fa-files-o"></i>Listar</li>
        					</ol>
        				</div>
        			</div>
              <!-- Body -->
              <section class="panel">
                  <header class="panel-heading tab-bg-primary ">
                      <ul class="nav nav-tabs">
                          <li class="active">
                              <a data-toggle="tab" href="#superusuarios">Super usuarios</a>
                          </li>
                          <li class="">
                              <a data-toggle="tab" href="#administradores">Administradores</a>
                          </li>
                          <li class="">
                              <a data-toggle="tab" href="#empleados">Empleados</a>
                          </li>
                          <li class="">
                              <a data-toggle="tab" href="#residentes">Residentes</a>
                          </li>
                      </ul>
                  </header>
                  <div class="panel-body">
                      <div class="tab-content">
                          <div id="superusuarios" class="tab-pane active">
                            <?php
                                include_once dirname(__FILE__) . '/listar_usuarios_callSU.php';
                            ?>
                          </div>
                          <div id="administradores" class="tab-pane">About</div>
                          <div id="empleados" class="tab-pane">Profile</div>
                          <div id="residentes" class="tab-pane">Contact</div>
                      </div>
                  </div>
              </section>

              <!-- body end-->
          </section>
      </section>
      <!--main content end-->

      <?php
          include_once dirname(__FILE__) . '/bottom_credits.php';
      ?>

  </section>
  <!-- container section end -->

    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>


  </body>
</html>
