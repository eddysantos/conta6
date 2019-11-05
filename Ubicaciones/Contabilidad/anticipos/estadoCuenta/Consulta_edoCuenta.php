<html>
<head>
<title>Estado de cuenta</title>
<?php 
	include ("../../../include/conexion.php"); 
	
	$Usuario = trim($_GET['Usuario']);
    $Oficina = trim($_GET['Oficina']);
  
	$sql_Cliente = mysqli_query($link,"select id_cliente,CLI_NOMBRE from TBL_CLIENTES order by CLI_NOMBRE");
	$sql_Corresponsal = mysqli_query($link,"select ID_CORRESP,COR_NOMBRE from TBL_CORRESP_MST WHERE  COR_STATUS = 'A' order by COR_NOMBRE");
?>

<script>
	function objetoAjax(){
		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
	  		}
		}
	
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp = new XMLHttpRequest(); }
		return xmlhttp;
	}
	function Actualiza_Expedido_Cliente(){
		idCliente = document.formAnticipo.Lst_Cliente.value;
		document.formAnticipo.T_Expedido.value = idCliente	
		document.formAnticipo.Lst_Corresponsal.options[0].selected= true;
	}
	function Actualiza_Expedido_Corresponsal(){
		idCliente = document.formAnticipo.Lst_Corresponsal.value;
		document.formAnticipo.T_Expedido.value = idCliente;
		document.formAnticipo.Lst_Cliente.options[0].selected= true;
	}
	
	function Valida(){
		
      if (val_box()){
        fechaInicial = document.formAnticipo.VonDatum.value;
		fechaFinal = document.formAnticipo.VonDatumFF.value;
        ID_Expedidor = document.formAnticipo.T_Expedido.value;
        
    	
		div_inserta = document.getElementById('resultado');
		div_error = document.getElementById('resultadoError');
		
		//instanciamos el objetoAjax
		ajax_inserta=objetoAjax();
									
		ajax_inserta.open("POST", "lst_anticipos.php?fechaInicial="+fechaInicial+'&fechaFinal='+fechaFinal+'&ID_Expedidor='+ID_Expedidor,true);
				
		ajax_inserta.onreadystatechange=function() {
			if (ajax_inserta.readyState==1) {
				div_inserta.innerHTML = "<img src='../../../Imagenes/loader.gif' align='center' /><font size=2 color=#FF0000> Cargando . . .";
			}else if (ajax_inserta.readyState==4){
				mensaje = ajax_inserta.responseText
				if (mensaje.indexOf("Error") > -1){
					div_error.innerHTML = mensaje;
				}else{
					div_inserta.innerHTML = ajax_inserta.responseText;
					document.getElementById('resultadoError').innerHTML ="";
				}

				
			}
		}
				
		ajax_inserta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax_inserta.send(null)
      }
   }
   
   function val_box(){
   
    //comprueba campo de fecha
     if (document.formAnticipo.VonDatum.value=="" ){
         document.getElementById('resultadoError').innerHTML ="Ingrese una fecha";
         document.formAnticipo.VonDatum.focus();
         return false;
      }
	  if (document.formAnticipo.VonDatumFF.value=="" ){
         document.getElementById('resultadoError').innerHTML ="Ingrese una fecha";
         document.formAnticipo.VonDatumFF.focus();
         return false;
      }
    //comprueba campo de Expedido por
	if (document.formAnticipo.T_Expedido.value=="" || document.formAnticipo.T_Expedido.value==null || document.formAnticipo.T_Expedido.value==0){
		document.getElementById('resultadoError').innerHTML ="Seleccione Cliente o Corresponsal";
		document.formAnticipo.Lst_Cliente.focus();
		return false;
      }

      return true;            
   }


</script>
</head>

<body>
<form name="formAnticipo" method="POST" >
<table border="1" width="auto" style="font-family: Trebuchet MS; font-size:10pt; color:#ffffff" align="center" bordercolor="#7F7F7F" cellspacing=1>
	<tr>
		<td bgcolor="#7F7F7F">Cliente</td>
		<td>
			  <select size="1"  onchange="Actualiza_Expedido_Cliente()" name="Lst_Cliente" style="font-family: Trebuchet MS; font-size: 10pt" tabindex=3>
			       <option selected value="0">Seleccione una opci&oacute;n</option>
				<?php while ($oRst_Cliente = mysqli_fetch_array($sql_Cliente)){ ?>
					<option value="<?php echo trim($oRst_Cliente["id_cliente"]);?>"><?php echo trim($oRst_Cliente["CLI_NOMBRE"]);?> ---  <?php echo trim($oRst_Cliente["id_cliente"]);?></option>
				<?php } ?>          
				</select>
		</td>
	</tr>
	<tr>
		<td bgcolor="#7F7F7F">Corresponsal</td>
		<td>
			<select size="1" onChange="Actualiza_Expedido_Corresponsal()" name="Lst_Corresponsal" style="font-family: Trebuchet MS; font-size: 10pt" tabindex=4>
       			<option selected value="0">Seleccione una opci&oacute;n</option>
			<?php while ($oRst_Corresponsal = mysqli_fetch_array($sql_Corresponsal)){ ?>
			    <option value="<?php echo trim($oRst_Corresponsal["ID_CORRESP"]);?>"><?php echo trim($oRst_Corresponsal["COR_NOMBRE"]);?> ---  <?php echo trim($oRst_Corresponsal["ID_CORRESP"]);?></option>
			<?php } ?>	
			</select>
		</td>
	</tr>
	<tr>
		<td bgcolor="#7F7F7F">Fecha Inicial</td>
		<td><Input type="text" id="VonDatum1" name="VonDatum" style="font-family: Trebuchet MS; text-align:center; font-size:10pt; " size=12 Value="" maxlength="12"> dd-mm-aaaa </td>
	</tr>
	<tr>
		<td bgcolor="#7F7F7F">Fecha Final</td>
		<td><Input type="text" id="VonDatum1" name="VonDatumFF" style="font-family: Trebuchet MS; text-align:center; font-size:10pt;" size=12 Value="" maxlength="12"> dd-mm-aaaa </td>
	</tr>
	<tr>
		<td colspan="2" align=center><input type=hidden name="T_Exp_Concepto" readonly>
									<input type=hidden name="T_Expedido" readonly>
									<input type=button value="Consultar" id="Btn_Insert_Ref0" name="Btn_Insert_Ant" onClick="Valida()" style="font-family: Trebuchet MS; font-size: 10pt; color:#000000;" tabindex="7"></td>
	</tr>
</table>
</form>
<div id="resultadoError" style="font-family: Trebuchet MS; font-size:10pt; text-align:center; color:#E52727;" align=center></div>
<div id="resultado" style="font-family: Trebuchet MS; font-size:10pt; text-align:center; color:#E52727;" align=center></div>
</body>
</html>
