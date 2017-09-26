<?php
# Ubicación del proyecto superadmin
define('URL_SADMIN', '/Siadi/superadmin');

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
} else {
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'].URL_SADMIN;

$ws_loginss = "http://localhost/WS_siadi/skeleton/api/loginsuser/";
$method_loginss = "GET";

$ws_dashboard = "http://localhost/WS_siadi/skeleton/api/obtieneDashboard";
$method_dashboard = "GET";

$ws_crearSU = "http://localhost/WS_siadi/skeleton/api/crearsusuario";
$method_crearSU = "POST";

$ws_listaUsuarios = "http://localhost/WS_siadi/skeleton/api/listarusuarios";
$method_listaUsuarios = "GET";

$ws_datosUsuarioEditar = "http://localhost/WS_siadi/skeleton/api/obtienedatos_eusuario";
$method_datosUsuarioEditar = "GET";

$ws_editarUsuario = "http://localhost/WS_siadi/skeleton/api/editarusuario";
$method_editarUsuario = "PUT";
