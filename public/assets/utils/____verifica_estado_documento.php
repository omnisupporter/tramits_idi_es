<?php

require_once 'conectar_a_bbdd.php';

$id = mysqli_real_escape_string($conn, $_GET["id"]);
$response = 'ok';
$query = "SELECT estado, corresponde_documento FROM pindust_documentos WHERE docRequerido='SI' AND id_sol = " . $id;
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $response = '';
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['estado'] === 'Rebutjat') {
            switch ( $row["corresponde_documento"] ) {          
                case 'file_certificadoIAE':
                    $nom_doc = "Certificat d'alta d'IAE.";
                    break;
                case 'file_certigicadoSegSoc':
                    $nom_doc = "Certificat de la Seguretat Social.";
                    break;
                case 'file_certificadoATIB':
                    $nom_doc = "Certificat estar al corrent obligacions amb Agència Estatal de l'Administració Tributària i Agència Tributària IB";
                    break;				
                case 'file_copiaNIF':
                    $nom_doc = "Còpia del NIF al no autoritzar a IDI per comprobar.";
                    break;				
                case 'file_altaAutonomos':	
                    $nom_doc = "Còpia documentació acreditativa alta d'autònoms.";
                    break;	
                case 'file_escrituraConstitucion':	
                    $nom_doc = "Còpia escriptura de constitució de l'entitat.";
                    break;
                case 'file_nifEmpresa':	
                    $nom_doc = "Còpia del NIF de l'empresa.";
                    break;
                case 'file_nifRepresentante':	
                    $nom_doc = "Còpia del NIF del representant de la societat.";
                    break;
                case 'file_certificadoDocumentacion':	
                    $nom_doc = "Certificats i documentació corresponent (al no donar consentiment a l'IDI).";
                    break;
                case 'file_declNoConsentimiento':	
                    $nom_doc = "Declaració de no consentiment.";
                      break;
                case 'file_enviardocumentoIdentificacion':	
                    $nom_doc = "Identificació de la persona sol·licitant i/o la persona autoritzada per l’empresa.";
                    break;
                case 'file_escritura_empresa':	
                    $nom_doc = "Escriptures del registre Mercantil.";
                    break;
                case 'file_informeResumenIls':	
                    $nom_doc = "Informe resum de la petjada de carboni.";
                    break;
                case 'file_informeInventarioIls':	
                    $nom_doc = "Informe d'Inventari de GEH segons la norma ISO 14.064-1.";
                    break;
                case 'file_modeloEjemploIls':	
                    $nom_doc = "Compromís de reducció de les emissions de gasos d'efecte hivernacle.";
                    break;
                case 'file_lineaProduccionBalearesIls':	
                    $nom_doc = "Declaració responsable de que l'empresa compta amb una línia de producció activa a les Illes Balears.";
                    break;
                case 'file_certificado_itinerario_formativo':	
                    $nom_doc = "Certificat itinerari formatiu.";
                    break;
                case 'file_certificado_verificacion_ISO':	
                    $nom_doc = "Certificat verificación ISO.";
                    break;    
                default:
                    $nom_doc = $docs_item->corresponde_documento; 
                }
                $response .= "- ".$nom_doc."\n ";
        }
    }
    echo $response;
} else {
    echo " 0 results ";
}
mysqli_close($conn);

?>