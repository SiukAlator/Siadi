<?php

  include_once dirname(__FILE__) . '/Config.php';

  session_start();
  unset($_SESSION['TOKEN']);

  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
  } else {
    $uri = 'http://';
  }
  $uri .= $_SERVER['HTTP_HOST'];
  header('Location: '.$uri.URL_SADMIN.'/login');
  exit;

?>
