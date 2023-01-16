<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title><?php echo lang('message_lang.titulo_sol_form_ils');?></title>
	<meta name="description" content="Assistent per sol·licitar l'adhesió al programa i formar part d'ILS">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"> 
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://use.fontawesome.com/5db4446d08.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> 	
	<link rel="icon" type="image/jpg" href="/public/assets/images/headeridi.jpg" />
	<link rel="stylesheet" type="text/css" href="/public/assets/css/style-pindust.css"/>
	<link rel="stylesheet" type="text/css" href="/public/assets/css/estilos.css"/>	
</head>


<?php
		use App\Models\ConfiguracionModel;
		use App\Models\ExpedientesModel;
		$configuracion = new ConfiguracionModel();
		$modelExp = new ExpedientesModel();
		$db = \Config\Database::connect();
		
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
	
		$language = \Config\Services::language();
		$language->setLocale($idioma);
	
		$data['configuracion'] = $configuracion->where('convocatoria_activa', 1)->first();
		$data['expedientes'] = $modelExp->where('id', $id)->first();

?>


<body>
<article>
	<!-- HEADER: MENU + HEROE SECTION -->
	<heade class="header__formempresasils">
		<fieldset  class="header__formempresasils--logo">
			<a href="http://www.idi.es" target="_blank">
				<img class="logo" alt="logo" title="logo" src="<?php echo base_url() ."/public/assets/images/logo_institut_dinnovacio_empresarial_col_horitz.jpg";?>" />
			</a>
		</fieldset>
		<fieldset  class="header__formempresasils--documento">

    	<h5><?php echo lang('message_lang.justificacion_exp');?>:  <?php echo $data['expedientes']['idExp'];?> / <?php echo $data['expedientes']['convocatoria'];?></h5>
    	<h5><?php echo lang('message_lang.destino_solicitud');?>: <?php echo lang('message_lang.idi');?></h5>
    	<h5><?php echo lang('message_lang.codigo_dir3');?> <?php echo $data['configuracion']['emisorDIR3'];?></h5>
  	</fieldset> 
	</heade>
</article>