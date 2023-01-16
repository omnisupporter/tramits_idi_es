<!-- CONTENT -->
	
	<script type="text/javascript" src="/public/assets/js/comprueba-CIF.js"></script>
	<script type="text/javascript" src="/public/assets/js/solicitud-ayuda.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section>
<?php
use App\Models\ConfiguracionModel;
	$modelConfig = new ConfiguracionModel();
	//$db = \Config\Database::connect();
	$data['configuracion'] = $modelConfig->where('convocatoria_activa', true)->first();	
?>

    <fieldset>
<h5><?php echo lang('message_lang.destino_solicitud');?>: <strong><?php echo lang('message_lang.idi');?></strong></h5>
<h5><?php echo lang('message_lang.codigo_dir3');?> <strong> A04003714</strong></h5>
   </fieldset> 

<div class="alert alert-info">
	<?php echo lang('message_lang.intro_sol_idigital');?>
</div>

<div><h4><?php echo lang('message_lang.convocatoria_sol_idigital');?><?php echo $data['configuracion']['convocatoria'];?></h4></div>
<form action="<?php echo base_url('/public/index.php/subirarchivo/store');?>" name="idigital_form" id="idigital_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<div>
	<span id = "mensaje"></span>
	</div>

<div id="formbox">
<div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.info_programa');?> </span></div>
    <fieldset>
 	<legend><?php echo lang('message_lang.programa');?></legend>
	 <label class="container-radio"><h6><?php echo lang('message_lang.opc_iDigital');?></h6>
			<input type="radio" required name="opc_programa" id="Programa_I" value="Programa I">
			<span class="checkmark"></span>
		</label>
		<label class="container-radio"><h6><?php echo lang('message_lang.opc_iExporta');?></h6>
			<input type="radio" name="opc_programa" id="Programa_II" value="Programa II">
			<span class="checkmark"></span>
		</label>		
		<label class="container-radio"><h6><?php echo lang('message_lang.opc_iLs');?></h6>
			<input type="radio" name="opc_programa" id="Programa_III" value="Programa III">
			<span class="checkmark"></span>
		</label>
   </fieldset> 
</div>

<div id="formbox">
<div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px; color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.info_tipo_empresa');?> </span></div>
    <fieldset>
 	<legend><?php echo lang('message_lang.solicitante_tipo');?></legend>   
	<div>
		<label class="container-radio"><h6><?php echo lang('message_lang.solicitante_tipo_autonomo');?></h6>
			<input type="radio" required name="tipo_solicitante" id="autonomo" onchange = "javaScript: tipoSolicitante (this.id);" value="autonomo">
			<span class="checkmark"></span>
		</label>
		<label class="container-radio"><h6><?php echo lang('message_lang.solicitante_tipo_pequenya');?></h6>
			<input type="radio" name="tipo_solicitante" id="pequenya" onchange = "javaScript: tipoSolicitante (this.id);" value="pequenya">
			<span class="checkmark"></span>
		</label>		
		<label class="container-radio"><h6><?php echo lang('message_lang.solicitante_tipo_mediana');?></h6>
			<input type="radio" name="tipo_solicitante" id="mediana" onchange = "javaScript: tipoSolicitante (this.id);" value="mediana">
			<span class="checkmark"></span>
		</label>
		<label class="container-radio"><h6><?php echo lang('message_lang.solicitante_tipo_cluster_ct');?></h6>
			<input type="radio" name="tipo_solicitante" id="cluster_ct" onchange = "javaScript: tipoSolicitante (this.id);" value="cluster_ct">
			<span class="checkmark"></span>
		</label> 		
	</div>
   </fieldset> 
