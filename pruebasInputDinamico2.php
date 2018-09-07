<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script>
$(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
});

</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>
<body>
  <table border="1">
    <tr id="fila0">
      <td>Columna 1.1</td>
      <td>Columna 1.2</td>
      <td>Columna 1.3</td>
      <td>Columna 1.4</td>
      <td>Columna 1.5</td>
      <td>Columna 1.6</td>
      <td><input type="button" class="borrar" value="Eliminar" /></td>
    </tr>
    <tr id="fila1">
      <td>Columna 2.1</td>
      <td>Columna 2.2</td>
      <td>Columna 2.3</td>
      <td>Columna 2.4</td>
      <td>Columna 2.5</td>
      <td>Columna 2.6</td>
      <td><input type="button" class="borrar" value="Eliminar" /></td>
    </tr>
    <tr id="fila2">
      <td>Columna 3.1</td>
      <td>Columna 3.2</td>
      <td>Columna 3.3</td>
      <td>Columna 3.4</td>
      <td>Columna 3.5</td>
      <td>Columna 3.6</td>
      <td><input type="button" class="borrar" value="Eliminar" /></td>
    </tr>
    <tr id="fila3">
      <td>Columna 4.1</td>
      <td>Columna 4.2</td>
      <td>Columna 4.3</td>
      <td>Columna 4.4</td>
      <td>Columna 4.5</td>
      <td>Columna 4.6</td>
      <td><input type="button" class="borrar" value="Eliminar" /></td>
    </tr>
    <tr id="fila4">
      <td>Columna 5.1</td>
      <td>Columna 5.2</td>
      <td>Columna 5.3</td>
      <td>Columna 5.4</td>
      <td>Columna 5.5</td>
      <td>Columna 5.6</td>
      <td><input type="button" class="borrar" value="Eliminar" /></td>
    </tr>
  </table>
</body>
</html>