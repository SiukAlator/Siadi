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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Super usuario</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_profile"></i>Usuarios</li>
						<li><i class="fa fa-files-o"></i>Agregar super usuario</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Datos de usuario
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal"  onSubmit="return validaFormulario(this);" method="post" action="agregarSU_call.php">
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Usuario<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="usuario" name="usuario" minlength="4" type="text" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Nombre<span class="required"></span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="nombre" name="nombre" minlength="2" type="text"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Apellidos<span class="required"></span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="apellidos" name="apellidos" minlength="2" type="text"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Email<span class="required"></span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="email" name="email" minlength="2" type="email"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Fono<span class="required"></span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="fono" name="fono" minlength="2" type="text"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Contraseña<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="contrasena" name="contrasena" minlength="6" type="password" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="cname" class="control-label col-lg-2">Repetir Contraseña<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="contrasena2" name="contrasena2" minlength="6" type="password" required />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Crear</button>
                                              <button class="btn btn-default" type="button">Cancelar</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <div class="text-right">
        <div class="credits">
            <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
            -->
            <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
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
