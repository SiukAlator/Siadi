<?php

?>

<div class="toggle-nav">
    <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
</div>

<!--logo start-->
<a href="index.html" class="logo">Nice <span class="lite">Admin</span></a>
<!--logo end-->

<div class="nav search-row" id="top_menu">
    <!--  search form start -->
    <!--
    <ul class="nav top-menu">
        <li>
            <form class="navbar-form">
                <input class="form-control" placeholder="Search" type="text">
            </form>
        </li>
    </ul>
    -->
    <!--  search form end -->
</div>

<div class="top-nav notification-row">
    <!-- notificatoin dropdown start-->
    <ul class="nav pull-right top-menu">

        <!-- alert notification start-->
        <li id="alert_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="icon-bell-l"></i>
                <span class="badge bg-important">7</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <div class="notify-arrow notify-arrow-blue"></div>
                <li>
                    <p class="blue">Tu tienes N nofiticaciones</p>
                </li>
                <li>
                    <a href="#">
                        <span class="label label-primary"><i class="icon_calendar"></i></span>
                        Solicitud de reserva
                        <span class="small italic pull-right">5 mins</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="label label-warning"><i class="icon_mail"></i></span>
                        Notificación de problemas
                        <span class="small italic pull-right">50 mins</span>
                    </a>
                </li>
                <li>
                    <a href="#">See all notifications</a>
                </li>
            </ul>
        </li>
        <!-- alert notification end-->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="profile-ava">
                    <img alt="" src="img/avatar1_small.jpg">
                </span>
                <span class="username">
                <?php
                    echo "".$_SESSION['USER_NAME']."";
                ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                <li class="eborder-top">
                    <a href="#"><i class="icon_profile"></i> Mi perfil</a>
                </li>
                <li>
                    <a href="logout.php"><i class="icon_key_alt"></i> Cerrar sesión</a>
                </li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!-- notificatoin dropdown end-->
</div>
