<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/Siadi/superadmin/Config.php';

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $ws_loginss.$user,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method_loginss,
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "pass: ".$pass
    ),
  ));
  session_start();
  unset($_SESSION['CODE_ERROR']);
  unset($_SESSION['INTENTOS']);
  unset($_SESSION['TOKEN']);
  unset($_SESSION['USER_NAME']);
  unset($_SESSION['USERID']);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $obj = json_decode($response, true);
    if ($obj['status']['code'] == '402')
    {
        $num_intentos = $obj['response']['data']['num_intentos'];
        $_SESSION['CODE_ERROR'] = '402';
        $_SESSION['INTENTOS'] = $num_intentos;
        header('Location: ../login');

    }
    else if ($obj['status']['code'] == '406')
    {
        $_SESSION['CODE_ERROR'] = '406';
        header('Location: ../login');
    }
    else if ($obj['status']['code'] == '413')
    {
        $_SESSION['CODE_ERROR'] = '413';
        header('Location: ../login');
    }
    else if ($obj['status']['code'] == '500')
    {
        $_SESSION['CODE_ERROR'] = '500';
        header('Location: ../login');
    }
    else if ($obj['status']['code'] == '200')
    {
        $_SESSION['TOKEN'] = $obj['response']['data']['token'];
        $_SESSION['USERID'] = $user;
        $_SESSION['USER_NAME'] = $obj['response']['data']['name']." ".$obj['response']['data']['last_name'];

        header('Location: ../');
    }
  }

 ?>
