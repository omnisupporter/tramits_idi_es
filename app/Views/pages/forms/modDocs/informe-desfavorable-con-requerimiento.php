<!-- -------------------------------------- Informe desfavorable amb requeriment 2021 OK-->
<div class="card-itramits">
  <div class="card-itramits-body">
     Informe desfavorable amb requeriment	
  </div>
  <div class="btn-group" role="group" aria-label="generar informe">

  		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
  			<button type = "button" class = "btn-primary-itramits" data-toggle = "modal" data-target = "#mygeneraInformeDesfConReq" id="myBtngeneraInformeDesfConReq">Generar l'informe</button>
			<span id="btn_4" class="">					
    			<a id ="wrapper_generaInformeDesfConReq" class="ocultar" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_informe_desfavorable_con_requerimiento');?>" class="btn btn-primary-itramits">Envia a signar el document</a>      	
			</span>
			<span id="spinner_4" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>	
		<?php }?>
			
	</div>

  	<div class="card-itramits-footer">
	<?php //if ($expedientes['doc_informe_desfavorable_con_requerimiento'] !=0) { ?>
	<?php 
		$db = \Config\Database::connect();
		$sql = "SELECT * FROM pindust_documentos_generados WHERE name='doc_informe_desfavorable_con_requerimiento.pdf' AND id_sol=".$expedientes['id']." AND convocatoria='".$expedientes['convocatoria']."'";// AND tipo_tramite='".$expedientes['tipo_tramite']."'";
		$query = $db->query($sql);
		$row = $query->getRow();
		if (isset($row))
		{
	   	$PublicAccessId = $row->publicAccessId;
		$requestPublicAccessId = $PublicAccessId;
		$request = execute("requests/".$requestPublicAccessId, null, __FUNCTION__);
		$respuesta = json_decode ($request, true);
		$estado_firma = $respuesta['status'];
		switch ($estado_firma)
			{
			case 'NOT_STARTED':
			$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Pendent de signar</div>";				
			break;
			case 'REJECTED':
			$estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId)."><i class='fa fa-warning'></i>Signatura rebutjada";
			$estado_firma .= "</a>";				
			break;
			case 'COMPLETED':
			$estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>Signat";		
			$estado_firma .= "</a>";					
			break;
			case 'IN_PROCESS':
			$estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>En curs";		
			$estado_firma .= "</a>";						
			default:
			$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Desconegut</div>";
			}
			echo $estado_firma;
		}			
			 ?>		
	<?php //} else {?>
            	<!-- El Modal -->
				<div id="mygeneraInformeDesfConReq" class="modal fade" role="dialog">
				<div class="modal-dialog">
                    <!-- Modal content-->
    				<div class="modal-content" style = "width: 80%;">
      					<div class="modal-header">
      					<label for="motivogeneraInformeDesfConReq"><strong>Escriu el motiu de la denegació:</strong></label>
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
      					</div>
      					<div class="modal-body">
							<div class="form-group">
            					<input type="hidden" name="motivogeneraInformeDesfConReq_valor" class="form-control" id = "motivogeneraInformeDesfConReq_valor" required placeholder="Nom del sol·licitant" value="<?php echo $expedientes['motivoDenegacion']; ?>">
								<textarea rows="10" cols="30" name="motivogeneraInformeDesfConReq" class="form-control" id = "motivogeneraInformeDesfConReq" min="0" placeholder="Motiu de la denegació"></textarea>
        					</div>
							<div class="form-group">
							    <button type="button" onclick = "javaScript: actualizaMotivoDesfavorableConReq_click();" id="guardaMotivogeneraInformeDesfConReq" class="btn-itramits btn-success-itramits">Guarda</button>
        					</div>			
    					</div>
  					</div>
				</div>
				</div>
				
				<script>
					document.getElementById("motivogeneraInformeDesfConReq").value =  document.getElementById("motivogeneraInformeDesfConReq_valor").value; 
					// Get the modal
					let modal2 = document.getElementById("mygeneraInformeDesfConReq");
					//// Get the button that opens the modal
					let btn2 = document.getElementById("myBtngeneraInformeDesfConReq");
					// Get the <span> element that closes the modal
					let span2 = document.getElementsByClassName("close")[0];
					// When the user clicks the button, open the modal 
					btn2.onclick = function() {
	  					modal2.style.display = "block";
					}
					// When the user clicks on <span> (x), close the modal
					span2.onclick = function() {
	  					modal2.style.display = "none";
					}
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
  						if (event.target == modal2) {
	   						modal2.style.display = "none";
  					}
					}
				</script>
						
				<div id="wrapper_motivogeneraInformeDesfConReq" class="ocultar">
				</div>
 	<?php //}?>	
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>