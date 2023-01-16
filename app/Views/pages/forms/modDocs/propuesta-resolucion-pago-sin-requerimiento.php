<!----------------------------------------- Proposta de resolució i resolució de pagament sense requeriment SIN VIAFIRMA OK-->
<div class="card-itramits">
  <div class="card-itramits-body">
    Proposta de resolució i resolució de pagament sense requeriment
  </div>
  <div class="card-itramits-footer">

  		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
  			<a class="btn-primary-itramits" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_conces_sin_req');?>">Genera la proposta</a>
			<span id="spinner_7" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>	
		<?php }?>

	</div>
  	<div class="card-itramits-footer">
 	<?php if ($expedientes['doc_prop_res_conces_sin_req'] !=0) { ?>
<!-- 		<a class="btn btn-ver-itramits" href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_conces_sin_req');?>" target = "_self"><i class='fa fa-check'></i>La proposta de resolució</a>
 -->
		<?php 
			$db = \Config\Database::connect();
			$sql = "SELECT * FROM pindust_documentos_generados WHERE name='doc_prop_res_conces_sin_req.pdf' AND id_sol=".$expedientes['id']." AND convocatoria='".$expedientes['convocatoria']."'";// AND tipo_tramite='".$expedientes['tipo_tramite']."'";
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
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Pendent de signar<br>per Gerència IDI</div>";				
					break;
					case 'REJECTED':
					$estado_firma = "<div class = 'warning-msg'><i class='fa fa-warning'></i><a href=".base_url('public/index.php/expedientes/muestrasolicitudrechazada/'.$requestPublicAccessId).">Signatura rebutjada<br>per Gerència IDI";
					$estado_firma .= "</a></div>";				
					break;
					case 'COMPLETED':
					$estado_firma = "<a class='btn btn-ver-itramits' href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." ><i class='fa fa-check'></i>Signat per Gerència IDI";		
					$estado_firma .= "</a>";					
					break;
					case 'IN_PROCESS':
					$estado_firma = "<div class='info-msg'><i class='fa fa-check'></i><a href=".base_url('public/index.php/expedientes/muestrasolicitudfirmada/'.$requestPublicAccessId)." >En curs";		
					$estado_firma .= "</a></div>";						
					default:
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i>Desconegut</div>";
			}
			echo $estado_firma;
	}	?>

	<?php }?>
	<?php //} else {?>

	<?php //}?>	
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>