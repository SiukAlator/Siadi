<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/proyectos/Siadi/superadmin/Config.php';

    $useredit = $_POST['useredit'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $fono = $_POST['fono'];
    $contrasena = $_POST['contrasena'];
    session_start();
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $ws_editarUsuario,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method_editarUsuario,
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "useredit: ".$useredit,
      "name: ".$nombre,
      "last_name: ".$apellidos,
      "token: ".$_SESSION['TOKEN'],
      "fono: ".$fono,
      "email: ".$email,
      "pass: ".$contrasena
    ),
  ));

  unset($_SESSION['CODE_ERROR']);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $obj = json_decode($response, true);
    if ($obj['status']['code'] != '200')
    {

        $_SESSION['CODE_ERROR'] = $obj['status']['code'];

        header('Location: listar_usuarios.php');

    }
    else
    {
        $_SESSION['CODE_ERROR'] = $obj['status']['code'];
        header('Location: listar_usuarios.php');

    }

    //echo "<script type='text/javascript'>alert('Error interno, favor intente nuevamente o contacte con el administrador: ".$obj['status']['code']."');</script>";
  }

 ?>
