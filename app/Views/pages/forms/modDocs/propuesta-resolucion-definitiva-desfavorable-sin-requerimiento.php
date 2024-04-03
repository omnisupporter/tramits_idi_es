<!----------------------------------------- Proposta de resolució definitiva desfavorable sense requeriment. DOC 13. SIN VIAFIRMA-->
<div class="card-itramits">
  <div class="card-itramits-body">
    Proposta de resolució definitiva desfavorable<br>sense requeriment <strong>¡¡¡¡¡[pre-tramits]!!!!!</strong>
  </div>
  <div class="card-itramits-footer">
  	<?php
      if ( !$esAdmin && !$esConvoActual ) {?>
      <?php }
      else {?>
				<button id="btnPropResDefDesfavSinReq" class='btn btn-primary btn-acto-admin' onclick="generaPropResDefDesfSinReq(<?php echo $id;?>, '<?php echo $convocatoria;?>', '<?php echo $programa;?>', '<?php echo $nifcif;?>')">Genera  la resolució</button>
					<div id='infoMissingDataDoc13' class="alert alert-danger ocultar btn-acto-admin"></div>
			<?php }?>
	</div>  
  <div class="card-itramits-footer">
			<?php
			$tieneDocumentosGenerados = $modelDocumentosGenerados->documentosGeneradosPorExpedYTipo($expedientes['id'], $expedientes['convocatoria'],'doc_prop_res_def_desfavorable_sin_req.pdf');
			if (isset($tieneDocumentosGenerados)) {
				$PublicAccessId = $tieneDocumentosGenerados->publicAccessId;
				$requestPublicAccessId = $PublicAccessId;
				$request = execute("requests/" . $requestPublicAccessId, null, __FUNCTION__);
				$respuesta = json_decode($request, true);
				$estado_firma = $respuesta['status'];
				switch ($estado_firma) {
					case 'NOT_STARTED':
					$estado_firma = "<div class='btn btn-info btn-acto-admin'><i class='fa fa-info-circle'></i>Pendent de signar</div>";				
					break;
					case 'REJECTED':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId)."><div class = 'btn btn-warning btn-acto-admin'><i class='fa fa-warning'></i>Signatura rebutjada</div>";
					$estado_firma .= "</a>";				
					break;
					case 'COMPLETED':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><div class='btn btn-success btn-acto-admin'><i class='fa fa-check'></i>Signat</div>";		
					$estado_firma .= "</a>";					
					break;
					case 'IN_PROCESS':
					$estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><div class='btn btn-secondary btn-acto-admin'><i class='fa fa-check'></i>En curs</div>";		
					$estado_firma .= "</a>";						
					default:
					$estado_firma = "<div class='btn btn-danger btn-acto-admin'><i class='fa fa-info-circle'></i>Desconegut</div>";
					}
				echo $estado_firma;
			}	?>
  </div>
</div>
<!------------------------------------------------------------------------------------------------------>

<script>
	function generaPropResDefDesfSinReq(id, convocatoria, programa, nifcif) {
		let todoBien = true
		let fecha_REC = document.getElementById('fecha_REC')
		let ref_REC = document.getElementById('ref_REC')
	 	let fecha_firma_propuesta_resolucion_def = document.getElementById('fecha_firma_propuesta_resolucion_def') //0000-00-00
		let fecha_not_propuesta_resolucion_def = document.getElementById('fecha_not_propuesta_resolucion_def')
		let btnPropResDefDesfavSinReq = document.getElementById('btnPropResDefDesfavSinReq')
		let base_url = 'https://pre-tramits.idi.es/public/index.php/expedientes/generaInforme'
		let infoMissingDataDoc13 = document.getElementById('infoMissingDataDoc13')
		infoMissingDataDoc13.innerText = ""

		if(!fecha_REC.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Data REC sol·licitud<br>"
			todoBien = false
		}
		if(!ref_REC.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Referència REC sol·licitud<br>"
			todoBien = false
		}
	 	if(!fecha_firma_propuesta_resolucion_def.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Data firma proposta resolució definitiva<br>"
			todoBien = false
		}
		if(!fecha_not_propuesta_resolucion_def.value) {
			infoMissingDataDoc13.innerHTML = infoMissingDataDoc13.innerHTML + "Data notificació proposta resolució definitiva<br>"
			todoBien = false
		}

		if (todoBien) {
			infoMissingDataDoc13.classList.add('ocultar')
			btnPropResDefDesfavSinReq.disabled = true
			btnPropResDefDesfavSinReq.innerHTML = "Generant i enviant ..."
			window.location.href = base_url+'/'+id+'/'+convocatoria+'/'+programa+'/'+nifcif+'/doc_prop_res_def_desfavorable_sin_req'
		} else {
			infoMissingDataDoc13.classList.remove('ocultar')
		}
	}
</script>