</div>
<!--------------------------3. DATOS DE LA PERSONA SOLICITANTE--------------------------------------------------------------------->
<div id="formbox">
	<fieldset>
	<legend><?php echo lang('message_lang.identificacion_sol_idigital');?>:</legend>
		<input type = "text" title = "<?php echo lang('message_lang.solicitante_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.solicitante_sol_idigital');?>" class = "grid-item-profesor" required name = "empresa" id = "empresa" size="220">
		<input type = "text" title="NIF" placeholder = "NIF" class = "grid-item-profesor" required name = "nif" id = "nif" maxlength = "9"><span id = "info_lbl"></span>
	    <input type = "text" title = "<?php echo lang('message_lang.nom_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.nom_rep_legal_sol_idigital');?>" class="grid-item-profesor" name="nom_representante" id="nom_representante" size="220" >
		<input type = "text" title = "<?php echo lang('message_lang.nif_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.nif_rep_legal_sol_idigital');?>" class="grid-item-profesor" name="dni_representante" id="dni_representante" maxlength = "9"> 		
		<input type = "text" title = "<?php echo lang('message_lang.direccion_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.direccion_sol_idigital');?>" class="grid-item-profesor"  required name="domicilio" id="domicilio">
		<?php include  $_SERVER['DOCUMENT_ROOT'] . '/public/assets/utils/municipios.php';?>
		<input type = "text" title="<?php echo lang('message_lang.cp_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.cp_sol_idigital');?>" class="grid-item-profesor"  required name="cpostal" id="cpostal" pattern="[0-9]{5}" minlength = "5" maxlength = "5" size="9">  
        <input type = "tel" title="<?php echo lang('message_lang.movil_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.movil_sol_idigital');?>" class = "grid-item-profesor" required name = "telefono_cont" id="telefono_cont" maxlength = "9" size="9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" ><p id="mensaje_tel"></p>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/public/assets/utils/epigrafeIAE.php';?>
	</fieldset> 

    <fieldset>
		<h6><strong><?php echo lang('message_lang.titulo_notificiaciones');?></strong></h6>	
		<input type = "tel" title = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.tel_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "tel_representante" id="tel_representante" maxlength = "9" size="9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" ><p id="mensaje_tel"></p>
		<input type = "email" title = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" placeholder = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" data-error = "<?php echo lang('message_lang.mail_rep_legal_sol_idigital');?>" class = "grid-item-profesor" required name = "adreca_mail_representante" id="adreca_mail_representante" size="220" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">		 
	</fieldset>
</div>
<!--------------------------4. DATOS DEL CONSULTOR--------------------------------------------------------------------->
<div  id="formbox">
    <fieldset>
	<div>
        <legend><?php echo lang('message_lang.datos_cons_sol_idigital');?>:</legend>
		<!--<label class="container-radio"><h6><?php //echo lang('message_lang.no_cons_sol_idigital');?></h6>-->
		<!--<input type="radio" name="tiene_consultor" id="no_tiene_consultor" onchange = "javaScript: tieneConsultor (this.value);" value="no">-->
		<!--<span class="checkmark"></span>-->
		<!--</label> -->
		<!--<label class="container-radio"><h6><?php echo lang('message_lang.si_cons_sol_idigital');?></h6>-->
		<!--<input type="radio" name="tiene_consultor" id="si_tiene_consultor" checked onchange = "javaScript: tieneConsultor (this.value);" value="si">-->
		<!--<span class="checkmark"></span>-->
		<!--</label>-->
	</div>
	
	<div id = "verDatosConsultor" class = "">
	    <div><input type = "text" title = "<?php echo lang('message_lang.nom_habilitador_sol_idigital');?>" required placeholder = "<?php echo lang('message_lang.nom_habilitador_sol_idigital');?>" class="grid-item-profesor" name = "nom_consultor" id = "nom_consultor"></div>
		<div><input type = "tel" title = "<?php echo lang('message_lang.movil_sol_idigital');?>" required placeholder = "<?php echo lang('message_lang.movil_sol_idigital');?>" class = "grid-item-profesor" name = "tel_consultor" id = "tel_consultor" maxlength = "9" pattern="[0-9]{3}[0-9]{3}[0-9]{3}"><p id="mensaje_dni"></p></div>
 		<div><input type = "email" title = "<?php echo lang('message_lang.mail_sol_idigital');?>" required placeholder = "<?php echo lang('message_lang.mail_sol_idigital');?>" class = "grid-item-profesor" name = "mail_consultor" id = "mail_consultor"></div>                                
	</div>
	</fieldset>
</div>
<!---------------------------------- 5. DOCUMENTACIÓN ADJUNTA--------------------------------------------------------------------->
<div id="formbox">
	<fieldset>
	<legend><?php echo lang('message_lang.documentacion_adjunta');?>:</legend>
		    <h5><?php echo lang('message_lang.memoria_tecnica');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
  			<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></h5>
			
			<div id = "enviarmemoriaTecnica" class = "">
				<input type = "file" class = "form-control" name="file_memoriaTecnica[]" size="50" accept=".pdf" multiple />
			</div>

			<h5><?php echo lang('message_lang.personas_juridicas');?></h5>
		    <label for = "nifEmpresa" class="main"><?php echo lang('message_lang.copia_nif');?>
			<input type="checkbox" name="nifEmpresa" id="nifEmpresa" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class="w3docs"></span>
			</label>
			<div id = "enviarnifEmpresa" class = "ocultar">
				<label for="file_nifEmpresa"><?php echo lang('message_lang.documento');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
  			<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" class = "form-control" name="file_nifEmpresa[]" size="20" accept=".pdf" multiple />
			</div>

			<h5><?php echo lang('message_lang.cluster_centroTecnologico');?></h5>
		    <label for = "docConstitutivoCluster" class="main"><?php echo lang('message_lang.docConstitutivoCluster');?>
			<input title = "<?php echo lang('message_lang.docConstitutivoCluster');?>" type="checkbox" name="docConstitutivoCluster" id="docConstitutivoCluster" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class="w3docs"></span>
			</label>
			<div id = "enviardocConstitutivoCluster" class = "ocultar">
				<label for="file_docConstitutivoCluster"><?php echo lang('message_lang.documento');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
  			<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" class = "form-control" name="file_docConstitutivoCluster[]" size="20" accept=".pdf" multiple />
			</div>		
	</fieldset>
