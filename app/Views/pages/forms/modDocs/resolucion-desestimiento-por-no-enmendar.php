<!----------------------------------------- Resolució desistiment por no esmenar SIN VIAFIRMA--------------------------------->
<div class="card-itramits">

  <div class="card-itramits-body">
  	Resolució desistiment per no esmenar
  </div>

  	<div class="card-itramits-footer">

	  <?php
        if ( !$esAdmin && !$esConvoActual ) {?>
        <?php }
        else {?>
			<a href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_desestimiento_por_no_enmendar');?>" class="btn-primary-itramits">Genera el desistiment per no esmenar</a>
			<span id="spinner_21" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
		<?php }?>  

	</div>

  	<div class="card-itramits-footer">
	<?php if ($expedientes['doc_res_desestimiento_por_no_enmendar'] !=0) { ?>
        <a class='btn btn-ver-itramits' href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_res_desestimiento_por_no_enmendar');?>" target = "_self"><i class='fa fa-check'></i>El desistiment per no esmenar</a>	
		<?php }?>
	<?php //} else {?>
        
	<?php //}?>
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>