<!-----------------------------------------6.-abril_Proposta resolucio concessió ajut_ amb requeriment SIN VIAFIRMA OK-->
<div class="card-itramits">
	<div class="card-itramits-body">
    	6. Proposta resolució concessió amb requeriment		
	</div>
	<div class="card-itramits-footer">

		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<a href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_conces_con_req');?>" class="btn-primary-itramits">Genera la proposta</a>
			<span id="spinner_6" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
		<?php }?>

	</div>
  	<div class="card-itramits-footer">
	<?php if ($expedientes['doc_prop_res_conces_con_req'] !=0) { ?>
		<a class='btn btn-ver-itramits' href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_prop_res_conces_con_req');?>" target = "_self"><i class='fa fa-check'></i>La proposta de resolució</a>	 	
		<?php }?>
	<?php //} else {?>
    	
	<?php //}?>
  	</div>
</div>
<!-------------------------------------------------------------------------------------------------------------------->