<!-- CONTENT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
<h5><?php echo lang('message_lang.destino_solicitud');?>: <strong><?php echo lang('message_lang.idi');?></strong></h5>
<h5><?php echo lang('message_lang.codigo_dir3');?> <strong> A04003714</strong></h5>
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
		$("#cuantia_ayuda").focus();
		$("#empresa").focusout(function() {
		var inputValue = $(this).val();
		var txt = "";
		
		if (inputValue == "" || document.getElementById("empresa").validity.patternMismatch)
			{
			txt = "Hauria de ser un nom vàlid !!!";
			document.getElementById("mensaje").innerHTML = txt;			
			$("#empresa").focus();
			$('#centre').prop('disabled', true);
			$("#empresa").addClass("form-control is-not-valid");
			$('#enviar_inscripcion').prop('disabled', true);
			}
		else
			{
			txt = "";
			document.getElementById("mensaje").innerHTML = txt;		
			$('#centre').prop('disabled', false);
			}
			})
			
	$("#empresa").keyup(function(){
			if( jQuery(this).val() == "" || document.getElementById("empresa").validity.patternMismatch)
				{
				txt = "Hauria de ser un nom vàlid !!!";
				document.getElementById("mensaje").innerHTML = txt;		
				$("#empresa").focus();
				$('#centre').prop('disabled', true);
				}
			else
				{
				txt = "";
				document.getElementById("mensaje").innerHTML = txt;		
				$('#centre').prop('disabled', false);
				}
			});
			
	$('#nif').on('change', function() {
		var currentNIF = $(this).val();
	}); 

	$("#nif").focusout(function() 
		{
		var currentNIF = $(this).val();
		})
			
	$("#nif").keyup(function() 
		{
		var currentNIF = $(this).val();
		});			

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
	
$("form").submit(function(){	
  let x = $('input:radio[name=tiene_consultor]:checked').val();
  if (x != "no" && x != "si") {
    alert("¡Falta indicar si tiene CONSULTOR/HABILITADOR, se debe indicar!");
	$('#no_tiene_consultor').focus();
    return false;
  }

  let opcion_banco = $('input:radio[name=opcion_banco]:checked').val();
  if (opcion_banco != "1" && opcion_banco != "2") {
    alert("¡Falta indicar si se trata de la OPCIÓN 1 o de la OPCIÓN 2 de los datos bancarios aportados!");
	$('#1_opcion_banco').focus();
    return false;
  }
});	
	
	
});	
</script>

<div><h4><?php echo lang('message_lang.convocatoria_sol_idigital');?><?php echo $data['configuracion']['convovatoria'];?></h4></div>
<form action="<?php echo base_url('subirarchivo/store');?>" name="idigital_form" id="idigital_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">

<div>
Que de conformitat amb el seu requeriment de data ...................................... per a l'esmena de documentació de la meva sol·licitud de data ...............................................,declaro que adjunt la següent documentació:
</div>

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

<div>
    <fieldset>
		<legend><?php echo lang('message_lang.titulo_notificiaciones');?></legend>	
		<input type = "tel" title = "<?php echo lang('message_lang.tit_tel_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "tel_representante" id="tel_representante" maxlength = "9" size="9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" ><p id="mensaje_tel"></p>
		<input type = "email" title = "<?php echo lang('message_lang.tit_mail_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" data-error = "<?php echo lang('message_lang.err_mail_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "adreca_mail_representante" id="adreca_mail_representante" size="220" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">		 
	</fieldset>
</div>

<div>
    <fieldset>
        <legend><?php echo lang('message_lang.datos_cons_sol_idigital');?></legend>  
		<label class="container-radio"><?php echo lang('message_lang.no_cons_sol_idigital');?>
		<input type="radio" name="tiene_consultor" id="no_tiene_consultor" onchange = "javaScript: tieneConsultor (this.value);" value="no">
		<span class="checkmark"></span>
		</label> 
		<label class="container-radio"><?php echo lang('message_lang.si_cons_sol_idigital');?>
		<input type="radio" name="tiene_consultor" id="si_tiene_consultor" onchange = "javaScript: tieneConsultor (this.value);" value="si">
		<span class="checkmark"></span>
		</label> 		
	<div id = "verDatosConsultor" class = "ocultar">
	    <div><input type = "text" title = "<?php echo lang('message_lang.nom_habilitador_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.nom_habilitador_sol_idigital');?>" class="grid-item-profesor" name = "nom_consultor" id = "nom_consultor"></div>
		<div><input type = "tel" title = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" class = "grid-item-profesor" name = "tel_consultor" id = "tel_consultor" maxlength = "9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}"><p id="mensaje_dni"></p></div>
 		<div><input type = "email" title = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" class = "grid-item-profesor" name = "mail_consultor" id = "mail_consultor"></div>                                    
		<h2>
			<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
			<?php echo lang('message_lang.aclaracion_habilitador_sol_idigital');?>
		</h2>
	</div>    
	</fieldset> 
