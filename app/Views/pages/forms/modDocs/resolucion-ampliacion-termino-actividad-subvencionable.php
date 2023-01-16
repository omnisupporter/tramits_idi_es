<!----------------------------------------- Resolució ampliaciò termini activitat subvencionable SIN VIAFIRMA OK-->
<div class="card-itramits">
  	<div class="card-itramits-header">
  		<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:48px;color:#1AB394"></i>
  	</div>
  	<div class="card-itramits-body">
    	Acord ampliació termini activitat subvencionable.
  	</div>
  	<div class="card-itramits-footer">
	  <span id="btn_16" class="">	
	  <a class="btn-primary-itramits" href="<?php echo base_url('public/index.php/expedientes/generaInforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_acuerdo_amp_term_act_sub');?>">Genera l'acord</a>
		</span>
		<span id="spinner_16" class ="ocultar"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:#000000;"></i></span>
	</div>
  	<div class="card-itramits-footer">
 	<?php if ($expedientes['doc_acuerdo_amp_term_act_sub'] !=0) { ?>
		<a class="btn btn-ver-itramits" href="<?php echo base_url('public/index.php/expedientes/muestrainforme/'.$id.'/'.$convocatoria.'/'.$programa.'/'.$nifcif.'/doc_acuerdo_amp_term_act_sub');?>" target = "_self"><i class='fa fa-check'></i>L'acord</a>	 	
	<?php }?>
	<?php //} else {?>
    	
	<?php //}?>	
  	</div>
</div>
<!------------------------------------------------------------------------------------------------------>