</div>
<!--------------------------------------- 6. AUTORIZACIONES ------------------------------------------------------------------------------------>
<div id="formbox">
	<fieldset>
		<legend><?php echo lang('message_lang.autorizaciones_solicitud');?>:</legend>
			<label for = "consentimientocopiaNIF" class = "main"><?php echo lang('message_lang.autorizaciones_personas_fisicas');?>
				<input title = "<?php echo lang('message_lang.copia_dni');?>" checked type = "checkbox" name = "consentimientocopiaNIF" id = "consentimientocopiaNIF" onchange = "javaScript: muestraSubeArchivo(this.id);">
				<span class = "w3docs"></span>
			</label>
			<div id = "enviarcopiaNIF" class = "ocultar">
				<label for = "file_copiaNIF"><?php echo lang('message_lang.documento_copiaNIF');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" class = "form-control" id = "file_copiaNIF[]" name = "file_copiaNIF[]" size = "20" accept = ".pdf" multiple />
			</div>

			<label for = "consentimiento_identificacion" class="main"><?php echo lang('message_lang.consentimiento_identificacion_solicitante');?>
				<input title = "<?php echo lang('message_lang.consentimiento_identificacion_solicitante');?>" checked type="checkbox" name="consentimiento_identificacion" id="consentimiento_identificacion" onchange = "javaScript: muestraSubeArchivo(this.id);">
				<span class = "w3docs"></span>
			</label>
			<div id = "enviardocumentoIdentificacion" class = "ocultar">
				<label for = "file_enviardocumentoIdentificacion"><?php echo lang('message_lang.document_identificativos');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" title = "Para varios documentos: mantenga pulsada la tecla CTRL (Control) y vaya seleccionando los archivos" class = "form-control" name="file_enviardocumentoIdentificacion[]" size="20" accept=".pdf" multiple />				
			</div>
			
			<label for = "consentimiento_certificadoATIB" class="main"><?php echo lang('message_lang.doy_mi_consentimiento_aeat_atib');?>
				<input title = "<?php echo lang('message_lang.doy_mi_consentimiento');?>" checked type="checkbox" name="consentimiento_certificadoATIB" id="consentimiento_certificadoATIB" onchange = "javaScript: muestraSubeArchivo(this.id);">
				<span class = "w3docs"></span>
			</label>
			<div id = "enviarcertificadoATIB" class = "ocultar">
				<label for = "file_certificadoATIB"><?php echo lang('message_lang.certificado_document_correspon');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" title = "Para varios documentos: mantenga pulsada la tecla CTRL (Control) y vaya seleccionando los archivos" class = "form-control" name="file_certificadoATIB[]" size="20" accept=".pdf" multiple />				
			</div>

			<label for = "consentimiento_certigicadoSegSoc" class="main"><?php echo lang('message_lang.doy_mi_consentimiento_seg_soc');?>
				<input title = "<?php echo lang('message_lang.doy_mi_consentimiento');?>" checked type="checkbox" name="consentimiento_certigicadoSegSoc" id="consentimiento_certigicadoSegSoc" onchange = "javaScript: muestraSubeArchivo(this.id);">
				<span class = "w3docs"></span>
			</label>
			<div id = "enviarcertificadosegSoc" class = "ocultar">
				<label for = "file_certigicadoSegSoc"><?php echo lang('message_lang.certificado_document_correspon');?> [.pdf]: <div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> info
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.upload_multiple');?> </span></div></label>
				<input type = "file" title = "Para varios documentos: mantenga pulsada la tecla CTRL (Control) y vaya seleccionando los archivos" class = "form-control" name="file_certigicadoSegSoc[]" size="20" accept=".pdf" multiple />				
			</div>						
	</fieldset>
