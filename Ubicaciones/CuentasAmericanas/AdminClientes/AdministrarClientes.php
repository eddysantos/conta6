<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root . '/conta6/Ubicaciones/barradenavegacion.php';
?>


<div class="container-fluid text-center">
  <div class="row submenuMed m-0">
    <ul class="nav nav-pills nav-fill w-100" id="selecTipoPoliza">
      <li class="nav-item">
        <a class="nav-link adminclientes" id="submenuMed" accion="ca-generar" status="cerrado">GENERAR</a>
      </li>
      <li class="nav-item">
        <a class="nav-link adminclientes" id="submenuMed" accion="ca-modificar" status="cerrado">MODIFICAR</a>
      </li>
      <li class="nav-item">
        <a class="nav-link adminclientes" id="submenuMed" accion="ca-consultar" status="cerrado">CONSULTAR</a>
      </li>
      <li class="nav-item">
        <a class="nav-link adminclientes" id="submenuMed" accion="ca-creditos" status="cerrado">CRÉDITOS</a>
      </li>
    </ul>
  </div>

  <!--Comienza Generar Clientes en Cuenta Americana-->
  <div id="cta-Generar" class="contorno" style="display:none">
    <table class="table form1">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12">Datos del Cliente</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row mt-5">
          <td class="col-md-6 input-effect">
            <input id="ca-nombre" class="efecto " type="text">
            <label for="ca-nombre">Nombre</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-idcliente" class="efecto tiene-contenido" type="text" disabled>
            <label for="ca-idcliente">ID Cliente</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-taxid" class="efecto" type="text">
            <label for="ca-taxid">TAX ID</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-calle" class="efecto" type="text">
            <label for="ca-calle">Calle</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-numext" class="efecto" type="text">
            <label for="ca-numext">Num Exterior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-numint" class="efecto" type="text">
            <label for="ca-numint">Num Interior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-colonia" class="efecto" type="text">
            <label for="ca-colonia">Colonia</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-ciudad" class="efecto" type="text">
            <label for="ca-ciudad">Ciudad</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-estado" class="efecto" type="text">
            <label for="ca-estado">Estado</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-codigo" class="efecto" type="text">
            <label for="ca-codigo">Código</label>
          </td>
          <td class="col-md-3 input-effect">
            <input  list="lista-pais" class="efecto"  id="ca-pais">
            <datalist id="lista-pais">
              <option value="AFGANISTAN"></option>
              <option value="BULGARIA"></option>
              <option value="CAMBOYA"></option>
              <option value="CHILE"></option>
              <option value="ESPAÑA"></option>
              <option value="ESTADOS UNIDOS"></option>
              <option value="JAPÓN"></option>
              <option value="MÉXICO"></option>
            </datalist>
            <label for="ca-pais">País</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-telefono" class="efecto" type="text">
            <label for="ca-telefono">Telefono</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-fax" class="efecto" type="text">
            <label for="ca-fax">Fax</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="lista-vendedor" class="efecto" id="ca-vendedor">
            <datalist id="lista-vendedor">
              <option value="CARLOS ALBERTO"></option>
              <option value="ESTELA"></option>
              <option value="GUSTAVO MARIO"></option>
              <option value="IVAN"></option>
              <option value="LEONARDO"></option>
              <option value="NATALIA"></option>
              <option value="NEMER"></option>
              <option value="OSCAR EDUARDO"></option>
              <option value="OSCAR GERARDO"></option>
              <option value="ROBERTO"></option>
              <option value="SERGIO"></option>
              <option value="VIRIDIANA SARAI"></option>
            </datalist>
            <label for="ca-vendedor">Vendedor</label>
          </td>
        </tr>
        <tr class="row borderojo mt-4">
          <td class="col-md-3 input-effect mb-4">
            <input id="ca-contacto" class="efecto" type="text">
            <label for="ca-contacto">Contacto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-email" class="efecto" type="text">
            <label for="ca-email">E-mail</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-repre" class="efecto" type="text">
            <label for="ca-repre">Representante Legal</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-rfc" class="efecto" type="text">
            <label for="ca-rfc">RFC</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <select class="custom-select">
              <option>Estatus</option>
              <option>ACTIVO</option>
              <option>INACTIVO</option>
            </select>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-observaciones" class="efecto" type="text">
            <label for="ca-observaciones">Observaciones</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-genero" class="efecto tiene-contenido" type="text" value="ESTEFANIA" disabled>
            <label for="ca-genero">Generó</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-modifico" class="efecto tiene-contenido" type="text" disabled>
            <label for="ca-modifico">Modificó</label>
          </td>
        </tr>
        <tr class="row">
          <td class="col-md-2 offset-md-5">
            <a href="" class="boton mt-5"><img src= "/conta6/Resources/iconos/save.svg" class="icochico"> GUARDAR</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Diario-->

  <!--Comienza Modificar Clientes en Cuenta Americana-->
  <div id="cta-Modificar" class="contorno" style="display:none">
    <table class="table">
      <tr class="row">
        <td class="col-md-6 offset-md-3">
          <select class="custom-select">
            <option>Seleccione un Cliente</option>
            <option>BABCOCK & WILCOX POWER --- CLA_2</option>
            <option>BABCOCK & WILCOX COMPANY --- CLA_7</option>
            <option>DIAMOND POWER INTERNATIONAL, INC --- CLA_5</option>
            <option>FIRMENICH INCORPORATED ---  CLA_3</option>
            <option>GOLDEN PEANUT COMPANY --- CLA_4</option>
            <option>GRETE T HOYOS --- CLA_6</option>
            <option>MAHLE FILTER SYSTEMS NORTH AMERICA, INC --- CLA_8</option>
            <option>SASIND AVIATION, INC --- CLA_9</option>
          </select>
        </td>
      </tr>
    </table>
    <table class="table form1">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12 ">Modificar Datos del Cliente</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row mt-5">
          <td class="col-md-6 input-effect">
            <input id="ca-nombre1" class="efecto tiene-contenido" type="text" value="BABCOCK & WILCOX POWER">
            <label for="ca-nombre1">Nombre</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-idcliente1" class="efecto tiene-contenido" type="text" disabled>
            <label for="ca-idcliente1">ID Cliente</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-taxid1" class="efecto tiene-contenido" type="text">
            <label for="ca-taxid1">TAX ID</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-calle1" class="efecto tiene-contenido" type="text">
            <label for="ca-calle1">Calle</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-numext1" class="efecto tiene-contenido" type="text">
            <label for="ca-numext1">Num Exterior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-numint1" class="efecto tiene-contenido" type="text">
            <label for="ca-numint1">Num Interior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-colonia1" class="efecto tiene-contenido" type="text">
            <label for="ca-colonia1">Colonia</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-ciudad1" class="efecto tiene-contenido" type="text">
            <label for="ca-ciudad1">Ciudad</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-estado1" class="efecto tiene-contenido" type="text">
            <label for="ca-estado1">Estado</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-codigo1" class="efecto tiene-contenido" type="text">
            <label for="ca-codigo1">Código</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido" id="ca-pais1" type="text" value="USA" disabled>
            <label for="ca-pais1">País</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-3 input-effect">
            <input id="ca-telefono1" class="efecto tiene-contenido" type="text">
            <label for="ca-telefono1">Telefono</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-fax1" class="efecto tiene-contenido" type="text">
            <label for="ca-fax1">Fax</label>
          </td>
          <td class="col-md-6 input-effect">
            <input  list="lista-vendedor" class="efecto tiene-contenido" id="ca-vendedor1">
            <datalist id="lista-vendedor"></datalist>
            <label for="ca-vendedor1">Vendedor</label>
          </td>
        </tr>
        <tr class="row mt-4 borderojo">
          <td class="col-md-3 input-effect mb-3">
            <input id="ca-contacto1" class="efecto tiene-contenido" type="text">
            <label for="ca-contacto1">Contacto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-email1" class="efecto tiene-contenido" type="text">
            <label for="ca-email1">E-mail</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-repre1" class="efecto tiene-contenido" type="text">
            <label for="ca-repre1">Representante Legal</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-rfc1" class="efecto tiene-contenido" type="text">
            <label for="ca-rfc1">RFC</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input  list="lista-status" class="efecto tiene-contenido" id="ca-status1">
            <datalist id="lista-status"></datalist>
            <label for="ca-status1">Estatus</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-obs1" class="efecto tiene-contenido" type="text">
            <label for="ca-obs1">Observaciones</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-genero1" class="efecto tiene-contenido" type="text" value="ESTEFANIA" disabled>
            <label for="ca-genero1">Generó</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="ca-modifico1" class="efecto tiene-contenido" type="text"  disabled>
            <label for="ca-modifico1">Modificó</label>
          </td>
        </tr>
        <tr class="row mt-4">
          <td class="col-md-2 offset-md-5">
            <a href="" class="boton"><img src= "/conta6/Resources/iconos/003-edit.svg" class="icochico"> MODIFICAR</a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->

