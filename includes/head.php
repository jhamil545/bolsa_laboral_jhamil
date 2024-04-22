<?php
    include("config.php");
    session_start();
?>    

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEMA DE BOLSA LABORAL</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTAGENERAL; ?>templates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTAGENERAL; ?>templates/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.theme.min.css" rel="stylesheet">




</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Inicio - Sidebar (Menú Izquierdo) -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bolsa Laboral</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inico -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>
                
            <!-- Nav Item - Registrarse -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/registro_usuarios.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Registrar Usuario</span></a>
            </li>


            <?php
                if(isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"]=='1'){
            ?>

                <!-- Nav Item - Listar usuarios -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_usuarios.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Listar Usuarios</span></a>
                </li>
            <?php
                }
            ?>


            <!-- Nav Item - Registrarse -->
            <li class="nav-item">
                            <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/registro_empresa.php">
                                <i class="fas fa-fw fa-chart-area"></i>
                                <span>Registrar Empresa</span></a>
                        </li>

            <?php
                if(isset($_SESSION["SESION_ROL"]) && $_SESSION["SESION_ROL"]=='1'){
            ?>
             <!-- Nav Item - Listar usuarios -->
             <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/listar_empresa.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Listar Empresa</span></a>
                </li>
            <?php
                }
            ?>

            <!-- Nav Item - iniciar / cerrar sesion -->
            <?php
                if(!isset($_SESSION["SESION_NOMBRES"])){
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/form_login.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Iniciar Sesión</span></a>
                </li>
            <?php
                }else{                    
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/logout.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Cerrar Sesión</span></a>
                    </li>
                    <?php
                }
            ?>

        </ul>
        <!-- Fin - Sidebar (Menú Izquierdo) -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php
                        //echo $_SESSION["SESION_NOMBRES"]."********************";                        
                        if(isset($_SESSION['SESION_NOMBRES']))                        
                            echo "Bienvenido ".$_SESSION['SESION_NOMBRES']." ".$_SESSION['SESION_APELLIDOS'];
                        else
                            echo "Inicie sesión.";
                        
                    ?>
                    
                </nav>
                <!-- End of Topbar -->
                <!-- End HEAD.PHP -->