</div>
<!--------------------------7. DACLARACIÓN RESPONSABLE--------------------------------------------------------------------->
<div id="formbox">
	<fieldset>   	
	<legend><?php echo lang('message_lang.declaracion_responsable');?>:</legend>
		    <label for = "declaracion_responsable_i" class="main"><?php echo lang('message_lang.declaracion_responsable_i');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_i');?>" disabled checked type="checkbox" name="declaracion_responsable_i" id="declaracion_responsable_i">
			<span class = "w3docs"></span>
			</label>
			<label  for = "declaracion_responsable_ii" class="main"><?php echo lang('message_lang.declaracion_responsable_ii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_ii');?>" type="checkbox" name="declaracion_responsable_ii" id="declaracion_responsable_ii" >
			<span class = "w3docs"></span>
			</label>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_ii');?>" disabled class="ocultar" name="importe_minimis" type="number" placeholder="10000.0" step="0.01" min="0" max="200000" value = "0" pattern="[0-9]*" id="importe_minimis">
	</fieldset> 
    <fieldset>
		    <label for = "veracidad_datos_bancarios_1" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_1');?>
			<input title = "<?php echo lang('message_lang.declaracion_datos_bancarios_1');?>" disabled checked value = "on" type="checkbox" name="veracidad_datos_bancarios_1" id="veracidad_datos_bancarios_1">
			<span class = "w3docs"></span>
			</label>
	<input type = "text" title = "<?php echo lang('message_lang.nom_entidad');?>" placeholder = "<?php echo lang('message_lang.nom_entidad');?>" class="grid-item-profesor" required name="nom_entidad" id="nom_entidad">
	<input type = "text" title = "<?php echo lang('message_lang.domicilio_sucursal');?>" placeholder = "<?php echo lang('message_lang.domicilio_sucursal');?>" class="grid-item-profesor" required name="domicilio_sucursal" id="domicilio_sucursal">
	<input type = "text" title = "<?php echo lang('message_lang.codigo_BIC_SWIFT');?>" placeholder = "<?php echo lang('message_lang.codigo_BIC_SWIFT');?>" class="grid-item-profesor" data-mask = "AAAA-AA-AA-999" maxlength = "14" required name="codigo_BIC_SWIFT" id="codigo_BIC_SWIFT">

				<label class="container-radio"><?php echo lang('message_lang.declaracion_datos_bancarios_2');?> :
					<input type="radio" required name = "opcion_banco" id="1_opcion_banco" onchange = "javaScript: opcionBanco (this.value);" value="1">
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
		<input type = "text" name = "cc2" id = "cc2" data-mask = "999999999999999999999999" maxlength = "24" >
		</div>		
		<label for = "veracidad_datos_bancarios_2" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_4');?>
			<input title = "Veracitat de les dades bancàries" disabled checked type="checkbox" name="veracidad_datos_bancarios_2" id="veracidad_datos_bancarios_2">
			<span class = "w3docs"></span>
		</label>	
		<label for = "veracidad_datos_bancarios_3" class="main"><?php echo lang('message_lang.declaracion_datos_bancarios_5');?>
			<input title = "Veracitat de les dades bancàries" disabled checked type="checkbox" name="veracidad_datos_bancarios_3" id="veracidad_datos_bancarios_3">
			<span class = "w3docs"></span>
		</label>		
	<script>
		$('#cc').mask('SS 99 9999 9999 99 9999999999');
		$('#cc2').mask('999999999999999999999999');
		//$("#codigo_BIC_SWIFT").mask('SSSS-SS-SS-AAA');
		$("#codigo_BIC_SWIFT").mask('AAAA-AA-AA-AAA');
	</script>	  
	</fieldset> 
	<fieldset>		
		    <label for = "declaracion_responsable_iii" class="main"><?php echo lang('message_lang.declaracion_responsable_iii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_iii');?>" disabled checked type="checkbox" name="declaracion_responsable_iii" id="declaracion_responsable_iii" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    
			<label for = "declaracion_responsable_iv" class="main"><?php echo lang('message_lang.declaracion_responsable_iv');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_iv');?>" disabled checked type="checkbox" name="declaracion_responsable_iv" id="declaracion_responsable_iv" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>						
			
			<label for = "declaracion_responsable_v" class="main"><?php echo lang('message_lang.declaracion_responsable_v');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_v');?>" disabled checked type="checkbox" name="declaracion_responsable_v" id="declaracion_responsable_v" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    
			<label for = "declaracion_responsable_vi" class="main"><?php echo lang('message_lang.declaracion_responsable_vi');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_vi');?>" disabled checked type="checkbox" name="declaracion_responsable_vi" id="declaracion_responsable_vi" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>	
		    
			<label for = "declaracion_responsable_vii" class="main"><?php echo lang('message_lang.declaracion_responsable_vii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_vii');?>" disabled checked type="checkbox" name="declaracion_responsable_vii" id="declaracion_responsable_vii" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>
		    
			<label for = "declaracion_responsable_viii" class="main"><?php echo lang('message_lang.declaracion_responsable_viii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_viii');?>" disabled checked type="checkbox" name="declaracion_responsable_viii" id="declaracion_responsable_viii" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>	
		    
			<label for = "declaracion_responsable_ix" class="main"><?php echo lang('message_lang.declaracion_responsable_ix');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_ix');?>" disabled checked type="checkbox" name="declaracion_responsable_ix" id="declaracion_responsable_ix" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>

		    <label for = "declaracion_responsable_x" class="main"><?php echo lang('message_lang.declaracion_responsable_x');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_x');?>" disabled checked type="checkbox" name="declaracion_responsable_x" id="declaracion_responsable_x" onchange = "javaScript: muestraSubeArchivo(this.id);">
			<span class = "w3docs"></span>
			</label>

		    <label for = "declaracion_responsable_xi" class="main"><?php echo lang('message_lang.declaracion_responsable_xi');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xi');?>" disabled checked type="checkbox" name="declaracion_responsable_xi" id="declaracion_responsable_xi">
			<span class = "w3docs"></span>
			</label>

		    <label for = "declaracion_responsable_xii" id="declaracion_responsable_xii_lbl" class="main"><?php echo lang('message_lang.declaracion_responsable_xii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xii');?>" disabled checked type="checkbox" name="declaracion_responsable_xii" id="declaracion_responsable_xii">
			<span class = "w3docs"></span>
			</label>
		    <label for = "declaracion_responsable_xiii" id="declaracion_responsable_xiii_lbl" class="main"><?php echo lang('message_lang.declaracion_responsable_xiii');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xiii');?>" disabled checked type="checkbox" name="declaracion_responsable_xiii" id="declaracion_responsable_xiii">
			<span class = "w3docs"></span>
			</label>
		    <label for = "declaracion_responsable_xiv" id="declaracion_responsable_xiv_lbl" class="main"><?php echo lang('message_lang.declaracion_responsable_xiv');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xiv');?>" disabled checked type="checkbox" name="declaracion_responsable_xiv" id="declaracion_responsable_xiv">
			<span class = "w3docs"></span>
			</label>
		    <label for = "declaracion_responsable_xv" id="declaracion_responsable_xv_lbl" class="main"><?php echo lang('message_lang.declaracion_responsable_xv');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xv');?>" disabled checked type="checkbox" name="declaracion_responsable_xv" id="declaracion_responsable_xv">
			<span class = "w3docs"></span>
			</label>
			<!--  
			<label for = "declaracion_responsable_xvi" class="main"><?php echo lang('message_lang.declaracion_responsable_xvi');?>
			<input title = "<?php echo lang('message_lang.declaracion_responsable_xvi');?>" checked type="checkbox" name="declaracion_responsable_xvi" id="declaracion_responsable_xvi">
			<span class = "w3docs"></span>
			</label>	-->											
	</fieldset>
