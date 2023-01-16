<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ExpedientesModel;
use App\Models\ConsultorModel;
use App\Models\DocumentosModel;
use App\Models\ConfiguracionModel;
class Consultor extends Controller
{
    public function insert()
		{
		helper(['form', 'url']);
		$modelExp = new ExpedientesModel();	
		$modelConsultor = new ConsultorModel();
        $data = [
			'id_sol' => $this->request->getVar('id_sol'),
			'empresa' => $this->request->getVar('nom_consultor'),
			'nif' => $this->request->getVar('nif'),
			'telefono' => $this->request->getVar('tel_consultor'),	
			'email' => $this->request->getVar('mail_consultor')			
            ];
		$save = $modelConsultor->insert($data);
		$db = \Config\Database::connect();
		$builder = $db->table('pindust_expediente');        
		$data = [
			'hay_consultor' => "si",
            ];
		$builder->where('id', $this->request->getVar('id_sol'));
		$save_exped = $builder->update($data);

        $data['expedientes'] = $modelExp->orderBy('id', 'DESC')->findAll();
		$data['titulo'] = lang('message_lang.todas_las_solicitudes');
		echo view('templates/header/header', $data);
		echo view('pages/forms/rest_api_firma/cabecera_viafirma', $data);
	    echo view('pages/exped/listado-expediente', $data);
		echo view('templates/footer/footer');
		}
	
    public function delete($id = null)
    {
		$modelExp = new ExpedientesModel();
		$data['user'] = $modelExp->where('id', $id)->delete();
		echo view('templates/header/header', $data);      
		echo redirect()->to( base_url('public/index.php/users') );
		echo view('templates/footer/footer');			
    }
	
    public function configurador_edit()
    {
		$modelConfig = new ConfiguracionModel();
		$db = \Config\Database::connect();
		$data['configuracion'] = $modelConfig->where('tipo_tramite', 'iDigital')->first();
		$data['titulo'] = "Configuració del gestor";
		echo view('templates/header/header', $data);	
        echo view('pages/exped/configurador-gestor');
		echo view('templates/footer/footer');	
    }  
	
    public function configurador_update()
    {
        helper(['form', 'url']);
		$db      = \Config\Database::connect();
		$builder = $db->table('pindust_configuracion');
        $data = [
			'dias_res_den' => $this->request->getVar('dias_res_den'),
			'dias_not_def' => $this->request->getVar('dias_not_def'),
			'dias_resp_def_usu' => $this->request->getVar('dias_resp_def_usu'),
			'dias_prop_res' => $this->request->getVar('dias_prop_res'),
			'dias_resol_just' => $this->request->getVar('dias_resol_just'),
			'dias_resp_just_usu' => $this->request->getVar('dias_resp_just_usu'),
			'mail_registro' => $this->request->getVar('mail_registro'),
			'tipo_tramite' => $this->request->getVar('tipo_tramite'),
            ];
        $builder->where('tipo_tramite', $tipo_tramite);
		$save = $builder->update($data);
		echo "<pre><code>Dades actualitzades...</code></pre>";
    } 	
	
	public function muestradocumento ()
	{
		$this->response->setHeader('Cache-Control', 'private');
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
		$file =  $request->uri->getSegment(3); 
		$nifcif =  $request->uri->getSegment(4);
		$selloDeTiempo = $request->uri->getSegment(5);
		$tipoMIME =  $request->uri->getSegment(6).'/'.$request->uri->getSegment(7);
		$esJustificacion =  $request->uri->getSegment(8);		
		//echo $file."**".$nifcif."**".$selloDeTiempo."**".$tipoMIME."**".$esJustificacion;
		//return;
		
		switch ($tipoMIME)
			{
			case "image/jpeg":
				$this->response->setHeader('Content-type', 'image/jpeg');
			break;
			
			case "application/pdf":
				$this->response->setHeader('Content-type', 'application/pdf');
			break;
			
			case "application/octet-stream":
				$this->response->setHeader('Content-type', 'application/octet-stream');
			break;			
			
			case "image/png":
				$this->response->setHeader('Content-type', 'image/png');
			break;

			}
		if ($esJustificacion != "justificacion") {
			echo file_get_contents(WRITEPATH.'documentos/'.$nifcif.'/'.$selloDeTiempo.'/'.$file);
		} 
		else
		{
			echo file_get_contents(WRITEPATH.'documentos/'.$nifcif.'/justificacion/'.$selloDeTiempo.'/'.$file);
		}
		
	}
	
	public function muestrasolicitudfirmada ()
	{
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
		$data = [
            'PublicAccessId' => $request->uri->getSegment(3),
            ];
		echo view('pages/forms/rest_api_firma/cabecera_viafirma', $data);
		echo view('pages/forms/rest_api_firma/ver-solicitud-firmada', $data);
	}
	
	public function muestrasolicitud ()
	{
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
		$data = [
            'PublicAccessId' => $request->uri->getSegment(3),
            ];
		echo view('pages/forms/rest_api_firma/cabecera_viafirma', $data);
		echo view('pages/forms/rest_api_firma/ver-solicitud', $data);
	}
	
	public function muestrasolicitudrechazada ()
	{
		$uri = new \CodeIgniter\HTTP\URI();
		$request = \Config\Services::request();
		$data['titulo'] = lang('message_lang.titulo');
		$data['PublicAccessId'] = $request->uri->getSegment(3);
		echo view('templates/header/header', $data);		
		echo view('pages/forms/rest_api_firma/cabecera_viafirma', $data);
		echo view('pages/forms/rest_api_firma/obtiene-datos-solicitud', $data);
		echo view('templates/footer/footer');		
	}
	
	public function justificacion ()
	{
		echo view('templates/header/header', $data);		
		echo view('pages/exped/justificador', $data);
		echo view('templates/footer/footer');		
	}
}