<!--Comienza Consultar Clientes en Cuenta Americana-->
  <div id="cta-Consultar" class="contorno" style="display:none">
    <table class="table">
      <tr class="row">
        <td class="col-md-6 offset-md-3">
          <select class="custom-select">
            <option>Seleccione un Cliente</option>
            <option>BABCOCK & WILCOX POWER --- CLA_2</option>
            <option>BABCOCK & WILCOX COMPANY --- CLA_7</option>
            <option>DIAMOND POWER INTERNATIONAL, INC --- CLA_5</option>
            <option>FIRMENICH INCORPORATED ---  CLA_3</option>
            <option>GOLDEN PEANUT COMPANY --- CLA_4</option>
            <option>GRETE T HOYOS --- CLA_6</option>
            <option>MAHLE FILTER SYSTEMS NORTH AMERICA, INC --- CLA_8</option>
            <option>SASIND AVIATION, INC --- CLA_9</option>
          </select>
        </td>
      </tr>
    </table>
    <table class="table form1">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-12 ">Consultar Cliente</td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row mt-5">
          <td class="col-md-6 input-effect">
            <input class="efecto tiene-contenido border-0" type="text" value="BABCOCK & WILCOX POWER" disabled>
            <label>Nombre</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text" disabled>
            <label>ID Cliente</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>TAX ID</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Calle</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Num Exterior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Num Interior</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Colonia</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Ciudad</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Estado</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Código</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class=" efecto  tiene-contenido border-0" disabled type="text" value="USA">
            <label>País</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Telefono</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Fax</label>
          </td>
          <td class="col-md-6 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Vendedor</label>
          </td>
        </tr>
        <tr class="row mt-5 borderojo">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Contacto</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>E-mail</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Representante Legal</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>RFC</label>
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Estatus</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Observaciones</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text" value="ESTEFANIA">
            <label>Generó</label>
          </td>
          <td class="col-md-3 input-effect">
            <input class="efecto tiene-contenido border-0" disabled type="text">
            <label>Modificó</label>
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->

  <div id="cta-credito" class="contorno" style="display:none">
    <table class="table form1">
      <thead class="font18">
        <tr class="row encabezado">
          <td class="col-md-6 text-left">Agregar Credito a Cliente</td>
          <td class="col-md-3 offset-md-3">
            <a href="#creditos"  data-toggle="modal" class="boton"><img class="icochico" src="/conta6/Resources/iconos/magnifier.svg"> REVISAR CREDITOS</a>
          </td>
        </tr>
      </thead>
      <tbody class="font14">
        <tr class="row mt-5">
          <td class="col-md-8 input-effect ml-5">
            <input  list="lista-cltPla" class="efecto" id="clientespla">
            <datalist id="lista-cltPla">
              <option value="Comite Organizador de los Juegos Panamericanos Guadalajara 2011 -- CLT_7417"></option>
              <option value="Congeladora y Distribuidora de Pescados y Mariscos, S.A de C.V -- CLT_6336"></option>
              <option value="Representaciones Asesoria Mantenimiento y Servicios Anexos S.A de C.V -- CLT_6921"></option>
              <option value="Servicios Integrales en Logistica Internacional, Aduanas y Tecnologia, S.C -- CLT_7158"></option>
              <option value="Tecnologias Relacionadas con Energia y Servicios Especializados S.A de C.V -- CLT_7517"></option>
            </datalist>
            <label for="clientespla">Clientes Proyección Logistica</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="dcreditoPLA" class="efecto" type="text">
            <label for="dcreditoPLA">Días de Credito</label>
          </td>
          <td class="text-left">
            <a href=""><img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
        <tr class="row mt-5">
          <td class="col-md-8 input-effect ml-5">
            <input  list="lista-cltIM" class="efecto" id="clientesIM">
            <datalist id="lista-cltIM">
              <option value="Babcock & Wilcox Power -- CLA_2"></option>
              <option value="Diamond Power International, Inc. -- CLA_5"></option>
              <option value="Firmenich Incorporated -- CLA_3"></option>
              <option value="Franklin Electric Manufacturing, Inc. -- CLA_1"></option>
              <option value="Golden Peanut Company -- CLA_4"></option>
              <option value="Grete T Hoyos -- CLA_6"></option>
            </datalist>
            <label for="clientesIM">Clientes IM International</label>
          </td>
          <td class="col-md-3 input-effect">
            <input id="dcreditoIM" class="efecto" type="text">
            <label for="dcreditoIM">Días de Credito</label>
          </td>
          <td class="text-left">
            <a href=""><img src= "/conta6/Resources/iconos/save.svg" class="icomediano"></a><!--nueva pagina, ingresar datos en poliza-->
          </td>
        </tr>
      </tbody>
    </table>
  </div><!--/Termina Generar Poliza de Ingreso-->
</div><!--/Termina Container FLuid-->



<script src="js/AdministrarClientes.js"></script>
<?php require_once('modales/AdminClientes.php'); ?>
