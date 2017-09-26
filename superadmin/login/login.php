<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/Siadi/superadmin/Config.php';
session_start();
if (isset($_SESSION['CODE_ERROR']))
{


  if ($_SESSION['CODE_ERROR'] == '402')
  {
      $num_intentos = $_SESSION['INTENTOS'];
      echo "<script type='text/javascript'>alert('El usuario y contraseña no coinciden, intento número '+".$num_intentos.");</script>";
  }
  else if ($_SESSION['CODE_ERROR'] == '406')
  {
      echo "<script type='text/javascript'>alert('El usuario no existe');</script>";
  }
  else if ($_SESSION['CODE_ERROR'] == '413')
  {
      echo "<script type='text/javascript'>alert('Usuario suspendido. Favor contactar con el administrador');</script>";
  }
  else if ($_SESSION['CODE_ERROR'] == '500')
  {
      echo "<script type='text/javascript'>alert('Error interno, intentelo mas tarde. Si el error persiste, favor comunicarse con el administrador');</script>";
  }
}

unset($_SESSION['CODE_ERROR']);
unset($_SESSION['INTENTOS']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">

    <title>Login</title>

    <?php
        echo '<link rel="shortcut icon" href="'.$uri.'/img/favicon.png">';
        //Bootstrap CSS
        echo '<link href="'.$uri.'/css/bootstrap.min.css" rel="stylesheet">';
        //bootstrap theme
        echo '<link href="'.$uri.'/css/bootstrap-theme.css" rel="stylesheet">';
        //external css
        //font icon
        echo '<link href="'.$uri.'/css/elegant-icons-style.css" rel="stylesheet">';
        echo '<link href="'.$uri.'/css/font-awesome.css" rel="stylesheet">';
        //Custom styles
        echo '<link href="'.$uri.'/css/style.css" rel="stylesheet">';
        echo '<link href="'.$uri.'/css/style-responsive.css" rel="stylesheet">';

    ?>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script>
    function validaUsuario(a)
    {
        if (a.user.value == "")
        {
            alert("Debes ingresar el campo usuario");
            return false;
        }
        else if (a.pass.value == "") {
          alert("Debes ingresar el campo contraseña");
          return false;

        }
        else {
          return true;
        }

    }
    </script>



</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" onSubmit="return validaUsuario(this);" method="post" action="validaLogin.php">
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="user" id="user" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" id="pass" name="pass"  placeholder="Password">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        </div>
      </form>
      <?php
          include_once $_SERVER['DOCUMENT_ROOT'].'/Siadi/superadmin/bottom_credits.php';
      ?>


  </body>
</html>
