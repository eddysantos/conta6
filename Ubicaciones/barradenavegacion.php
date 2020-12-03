<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/Resources/PHP/Utilities/initialScript.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Spectrum WorlWide</title>
  <?php  require $root . '/stylesheets.php'; ?>
</head>
<body>
<!-- <body class="d-flex flex-column h-100"> -->
  <header class="bd-navbar">
    <nav class="navbar flex-column flex-sm-row header" style='background:white'>
      <div class="navbar-collapse">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item dropdown text-left">
            <a href="/Ubicaciones/Bienvenida.php"><img src="/Resources/imagenes/s_rojo.svg" style=' width: 45px;'></a>
            <ul class="dropdown-menu text-center" style="width:220px">
              <select class="w-75">
                <option value="">Aeropuerto</option>
                <option value="">Manzanillo</option>
                <option value="">Nuevo Laredo</option>
                <option value="">Veracruz</option>
              </select>
            </ul>
          </li>

    <!--***************MENU PROLOG  Contabilidad*****************-->
        <?PHP if($oRst_permisos['s_MENU_CONTABILIDAD'] == 1){ ?>
        <li class="nav-item dropdown text-left">
          <a href="#" class="" data-hover="dropdown">CONTABILIDAD <img src="/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
          <ul class="dropdown-menu">
            <?PHP if($oRst_permisos['s_MENU_POLIZAS'] == 1){ ?>
            <li class="dropdown">
              <a href="#" class="">Pólizas <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
              <ul class="dropdown-menu ">
                <li class="dropdown">
                  <?PHP if($oRst_permisos['s_agregar_polizas'] == 1){ ?>
                  <li><a href="/Ubicaciones/Contabilidad/polizas/Generarpoliza.php">Generar</a></li><?php } ?>

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
              <a href="#" class="">Cheques <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
              <ul class="dropdown-menu">

                <?PHP if($oRst_permisos['s_agregar_cheques'] == 1){ ?>
                <li><a href="/Ubicaciones/Contabilidad/cheques/GenerarCheque.php">Generar</a></li><?php } ?>

                <?PHP if($oRst_permisos['s_modifica_cheques'] == 1){ ?>
                <li><a href="#modificar-ch" data-toggle="modal">Modificar</a></li><?php } ?>

                <?PHP if($oRst_permisos['s_consulta_cheques'] == 1){ ?>
                <li><a href="#consultar-ch" data-toggle="modal">Consultar</a></li><?php } ?>
              </ul>
            </li>
            <?PHP } ?>


            <?PHP if($oRst_permisos['s_MENU_ANTICIPOS'] == 1){ ?>
            <li class="dropdown">
              <a href="#" class="">Anticipos <img src="/Resources/iconos/right1.svg"  style="width:10px;"></i></a>
              <ul class="dropdown-menu">
                <?PHP if($oRst_permisos['s_agregar_anticipos'] == 1){ ?>
                <li><a href="/Ubicaciones/Contabilidad/anticipos/GenerarAnticipo.php">Generar</a></li><?PHP } ?>

                <?PHP if($oRst_permisos['s_modifica_anticipos'] == 1){ ?>
                <li><a href="#modificar-ant" data-toggle="modal">Modificar</a></li><?PHP } ?>

                <?PHP if($oRst_permisos['s_consulta_anticipos'] == 1){ ?>
                <li><a href="#consultar-ant" data-toggle="modal">Consultar</a></li><?PHP } ?>

              </ul>
            </li>
            <?PHP } ?>

            <?PHP if($oRst_permisos['s_MENU_FACTURAS'] == 1){ ?>
            <li class="dropdown">
              <a href="#" class="">Factura Electrónica <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
              <ul class="dropdown-menu">
                <?PHP if($oRst_permisos['s_cta_gastos'] == 1){ ?>
                <li><a href="/Ubicaciones/Contabilidad/facturaelectronica/1-CuentaGastos.php">Cuenta de Gastos</a></li><?PHP } ?>
                <?PHP if($oRst_permisos['s_facturas'] == 1){ ?>
                <li class="dropdown">
                  <a href="#" class="">Facturar <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
                  <ul class="dropdown-menu sub">
                    <?PHP if($oRst_permisos['s_facturas_timbrar'] == 1){ ?>
                    <li><a href="/Ubicaciones/Contabilidad/facturaelectronica/3-Generarfactura.php">Timbrar</a></li><?PHP } ?>

                    <?PHP if($oRst_permisos['s_facturas_consultar'] == 1){ ?>
    			          <li><a href="#ConsultarFactura" data-toggle="modal">Consultar</a></li><?PHP } ?>

                    <?PHP if($oRst_permisos['s_facturas_cancelar'] == 1){ ?>
                    <li><a href="#CancelarFactura" data-toggle="modal">Cancelar</a></li><?PHP } ?>
                  </ul>
                </li>
                <?PHP }  if($oRst_permisos['s_facturas_observaciones'] == 1){ ?>
                <li><a href="/Ubicaciones/Contabilidad/facturaelectronica/6-observaciones.php">Observaciones</a></li><?PHP } ?>
              </ul>
            </li>
            <?PHP } ?>

              <?PHP if($oRst_permisos['s_MENU_NOTA_CREDITO'] == 1){ ?>
              <li class="dropdown">
                <a href="#" class="">Nota de Crédito <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
                <ul class="dropdown-menu">
                  <li><a href="/Ubicaciones/Contabilidad/Notacredito/1-notacredito.php">Nota de Crédito</a></li>

                  <?PHP if($oRst_permisos['s_NC_Reportes'] == 1){ ?>
                  <li><a href="/Ubicaciones/Contabilidad/Notacredito/2-Reportes.php">Reportes</a></li><?PHP } ?>
                </ul>
              </li>
              <?PHP } ?>

              <?PHP if($oRst_permisos['s_MENU_RPAGO'] == 1){ ?>
              <li><a href="/Ubicaciones/Contabilidad/Pagos/pagos.php">Pagos</a></li><?PHP } ?>

              <li class="dropdown">
                <a href="#" class="">Administración Contable <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
                <ul class="dropdown-menu">
                  <li><a href="/Ubicaciones/Contabilidad/AdminContable/CatalogoCuentas/index.php">Catálogo de Cuentas</a></li>

                  <?PHP if($oRst_permisos['s_catalogoPersonas'] == 1){ ?>
                  <li><a href="/Ubicaciones/Contabilidad/AdminContable/CatalogoPersonas/">Catálogo de Personas</a></li><?PHP } ?>
                  <li><a href="/Ubicaciones/Contabilidad/AdminContable/Cierredemes.php">Cierre de Mes</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#ReportesCont" data-toggle="modal">Reportes</a>
              </li>
             </ul>
          </li>
          <?php } ?>

    <!--******************************MENU PROLOG  Indice NOMINA******************************-->
        <li class="nav-item dropdown text-left">
          <a href="#" class="">NÓMINA <img src="/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
          <ul class="dropdown-menu">
          <?PHP if($oRst_permisos['s_nom_empleados'] == 1){ ?>
            <li><a href="/Ubicaciones/Nomina/empleados">Empleados</a></li><?php } ?>
          <?PHP if($oRst_permisos['s_nom_suel'] == 1){ ?>
            <li><a href="/Ubicaciones/Nomina/SueldosySalarios/Generar_Nomina.php">Nómina Sueldos y Salarios CFDI</a></li><?php } ?>
          <?PHP if($oRst_permisos['s_nom_has'] == 1){ ?>
            <li><a href="/Ubicaciones/Nomina/Honorarios/Generar_Nomina.php">Nómina Honorarios Asimilados CFDI</a></li><?php } ?>
          <?PHP if($oRst_permisos['s_datos_oficinas_mod'] == 1){ ?>
            <li><a href="/Ubicaciones/Nomina/DatosOficina/DatosOficina.php">Datos de Oficina</a></li><?php } ?>
          <?PHP if($oRst_permisos['s_nom_reportes'] == 1){ ?>
            <li><a href="/Ubicaciones/Nomina/Reportes/Reporte.php">Reportes</a></li><?php } ?>
          </ul>
    <!--******************************MENU PROLOG  Indice TRAFICO******************************-->
         <li class="nav-item dropdown text-left">
           <a href="#" class="">TRÁFICO <img src="/Resources/iconos/3down.svg" alt="logo" style="width:13px;"></a>
           <ul class="dropdown-menu">
             <li><a href="/Ubicaciones/Trafico/SolicitudAnticipo/SolAnticipo.php">Solicitud de Anticipo</a></li>
             <li><a href="/Ubicaciones/Trafico/NotasRemision/NotasRemision.php">Notas de Remisión</a></li>
             <li class="dropdown">
               <a href="" class="">Admón. Tarifas Almacenes <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
               <ul class="dropdown-menu">
                 <li><a href="/Ubicaciones/Trafico/TarifasAlmacenes/Conceptos.php">Conceptos</a></li>
                 <li><a href="/Ubicaciones/Trafico/TarifasAlmacenes/Tarifas.php">Tarifas</a></li>
               </ul>
             </li>
             <li class="dropdown">
               <a href="#" class="">Admón. Tarifas Clientes <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
               <ul class="dropdown-menu">
                 <li><a href="/Ubicaciones/Trafico/TarifasClientes/Conceptos.php">Conceptos</a></li>
                 <li><a href="/Ubicaciones/Trafico/TarifasClientes/Tarifas.php">Tarifas</a></li>
               </ul>
               <li><a href="#MonitordeOficinas" data-toggle="modal">Monitor de Oficinas</a></li>
             </li>
           </ul>
    <!--******************************MENU PROLOG  Indice CUENTAS AMERICANAS*************************************-->
          <li class="nav-item dropdown text-left">
            <a href="#" class="">CUENTAS  AMERICANAS <img src="/Resources/iconos/3down.svg" alt="logo"  style="width:13px;"></a>
            <ul class="dropdown-menu">
              <li><a href="/Ubicaciones/CuentasAmericanas/CuentaGastos/CuentaGastos.php">Cuentas de Gastos</a></li>
              <li class="dropdown">
                <a href="/Ubicaciones/CuentasAmericanas/AdminClientes/AdministrarClientes.php" class="">Administración de Clientes</a>
              </li>
              <li class="dropdown">
                <a href="#" class="">Administración de Tarifas <img src="/Resources/iconos/right1.svg"  style="width:10px;"></a>
                <ul class="dropdown-menu">
                  <li><a href="/Ubicaciones/CuentasAmericanas/AdminTarifas/Catalogo.php">Catálogos</a></li>
                  <li><a href="#">Conceptos de Tarifas</a></li>
                  <li><a href="#">Tarifas</a></li>
                </ul>
                <li><a href="#">Reportes</a></li>
              </li>
            </ul>
          </li>
          <li class="nav-item text-left"><a href="#">SOPORTE</a></li>
          <li class="nav-item text-left"><a href="/Resources/PHP/Utilities/cerrarSesion.php">CERRAR SESION</a></li>
        </ul>
        </li>
        </li>
      </div>
    </nav>
  </header>

<?php
  require $root . '/Ubicaciones/Contabilidad/modales/ImprimirPolizas.php';
  require $root . '/Ubicaciones/Contabilidad/Reportes/modales/ModalRepo.php';
  require $root . '/Ubicaciones/Contabilidad/modales/ModificarConsultar.php';
  require $root . '/Ubicaciones/Contabilidad/facturaelectronica/modales/ConsultarFactura.php';
  require $root . '/Ubicaciones/Trafico/modales/MonitordeOficinas.php';
  require $root . '/scripts.php';

?>
<script src="/Resources/js/navbar.js"></script>
