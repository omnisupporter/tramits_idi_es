
<h1 id="js-counter"> Sellado parado. </h1>
<div class = "lista-exped-wrapper">
<button id = "btn_start_Stamping" type="button"> Sellar documentos adjuntos </button>
<button id = "btn_stop_Stamping" disabled type="button"> Parar sellado </button>

<table id = "resultados">
<thead>
    <tr>
      <th scope="col">Document enviat a segellar</th>
    </tr>
</thead>
  <tbody></tbody> 
</table>
<div class = "lista-exped-wrapper">
	<div class = "header-custodia-wrapper">
		<div class="header-wrapper-col">Total documents custodiats</div><div class="header-wrapper-col">Total documents pendents de custodiar</div>
	</div>
	<div id ="fila" class = "detail-custodia-wrapper">
		<div class="header-wrapper-col"><?php 
		foreach ($totalCustodiados as $item) {
			echo "<strong>".$item->totalCustodiados."</strong>";
		}
		?></div>
		<div class="header-wrapper-col"><?php 
		foreach ($totalPendientes as $item) {
			echo "<strong>".$item->totalPendientes."</strong>";
		}
		?></div>
	</div>
</div>
<!--<button id="selladorBtn" >Sellar un documento</button>-->
<?php
			//if ($documentosSellados) {
		?>
  	<!-- The first list item is the header of the table -->
