<!----------------------------------------- Requerimiento enmienda justificación DOC 13 ------------------------------------>
<div class="card-itramits">
  <div class="card-itramits-body">
    Requeriment d'esmena justificació
		<?php
		if ($base_url === "pre-tramitsidi") {?>
			**testear** [PRE]
		<?php }?>		
	</div>
	<div class="card-itramits-footer">
		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<button type = "button" class = "btn btn-secondary btn-acto-admin" data-bs-toggle="modal" data-bs-target="#myRequerimientoJustificacion" id="myBtnRequerimientoJustificacion">Motiu del requeriment</button>
			<span id="btn_19" class="">
					<button id="wrapper_generadoc_req_justificacion" class='btn btn-secondary ocultar btn-acto-admin' onclick="enviaRequerimientoJustificacion(<?php echo $id;?>, '<?php echo $convocatoria;?>', '<?php echo $programa;?>', '<?php echo $nifcif;?>')">Envia a firma</button>
					<div id='infoMissingDataDoc13' class="alert alert-danger ocultar"></div>
			</span>
		<?php }?>
	</div>
	<div class="card-itramits-footer">
		<?php if ($expedientes['doc_requerimiento_justificacion'] !=0) { ?>
		<?php 
		$tieneDocumentosGenerados = $modelDocumentosGenerados->documentosGeneradosPorExpedYTipo($expedientes['id'], $expedientes['convocatoria'], 'doc_requerimiento_justificacion.pdf');
		if (isset($tieneDocumentosGenerados))
		{
	    $PublicAccessId = $tieneDocumentosGenerados->publicAccessId;
	    $requestPublicAccessId = $PublicAccessId;
			$request = execute("requests/".$requestPublicAccessId, null, __FUNCTION__);
			$respuesta = json_decode ($request, true);
			$estado_firma = $respuesta['status'];
			switch ($estado_firma) {
				case 'NOT_STARTED':
					$estado_firma = "<div class='btn btn-info btn-acto-admin'><i class='fa fa-info-circle'></i> Pendent de signar</div>";				
					break;
				case 'REJECTED':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId)."><div class = 'btn btn-warning btn-acto-admin'><i class='fa fa-warning'></i> Signatura rebutjada</div>";
					$estado_firma .= "</a>";
					$estado_firma .= gmdate("d-m-Y", intval ($respuesta['rejectInfo']['rejectDate']/1000));
					break;
				case 'COMPLETED':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><div class='btn btn-success btn-acto-admin'><i class='fa fa-check'></i> Signat</div>";		
					$estado_firma .= "</a>";
					$estado_firma .= gmdate("d-m-Y", intval ($respuesta['endDate']/1000));
					break;
				case 'IN_PROCESS':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><div class='btn btn-secondary btn-acto-admin'><i class='fa fa-check'></i> En curs</div>";		
					$estado_firma .= "</a>";
					break;
				default:
					$estado_firma = "<div class='btn btn-danger btn-acto-admin'><i class='fa fa-info-circle'></i> Desconegut</div>";
				}
			echo $estado_firma;
		}
		}?>
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>
 <!-- The Modal -->
 		<div id="myRequerimientoJustificacion" class="modal" tabindex="-1">
				<div class="modal-dialog">
                <!-- Modal content-->
    			<div class="modal-content" style = "width: 80%;">
      			<div class="modal-header">
							<h4 class="modal-title">Motiu del requeriment d'esmena:</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      			</div>
      			<div class="modal-body">
							<div class="form-group">
								<textarea required rows="10" cols="30" name="motivoRequerimientoJustificacion" class="form-control" id = "motivoRequerimientoJustificacion" 
								placeholder="Motiu del requeriment d'esmena"><?php echo $expedientes['motivoRequerimientoJustificacion']; ?></textarea>
        			</div>
							<div class="form-group">
           			<button type="button" onclick = "javaScript: actualizaMotivoRequerimientoJustificacion_click();" id="guardaMotivoRequerimientoJustificacion" 
									class="btn-itramits btn-success-itramits" data-bs-dismiss="modal">Guarda</button>
        			</div>				
    				</div>
  			</div>
				</div>
		</div>
<!------------------------------------------------------------------------------------------------------>
<script>
	function enviaRequerimientoJustificacion(id, convocatoria, programa, nifcif) {
		let todoBien = true
		let fecha_firma_res = document.getElementById('fecha_firma_res')
		let fecha_limite_justificacion = document.getElementById('fecha_limite_justificacion')
		let fecha_inicio_req_justificacion = document.getElementById('fecha_inicio_req_justificacion')
		let wrapper_generadoc_req_justificacion = document.getElementById('wrapper_generadoc_req_justificacion')
		let infoMissingDataDoc13 = document.getElementById('infoMissingDataDoc13')
		infoMissingDataDoc13.innerText = ""
	
 		if(!fecha_firma_res.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Firma resolució<br>"
			todoBien = false
		}

		if(!fecha_limite_justificacion.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Data límit per justificar l'ajut rebut<br>"
			todoBien = false
		}

		if (todoBien) {
			infoMissingDataDoc13.classList.add('ocultar')
			wrapper_generadoc_req_justificacion.disabled = true
			wrapper_generadoc_req_justificacion.innerHTML = "Generant i enviant ..."
			window.location.href = actualBaseUrl+'/'+id+'/'+convocatoria+'/'+programa+'/'+nifcif+'/doc_requerimiento_justificacion'
		} else {
			infoMissingDataDoc13.classList.remove('ocultar')
		}
	}

</script>
			