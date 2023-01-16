<!----------------------------------------- Proposta resolució denegació ajut sin requeriment. SIN VIAFIRMA OK-->
<div class="card-itramits">
  	<div class="card-itramits-body">
    	Proposta de resolució de denegació sense requeriment	
  	</div>
  	<div class="btn-group" role="group" aria-label="generar informe">

	  	<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<button type = "button" class = "btn-primary-itramits" data-toggle = "modal" data-target = "#myDenegacion_9" id="myBtnResDenegacionSinReq">Genera la proposta</button>
			<span id="btn_9" class="">
    			<a id="wrapper_motivoDenegacion_9" class="ocultar" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_denegacion_sin_req');?>" class="btn btn-primary-itramits">Genera el PDF de la proposta</a>
			</span>
			<span id="spinner_9" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
		<?php }?>
	
	</div>	  
  	<div class="card-itramits-footer">
		<?php if ($expedientes['doc_prop_res_denegacion_sin_req'] !=0) { ?> <!--Si existe el documento PDF muetra el enlace -->
			<a class='btn btn-ver-itramits' href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_denegacion_sin_req');?>" 
			target = "_self"><i class='fa fa-check'></i>La proposta de resolució</a>	 	
		<?php }?>
		<?php //} else {?> <!-- En caso de no existir el documento PDF muestra el botón para generarlo-->
            <!-- The Modal -->
			<div id="myDenegacion_9" class="modal fade" role="dialog">
				<div class="modal-dialog">
                    <!-- Modal content-->
    				<div class="modal-content" style = "width: 80%;">
      					<div class="modal-header">
      					<label for="motivoResDenegacionConReq"><strong>Escriu el motiu de la denegació:</strong></label>
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
      					</div>
      					<div class="modal-body">
							<div class="form-group">
								<textarea rows="10" cols="30" class="form-control" id="motivoDenegacion_9" 
									placeholder="Motiu de la denegació"><?php echo $expedientes['motivoDenegacion']; ?></textarea>
        					</div>
							<div class="form-group">
           						<button type="button" onclick = "javaScript: actualizaMotivoDenegacionSinReq_click();" id="guardaMotivoDenegacion" 
								   	class="btn-itramits btn-success-itramits">Guarda</button>
        					</div>				
    					</div>
  					</div>
				</div>
			</div>
				<script>
					// Get the modal
					let modal_9 = document.getElementById("myDenegacion_9");
					// Get the button that opens the modal
					let btn_9 = document.getElementById("myBtnResDenegacionSinReq");
					// Get the <span> element that closes the modal
					let span_9 = document.getElementsByClassName("close")[0];
					// When the user clicks the button, open the modal 
					btn_9.onclick = function() {
						modal_9.style.display = "block";
					}
					// When the user clicks on <span> (x), close the modal
					span_9.onclick = function() {
						modal_9.style.display = "none";
					}
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
  					if (event.target == modal_9) {
						modal_9.style.display = "none";
  					}
					}
				</script>
			
		<?php //}?>
  	</div>
</div>