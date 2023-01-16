<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ExpedientesModel;
use App\Models\DocumentosModel;
use App\Models\ConfiguracionModel;
use App\Models\ResolucionModel;
use CodeIgniter\I18n\Time;

class Resoluciones extends Controller
{
    public function index() {
        helper('date');
		// echo now('Europe/Madrid');
		$language = \Config\Services::language();
		$modelExp = new ExpedientesModel();
		$modelDocs = new DocumentosModel();
		$modelRes = new ResolucionModel();
        $data['expedientes'] = $modelExp->orderBy('id', 'DESC')->findAll();
		$data['titulo'] = lang('message_lang.todas_las_solicitudes');
		echo view('templates/header/header', $data);
	    echo view('pages/exped/listado-resolucion', $data);
		echo view('templates/footer/footer');
    }
	
    public function create() {
		echo view('templates/header/header', $data);	
        echo view('pages/exped/create-expediente');
		echo view('templates/footer/footer');	
    }
 
    public function store() {
        helper(['form', 'url']);
        $modelExp = new ExpedientesModel();
        $data = [
            'empresa' => $this->request->getVar('empresa'),
            'email'  => $this->request->getVar('email'),
            ];
        $save = $modelExp->insert($data);
        return redirect()->to( base_url('public/index.php/users') );
    }
 
    public function edit($id = null) {
		helper('filesystem');
        $modelExp = new ExpedientesModel();
		$db = \Config\Database::connect();
		$data['titulo'] = "Detall de l'expedient";
		$data['expedientes'] = $modelExp->where('id', $id)->first();
		$qry = "SELECT * FROM pindust_documentos WHERE cifnif_propietario = '" . $data['expedientes']['nif'] . "' AND selloDeTiempo = '" . $data['expedientes']['selloDeTiempo'] . "'";
		$query = $db->query($qry);
		$data['documentos'] = $query->getResult();
		echo view('templates/header/header', $data);
		echo view('pages/exped/edita-expediente', $data);
		echo view('templates/footer/footer');
    }
 
    public function update() {
		helper(['form', 'url']);
        $modelExp = new ExpedientesModel();
        $id = $this->request->getVar('id');
        $data = [
            'empresa' => $this->request->getVar('empresa'),
            'email'   => $this->request->getVar('email'),
            ];
        $save = $modelExp->update($id,$data);
        return redirect()->to( base_url('public/index.php/users') );
    }
 
    public function delete($id = null) {
		$modelExp = new ExpedientesModel();
		$data['user'] = $modelExp->where('id', $id)->delete();
		echo view('templates/header/header', $data);      
		echo redirect()->to( base_url('public/index.php/users') );
		echo view('templates/footer/footer');			
    }
	
    public function tramitar($id = null) {
		helper('filesystem');
        $modelExp = new ExpedientesModel();
		$modelRes = new ResolucionModel();
		$db = \Config\Database::connect();
		$data['titulo'] = "Resolucions";
		$data['expedientes'] = $modelExp->where('id', $id)->first();
		$data['resoluciones'] = $modelRes->where('id_sol', $id)->findAll();
		$qry = "SELECT * FROM pindust_documentos WHERE cifnif_propietario = '" . $data['expedientes']['nif'] . "' AND selloDeTiempo = '" . $data['expedientes']['selloDeTiempo'] . "'";
		$query = $db->query($qry);
		$data['documentos'] = $query->getResult();
		echo view('templates/header/header', $data);
		echo view('pages/exped/resolucion-tramitar', $data);
		echo view('templates/footer/footer');
    }
	
	public function verPDF () {

		$this->response->setHeader('Cache-Control', 'private');
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
		$id_sol =  $request->uri->getSegment(3);
		$tipo_resol =  $request->uri->getSegment(4); 
		$modelExp = new ExpedientesModel();
		$data['expedientes'] = $modelExp->where('id', $id_sol)->first();
		$nifcif = $data['expedientes']['nif'];
		$selloDeTiempo = $data['expedientes']['selloDeTiempo'];
		//$tipoMIME =  $request->uri->getSegment(6).'/'.$request->uri->getSegment(7);
		$this->response->setHeader('Content-type', 'application/pdf');
		
		echo file_get_contents(WRITEPATH.'documentos/'.$nifcif.'/'.$selloDeTiempo.'/resolucion_'.$tipo_resol.'.pdf');
	}
	
	public function generaPDF () {
	helper('filesystem');
    helper(['form', 'url']);
	$request = \Config\Services::request();
	$db      = \Config\Database::connect();
	$builder = $db->table('pindust_resoluciones');
	$id =  $request->uri->getSegment(3);
	$id_sol =  $request->uri->getSegment(4);
	
	$data_resol = [
            'tipo_resolucion' 	=> $this->request->getVar('tipo_resolucion'),
            'motivo_resol' 		=> $this->request->getVar('motivo_resol'),
			'fecha_resol' 		=> $this->request->getVar('fecha_resol'),
			'nom_PDF' 			=> 'resolucion_denegacion.pdf'
            ];
	$builder->where('id', $id);
	$save_resol = $builder->update($data_resol);
    $modelExp = new ExpedientesModel();
	$data_resol['expedientes'] = $modelExp->where('id', $id_sol)->first();
	$data['expedientes'] = $modelExp->orderBy('id', 'DESC')->findAll();
	echo view('templates/header/header', $data);	
	switch ($this->request->getVar('tipo_resolucion'))
		{
		case 'denegacion':
			echo view('pages/forms/generar_pdf_resolucion_denegar', $data_resol);
			break;
		case 'aprobacion':
			echo view('pages/forms/generar_pdf_resolucion_aprobar', $data_resol);
			break;
		case 'deficiencias':
			echo view('pages/forms/generar_pdf_resolucion_deficiencias', $data_resol);
			break;
		default:
			echo view('pages/forms/generar_pdf_resolucion_denegar', $data_resol);
		}
	echo view('pages/exped/listado-resolucion', $data);
	echo view('templates/footer/footer');		
	}
	
	public function formEditaResol () {
		helper(['form', 'url']);
		$request = \Config\Services::request();
		$modelExp = new ExpedientesModel();
		$modelRes = new ResolucionModel();
		$db = \Config\Database::connect();
		$id_res =  $request->uri->getSegment(3);
		$id_sol =  $request->uri->getSegment(4);
		$data['resolucion'] = $modelRes->where('id', $id_res)->first();
		$data['expedientes'] = $modelExp->where('id', $id_sol)->first();
		$data['titulo'] = "Editar la resolució";
		echo view('templates/header/header', $data);
		echo view('pages/exped/edita-resolucion', $data);
		echo view('templates/footer/footer');
	}
	
	public function editaResol () {
    helper(['form', 'url']);
	$request = \Config\Services::request();
	$db = \Config\Database::connect();
	$modelResolucion = new ResolucionModel();
	$id =  $request->uri->getSegment(3);
	echo $id;

	$data_resol = [
            'tipo_resolucion' => $this->request->getPostGet('tipo_resolucion'),
            'motivo' => $this->request->getPostGet('motivo_resol'),
			'fecha_resol' => $this->request->getPostGet('corrientePagoAEAT_dec_resp'),
			'hay_PDF' => 1
            ];
	
	$save_resol = $modelResolucion->update($id,$data_resol);
	var_dump($save_resol);
	return;
	echo view('pages/forms/generar_pdf_resolucion', $data_resol);
	}
}