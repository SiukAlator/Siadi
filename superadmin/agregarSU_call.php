<?php
    include_once dirname(__FILE__) . '/Config.php';
    session_start();
    $user = $_POST['usuario'];
    $name = $_POST['nombre'];
    $last_name = $_POST['apellidos'];
    $email = $_POST['email'];
    $fono = $_POST['fono'];
    $pass = $_POST['contrasena'];
    $pass2 = $_POST['contrasena2'];
    $token = $_SESSION['TOKEN'];

    if($pass != $pass2)
    {
       echo "<script>alert('Las contraseñas ingresadas no coinciden');";
       echo "window.location = './agregar_super_usuario.php';";
       echo "</script>";
    }
    else if($token == '')
    {
      echo "<script>alert('Sesión expirada');";
      echo "window.location = './login/';";
      echo "</script>";
    }
    else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $ws_crearSU,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method_crearSU,
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "user: ".$user,
          "name: ".$name,
          "last_name: ".$last_name,
          "email: ".$email,
          "fono: ".$fono,
          "pass: ".$pass,
          "token: ".$token
        ),
      ));


      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $obj = json_decode($response, true);
        if ($obj['status']['code'] == '414')
        {
          echo "<script>alert('Sesión expirada');";
          echo "window.location = './login/';";
          echo "</script>";

        }
        else if ($obj['status']['code'] == '412')
        {
          echo "<script>alert('El usuario que intenta registrar ya existe');";
          echo "window.location = './agregar_super_usuario.php';";
          echo "</script>";
        }
        else if ($obj['status']['code'] == '413')
        {
            echo "<script>alert('Cuenta de usuario ya existe o se encuentra suspendida');";
            echo "window.location = './agregar_super_usuario.php';";
            echo "</script>";
        }
        else if ($obj['status']['code'] == '500')
        {
            echo "<script>alert('Error interno. Favor intentar mas tarde o comunicarse con el administrador');";
            echo "window.location = './agregar_super_usuario.php';";
            echo "</script>";
        }
        else if ($obj['status']['code'] == '200')
        {
            echo "<script>alert('Usuario creado exitosamente');";
            echo "window.location = './agregar_super_usuario.php';";
            echo "</script>";
        }
      }
    }


 ?>