</div>

<div>
    <fieldset>
        <legend><?php echo lang('message_lang.declaracion_minimis');?></legend>  
		    <label for = "cumpleNormativaMinimos_dec_resp_1" class="main"><?php echo lang('message_lang.declaracion_minimis_1');?>
			<input title = "<?php echo lang('message_lang.declaracion_minimis_1');?>" checked disabled type="checkbox" name="cumpleNormativaMinimos_dec_resp_1" id="cumpleNormativaMinimos_dec_resp_1">
			<span class = "w3docs"></span>
			</label>
		<label  for = "importe_minimis" class="main"><?php echo lang('message_lang.declaracion_minimis_2');?>
			<input name="importe_minimis" type="number" min="0" max="200000" value = "0" pattern="[0-9]*" id="importe_minimis">
		</label>
	</fieldset> 
</div>

<div>
    <fieldset>
        <legend><?php echo lang('message_lang.declaracion_datos_bancarios');?></legend>  
		    <label for = "veracidad_datos_bancarios_1" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_1');?>
			<input title = "<?php echo lang('message_lang.declaracion_datos_bancarios_1');?>" checked disabled value = "on" type="checkbox" name="veracidad_datos_bancarios_1" id="veracidad_datos_bancarios_1">
			<span class = "w3docs"></span>
			</label>
	<input type = "text" title = "<?php echo lang('message_lang.nom_entidad');?>" placeholder = "<?php echo lang('message_lang.nom_entidad');?>" class="grid-item-profesor" required name="nom_entidad" id="nom_entidad">
	<input type = "text" title = "<?php echo lang('message_lang.domicilio_sucursal');?>" placeholder = "<?php echo lang('message_lang.domicilio_sucursal');?>" class="grid-item-profesor" required name="domicilio_sucursal" id="domicilio_sucursal">
	<input type = "text" title = "<?php echo lang('message_lang.codigo_BIC_SWIFT');?>" placeholder = "<?php echo lang('message_lang.codigo_BIC_SWIFT');?>" class="grid-item-profesor" data-mask = "AAAA-AA-AA-999" maxlength = "14" required name="codigo_BIC_SWIFT" id="codigo_BIC_SWIFT">

				<label class="container-radio"><?php echo lang('message_lang.declaracion_datos_bancarios_2');?> :
					<input type="radio" name = "opcion_banco" id="1_opcion_banco" onchange = "javaScript: opcionBanco (this.value);" value="1">
					<span class="checkmark"></span>
				</label> 
		<div id = "verBancoOpcion1" class = "ocultar">
			<input type="text" name="cc" id="cc" data-mask = "ES 99 9999 9999 99 9999999999" maxlength = "29" >
		</div>				
				<label class="container-radio"><?php echo lang('message_lang.declaracion_datos_bancarios_3');?> :
					<input type="radio" name = "opcion_banco" id="1_opcion_banco" onchange = "javaScript: opcionBanco (this.value);" value="2">
					<span class="checkmark"></span>
				</label> 				
		<div id = "verBancoOpcion2" class = "ocultar">
		<input type="text" name="cc2" id = "cc2" data-mask = "999999999999999999999999" maxlength = "24" >
		</div>		
		<label for = "veracidad_datos_bancarios_2" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_4');?>
			<input title = "Veracitat de les dades bancàries" checked disabled type="checkbox" name="veracidad_datos_bancarios_2" id="veracidad_datos_bancarios_2">
			<span class = "w3docs"></span>
		</label>	
		<label for = "veracidad_datos_bancarios_3" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_5');?>
			<input title = "Veracitat de les dades bancàries" checked disabled type="checkbox" name="veracidad_datos_bancarios_3" id="veracidad_datos_bancarios_3">
			<span class = "w3docs"></span>
		</label>		
