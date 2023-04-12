<!----------------------------------------- Acta de cierre -->
<div class="card-itramits">

  	<div class="card-itramits-body">
    	Acta de tancament
  	</div>
  	<div class="btn-group">
	  	<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<button type = "button" class = "btn-primary-itramits" data-bs-toggle="modal" data-bs-target="#myActaDeCierre" id="myBtnActaDeCierre">Genera l'acta</button>
			<button type = "button" class = "btn-primary-itramits" data-bs-toggle="modal" data-bs-target="#myEnviarJustificador" id="myBtnEnviarJustificador">Envia la justificació</button>       
		<?php }?>
		<span id="btn_17" class="">
    		<a id="wrapper_ActaDeCierre" class="ocultar" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_acta_de_cierre');?>" class="btn-primary-itramits">Envia a signar l'acta</a>      	
		</span>	
		<span id="spinner_17" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
	</div>
  	<div class="card-itramits-footer">
	<?php if ($expedientes['doc_acta_kickoff'] !=0) { ?>

	<?php 
    //Compruebo el estado de la firma del documento.
/* 	   $db = \Config\Database::connect();
	   $sql = "SELECT publicAccessId FROM pindust_documentos_generados WHERE name='doc_acta_de_cierre.pdf' AND id_sol=".$expedientes['id']." AND convocatoria='".$expedientes['convocatoria']."'";
	   $query = $db->query($sql);
	   $row = $query->getRow(); */
		 $tieneDocumentosGenerados = $modelDocumentosGenerados->documentosGeneradosPorExpedYTipo($expedientes['id'], $expedientes['convocatoria'],'doc_acta_kickoff.pdf');
	   if (isset($tieneDocumentosGenerados))
	   {
    	$PublicAccessId = $tieneDocumentosGenerados->publicAccessId;
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
					    $estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId)."><div class = 'warning-msg'><i class='fa fa-warning'></i>Signatura rebutjada</div>";
					$estado_firma .= "</a>";				
					break;
					case 'COMPLETED':
					    $estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>Signat";		
					$estado_firma .= "</a>";					
					break;
					case 'IN_PROCESS':
					    $estado_firma = "<a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><div class='info-msg'><i class='fa fa-check'></i>En curs</div>";		
					$estado_firma .= "</a>";						
					default:
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Desconegut</div>";
					}
			 	echo $estado_firma;
		}
	?>

		<?php }?>
		<div id="wrapper_generaActaDeCierre" class="">
		
    </div>

    <!-- The Modal para generar el acta de cierre-->
		<div class="modal" id="myActaDeCierre">
			<div class="modal-dialog">
				<div class="modal-content">	
					<div class="modal-header">
					<h4 class="modal-title">Dades per generar l'acta de tancament</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  					</div>

    				<div class="modal-body">
                        <div class="form-group">
						    <label style = "color: orange;" for = "actaNumCierre"><strong>Document Acta núm.:</strong></label>
						    <input type="text" required width="50%" name="actaNumCierre" class="form-control" id = "actaNumCierre" 
						    placeholder="Acta número" value = "<?php echo $expedientes['actaNumCierre']; ?>">
        			    </div>
					
                        <div class="form-group">
                            <label style = "color: orange;"  for = "fecha_reunion_cierre_modal"><strong>Data reunió tancament:</strong></label>
                            <input type = "date" readonly width="50%" name = "fecha_reunion_cierre_modal" class = "form-control" id = "fecha_reunion_cierre_modal" value = "<?php if ($expedientes['fecha_reunion_cierre'] != null) {echo date_format(date_create($expedientes['fecha_reunion_cierre']), 'Y-m-d');}?>">
                        </div>

					    <div class="form-group">
                            <label style = "color: orange;" for = "fecha_limite_justificacion_modal"><strong>Data límit per justificar l'ajut rebut: </strong></label>
                            <input type = "date" readonly name = "fecha_limite_justificacion_modal" class = "form-control" id = "fecha_limite_justificacion_modal" value = "<?php echo date_format(date_create($expedientes['fecha_limite_justificacion']), 'Y-m-d');?>">
                        </div>

  		    			<div class="form-group">
                            <label style = "color: orange;" for = "horaInicioActaCierre"><strong>Hora inici:</strong></label>
                            <input type = "time" required width="50%" name = "horaInicioActaCierre" class = "form-control" id = "horaInicioActaCierre" value = "<?php echo $expedientes['horaInicioActaCierre'];?>">
                        </div>
  					
  					    <div class="form-group">
                            <label style = "color: orange;" for = "horaFinActaCierre"><strong>Hora acabament:</strong></label>
                            <input type = "time" required width="50%" name = "horaFinActaCierre" class = "form-control" id = "horaFinActaCierre" value = "<?php echo $expedientes['horaFinActaCierre'];?>">
                        </div>

                        <div class="form-group">
                            <label style = "color: orange;" for = "lugarActaCierre"><strong>Lloc:</strong></label>
                            <input type = "text" required name = "lugarActaCierre" class = "form-control" id = "lugarActaCierre" value = "<?php echo $expedientes['lugarActaCierre']; ?>">
                        </div>

				  	    <div class="form-group">
                        	<label style = "color: orange;" for = "asistentesActaCierre"><strong>Assistents: </strong></label>
                        	<textarea rows="5" cols="40" required name="asistentesActaCierre" class="form-control" id = "asistentesActaCierre" 
							placeholder="Assistents"><?php echo $expedientes['asistentesActaCierre']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label style = "color: orange;" for = "observacionesActaCierre"><strong>Observacions: </strong></label>
                            <textarea rows="5" cols="40" name="observacionesActaCierre" class="form-control" id = "observacionesActaCierre" 
						    placeholder="Observacions"><?php echo $expedientes['observacionesActaCierre']; ?></textarea>
                        </div>	 					

					    <div class="form-group">
           				    <button type="button" onclick = "javaScript: actualizaActaCierre_click();" id="guardaMotivoActaDeCierre" 
											class="btn-itramits btn-success-itramits" data-bs-dismiss="modal">Guarda</button>
        				</div>	
					</div>
				</div>
			</div>
		</div>

 		<!-- The Modal para generar el correo de justificación-->
 		<div class="modal" id="myEnviarJustificador">
			<div class="modal-dialog">
				<div class="modal-content">	
					<div class="modal-header">
						<h4 class="modal-title">Enviar correu electrònic per justificació</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  				</div>
    				<div class="modal-body">
						<div class="form-group">
							<span>Vols enviar un correu electrònic al sol·licitant de l'ajuda perquè pugui realitzar la justificació?</span>
						</div>	
						<div class="form-group">
           				    <button type="button" onclick = "javaScript: enviaMailJustificacion_click();" id="enviaMailJustificacion" class="btn-itramits btn-success-itramits">Enviar
							   <span id="spinner_171" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:24px; color:#1AB394;"></i></span>
							   </button>
							   <span id="mensaje" class ="ocultar info-msg"></span>
        				</div>	
					</div>
				</div>
			</div>
		</div>
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>