<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/conta6/Resources/PHP/Utilities/initialScript.php';


$marginbottom = "margin-bottom:100px!important";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Proyeccion Logistica Agencia Aduanal S.A de C.V</title>

<!--****************ESTILOS****************-->

  <link rel="stylesheet" href="/conta6/Resources/fontAwesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/conta6/Resources/css/inputs.css">
  <link rel="stylesheet" href="/conta6/Resources/css/Modulo1.css">
  <!-- <link rel="stylesheet" href="/conta6/Resources/css/Modulo2.css">
  <link rel="stylesheet" href="/conta6/Resources/css/Modulo3.css"> -->
  <link rel="stylesheet" href="/conta6/Resources/css/barraNavegacion.css">
  <link rel="stylesheet" href="/conta6/Resources/css/modals.css">
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/css/reset.css">
  <link rel="stylesheet" href="/conta6/Resources/css/bienvenida.css">
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/css/bootstrap-toggle.css">
  <link rel="stylesheet" href="/conta6/Resources/css/sweetalert.css">
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="/conta6/Resources/bootstrap/alertifyjs/css/themes/default.css">

<!--***************SCRIPTS*****************-->
  <script src="/conta6/Resources/JQuery/jquery.min.js"></script>
  <script src="/conta6/Resources/bootstrap/alertifyjs/alertify.min.js"></script>
  <script src="/conta6/Resources/JQuery/sweetalert.min.js"></script>
  <script src="/conta6/Resources/JQuery/popper.min.js"></script>
  <script src="/conta6/Resources/JQuery/tether.min.js"></script>
  <script src="/conta6/Resources/bootstrap/js/bootstrap.min.js"></script>
  <script src="/conta6/Resources/js/menuresponsive.js"></script>



</head>
  <header class="container-fluid p-0">

    <nav class="navbar navbar-fixed-top p-0">
      <div class="container-fluid">
        <div class="navbar-header"></div>
        <div class="navbar-collapse m-0" id="menu">
          <ul class="nav nav-pills nav-fill">
            <li class="nav-item dropdown">
              <a href="#"><img src="/conta6/Resources/imagenes/cheetah.svg"  class="logo"></a>
              <ul class="dropdown-menu" style="width:220px">
                <select class="w-75 ml-5">
                  <option value="">Aeropuerto</option>
                  <option value="">Manzanillo</option>
                  <option value="">Nuevo Laredo</option>
                  <option value="">Veracruz</option>
                </select>
              </ul>
            </li>