</div>
<div>
	<fieldset>
    <legend><?php echo lang('message_lang.rgpd');?>:</legend>  
	
	<label for = "rgpd" class="main" >
		<!--<button type = "button" class = "btn  btn-lg" ><?php echo lang('message_lang.rgpd_leido');?></button>  -->
		<input title = "He llegit i accept les condicions del RGPD" type = "checkbox" name = "rgpd" id = "rgpd">
		<span class="w3docs"></span>
	</label>
	<div class="tooltip_idi"><i class="fa fa-info-circle" style="font-size:24px;color: #1AB394;"></i> <?php echo lang('message_lang.rgpd_leido');?>
				<span class="tooltiptext_idi"> <?php echo lang('message_lang.rgpd_txt');?> </span></div>
	<div id = "enviardeocumentacion">	
	<button disabled style = "width:100%" name = "enviar_iDigital" id = "enviar_iDigital" type = "submit" class = "btn btn-success" form="idigital_form" value="Submit">Enviar</button> 	
	</div>
	</fieldset>
</div>
</form>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title"><?php echo lang('message_lang.clausula_idi');?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div><span ><?php echo lang('message_lang.rgpd_txt');?></span></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('message_lang.cierra');?></button>
      </div>
    </div>
  </div>
</div>
</div>
</section>
</body>
</html>