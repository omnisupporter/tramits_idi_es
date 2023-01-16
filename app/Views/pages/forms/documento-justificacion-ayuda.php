<?php
require_once('tcpdf/tcpdf.php');
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
        $this->Cell(0, 15, 'Pàgina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
	
$pdf->SetAuthor("INSTITUT D'INNOVACIÓ EMPRESARIAL DE LES ILLES BALEARS (IDI) - SISTEMES D'INFORMACIÓ");
$pdf->SetTitle("Requeriment de justificació documentació d'ajuts xecs consultoria");
$pdf->SetSubject('REQUERIMENT DE JUSTIFICACIÓ iDigital');
$pdf->SetKeywords('INDUSTRIA 4.0, DIAGNÓSTIC, DIGITAL, PIMES, IDI, GOIB');	

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

// -------------------------------------------------------------------------------------------------------------------------------------------------- //
use App\Models\ExpedientesModel;

	$modelExp = new ExpedientesModel();
	$db = \Config\Database::connect();
	$uri = new \CodeIgniter\HTTP\URI();
	$request = \Config\Services::request();

	//$id_sol = get_cookie ('pindust_id');
	//$nif = get_cookie ('nif');
	$tipoTramite = get_cookie ('tipoTramite');
	
	
	$query = $db->query("SELECT * FROM pindust_documentos_justificacion WHERE selloDeTiempo ='" . $selloTiempo."'");
	$justificacion = $query->getResult();
	$data['expedientes'] = $modelExp->where('id', $id)->first();

// --------------------------------------------------------------------------------------------------------------------------------------------------- //
$pdf->AddPage();

$currentY = $pdf->getY();
$pdf->setY($currentY + 15);
$html = lang('message_lang.justificacion_doc').": ".lang('message_lang.justificacion_titulo')."<br>";
$html .= "Núm. Expedient: ". $data['expedientes']['idExp']."/".$data['expedientes']['convocatoria']."<br>";
$html .= "SIA: 2406896<br>";
$html .= "Emissor (DIR3): A04003714<br>";
$html .= "Projecte: ".$data['expedientes']['tipo_tramite']."<br>";

// set membrete
$pdf->SetFillColor(255, 255, 255);
// set color for text
$pdf->SetTextColor(0, 0, 0);
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->writeHTMLCell(90, '', 120, 40, $html, 0, 1, 1, true, 'J', true);

echo "<content><section>".$html;

$html = lang('message_lang.intro_sol_idigital');
$html .= "Idigital, ". lang('message_lang.convocatoria_sol_idigital')." 2020";
echo $html;
$currentY = $pdf->getY();
$pdf->setY($currentY + 5);
// $pdf->Cell(0, 10, $html, 1, 1, 'C');

$currentY = $pdf->getY();
$pdf->setY($currentY + 5);
// $pdf->Cell(0, 10, lang('message_lang.solicitante'), 1, 1, 'C');
$html = "<table cellpadding='5' style='width: 100%; border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;font-size:14px;'><b>". $data['expedientes']['empresa'] ."</b> ";
$html .= lang('message_lang.conCIF')."<b> " . $data['expedientes']['nif']."</b>";
//if ($data['expedientes']['tipo_tramite'] == "Programa I" || $data['expedientes']['tipo_tramite'] == "Programa iDigital 20")	{
	$html .= lang('message_lang.justificacion_declaracion').":</td></tr>";
//} 
//else {
//	$html .= lang('message_lang.justificacion_declaracion_PII_PIII').":</td></tr>";
//}
$html .= "</table>";
echo $html;
$currentY = $pdf->getY();
$pdf->setY($currentY + 5);
$pdf->writeHTML($html, true, false, true, false, '');

$html = "<br><br>";
$html .= "<table cellpadding='5' style='border: 1px solid #ffffff;'>";
$html .= "<tr><td style='background-color:#ffffff;color:#000;font-size:14px;'>";
$html .= "<ul>";
foreach($justificacion as $docsJustif_item):
	if ( $docsJustif_item->corresponde_documento == "file_PlanTransformacionDigital") {
		//if ($data['expedientes']['tipo_tramite'] == "Programa I" || $data['expedientes']['tipo_tramite'] == "Programa iDigital 20")	{
			$html .= "<li>".lang('message_lang.justificacion_plan_p1').".</li>";
		//} else {
		//	$html .= "<li>".lang('message_lang.justificacion_plan_p2_p3').".</li>";	
		//}
	}
//if ($data['expedientes']['tipo_tramite'] == "Programa I" || $data['expedientes']['tipo_tramite'] == "Programa iDigital 20")	{
	if ( $docsJustif_item->corresponde_documento == "file_FactTransformacionDigital") {
		$html .= "<li>".lang('message_lang.justificacion_facturas_doc').".</li>";
	}
	if ( $docsJustif_item->corresponde_documento == "file_PagosTransformacionDigital") {
		$html .= "<li>".lang('message_lang.justificacion_justificantes_doc').".</li>";
	}
//}
endforeach;
$html .= "</ul>";
$html .= "</td></tr>";
$html .= "</table>";
echo $html;

$currentY = $pdf->getY();
$pdf->setY($currentY + 5);
$pdf->WriteHTML($html, true, false, true, false, '');

$pdf->SetFont('helvetica', '', 7);
$rgpd = lang('message_lang.rgpd_txt');

$html = "<br><br>";
$html .= "<table cellpadding='5' style='width: 100%; border: 1px solid #ffffff;'>";
$html .= "<tr><td style='text-align:center;background-color:#f2f2f2;color:#000;font-size:8px;'>$rgpd</td></tr><br>";
$html .= "</table>";

echo $html;
$currentY = $pdf->getY();
$pdf->setY($currentY + 5);
$pdf->WriteHTML($html."</section></content>", true, false, true, false, '');

// --------------------------------------------------------------------------------------------------------------------------------------------- //
// Lo guarda todo en una carpeta del servidor para, luego, enviarlo por correo electrónico.
$pdf->Output(WRITEPATH.'documentos/'.$nif.'/justificacion/'.$selloTiempo.'/'.$nif.'_justificacion_solicitud_ayuda.pdf', 'F');