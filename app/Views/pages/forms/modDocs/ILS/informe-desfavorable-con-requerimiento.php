<!-- -------------------------------------- Informe desfavorable amb requeriment 2021 OK-->
<div class="card-itramits">
  	<div class="card-itramits-body">
    	Informe desfavorable <strong style="background-color:#c5eae2;padding:0.5rem;">amb</strong> requeriment	
  	</div>
	<div class="card-itramits-footer">

		<?php
			if ( !$esAdmin && !$esConvoActual ) {?>
		<?php }
			else {?>
				<span id="btn_4_ils" class="">	
					<a id="generaInformeDesfConReq_ils" href="<?php echo base_url('public/index.php/expedientes/generainformeILS/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_informe_desfavorable_con_requerimiento_ils');?>" class="btn-primary-itramits">Generar l'informe</a>
				</span>
				<span id="spinner_4_ils" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#cbebe9;"></i></span>
		<?php }?>

	</div>

  	<div class="card-itramits-footer">
	<?php //if ($expedientes['doc_informe_desfavorable_con_requerimiento'] !=0) { ?>
	<?php 
		$db = \Config\Database::connect();
		$sql = "SELECT * FROM pindust_documentos_generados WHERE name='doc_informe_desfavorable_con_requerimiento_ils.pdf' AND id_sol=".$expedientes['id']." AND convocatoria='".$expedientes['convocatoria']."'";
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
	<?php //} else {?>

 	<?php //}?>	
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>