<script>
$('#cc').mask('SS 99 9999 9999 99 9999999999');
$('#cc2').mask('999999999999999999999999');
$("#codigo_BIC_SWIFT").mask('SSSS-SS-SS-AAA');
</script>	  
	</fieldset> 
</div>

<div>  
<h4><strong><?php echo lang('message_lang.documentacion_adjunta');?>:</strong></h4>
<fieldset>      
			<h5><?php echo lang('message_lang.informe_autodiagnostico');?> [.pdf, .jpg, .png]:</h5>
			<div id = "enviarinfoautodiagnostico" class = "">
				<?php 
				$data = [
				'name'      => 'file_infoautodiagnostico',
				'id'        => 'file_infoautodiagnostico',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				'lang'      => 'ca-ES',
				'required'  => 'required'
				//'onchange' 	=> 'javaScript: activaRGPD (this.value, true);'
				];
				echo form_upload ($data);
				?>
			</div>

		    <h5><?php echo lang('message_lang.memoria_tecnica');?> [.pdf, .jpg, .png]:</h5>
			<div id = "enviarmemoriaTecnica" class = "">
				<?php 
				$data = [
				'name'      => 'file_memoriaTecnica',
				'id'        => 'file_memoriaTecnica',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				'required'  => 'required'				
				// 'onchange' 	=> 'javaScript: activaRGPD (this.value, true);'
				];
				echo form_upload ($data);
				?>
			</div>
			
			<h5><u><?php echo lang('message_lang.personas_fisicas');?></u>:</h5>
			<label class = "main"><?php echo lang('message_lang.copia_dni');?>
				<input title = "<?php echo lang('message_lang.copia_dni');?>" type = "checkbox" name = "copiaNIF" id = "copiaNIF" onchange = "javaScript: muestraSubeArchivo(this.id);">
				<span class = "w3docs"></span>
			</label>
			<div id = "enviarcopiaNIF" class = "ocultar">
				<label for = "file_copiaNIF"><?php echo lang('message_lang.documento');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_copiaNIF',
				'id'        => 'file_copiaNIF',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				// 'onchange' 	=> 'javaScript: activaRGPD (this.value, copiaNIF.checked);'
				];
				echo form_upload ($data);
				?>
			</div>
			
			<h5><u><?php echo lang('message_lang.personas_juridicas');?></u>:</h5>
		    <label for = "nifRepresentante" class="main"><?php echo lang('message_lang.copia_dni_representante');?>
			<input title = "Còpia del NIF del representant de la societat" type = "checkbox" name = "nifRepresentante" id = "nifRepresentante" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class="w3docs"></span>
			</label>
			<div id = "enviarnifRepresentante" class = "ocultar">
				<label for="file_nifRepresentante"><?php echo lang('message_lang.documento');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_nifRepresentante',
				'id'        => 'file_nifRepresentante',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				// 'onchange' 	=> 'javaScript: activaRGPD (this.value, nifRepresentante.checked);'
				];
				echo form_upload ($data);
				?>
			</div>	

		    <label for = "nifEmpresa" class="main"><?php echo lang('message_lang.copia_nif');?>
			<input title = "Còpia del NIF de l'empresa" type="checkbox" name="nifEmpresa" id="nifEmpresa" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class="w3docs"></span>
			</label>
			<div id = "enviarnifEmpresa" class = "ocultar">
				<label for="file_nifEmpresa"><?php echo lang('message_lang.documento');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_nifEmpresa',
				'id'        => 'file_nifEmpresa',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				// 'onchange' 	=> 'javaScript: activaRGPD (this.value, nifEmpresa.checked);'
				];
				echo form_upload ($data);
				?>
			</div>				
			
		    <label for = "document_acred_como_repres" class="main"><?php echo lang('message_lang.documentacion_acreditativa');?>
			<input title = "Documentació acreditativa de les facultats de representació de la persona." type="checkbox" name="document_acred_como_repres" id="document_acred_como_repres" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class="w3docs"></span>
			</label>
			<div id = "enviardocument_acred_como_repres" class = "ocultar">
				<label for="file_document_acred_como_repres"><?php echo lang('message_lang.documento');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_document_acred_como_repres',
				'id'        => 'file_document_acred_como_repres',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				// 'onchange' 	=> 'javaScript: activaRGPD (this.value, document_acred_como_repres.checked);'
				];
				echo form_upload ($data);
				?>
			</div>
</fieldset>

