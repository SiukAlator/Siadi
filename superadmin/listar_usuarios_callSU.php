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

</br>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">

            <table class="table table-striped table-advance table-hover">
             <tbody>
                <tr>
                   <th><i class="icon_profile"></i> Usuario</th>
                   <th><i class="icon_profile"></i> Nombre</th>
                   <th><i class="icon_mail_alt"></i> Email</th>
                   <th><i class="icon_mobile"></i> Fono</th>
                   <th><i class="icon_cogs"></i> Acciones</th>
                </tr>
                <?php
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $ws_listaUsuarios,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => $method_listaUsuarios,
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
                        if ($obj['status']['code'] == '200')
                        {
                          $arr = $obj['response']['data'];
                          foreach($arr as $item) {
                              echo '<tr>';
                              $user = $item['user'];
                              echo '<td>'.$user.'</td>';
                              $name = $item['name'];
                              $last_name = $item['last_name'];
                              echo '<td>'.$name.' '.$last_name.'</td>';
                              $email = $item['email'];
                              echo '<td>'.$email.'</td>';
                              $fono = $item['fono'];
                              echo '<td>'.$fono.'</td>';
                              echo '<td>';
                              echo '<div class="btn-group">';
                              echo    '<a class="btn btn-primary" href="editar_super_usuario.php?user='.$user.'"><i class="icon_plus_alt2"></i></a>';
                              echo    '<a class="btn btn-danger" href="eliminar_super_usuario.php?user='.$user.'"><i class="icon_close_alt2"></i></a>';
                              echo '</div>';
                              echo ' </td>';
                              echo '</tr>';
                          }
                        }
                    }
                ?>
             </tbody>
          </table>
        </section>
    </div>
</div>
