<!-----------------------------------------Resolució concessió favorable sense requeriment. DOC 16.-->
<div class="card-itramits">
  	<div class="card-itramits-body">
    	Resolució concessió favorable
			<?php if ($base_url === "pre-tramitsidi") {?>
				<span class="label label-warning">***testear*** [PRE]</span>
			<?php }?>
  	</div>
		<div class="card-itramits-footer">
  		<?php
      	if ( !$esAdmin && !$esConvoActual ) {
        }
      	else {?>
				<button id="btnResConcesionFavSinReq" class='btn btn-primary btn-acto-admin' onclick="generaResolucionConcesionFavSinReq(<?php echo $id;?>, '<?php echo $convocatoria;?>', '<?php echo $programa;?>', '<?php echo $nifcif;?>')">Genera la resolució</button>
				<div id='infoMissingDataDoc16' class="alert alert-danger ocultar btn-acto-admin"></div>
			<?php }?>
		</div>
  	<div class="card-itramits-footer">
			<?php
			$tieneDocumentosGenerados = $modelDocumentosGenerados->documentosGeneradosPorExpedYTipo($expedientes['id'], $expedientes['convocatoria'],'doc_res_concesion_favorable_sin_req.pdf');
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

	function generaResolucionConcesionFavSinReq(id, convocatoria, programa, nifcif) {
		let todoBien = true
		let fecha_REC = document.getElementById('fecha_REC')
		let ref_REC = document.getElementById('ref_REC')
		let fecha_infor_fav_desf = document.getElementById('fecha_infor_fav_desf')
		let fecha_firma_propuesta_resolucion_def = document.getElementById('fecha_firma_propuesta_resolucion_def')
		let fecha_not_propuesta_resolucion_def = document.getElementById('fecha_not_propuesta_resolucion_def')
		let btnResConcesionFavSinReq = document.getElementById('btnResConcesionFavSinReq')
		let infoMissingDataDoc16 = document.getElementById('infoMissingDataDoc16')
		infoMissingDataDoc16.innerText = ""

		if(!fecha_REC.value) {
			infoMissingDataDoc16.innerHTML = infoMissingDataDoc16.innerHTML + "Data SEU sol·licitud<br>"
			todoBien = false
		}
		if(!ref_REC.value) {
			infoMissingDataDoc16.innerHTML = infoMissingDataDoc16.innerHTML + "Referència SEU sol·licitud<br>"
			todoBien = false
		}
		if(!fecha_infor_fav_desf.value) {
			infoMissingDataDoc16.innerHTML = infoMissingDataDoc16.innerHTML + "Data firma informe favorable / desfavorable<br>"
			todoBien = false
		}
		if(!fecha_firma_propuesta_resolucion_def.value) {
			infoMissingDataDoc16.innerHTML = infoMissingDataDoc16.innerHTML + "Data firma proposta resolució definitiva<br>"
			todoBien = false
		}
		if(!fecha_not_propuesta_resolucion_def.value) {
			infoMissingDataDoc16.innerHTML = infoMissingDataDoc16.innerHTML + "Data notificació proposta resolució definitiva<br>"
			todoBien = false
		}

		if (todoBien) {
			infoMissingDataDoc16.classList.add('ocultar')
			btnResConcesionFavSinReq.disabled = true
			btnResConcesionFavSinReq.innerHTML = "Generant i enviant ..."
			window.location.href = base_url+'/'+id+'/'+convocatoria+'/'+programa+'/'+nifcif+'/doc_res_concesion_favorable_sin_req'
		} else {
			infoMissingDataDoc16.classList.remove('ocultar')
		}
	}

</script>