<fieldset>   	
	<legend><?php echo lang('message_lang.declaracion_responsable');?></legend>
			<label for = "cumpleRequisitos_dec_resp" class="main"><?php echo lang('message_lang.capacidad_representacion');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="cumpleRequisitos_dec_resp" id="cumpleRequisitos_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>									
			<label for = "cumpleRequisitos_participacion_dec_resp" class="main"><?php echo lang('message_lang.datos_consignados');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="cumpleRequisitos_participacion_dec_resp" id="cumpleRequisitos_participacion_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    <label for = "noArticulo_10_dec_resp" class="main"><?php echo lang('message_lang.articulo_10');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="noArticulo_10_dec_resp" id="noArticulo_10_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>	
		    <label for = "epigrafeIAE_dec_resp" class="main"><?php echo lang('message_lang.epígrafe_IAE_incluido');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="epigrafeIAE_dec_resp" id="epigrafeIAE_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    <label for = "registroIndustrialMinero_dec_resp" class="main"><?php echo lang('message_lang.inscrita_registro_industrial');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="registroIndustrialMinero_dec_resp" id="registroIndustrialMinero_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>	
		    <label for = "cumpleNormativaSegInd_dec_resp" class="main"><?php echo lang('message_lang.normativa_seguridad_industrial');?>
			<input title = "Compleix els requisits" type="checkbox" checked disabled name="cumpleNormativaSegInd_dec_resp" id="cumpleNormativaSegInd_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>	

		    <label for = "noHaRecibidoAyudas_dec_resp" class="main"><?php echo lang('message_lang.no_he_recibido_subvencion');?>
			<input title = "Compleix els requisits" checked disabled type="checkbox" name="noHaRecibidoAyudas_dec_resp" id="noHaRecibidoAyudas_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    <label for = "aceptaCondicionesConv_dec_resp" class="main"><?php echo lang('message_lang.acepto_integramente');?>
			<input title = "Compleix els requisits" checked disabled type="checkbox" name="aceptaCondicionesConv_dec_resp" id="aceptaCondicionesConv_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    <label for = "consentimientoAIDI_dec_resp" class="main"><?php echo lang('message_lang.doy_mi_consentimiento');?>
			<input title = "Compleix els requisits" checked type="checkbox" name="consentimientoAIDI_dec_resp" id="consentimientoAIDI_dec_resp" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
						
			<div id = "enviardeclNoConsentimiento" class = "ocultar">
				<label for="file_declNoConsentimiento"><?php echo lang('message_lang.declaracion_no_consentimiento');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_declNoConsentimiento',
				'id'        => 'file_declNoConsentimiento',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				'onmouseout' 	=> 'javaScript: activaRGPD (this.value, declNoConsentimiento.checked);'
				];
				echo form_upload ($data);
				?>
			</div>
			<div id = "enviarcertificadoDocumentacion" class = "ocultar">
				<label for="file_certificadoDocumentacion"><?php echo lang('message_lang.certificado_document_correspon');?> [.pdf, .jpg, .png]:</label>
				<?php 
				$data = [
				'name'      => 'file_certificadoDocumentacion',
				'id'        => 'file_certificadoDocumentacion',
				'maxlength' => '100',
				'size'      => '50',
				'style'     => 'width:50%',
				'class'		=> 'form-control',
				'accept'    => '.pdf, .jpg, .png',
				'onmouseout' 	=> 'javaScript: activaRGPD (this.value, declNoConsentimiento.checked);'
				];
				echo form_upload ($data);
				?>
			</div>			
			
</fieldset>

<span id = "info_insercion"></span>
<div id = "loaderDiv"></div>
<fieldset>
    <legend><?php echo lang('message_lang.rgpd');?>:</legend>  
	<label for = "rgpd" class="main" ><button type = "button" class = "btn btn-link" data-toggle = "modal" data-target = "#myModal"><?php echo lang('message_lang.rgpd_leido');?></button>
	<input title = "He llegit i accept les condicions del RGPD" type = "checkbox" name = "rgpd" id = "rgpd">
	<span class="w3docs"></span>
	</label>
	<div id = "enviardeocumentacion">	
	<button disabled style = "width:100%" name = "enviar_iDigital" id = "enviar_iDigital" type = "submit" class = "btn btn-success" form="idigital_form" value="Submit">Enviar</button> 	
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title"><?php echo lang('message_lang.clausula_idi');?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div><span style='font-size:8pt'><span style='font-family:Trebuchet\ MS,Default\ Sans\ Serif,Verdana,Arial,Helvetica,sans-serif'>
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