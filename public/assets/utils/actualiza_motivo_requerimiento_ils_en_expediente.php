<?php
require_once 'conectar_a_bbdd.php';
$nom_doc = "";
$query = 'UPDATE pindust_expediente SET motivoRequerimientoIls = "' . $nom_doc . '" WHERE  id = ' . $_POST["id"];
$result = mysqli_query($conn, $query);

//$nom_doc = "Necessitem que ens faci arribar la següent documentació:\r\n";

$textoMotivoReq = mysqli_real_escape_string($conn, $_POST["textoMotivoReq"]);

$textoMotivoReq = explode( ",", $textoMotivoReq );

for ( $i=0; $i<count($textoMotivoReq); $i++ ) {

  switch ( $textoMotivoReq[$i] ) {
    case 'file_infoautodiagnostico':
      $nom_doc .= "\r\n- Informe autodiagnosi digital.";
      break;
    case 'file_certificadoIAE':
      $nom_doc .= "\r\n- Certificat d'alta d'IAE.";
      break;
    case 'file_declaracionResponsable':
      $nom_doc .= "\r\n- Declaració responsable de l'empresa.";
      break;
    case 'file_declaracionResponsableConsultor':
      $nom_doc .= "\r\n- Declaració responsable del consultor.";
      break;
    case 'file_memoriaTecnica':
      $nom_doc .= "\r\n- La memòria tècnica.";
      break;
    case 'file_document_acred_como_repres':
        $nom_doc .= "\r\n- Documentació acreditativa de les facultats de representació de la persona que firma la sol·licitud d'ajut.";
      break;
    case 'file_docConstitutivoCluster':	
      $nom_doc .= "\r\n- Document constitutiu clústers i/o centres tecnològics.";
      break;    					
    case 'file_certigicadoSegSoc':
      $nom_doc .= "\r\n- Certificat de la Seguretat Social.";
      break;
    case 'file_certificadoATIB':
      $nom_doc .= "\r\n- Certificat estar al corrent obligacions amb Agència Estatal de l'Administració Tributària i Agència Tributària IB.";
      break;				
    case 'file_copiaNIF':
      $nom_doc .= "\r\n- Còpia del NIF al no autoritzar a IDI per comprobar.";
      break;				
    case 'file_altaAutonomos':	
      $nom_doc .= "\r\n- Còpia documentació acreditativa alta d'autònoms.";
      break;	
    case 'file_escrituraConstitucion':	
      $nom_doc .= "\r\n- Còpia escriptura de constitució de l'entitat.";
      break;
    case 'file_nifEmpresa':	
      $nom_doc .= "\r\n- Còpia del NIF de l'empresa.";
      break;
    case 'file_nifRepresentante':	
      $nom_doc .= "\r\n- Còpia del NIF del representant de la societat.";
      break;
    case 'file_certificadoDocumentacion':	
      $nom_doc .= "\r\n- Certificats i documentació corresponent (al no donar consentiment a l'IDI).";
      break;
    case 'file_declNoConsentimiento':	
      $nom_doc .= "\r\n- Declaració de no consentiment.";
      break;
    case 'file_enviardocumentoIdentificacion':	
      $nom_doc .= "\r\n- Identificació de la persona sol·licitant i/o la persona autoritzada per l’empresa.";
      break;
    case 'file_certificadoSegSoc':	
      $nom_doc .= "\r\n- Certificat estar al corrent obligacions amb la Tesoreria de la Seguridad Social.";
      break;
    case 'file_resguardoREC':	
      $nom_doc .= "\r\n- Justificant de presentació pel REC.";
      break;
    case 'file_DocumentoIDI':	
      $nom_doc .= "\r\n- Document pujat des-de l'IDI.";
      break;
    case 'file_escritura_empresa':	
      $nom_doc .= "\r\n- Escriptures del registre Mercantil.";
      break;
    case 'file_logotipoEmpresaIls':	
      $nom_doc .= "\r\n- Logotip de l'empresa.";
      break; 
    case 'file_informeResumenIls':	
      $nom_doc .= "\r\n- Informe resum de la petjada de carboni.";
      break;
    case 'file_informeInventarioIls':	
      $nom_doc .= "\r\n- Informe d'Inventari de GEH segons la norma ISO 14.064-1.";
      break;
    case 'file_modeloEjemploIls':	
      $nom_doc .= "\r\n- Compromís de reducció de les emissions de gasos d'efecte hivernacle.";
      break;
    case 'file_lineaProduccionBalearesIls':	
      $nom_doc .= "\r\n- Declaració responsable de que l'empresa compta amb una línia de producció activa a les Illes Balears.";
      break;
    case 'file_certificado_itinerario_formativo':	
      $nom_doc .= "\r\n- Certificat itinerari formatiu.";
      break;
    case 'file_certificado_verificacion_ISO':	
      $nom_doc .= "\r\n- Certificat verificació ISO.";
      break;    
    default:
      $nom_doc .=  $textoMotivoReq[$i]; 
  }

}

$query = 'UPDATE pindust_expediente SET motivoRequerimientoIls = "' . $nom_doc . '",doc_requeriment_auto_ils = 1  WHERE  id = ' . $_POST["id"];
$result = mysqli_query($conn, $query);

//mysqli_close($conn);
echo $result;
?>