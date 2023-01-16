<!-- CONTENT -->
<?php 
use App\Models\ConfiguracionModel;
use App\Models\ExpedientesModel;
	$modelConfig = new ConfiguracionModel();
	$modelExp = new ExpedientesModel();
	$db = \Config\Database::connect();
	
	$uri = new \CodeIgniter\HTTP\URI();
	$request = \Config\Services::request();
	$id_sol =  $request->uri->getSegment(3);
	$data['configuracion'] = $modelConfig->where('tipo_tramite', 'iDigital')->first();	
	$data['expedientes'] = $modelExp->where('id', $id_sol)->first();
?>
<section>
    <fieldset>
<h5><b><?php echo lang('message_lang.destino_solicitud');?></b>: <?php echo lang('message_lang.idi');?></h5>
<h5><b><?php echo lang('message_lang.codigo_dir3');?>DIR3</b>: A04003714</h5>
   </fieldset> 

<div class="alert alert-info">
<?php echo lang('message_lang.subtitulo_sol_idigital');?>
</div>

<div >
<blockquote cite="https://www.caib.es/seucaib/ca/200/persones/tramites/tramite/4078108">
<?php echo lang('message_lang.intro_sol_idigital');?>
</blockquote>
</div>

<script>
$(document).ready(function(){
	var focus = 0,
		blur = 0;
		$("#info_insercion").hide();
		$("#nomllinatges").focus();
		$("#nomllinatges").focusout(function() {
		var inputValue = $(this).val();
		var txt = "";
		
		if (inputValue == "" || document.getElementById("nomllinatges").validity.patternMismatch)
			{
			txt = "Hauria de ser un nom vàlid !!!";
			document.getElementById("mensaje").innerHTML = txt;			
			$("#nomllinatges").focus();
			$('#centre').prop('disabled', true);
			$("#nomllinatges").addClass("form-control is-not-valid");
			$('#enviar_inscripcion').prop('disabled', true);
			}
		else
			{
			txt = "";
			document.getElementById("mensaje").innerHTML = txt;		
			$('#centre').prop('disabled', false);
			}
			})
			
		$("#nomllinatges").keyup(function(){
			if( jQuery(this).val() == "" || document.getElementById("nomllinatges").validity.patternMismatch)
				{
				txt = "Hauria de ser un nom vàlid !!!";
				document.getElementById("mensaje").innerHTML = txt;		
				$("#nomllinatges").focus();
				$('#centre').prop('disabled', true);
				}
			else
				{
				txt = "";
				document.getElementById("mensaje").innerHTML = txt;		
				$('#centre').prop('disabled', false);
				}
			});

	$("#centre").change(function(){
		var str = $(this).val();
		var datosCentro = str.split("#");
		$("#codicentre").val(datosCentro[0]);
		$("#localitat").val(datosCentro[1]);
		$("#adreca").val(datosCentro[2]);
		$("#codipostal").val(datosCentro[3]);
		$("#telefon").val(datosCentro[4]);
		$("#adrecacorreu").val(datosCentro[5]);
		$(".datosCentro").addClass("form-control is-valid");
		$('#nom_llinatges_profes').prop('disabled', false);
		$('#dni').prop('disabled', false);
		$('#adreca_mail').prop('disabled', false);
		$('#telefono_cont').prop('disabled', false);
		$('#formacion').prop('disabled', false);
		$("#nom_llinatges_profes").focus();
		});
		
	// La operación consiste en una división del número del DNI entre 23. 
	// El número del DNI debe tomarse como un entero, por ello los ceros que se encuentre la izquierda no serán válidos. 
	// Al dividir entre 23 tendremos 23 posibles resultados.  'T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E'
	// $posiblesLetrasDNI = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
	// El valor que debemos tomar para el cálculo de la letra del DNI es el resto qué se obtiene de la resta anteriormente indicada. 
	// Tendremos pues vete tres posibles resultados desde cero a 22. 
	// Cada letra tiene un valor entre 0 y 22 que coincidirá pues con el resto que hemos obtenido de la operación aritmética. 
	// coincide el último dígito con el resultado de la operación de comprobación.
	
	$( "#rgpd" ).change(function() {
		if ($(this).is(":checked"))
		{
		$('#enviar_iDigital').prop('disabled', false);
		}
		else
		{
		$('#enviar_iDigital').prop('disabled', true);	
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
});	
</script>

<div><h4><?php echo lang('message_lang.convocatoria_sol_idigital');?><?php echo $data['configuracion']['convovatoria'];?></h4></div>
<form action="<?php echo base_url('subirarchivo/envia_dec_resp_con');?>" name="dec_resp_consul" id="dec_resp_consul" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<input type = "hidden" name="id_sol" id="id_sol" value = "<?php echo $id_sol;?>">
<div>
<fieldset> 
<h6><legend><?php echo lang('message_lang.titulo_dec_resp_consul');?></legend></h6>  
		<input type = "text" placeholder = "<?php echo lang('message_lang.solicitante_sol_idigital');?>" title = "<?php echo lang('message_lang.solicitante_sol_idigital');?>" class="grid-item-profesor" required minlength = "4" name="empresa" id="empresa" value = "<?php echo $data['expedientes']['nombre_rep'];?>" >
		<input type = "text" title="NIF del consultor digital" placeholder = "NIF" class="grid-item-profesor" required name="nif" id="nif" maxlength = "9" value = "<?php echo $data['expedientes']['nif_rep'];?>">
		<!--<input type = "text" title="Adreça" placeholder = "Adreça" class="grid-item-profesor"  required name="domicilio" id="domicilio" value = "CALLE CARRETERA DE INCA A SENCELLES 0.5">-->
		<!--<input type = "text" title="Codi postal" placeholder = "Codi postal" class="grid-item-profesor"  required name="cpostal" id="cpostal" maxlength = "5" size="9" value = "00000">  -->
        <input type = "tel" placeholder = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" title = "<?php echo lang('message_lang.tit_tel_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "telefono_cont" id="telefono_cont" maxlength = "9" size="9" value = "<?php echo $data['expedientes']['telefono_rep'];?>" pattern="[0-9]{3}[0-9]{3}[0-9]{3}">				
		<input type = "email" placeholder = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" title="<?php echo lang('message_lang.tit_mail_rep_legal_sol_idigital');?>"  data-error = "Adreça de correu invàlida!" class = "grid-item-profesor"  required name = "adreca_mail" id="adreca_mail" value = "<?php echo $data['expedientes']['email_rep'];?>" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
</fieldset> 
</div>

<!--
<!--<div>
    <!--<fieldset>   	
	<!--<label for = "representanteLegal" class = "main"><?php echo lang('message_lang.titulo_rep_legal');?>-->
	<!--<input title = "Representant legal" type = "checkbox" name = "representanteLegal" id = "representanteLegal" onchange = "javaScript: tieneRepresentanteLegal(this.id);">-->
	<!--<span class="w3docs"></span>-->
	<!--</label>-->
	<!--<div id = "verRepresentanteLegal" class = "">	-->
	<!--    <input required type = "text" title = "Nom del representant" placeholder = "<?php echo lang('message_lang.nom_rep_legal_sol_idigital');?>" class="grid-item-profesor" required name="nom_representante" id="nom_representante" size="220" >-->
	<!--	<input required type = "text" title = "DNI/NIE" placeholder = "DNI/NIE" class="grid-item-profesor" required name="dni_representante" id="dni_representante" maxlength = "9" pattern = "(?=.*\d)(?=.*[A-Z]).{9}" > -->
	<!--	<input required type = "text" title = "Adreça" placeholder = "<?php echo lang('message_lang.direccion_rep_legal_sol_idigital');?>" class="grid-item-profesor"  required name="dom_representante" id="dom_representante" >-->
    <!--    <input required type = "tel" title = "<?php echo lang('message_lang.tit_tel_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "tel_representante" id="tel_representante" maxlength = "9" size="9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" ><p id="mensaje_tel"></p>-->
	<!--	<input required type = "email" title = "<?php echo lang('message_lang.tit_mail_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" data-error = "<?php echo lang('message_lang.err_mail_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "adreca_mail_representante" id="adreca_mail_representante" size="220" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">	 -->
	<!--	<legend>Condició que al·lega:</legend>-->
	<!--	<select required name="cond_rep_legal" id="cond_rep_legal">-->
	<!--		<option value="" disabled selected><?php echo lang('message_lang.select_generico');?></option>-->
	<!--		<option value="Administrador">Administrador</option>-->
	<!--		<option value="Apoderado">Apoderado</option>-->
	<!--	</select>	-->
	<!--</div>	-->
	<!--</fieldset>   	-->
<!--</div>-->


<div>
<fieldset>   	
		<label for = "expMinDos_dec_resp_cons" class="main"><?php echo lang('message_lang.declaracion_responsable_asesor');?>
		<input type="checkbox" name="expMinDos_dec_resp_cons" checked disabled id="expMinDos_dec_resp_cons" >
		<span class="w3docs"></span>
		</label>									
		<label for = "expTransDigital_dec_resp_cons" class="main"><?php echo lang('message_lang.declaracion_responsable_experiencia');?>
		<input type="checkbox" name="expTransDigital_dec_resp_cons" checked disabled id="expTransDigital_dec_resp_cons" >
		<span class="w3docs"></span>
		</label>
		<label for = "tieneEstudios_dec_resp_cons" class="main"><?php echo lang('message_lang.declaracion_responsable_formacion');?>
		<input type="checkbox" name="tieneEstudios_dec_resp_cons" checked disabled id="tieneEstudios_dec_resp_cons" >
		<span class="w3docs"></span>
		</label>			
</fieldset>
<span id = "info_insercion"></span>
<div id = "loader"></div>
<fieldset>
    <legend><?php echo lang('message_lang.rgpd');?>:</legend>  
	<label for = "rgpd" class="main" ><button type = "button" class = "btn btn-link" data-toggle = "modal" data-target = "#myModal"><?php echo lang('message_lang.rgpd_leido');?></button>
	<input title = "He llegit i accept les condicions del RGPD" type = "checkbox" name = "rgpd" id = "rgpd">
	<span class="w3docs"></span>
	</label>
	<div id = "enviardeocumentacion">			
	<button disabled style = "width:100%" name = "enviar_iDigital" id = "enviar_iDigital" type = "submit" class = "btn btn-success" form="dec_resp_consul" value="Submit">Enviar</button> 	
	</div>
</fieldset>
</div>
</form>
	
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<script>
function mostrarSpinner () {
	document.getElementById("loader").classList.add("loader");
	document.getElementById("enviar_iDigital").disabled = true;
}

$(document).ready(function(){
	$(".loader").hide();
});

$('#nif').on('change', function() {
		var currentNIF = $(this).val();
		console.log ("nif: " + currentNIF);
		// var esCorrecto = analiza_NIF (currentNIF);
		var esCorrecto = true;
	}); 

function enviaSolicitud ()
	{

	}

	$("#nom_llinatges_profes").focusout(function() {
		var inputValue = $(this).val();
		var txt = "";
		if (inputValue == "" || document.getElementById("nom_llinatges_profes").validity.patternMismatch)
			{
			txt = "Hauria de ser un nom vàlid !!!";
			document.getElementById("mensaje_prof").innerHTML = txt;			
			$("#nom_llinatges_profes").focus();
			$("#nom_llinatges_profes").addClass("form-control is-not-valid");
			//$('#rgpd').prop('disabled', true);
			}
		else
			{
			txt = "";
			document.getElementById("mensaje_prof").innerHTML = txt;	
			//$('#rgpd').prop('disabled', false);			
			}
			})
			
	$("#nom_llinatges_profes").keyup(function() {
			if( jQuery(this).val() == "" || document.getElementById("nom_llinatges_profes").validity.patternMismatch)
				{
				txt = "Hauria de ser un nom vàlid !!!";
				document.getElementById("mensaje_prof").innerHTML = txt;		
				$("#nom_llinatges_profes").focus();
				//$('#rgpd').prop('disabled', true);		
				}
			else
				{
				txt = "";
				document.getElementById("mensaje_prof").innerHTML = txt;
				//$('#rgpd').prop('disabled', false);						
				}
			});

	$("#nif").focusout(function() 
		{
		var currentNIF = $(this).val();
		})
			
	$("#nif").keyup(function() 
		{
		var currentNIF = $(this).val();
		});
			
	$("#telefono_cont").focusout(function() {
		var inputValue = $(this).val();
		var txt = "";
		if (inputValue == "" || document.getElementById("telefono_cont").validity.patternMismatch)
			{
			txt = "Hauria de ser un telèfon vàlid !!!";
			document.getElementById("mensaje_tel").innerHTML = txt;			
			$("#telefono_cont").focus();
			$("#telefono_cont").addClass("form-control is-not-valid");
			//$('#rgpd').prop('disabled', true);
			}
		else
			{
			txt = "";
			document.getElementById("mensaje_tel").innerHTML = txt;
			//$('#rgpd').prop('disabled', false);			
			}
			})
			
	$("#telefono_cont").keyup(function() {
			if( jQuery(this).val() == "" || document.getElementById("telefono_cont").validity.patternMismatch)
				{
				txt = "Hauria de ser un telèfon vàlid !!!";
				document.getElementById("mensaje_tel").innerHTML = txt;		
				$("#telefono_cont").focus();
				//$('#rgpd').prop('disabled', true);
				}
			else
				{
				txt = "";
				document.getElementById("mensaje_tel").innerHTML = txt;	
				//$('#rgpd').prop('disabled', false);				
				}
			});
			
function activaRGPD (activado)
	{

	}			
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title"><?php echo lang('message_lang.clausula_idi');?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><div><span style='font-size:8pt'><span style='font-family:Trebuchet\ MS,Default\ Sans\ Serif,Verdana,Arial,Helvetica,sans-serif'>
		<?php echo lang('message_lang.rgpd_txt');?>
      </span></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('message_lang.cierra');?></button>
      </div>
    </div>
  </div>
</div>
</div>
</section>