<div class = "lista-exped-wrapper">
<div class = "header-custodia-wrapper">
  <div <?php echo($sort_by == 'cifnif_propietario' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/cifnif_propietario/" . (($sort_order == 'ASC' && $sort_by == 'cifnif_propietario') ? 'DESC' : 'ASC'), 'https');?>">nif/cif sol·licitant</a>
				</div>
	<div <?php echo($sort_by == 'expediente' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/expediente/" . (($sort_order == 'ASC' && $sort_by == 'expediente') ? 'DESC' : 'ASC'), 'https');?>">Expedient</a>					
        </div>
	<div <?php echo($sort_by == 'tipo_tramite' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/tipo_tramite/" . (($sort_order == 'ASC' && $sort_by == 'tipo_tramite') ? 'DESC' : 'ASC'), 'https');?>">Programa</a>
				</div>			
	<div <?php echo($sort_by == 'corresponde_documento' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/corresponde_documento/" . (($sort_order == 'ASC' && $sort_by == 'corresponde_documento') ? 'DESC' : 'ASC'), 'https');?>">Document</a>
				</div>	
	<div <?php echo($sort_by == 'fechaCustodiado' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/fechaCustodiado/" . (($sort_order == 'ASC' && $sort_by == 'fechaCustodiado') ? 'DESC' : 'ASC'), 'https');?>">Data custodiat</a>
				</div>
  <div <?php echo($sort_by == 'publicAccessIdCustodiado' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/publicAccessIdCustodiado/" . (($sort_order == 'ASC' && $sort_by == 'publicAccessIdCustodiado') ? 'DESC' : 'ASC'), 'https');?>">Estat del segell</a>
				</div> 
        <div class="header-wrapper-col"></div>
</div>
  </div>
  <!-- The rest of the items in the list are the actual data -->
  	<?php
	$i = 0;
	foreach ($documentosSellados as $item) {
	$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
		$i++;
		?>
  		<div id ="fila" class = "detail-custodia-wrapper">
   			<span id = "cifnif_propietario" class = "detail-wrapper-col"><?php echo $item->cifnif_propietario; ?></span>
			<span id = "expediente" class = "detail-wrapper-col"><?php echo $item->id_sol.' / '.$item->convocatoria ?></span>										
			<span id = "tipo_tramite" class = "detail-wrapper-col"><?php echo $item->tipo_tramite; ?></span>
			<span id = "corresponde_documento" class = "detail-wrapper-col"><?php 
      		switch ($item->corresponde_documento) {
				case 'file_infoautodiagnostico':
					$nom_doc = "Informe autodiagnosi digital";
					break;
				case 'file_certificadoIAE':
					$nom_doc = "Certificat d'alta d'IAE";
					break;
				case 'file_declaracionResponsable':
					$nom_doc = "Declaració responsable de l'empresa";
					break;
				case 'file_declaracionResponsableConsultor':
					$nom_doc = "Declaració responsable del consultor";
					break;
				case 'file_memoriaTecnica':
					$nom_doc = "Memòria tècnica de l'empresa";
					break;
				case 'file_docConstitutivoCluster':	
						$nom_doc = "Document constitutiu clústers i/o centres tecnològics";
					break;    					
				case 'file_certigicadoSegSoc':
					$nom_doc = "Certificat de la Seguretat Social";
					break;
				case 'file_certificadoATIB':
					$nom_doc = "Certificat obligacions tributàries amb Agència Estatal de l'Administració Tributària i Agència Tributària IB";
					break;				
				case 'file_copiaNIF':
					$nom_doc = "Còpia del NIF";
					break;				
				case 'file_altaAutonomos':	
					$nom_doc = "Còpia documentació acreditativa alta d'autònoms";
					break;	
				case 'file_escrituraConstitucion':	
					$nom_doc = "Còpia escriptura de constitució de l'entitat";
					break;
				case 'file_nifEmpresa':	
					$nom_doc = "Còpia del NIF de l'empresa";
					break;
				case 'file_nifRepresentante':	
					$nom_doc = "Còpia del NIF del representant de la societat";
					break;
				case 'file_certificadoDocumentacion':	
					$nom_doc = "Certificats i documentació corresponent (al no donar consentiment a l'IDI)";
					break;
				case 'file_declNoConsentimiento':	
					$nom_doc = "Declaració de no consentiment";
          			break;
				case 'file_enviardocumentoIdentificacion':	
					$nom_doc = "Identificació de la persona sol·licitant i/o la persona autoritzada per l’empresa";
					break;   
        		case 'file_resguardoREC':	
            		$nom_doc = "Document enregistrat per mitjá del REC";
            		break;            
  			    default:
					$nom_doc = $item->corresponde_documento;
        	}
        	echo $nom_doc;?></span>
			<span id = "fechaCustodiado" class = "detail-wrapper-col"><?php echo $item->fechaCustodiado; ?></span>			
			<span class = "detail-wrapper-col"> 
				<a href="<?php echo base_url('/public/index.php/expedientes/muestrasolicitudfirmada/'.$item->publicAccessIdCustodiado);?>"><div class = 'verSello' id='<?php echo $item->publicAccessIdCustodiado;?>'>ver sello</div></a>
			</span>
			<span class = "detail-wrapper-col"><a href="<?php echo base_url('/public/index.php/expedientes/edit/'.$item->id);?>" class="btn btn-itramits-info">Veure expedient</a></span>
  		</div>
<?php
	}
?>
	</div>
</div>

<h1 id="titulo_doc_justificacion"> Sellado parado. </h1>
<button id="btn_sellar_justificacion" type="button"> Sellar documentos justificación </button>
<button id="btn_parar_sellar_justificacion" disabled type="button"> Parar sellado </button>
<table id="resultadosJustificacion">
<thead>
    <tr>
      <th scope="col">Document enviat a segellar</th>
    </tr>
</thead>
  <tbody></tbody> 
</table>
<div class = "lista-exped-wrapper">
	<div class = "header-custodia-wrapper">
		<div class="header-wrapper-col">Total documents justificació custodiats</div><div class="header-wrapper-col">Total documents justificació pendents de custodiar</div>
	</div>
	<div id ="fila" class = "detail-custodia-wrapper">
		<div class="header-wrapper-col"><?php 
		foreach ($totalCustodiadosJustificacion as $item) {
			echo "<strong>".$item->totalCustodiados."</strong>";
		}
		?></div>
		<div class="header-wrapper-col"><?php 
		foreach ($totalPendientesJustificacion as $item) {
			echo "<strong>".$item->totalPendientes."</strong>";
		}
		?></div>
	</div>
</div>

<div class = "lista-exped-wrapper">
<div class = "header-custodia-wrapper">
  <div <?php echo($sort_by == 'cifnif_propietario' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/cifnif_propietario/" . (($sort_order == 'ASC' && $sort_by == 'cifnif_propietario') ? 'DESC' : 'ASC'), 'https');?>">nif/cif sol·licitant</a>
				</div>
	<div <?php echo($sort_by == 'expediente' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/expediente/" . (($sort_order == 'ASC' && $sort_by == 'expediente') ? 'DESC' : 'ASC'), 'https');?>">Expedient</a>					
        </div>
	<div <?php echo($sort_by == 'tipo_tramite' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/tipo_tramite/" . (($sort_order == 'ASC' && $sort_by == 'tipo_tramite') ? 'DESC' : 'ASC'), 'https');?>">Programa</a>
				</div>			
	<div <?php echo($sort_by == 'corresponde_documento' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/corresponde_documento/" . (($sort_order == 'ASC' && $sort_by == 'corresponde_documento') ? 'DESC' : 'ASC'), 'https');?>">Document</a>
				</div>	
	<div <?php echo($sort_by == 'fechaCustodiado' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/fechaCustodiado/" . (($sort_order == 'ASC' && $sort_by == 'fechaCustodiado') ? 'DESC' : 'ASC'), 'https');?>">Data custodiat</a>
				</div>
  <div <?php echo($sort_by == 'publicAccessIdCustodiado' ? 'class="header-wrapper-col sort_'.$sort_order.'"' : 'class="header-wrapper-col"'); ?>>
			<a href="<?php echo base_url("/public/index.php/expedientes/ordenarExpedientes/publicAccessIdCustodiado/" . (($sort_order == 'ASC' && $sort_by == 'publicAccessIdCustodiado') ? 'DESC' : 'ASC'), 'https');?>">Estat del segell</a>
				</div> 
        <div class="header-wrapper-col"></div>
</div>
  </div>
  <!-- The rest of the items in the list are the actual data -->
  	<?php
	$i = 0;
	foreach ($documentosSelladosJustificacion as $item) {
	$col_class = ($i % 2 == 0 ? 'odd_col' : 'even_col');
		$i++;
		?>
  		<div id ="fila" class = "detail-custodia-wrapper">
   			<span id = "cifnif_propietario" class = "detail-wrapper-col"><?php echo $item->cifnif_propietario; ?></span>
			<span id = "expediente" class = "detail-wrapper-col"><?php echo $item->id_sol.' / '.$item->convocatoria ?></span>										
			<span id = "tipo_tramite" class = "detail-wrapper-col"><?php echo $item->tipo_tramite; ?></span>
			<span id = "corresponde_documento" class = "detail-wrapper-col"><?php 
      		switch ($item->corresponde_documento) {
				case 'file_infoautodiagnostico':
					$nom_doc = "Informe autodiagnosi digital";
					break;
				case 'file_certificadoIAE':
					$nom_doc = "Certificat d'alta d'IAE";
					break;
				case 'file_declaracionResponsable':
					$nom_doc = "Declaració responsable de l'empresa";
					break;
				case 'file_declaracionResponsableConsultor':
					$nom_doc = "Declaració responsable del consultor";
					break;
				case 'file_memoriaTecnica':
					$nom_doc = "Memòria tècnica de l'empresa";
					break;
				case 'file_docConstitutivoCluster':	
						$nom_doc = "Document constitutiu clústers i/o centres tecnològics";
					break;    					
				case 'file_certigicadoSegSoc':
					$nom_doc = "Certificat de la Seguretat Social";
					break;
				case 'file_certificadoATIB':
					$nom_doc = "Certificat obligacions tributàries amb Agència Estatal de l'Administració Tributària i Agència Tributària IB";
					break;				
				case 'file_copiaNIF':
					$nom_doc = "Còpia del NIF";
					break;				
				case 'file_altaAutonomos':	
					$nom_doc = "Còpia documentació acreditativa alta d'autònoms";
					break;	
				case 'file_escrituraConstitucion':	
					$nom_doc = "Còpia escriptura de constitució de l'entitat";
					break;
				case 'file_nifEmpresa':	
					$nom_doc = "Còpia del NIF de l'empresa";
					break;
				case 'file_nifRepresentante':	
					$nom_doc = "Còpia del NIF del representant de la societat";
					break;
				case 'file_certificadoDocumentacion':	
					$nom_doc = "Certificats i documentació corresponent (al no donar consentiment a l'IDI)";
					break;
				case 'file_declNoConsentimiento':	
					$nom_doc = "Declaració de no consentiment";
          			break;
				case 'file_enviardocumentoIdentificacion':	
					$nom_doc = "Identificació de la persona sol·licitant i/o la persona autoritzada per l’empresa";
					break;   
        		case 'file_resguardoREC':	
            		$nom_doc = "Document enregistrat per mitjá del REC";
            		break;            
  			    default:
					$nom_doc = $item->corresponde_documento;
        	}
        	echo $nom_doc;?></span>
			<span id = "fechaCustodiado" class = "detail-wrapper-col"><?php echo $item->fechaCustodiado; ?></span>			
			<span class = "detail-wrapper-col"> 
				<a href="<?php echo base_url('/public/index.php/expedientes/muestrasolicitudfirmada/'.$item->publicAccessIdCustodiado);?>"><div class = 'verSello' id='<?php echo $item->publicAccessIdCustodiado;?>'>ver sello</div></a>
			</span>
			<span class = "detail-wrapper-col"><a href="<?php echo base_url('/public/index.php/expedientes/edit/'.$item->id);?>" class="btn btn-itramits-info">Veure expedient</a></span>
  		</div>
<?php
	}
?>
	</div>
</div>
<script type="text/javascript" src="/public/assets/js/custodia.js"></script>