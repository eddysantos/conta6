  <footer class="footer">
    <div class="d-flex justify-content-between mx-5">
      <div class="">
        <span class="text-muted">Bienvenido, <b><?php echo $usuario;?>  </b></span>
      </div>
      <div class="">
        <span>Oficina Activa: <b><?php echo $aduana;?></b></span>
      </div>
    </div>
  </footer>


<?php // NOTE: se comenta, porque la barra de navegacion ya cuenta con el archivo de scritps y causa conflicto al querer utilizar barra de navegacion ?>
  <?php
  // require_once $root . "/scripts.php"
  ?>
</body>
</html>
