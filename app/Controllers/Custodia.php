<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ExpedientesModel;
use App\Models\ConsultorModel;
use App\Models\DocumentosModel;
use App\Models\DocumentosJustificacionModel;

class Custodia extends Controller
{
    public function index()
    {
        helper('filesystem');
		$language = \Config\Services::language();
		$language->setLocale('ca');
		$session = session();
		$session->set('programa_fltr', '');
		$session->set('convocatoria_fltr', '');
		$session->set('textoLibre_fltr', '');
		$rol =  $session->get('rol');

		$modelDocs = new DocumentosModel();
		$request = \Config\Services::request();
		$serverData = $request->getServer();

		$db = \Config\Database::connect();	

		//Documentación adjunta a la solicitud
		$qry = "SELECT * from pindust_documentos WHERE custodiado = true order by id DESC  LIMIT 25";
		$query = $db->query($qry);
		$data['documentosSellados'] = $query->getResult();

		$qry = "SELECT count(*) as totalCustodiados from pindust_documentos WHERE custodiado = true;";
		$query = $db->query($qry);
		$data['totalCustodiados'] = $query->getResult();

		$qry = "SELECT count(*) as totalPendientes from pindust_documentos WHERE custodiado = false;";
		$query = $db->query($qry);
		$data['totalPendientes'] = $query->getResult();

		//Documentos de justificación
		$qry = "SELECT * from pindust_documentos_justificacion WHERE custodiado = true order by id DESC  LIMIT 25";
		$query = $db->query($qry);
		$data['documentosSelladosJustificacion'] = $query->getResult();

		$qry = "SELECT count(*) as totalCustodiados from pindust_documentos_justificacion WHERE custodiado = true;";
		$query = $db->query($qry);
		$data['totalCustodiadosJustificacion'] = $query->getResult();

		$qry = "SELECT count(*) as totalPendientes from pindust_documentos_justificacion WHERE custodiado = false;";
		$query = $db->query($qry);
		$data['totalPendientesJustificacion'] = $query->getResult();

		$data['titulo'] = lang('message_lang.timbrado_de_documentos');
		echo view('templates/header/header', $data);
		echo view('pages/forms/rest_api_firma/cabecera_viafirma', $data);	
		echo view('pages/forms/rest_api_firma/resumen-custodia-documentacion', $data);
		echo view('templates/footer/footer');
    }
}