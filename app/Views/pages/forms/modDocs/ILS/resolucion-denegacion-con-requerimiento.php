<!----------------------------------------- Resolució denegació amb requeriment SIN VIAFIRMA-->
<div class="card-itramits">
	<div class="card-itramits-body">
		Resolució de denegació <strong style="background-color:#c5eae2;padding:0.5rem;">amb</strong> requeriment
	</div>
	<div class="card-itramits-footer">

		<?php
		if (!$esAdmin && !$esConvoActual) { ?>
		<?php } else { ?>
			<a id="generadoc_res_denegacion_con_req" href="<?php echo base_url('public/index.php/expedientes/generainformeILS/' . $id . '/' . $convocatoria . '/' . $programa . '/' . $nifcif . '/doc_res_denegacion_con_req_ils'); ?>" class="btn-primary-itramits">Genera la resolució</a>
			<span id="spinner_12" class="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#cbebe9;"></i></span>
		<?php } ?>

	</div>
	<div class="card-itramits-footer">
		<?php if ($expedientes['doc_res_denegacion_con_req_ils'] != 0) { ?>
			<a href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_denegacion_con_req_ils');?>" target = "_self"><div class = 'btn btn-ver-itramits'><i class='fa fa-check'></i>La resolució de denegació</div></a>

		<?php } ?>
		<?php //} else {
		?>
		<?php //}
		?>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------>