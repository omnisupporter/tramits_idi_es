<!----------------------------------------- Resolució desistiment por renuncia DOC 22 SIN VIAFIRMA --------------------------------->
<div class="card-itramits">
  <div class="card-itramits-body">
		Resolució desistiment per renúncia<br>
		<small>Pendent crear plantilla json</small>
	</div>
  	<div class="card-itramits-footer">
	  <?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<button type = "button" class = "btn btn-secondary btn-acto-admin" data-bs-toggle = "modal" data-bs-target = "#myDesestimientoRenuncia" id="myBtnDesestimientoRenuncia">Motiu del desestiment</button>  
			<span id="btn_22" class="">
					<button id="wrapper_motivoDesestimientoRenuncia" class='btn btn-primary ocultar btn-acto-admin' onclick="generaResolucionPorDesestimiento(<?php echo $id; ?>, '<?php echo $convocatoria; ?>', '<?php echo $programa; ?>', '<?php echo $nifcif; ?>')">Generar la resolució</button>
					<div id='infoMissingDataDoc22' class="alert alert-danger ocultar"></div>
			</span>
		<?php }?>  
	</div>
  	<div class="card-itramits-footer">
			<?php if ($expedientes['doc_res_desestimiento_por_renuncia'] !=0) { ?>
        <a class='btn btn-success btn-acto-admin' href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_desestimiento_por_renuncia');?>" target = "_self">La resolució de desistiment</a>	
			<?php }?>
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>

		<div id="myDesestimientoRenuncia" class="modal">
			<div class="modal-dialog">
                <!-- Modal content-->
    			<div class="modal-content">
      				<div class="modal-header">
						<h4 class="modal-title">Motiu del desistiment per renúncia:</h4>
        				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      				</div>
      				<div class="modal-body">
						<div class="form-group">
						<textarea required rows="10" cols="30" name="motivoDesestimientoRenuncia" class="form-control" id = "motivoDesestimientoRenuncia" 
						placeholder="Motiu del desistiment per renúncia"><?php echo $expedientes['motivoDesestimientoRenuncia']; ?></textarea>
        				</div>
						<div class="form-group">
           				<button type="button" onclick = "javaScript: actualizaMotivoDesestimientoRenuncia_click();" id="guardaMotivoDesestimientoRenuncia" 
							class="btn-itramits btn-success-itramits" data-bs-dismiss="modal">Guarda</button>
        				</div>				
    					</div>
  					</div>
				</div>
		</div>

<script>
	function generaResolucionPorDesestimiento(id, convocatoria, programa, nifcif) {
		let todoBien = true
		let fecha_REC = document.getElementById('fecha_REC')
		let ref_REC = document.getElementById('ref_REC')
	 	let fecha_REC_desestimiento = document.getElementById('fecha_REC_desestimiento') //0000-00-00
		let ref_REC_desestimiento = document.getElementById('ref_REC_desestimiento')
		
		let wrapper_motivoDesestimientoRenuncia = document.getElementById('wrapper_motivoDesestimientoRenuncia')
		let infoMissingDataDoc22 = document.getElementById('infoMissingDataDoc22')
		infoMissingDataDoc22.innerText = ""

		if(!fecha_REC.value) {
			infoMissingDataDoc22.innerHTML = infoMissingDataDoc22.innerHTML + "Data SEU sol·licitud<br>"
			todoBien = false
		}
		if(!ref_REC.value) {
			infoMissingDataDoc22.innerHTML = infoMissingDataDoc22.innerHTML + "Referència SEU sol·licitud<br>"
			todoBien = false
		}
	 	if(!fecha_REC_desestimiento.value) {
			infoMissingDataDoc22.innerHTML = infoMissingDataDoc22.innerHTML + "Data SEU desistiment<br>"
			todoBien = false
		}
		if(!ref_REC_desestimiento.value) {
			infoMissingDataDoc22.innerHTML = infoMissingDataDoc22.innerHTML + "Referència SEU desistiment<br>"
			todoBien = false
		}
	
		if (todoBien) {
			infoMissingDataDoc22.classList.add('ocultar')
			wrapper_motivoDesestimientoRenuncia.disabled = true
			wrapper_motivoDesestimientoRenuncia.innerHTML = "Generant i enviant ..."
			window.location.href = base_url+'/'+id+'/'+convocatoria+'/'+programa+'/'+nifcif+'/doc_res_desestimiento_por_renuncia'
		} else {
			infoMissingDataDoc22.classList.remove('ocultar')
		}
	}
</script>