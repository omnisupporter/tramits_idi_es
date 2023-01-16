<!----------------------------------------- Resolució concessió sense requeriment SIN VIAFIRMA-->
<div class="card-itramits">
  	<div class="card-itramits-body">
    	Resolució concessió sense requeriment
	</div>
	<div class="card-itramits-footer">

		<?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
    		<a id="generadoc_res_conces_sin_req" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_conces_sin_req');?>" class="btn-primary-itramits">Genera la resolució</a>
			<span id="spinner_11" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
		<?php }?>
	
	</div>
	<div class="card-itramits-footer">
	<?php if ($expedientes['doc_res_conces_sin_req'] !=0) { ?>
		<a	class='btn btn-ver-itramits' href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_conces_sin_req');?>" target = "_self"><i class='fa fa-check'></i>La resolució de concessió</a>		
		<?php }?>
	<?php //} else {?>

	<?php //}?>	
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>