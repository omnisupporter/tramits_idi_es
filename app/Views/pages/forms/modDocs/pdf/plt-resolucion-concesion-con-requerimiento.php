<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/public/assets/js/edita-expediente.js"></script>
<?php
require_once('tcpdf/tcpdf.php');
setlocale(LC_MONETARY,"es_ES");
    //obtengo los datos de la convocatoria
    use App\Models\ConfiguracionModel;
    use App\Models\ExpedientesModel;
    use App\Models\MejorasExpedienteModel;
    $configuracion = new ConfiguracionModel();
    $data['configuracion'] = $configuracion->where('convocatoria_activa', 1)->first();
    //obtengo los datos de la última mejora de la solicitud (si la hay)
    $mejorasSolicitud = new MejorasExpedienteModel();
    $data['ultimaMejora'] = $mejorasSolicitud->selectLastMejorasExpediente($id);
    $ultimaMejora = explode("##",  $data['ultimaMejora']);
    //obtengo los datos de la solicitud
    $expediente = new ExpedientesModel();
    $data['expediente'] = $expediente->where('id', $id)->first();
    //obtengo los datos del documento
    $db = \Config\Database::connect();
	$query = $db->query("SELECT * FROM pindust_documentos_generados WHERE id_sol=".$id." AND convocatoria='".$convocatoria."' AND tipo_tramite='".$programa."'");
    foreach ($query->getResult() as $row)
        {
        $nif = $row->cifnif_propietario;
        }
        
    $session = session();
        if ($session->has('logged_in')) {  
           $pieFirma =  $session->get('full_name');
        }
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_idi_conselleria.jpg';
        $this->Image($image_file, 10, 10, 90, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	}
    // Page footer
    public function Footer() {
        // Logo

		// Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Address and Page number
        $this->Cell(0, 5, "Institut d'Innovació Empresarial - Plaça Son Castelló 1 - Tel. 971 17 61 61 - 07009 - Palma - Illes Balears", 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 15, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
	
$pdf->SetAuthor("INSTITUT D'INNOVACIÓ EMPRESARIAL DE LES ILLES BALEARS (IDI) - SISTEMES D'INFORMACIÓ");
$pdf->SetTitle("RESOLUCIÓN CONCESIÓN CON REQUERIMIENTO");
$pdf->SetSubject("RESOLUCIÓN CONCESIÓN CON REQUERIMIENTO");
$pdf->SetKeywords("INDUSTRIA 4.0, DIAGNOSTIC, DIGITAL, EXPORTA, ILS, PIMES, IDI, GOIB");	

$pdf->setFooterData(array(0,64,0), array(0,64,128));
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('helvetica', '', 10);
$pdf->setFontSubsetting(false);

// -------------------------------------------------------------- Programa, datos solicitante, datos consultor ------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------- //
$pdf->AddPage();

$currentY = $pdf->getY();
$pdf->setY($currentY + 15);
$html = "Document: resolució de concessió<br>amb requeriment<br>";
$html .= "Núm. Expedient: ". $data['expediente']['idExp']."/".$data['expediente']['convocatoria']." (".$data['expediente']['tipo_tramite'].")"."<br>";
$html .= "Nom sol·licitant: ".$data['expediente']['empresa']."<br>";
$html .= "NIF: ". $data['expediente']['nif']."<br>";
$html .= "Codi SIA: ".$data['configuracion']['codigoSIA']."<br>";
$html .= "Emissor (DIR3): ".$data['configuracion']['emisorDIR3']."<br>";

// set color for background
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 0, 0);
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->writeHTMLCell(90, '', 120, 40, $html, 0, 1, 1, true, 'J', true);
$pdf->SetFont('helvetica', '', 11);
$pdf->setFontSubsetting(false);

$currentY = $pdf->getY();
$pdf->setY($currentY + 15);
$intro = str_replace("%SOLICITANTE%", $data['expediente']['empresa'], lang('message_lang.doc_resolucion_concesion_con_req_intro'));
$intro = str_replace("%NIF%", $data['expediente']['nif'], $intro);
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;font-size:14px;'><b>". $intro ."</b></td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 6);
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;font-size:14px;'><b>". lang('message_lang.doc_resolucion_concesion_con_req_antecedentes') ."</b></td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_1 = str_replace("%RESPRESIDENTE%", $data['configuracion']['respresidente'], lang('message_lang.doc_resolucion_concesion_con_req_p1'));
$parrafo_1 = str_replace("%BOIB%", $data['configuracion']['num_BOIB'], $parrafo_1);
$html = "<ol>";
$html .= "<li>". $parrafo_1 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_2 = str_replace("%FECHAREC%", date_format(date_create($data['expediente']['fecha_REC']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p2'));
$parrafo_2 = str_replace("%SOLICITANTE%", $data['expediente']['empresa'], $parrafo_2);
$parrafo_2 = str_replace("%NIF%", $data['expediente']['nif'], $parrafo_2);
$parrafo_2 = str_replace("%NUMREC%", $data['expediente']['ref_REC'], $parrafo_2);
$parrafo_2 = str_replace("%IMPORTE%", money_format("%i ", $data['expediente']['importeAyuda']), $parrafo_2);
$parrafo_2 = str_replace("%PROGRAMA%", $data['expediente']['tipo_tramite'], $parrafo_2);
$html .= "<li>". $parrafo_2 ."</li>";
$html .= "<br>";

if ($ultimaMejora[2] && $ultimaMejora[3]) {
    $parrafo_3m = str_replace("%FECHARECM%", date_format(date_create($ultimaMejora[2]),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p3m'));
    $parrafo_3m = str_replace("%REFRECM%", $ultimaMejora[3], $parrafo_3m);
    $html .= "<li>". $parrafo_3m ."</li>";
    $html .= "<br>";
}

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_3 = str_replace("%FECHANOTPROPRES%", date_format(date_create($data['expediente']['fecha_propuesta_resolucion_notif']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p3'));
$html .= "<li>". $parrafo_3 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_4 = str_replace("%FECHAPAGO%", date_format(date_create($data['expediente']['fecha_de_pago']),"d/m/Y") ,lang('message_lang.doc_resolucion_concesion_con_req_p4'));
$html .= "<li>". $parrafo_4 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_5 = str_replace("%FECHACIERRE%", date_format(date_create($data['expediente']['fecha_reunion_cierre']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p5'));
$html .= "<li>". $parrafo_5 ."</li>";
$html .= "<br>";

$pdf->writeHTML($html, true, false, true, false, '');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->AddPage();
$image_file = K_PATH_IMAGES.'logoVerticalIDI.png';
// $pdf->Image('images/image_demo.jpg', $x, $y, $w, $h, 'JPG', 'url', 'align', false (resize), 300 (dpi), 'align (L (left) C (center) R (righ)', false, false, 0, $fitbox, false, false);
// align: T (top), M (middle), B (bottom), N (next line)
$pdf->Image($image_file, 15, 15, '', '40', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$currentY = $pdf->getY();
$pdf->setY($currentY + 4);
$parrafo_6 = str_replace("%FECHARECJUSTIFICACION%", date_format(date_create($data['expediente']['fecha_REC_justificacion']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p6'));
$parrafo_6 = str_replace("%REFRECJUSTIFICACION%", $data['expediente']['ref_REC_justificacion'] , $parrafo_6);

$html = "<ul style=' list-style-type: none;'>";
if ($ultimaMejora[2] && $ultimaMejora[3]) { 
    $html .= "7. ". $parrafo_6;
    $html .= "<br><br>";
    
    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_7 = lang('message_lang.doc_resolucion_concesion_con_req_p7');
    $html .= "8. ". $parrafo_7;
    $html .= "<br><br>";
    
    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_8 = lang('message_lang.doc_resolucion_concesion_con_req_p8');
    /* $parrafo_8 = str_replace("%FECHANOTREQ%", date_format(date_create($data['expediente']['fecha_XXXXXXXXXX']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p8')); */
    $html .= "9. ". $parrafo_8;
    $html .= "<br><br>";
    
    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_9 = lang('message_lang.doc_resolucion_concesion_con_req_p9');
    /* $parrafo_9 = str_replace("%FECHAENMIENDA%", date_format(date_create($data['expediente']['fecha_REC_enmienda']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p9')); */
    $html .= "10. ". $parrafo_9;
    $html .= "<br><br>";
    
    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_10 = str_replace("%FECHAFIRMAINFPOSTENMIENDA%", date_format(date_create($data['expediente']['fecha_YYYYYYYYY']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p10'));
    $html .= "11. ". $parrafo_10;
} else  {
    $html .= "6. ". $parrafo_6;
    $html .= "<br><br>";

    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_7 = lang('message_lang.doc_resolucion_concesion_con_req_p7');

    $html .= "7. ". $parrafo_7;
    $html .= "<br><br>";

    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_8 = lang('message_lang.doc_resolucion_concesion_con_req_p8');
    /* $parrafo_8 = str_replace("%FECHANOTREQ%", date_format(date_create($data['expediente']['fecha_XXXXXXXXXX']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p8')); */
    $html .= "8. ". $parrafo_8;
    $html .= "<br><br>";

    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_9 = lang('message_lang.doc_resolucion_concesion_con_req_p9');
    /* $parrafo_9 = str_replace("%FECHAENMIENDA%", date_format(date_create($data['expediente']['fecha_REC_enmienda']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p9')); */
    $html .= "9. ". $parrafo_9;
    $html .= "<br><br>";

    $currentY = $pdf->getY();
    $pdf->setY($currentY + 4);
    $parrafo_10 = str_replace("%FECHAFIRMAINFPOSTENMIENDA%", date_format(date_create($data['expediente']['fecha_YYYYYYYYY']),"d/m/Y") , lang('message_lang.doc_resolucion_concesion_con_req_p10'));
    $html .= "10. ". $parrafo_10;
}
$html .= "</ul>";
$pdf->writeHTML($html, true, false, true, false, '');


$currentY = $pdf->getY();
$pdf->setY($currentY + 15);
$req_fundamentos = lang('message_lang.doc_resolucion_concesion_con_req_fundamentos');
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;'>". $req_fundamentos ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$req_fundamentos_1 = lang('message_lang.doc_resolucion_concesion_con_req_fundamentos_1');
$html = "<ol>";
$html .= "<li>". $req_fundamentos_1 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$req_fundamentos_2 = lang('message_lang.doc_resolucion_concesion_con_req_fundamentos_2');
$html .= "<li>". $req_fundamentos_2 ."</li>";
$html .= "<br>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$dicto = lang('message_lang.doc_resolucion_concesion_con_req_dicto');
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;'>". $dicto ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$resolucion = lang('message_lang.doc_resolucion_concesion_con_req_resolucion');
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;'>". $resolucion ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$resolucion_1 = str_replace("%IMPORTE%", money_format("%i ", $data['expediente']['importeAyuda']) , lang('message_lang.doc_resolucion_concesion_con_req_resolucion_1'));
$resolucion_1 = str_replace("%SOLICITANTE%", $data['expediente']['empresa'] , $resolucion_1);
$resolucion_1 = str_replace("%NIF%", $data['expediente']['nif'] , $resolucion_1);
$html = "<ol>";
$html .= "<li>". $resolucion_1 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$resolucion_2 = str_replace("%IMPORTE%", money_format("%i ", $data['expediente']['importeAyuda']) , lang('message_lang.doc_resolucion_concesion_con_req_resolucion_2'));
$resolucion_2 = str_replace("%SOLICITANTE%", $data['expediente']['empresa'] , $resolucion_2);
$resolucion_2 = str_replace("%NIF%", $data['expediente']['nif'] , $resolucion_2);
$html .= "<li>". $resolucion_2 ."</li>";
$html .= "<br>";

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$resolucion_3 = lang('message_lang.doc_resolucion_concesion_con_req_resolucion_3');
$html .= "<li>". $resolucion_3 ."</li>";
$html .= "<br>";
$pdf->writeHTML($html, true, false, true, false, '');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->AddPage();
$image_file = K_PATH_IMAGES.'logoVerticalIDI.png';
// $pdf->Image('images/image_demo.jpg', $x, $y, $w, $h, 'JPG', 'url', 'align', false (resize), 300 (dpi), 'align (L (left) C (center) R (righ)', false, false, 0, $fitbox, false, false);
// align: T (top), M (middle), B (bottom), N (next line)
$pdf->Image($image_file, 15, 15, '', '40', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$currentY = $pdf->getY();
$pdf->setY($currentY + 15);
$resolucion_4 = lang('message_lang.doc_resolucion_concesion_con_req_inter_recursos');
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;'>". $resolucion_4 ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 3);
$resolucion_5 = lang('message_lang.doc_resolucion_concesion_con_req_inter_recursos_texto');
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;'>". $resolucion_5 ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');

$currentY = $pdf->getY();
$pdf->setY($currentY + 6);
//$currentX = $pdf->getX();
//$pdf->setX($currentX + 10);
$firma = lang('message_lang.doc_resolucion_concesion_con_req_firma');
$firma = str_replace("%BOIBNUM%", $data['configuracion']['num_BOIB'], $firma);
$firma = str_replace("%DIRECTORGENERAL%", $data['configuracion']['directorGeneralPolInd'], $firma);
$html = "<table cellpadding='5' style='width: 100%;border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;font-size:14px;'>". $firma ."</td></tr>";
$html .= "</table>";
$pdf->writeHTML($html, true, false, true, false, '');
// ------------------------------------------------------------------------------------ //
// ------------------------------------------------------------------------------------ //
/* Limpiamos la salida del búfer y lo desactivamos */
//ob_end_clean();
 /* Finalmente se genera el PDF */
$numExped = $data['expediente']['idExp']."_".$data['expediente']['convocatoria'];
$pdf->Output(WRITEPATH.'documentos/'.$nif.'/informes/'.$numExped.'_resolucion_concesion_con_req_20b.pdf', 'F');
