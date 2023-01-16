<!----------------------------------------- Informe de liquidación SIN VIAFIRMA OK-->
<div class="card-itramits">
  	<div class="card-itramits-body">
    	 Informe de liquidació		
  	</div>
	<div class="card-itramits-footer">
	
		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<a href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_informe_de_liquidacion');?>" class="btn-primary-itramits">Genera l'informe</a>
		<?php }?>
	
	</div>
  	<div class="card-itramits-footer">
		<?php if ($expedientes['doc_informe_de_liquidacion'] !=0) { ?>
		<?php 
		$db = \Config\Database::connect();
		$sql = "SELECT * FROM pindust_documentos_generados WHERE name='doc_informe_de_liquidacion.pdf' AND id_sol=".$expedientes['id']." AND convocatoria='".$expedientes['convocatoria']."'";// AND tipo_tramite='".$expedientes['tipo_tramite']."'";
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
				$estado_firma = "<div class = 'warning-msg'><a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId)."><i class='fa fa-warning'></i>Signatura rebutjada";
				$estado_firma .= "</a></div>";				
				break;
				case 'COMPLETED':
				$estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>Signat";		
				$estado_firma .= "</a>";					
				break;
				case 'IN_PROCESS':
				$estado_firma = "<div class='info-msg'><a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>En curs";		
				$estado_firma .= "</a></div>";						
				default:
				$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Desconegut</div>";
			}
			echo $estado_firma;
		}		
			 ?>		
		<?php }?>
	</div>	

</div>
<!-------------------------------------------------------------------------------------------------------------------->