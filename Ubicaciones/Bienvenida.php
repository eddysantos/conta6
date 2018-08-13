<?php
  include 'barradenavegacion.php';
  session_start();
?>

  <section class="bienvenida">
    <div class="text-center">
      <h1>Hola, <?php echo $_SESSION['u_usuario']; ?></h1>
      <h2>Bienvenido a <span>Proyección Logistica</span></h2>
      <h2>Agencia Aduanal</h2>
      <span id="cargando"></span>
    </div>
  </section>