<!--***************MENU PROLOG  Contabilidad*****************-->
            <?PHP if($oRst_permisos['s_MENU_CONTABILIDAD'] == 1){ ?>
			      <li class="nav-item dropdown">
              <a href="#" class="" data-hover="dropdown">CONTABILIDAD <img src="/conta6/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
              <ul class="dropdown-menu">


                <?PHP if($oRst_permisos['s_MENU_POLIZAS'] == 1){ ?>
			          <li class="dropdown">
                  <a href="#" class="">Pólizas <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu ">
                    <li class="dropdown">

                      <?PHP if($oRst_permisos['s_agregar_polizas'] == 1){ ?>
                      <li><a href="/conta6/Ubicaciones/Contabilidad/polizas/Generarpoliza.php">Generar</a></li><?php } ?>

                      <?PHP if($oRst_permisos['s_modifica_polizas'] == 1){ ?>
                      <li><a href="" data-toggle='modal' data-target='#modificar-pol'>Modificar</a></li><?php } ?>

                      <?PHP if($oRst_permisos['s_consulta_polizas'] == 1){ ?>
                      <li><a href="#consultar-pol" data-toggle="modal">Consultar</a></li><?php } ?>

                      <?PHP if($oRst_permisos['s_catalogoPersonasPROV_asignar'] == 1){ ?>
                      <li><a href="#asignar-proveedor" data-toggle="modal">Asignar proveedor</a></li><?php } ?>

                      <?PHP if($oRst_permisos['s_imprimir_polizas_periodo'] == 1){ ?>
                      <li><a href="#imprimir-pol" data-toggle="modal">Imprimir Pólizas</a></li><?php } ?>

                    </li>
                  </ul>
                </li>
                <?php } ?>


                <?PHP if($oRst_permisos['s_MENU_CHEQUES'] == 1){ ?>
                <li class="dropdown">
                  <a href="#" class="">Cheques <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">

                    <?PHP if($oRst_permisos['s_agregar_cheques'] == 1){ ?>
                    <li><a href="/conta6/Ubicaciones/Contabilidad/cheques/GenerarCheque.php">Generar</a></li><?php } ?>

                    <?PHP if($oRst_permisos['s_modifica_cheques'] == 1){ ?>
                    <li><a href="#modificar-ch" data-toggle="modal">Modificar</a></li><?php } ?>

                    <?PHP if($oRst_permisos['s_consulta_cheques'] == 1){ ?>
                    <li><a href="#consultar-ch" data-toggle="modal">Consultar</a></li><?php } ?>

                    <!-- <?PHP if($oRst_permisos['s_benef_cheques'] == 1){ ?>
				          	<li><a href="/conta6/Ubicaciones/Contabilidad/cheques/beneficiarios/Catalogo.php">Beneficiarios</a></li><?PHP } ?> -->

                  </ul>
                </li>
                <?PHP } ?>


                <?PHP if($oRst_permisos['s_MENU_ANTICIPOS'] == 1){ ?>
                <li class="dropdown">
                  <a href="#" class="">Anticipos <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></i></a>
                  <ul class="dropdown-menu">
                    <?PHP if($oRst_permisos['s_agregar_anticipos'] == 1){ ?>
                    <li><a href="/conta6/Ubicaciones/Contabilidad/anticipos/GenerarAnticipo.php">Generar</a></li><?PHP } ?>

                    <?PHP if($oRst_permisos['s_modifica_anticipos'] == 1){ ?>
                    <li><a href="#modificar-ant" data-toggle="modal">Modificar</a></li><?PHP } ?>

                    <?PHP if($oRst_permisos['s_consulta_anticipos'] == 1){ ?>
                    <li><a href="#consultar-ant" data-toggle="modal">Consultar</a></li><?PHP } ?>

                  </ul>
                </li>
                <?PHP } ?>


                <?PHP if($oRst_permisos['s_MENU_FACTURAS'] == 1){ ?>
                <li class="dropdown">
                  <a href="#" class="">Factura Electrónica <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">

                    <?PHP if($oRst_permisos['s_cta_gastos'] == 1){ ?>
                    <li><a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/1-CuentaGastos.php">Cuenta de Gastos</a></li><?PHP } ?>

                    <?PHP if($oRst_permisos['s_facturas'] == 1){ ?>
                    <li class="dropdown">
                      <a href="#" class="">Facturar <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                      <ul class="dropdown-menu sub">
                        <?PHP if($oRst_permisos['s_facturas_timbrar'] == 1){ ?>
                        <li><a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/3-Generarfactura.php">Timbrar</a></li><?PHP } ?>

                        <?PHP if($oRst_permisos['s_facturas_consultar'] == 1){ ?>
    					          <li><a href="#ConsultarFactura" data-toggle="modal">Consultar</a></li><?PHP } ?>

                        <?PHP if($oRst_permisos['s_facturas_cancelar'] == 1){ ?>
                        <li><a href="#CancelarFactura" data-toggle="modal">Cancelar</a></li><?PHP } ?>

                      </ul>
                    </li>
                    <?PHP } ?>

                    <?PHP if($oRst_permisos['s_facturas_observaciones'] == 1){ ?>
                      <li><a href="/conta6/Ubicaciones/Contabilidad/facturaelectronica/6-observaciones.php">Observaciones</a></li><?PHP } ?>
                  </ul>
                </li>
                <?PHP } ?>

                <?PHP if($oRst_permisos['s_MENU_NOTA_CREDITO'] == 1){ ?>
                <li class="dropdown">
                  <a href="#" class="">Nota de Crédito <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">
                    <li><a href="/conta6/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php">Nota de Crédito</a></li>

                    <?PHP if($oRst_permisos['s_NC_Reportes'] == 1){ ?>
                    <li><a href="/conta6/Ubicaciones/Contabilidad/Notacredito/2-Reportes.php">Reportes</a></li><?PHP } ?>
                  </ul>
                </li>
                <?PHP } ?>

                <?PHP if($oRst_permisos['s_MENU_RPAGO'] == 1){ ?>
                <li><a href="/conta6/Ubicaciones/Contabilidad/Pagos/pagos.php">Pagos</a></li><?PHP } ?>
                <!-- <li><a href="/conta6/Ubicaciones/Contabilidad/controlpedimentos/PedimentosCapturados.php">Control Pedimentos Pag.</a></li> -->
                <!-- <li class="dropdown">
                  <a href="#" class="">Cuenta de Gastos <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">
                    <li><a href="/conta6/Ubicaciones/Contabilidad/CuentaGastos/consultarCtaGtos.php" >Consultar</a></li>
                  </ul>
                </li> -->

                <li class="dropdown">
                  <a href="#" class="">Administración Contable <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">
                    <li><a href="/conta6/Ubicaciones/Contabilidad/AdminContable/catalogocuentas.php">Catálogo de Cuentas</a></li>

                    <?PHP if($oRst_permisos['s_catalogoPersonas'] == 1){ ?>
                    <li><a href="/conta6/Ubicaciones/Contabilidad/AdminContable/catalogopersonas.php">Catálogo de Personas</a></li><?PHP } ?>

                    <!-- <li><a href="/conta6/Ubicaciones/Contabilidad/AdminContable/Corresponsales.php">Corresponsales</a></li> -->
                    <li><a href="/conta6/Ubicaciones/Contabilidad/AdminContable/Cierredemes.php">Cierre de Mes</a></li>
                  </ul>
                </li>
                <!-- <li class="dropdown">
                  <a href="#" class="">Proveedores <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu">
                    <li><a href="/conta6/Ubicaciones/Contabilidad/Proveedores/Catalogo.php">Catálogo</a></li>
                  </ul>
                </li> -->
                <li class="dropdown">
                  <a href="#ReportesCont" data-toggle="modal">Reportes</a>
                </li>
               </ul>
            </li>
            <?php } ?>

<!--******************************MENU PROLOG  Indice NOMINA******************************-->
              <li class="nav-item dropdown">
                <a href="#" class="">NÓMINA <img src="/conta6/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
                <ul class="dropdown-menu">
                  <!-- <li class="dropdown">
                    <a href="" class="">Sueldos y Salarios CFDI <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                    <ul class="dropdown-menu">
                      <li><a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/empleados/Empleados.php">Empleados</a></li>
                      <li><a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/GenerarNominaCFDI.php">Nomina</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="" class="">Honorarios Asimilados CFDI <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                    <ul class="dropdown-menu">
                      <li><a href="/conta6/Ubicaciones/Nomina/Honorarios/Empleados.php">Empleados</a></li>
                      <li><a href="/conta6/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php">Nomina</a></li>
                    </ul>
                  </li> -->
                  <li><a href="/Conta6/Ubicaciones/Nomina/empleados/Empleados.php">Empleados</a></li>
                  <li><a href="/conta6/Ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php">Nómina Sueldos y Salarios CFDI</a></li>
                  <li><a href="/conta6/Ubicaciones/Nomina/Honorarios/GenerarNominaCFDI.php">Nómina Honorarios Asimilados CFDI</a></li>
                  <li><a href="/conta6/Ubicaciones/Nomina/DatosOficina/DatosOficina.php">Datos de Oficina</a></li>
                  <li><a href="/conta6/Ubicaciones/Nomina/Reportes/Reporte.php">Reportes</a></li>

                </ul>
<!--******************************MENU PROLOG  Indice TRAFICO******************************-->
               <li class="nav-item dropdown">
                 <a href="#" class="">TRÁFICO <img src="/conta6/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
                 <ul class="dropdown-menu">
                   <li><a href="/conta6/Ubicaciones/Trafico/SolicitudAnticipo/SolAnticipo.php">Solicitud de Anticipo</a></li>
                   <li><a href="/conta6/Ubicaciones/Trafico/NotasRemision/NotasRemision.php">Notas de Remisión</a></li>
                   <li class="dropdown">
                     <a href="" class="">Admón. Tarifas Almacenes <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                     <ul class="dropdown-menu">
                       <li><a href="/conta6/Ubicaciones/Trafico/TarifasAlmacenes/Conceptos.php">Conceptos</a></li>
                       <li><a href="/conta6/Ubicaciones/Trafico/TarifasAlmacenes/Tarifas.php">Tarifas</a></li>
                     </ul>
                   </li>
                   <li class="dropdown">
                     <a href="#" class="">Admón. Tarifas Clientes <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                     <ul class="dropdown-menu">
                       <li><a href="/conta6/Ubicaciones/Trafico/TarifasClientes/Conceptos.php">Conceptos</a></li>
                       <li><a href="/conta6/Ubicaciones/Trafico/TarifasClientes/Tarifas.php">Tarifas</a></li>
                     </ul>
                     <li><a href="#MonitordeOficinas" data-toggle="modal">Monitor de Oficinas</a></li>
                   </li>
                 </ul>
<!--******************************MENU PROLOG  Indice CUENTAS AMERICANAS*************************************-->
                <li class="nav-item dropdown">
                  <a href="#" class="">CUENTAS  AMERICANAS <img src="/conta6/Resources/iconos/3down.svg" alt="logo"  style="width:13px;"></a>
                  <ul class="dropdown-menu">
                    <li><a href="/conta6/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">Cuentas de Gastos</a></li>
                    <li class="dropdown">
                      <a href="/conta6/Ubicaciones/CuentasAmericanas/AdminClientes/AdministrarClientes.php" class="">Administración de Clientes</a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="">Administración de Tarifas <img src="/conta6/Resources/iconos/right1.svg"  style="width:10px;"></a>
                      <ul class="dropdown-menu">
                        <li><a href="/conta6/Ubicaciones/CuentasAmericanas/AdminTarifas/Catalogo.php">Catálogos</a></li>
                        <li><a href="#">Conceptos de Tarifas</a></li>
                        <li><a href="#">Tarifas</a></li>
                      </ul>
                      <li><a href="#">Reportes</a></li>
                    </li>
                  </ul>
                </li>
                <!-- <li class="nav-item"><a href="#">OFICINA</a></li> -->
                <li class="nav-item"><a href="#">SOPORTE</a></li>
                <li class="nav-item"><a href="/conta6/Resources/PHP/Utilities/cerrarSesion.php">CERRAR SESION</a></li>
              </ul>
              </li>
              </li>
            </div>
          </div>
        </nav>
        <script src="/conta6/Resources/js/navbar.js"></script>
      </header>

  <?php

    require $root . '/conta6/Ubicaciones/Contabilidad/modales/ImprimirPolizas.php';
    require $root . '/conta6/Ubicaciones/Contabilidad/Reportes/modales/ModalRepo.php';
    require $root . '/conta6/Ubicaciones/Contabilidad/modales/Modificarconsultar.php';
    require $root . '/conta6/Ubicaciones/Contabilidad/facturaelectronica/modales/ConsultarFactura.php';
    require $root . '/conta6/Ubicaciones/Trafico/modales/MonitordeOficinas.php';
  ?>
