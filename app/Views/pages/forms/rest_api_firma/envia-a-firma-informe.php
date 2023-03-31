<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<?php	
        use App\Models\UseriTramitsModel;

        $session = session();
        $empresa = $session->get('full_name');
        $nif = $nifcif;
				$adreca_mail = $session->get('username');
				$telefono_cont = $session->get('telefono');
		if ( $byCEOSigned ) {
    		$useritramits = new UseriTramitsModel();
    		$data['useriTramits'] = $useritramits->where('rol', 'gerencia')->first();
				$adreca_mail = $data['useriTramits']['user_name'];
				$telefono_cont = $data['useriTramits']['telefono'];
				$adreca_mail = "ignacio.llado@idi.es";
				$telefono_cont = "677234076";
		}
		require_once dirname(__FILE__) . '/model/AddresseeActionInfo.php';
		require_once dirname(__FILE__) . '/model/AddresseeGroup.php';
		require_once dirname(__FILE__) . '/model/AddresseeLine.php';
		require_once dirname(__FILE__) . '/model/AddresseeUserEntity.php';
		require_once dirname(__FILE__) . '/model/Document.php';
		require_once dirname(__FILE__) . '/model/Item.php';
		require_once dirname(__FILE__) . '/model/Job.php';
		require_once dirname(__FILE__) . '/model/Request.php';
		/* require_once dirname(__FILE__) . '/model/StampPosition.php'; */ //COMENTADO PORQUE EN, VERSIÓN PRE y PRO, NO ES COMPATIBLE
		require_once dirname(__FILE__) . '/model/Template.php';
		require_once dirname(__FILE__) . '/model/UserEntity.php';
		require_once dirname(__FILE__) . '/model/VerificationAccess.php';

		// INFO: En este ejemplo se creará una petición en paralelo que constará de dos líneas de firma:
		// Línea 1: Usuario 12345678A (VISTO BUENO) > Usuario 12345678B (FIRMA)
	 
		// Usuario remitente del formulario, a partir del $nif firma el/los documentos (FIRMA)
		// Línea 2: Grupo ZFLVHE6AAJ (FIRMA)

		/* echo "--".$adreca_mail."--".$telefono_cont."--"; */

		// Construct Request object
		$request = new Request;
		
		$sender = new UserEntity;
		$sender->entityCode = "default";
		$sender->userCode = "Q5755018H";
		$request->sender = $sender;

		$user = new AddresseeUserEntity;
		$user->action = "SIGN";  
		$user->userCode = $adreca_mail; //"ignacio.llado@idi.es";  
		$user->entityCode = "default";
		//$user->userName = $empresa; // "wwwwwwwwwwwwwwww";
		//$user->userSurname1 = $nif; // "43036826P";
		//$user->userSurname2 = "";
		$user->userPhone = "+34".$telefono_cont; //"+34677234076";

		$line1 = new AddresseeLine;
		
		$group2Line1 = new AddresseeGroup;
		$group2Line1Users = array ($user);
		$group2Line1->userEntities = $group2Line1Users;
		
		$line1Groups = array ($group2Line1);
		$line1->addresseeGroups = $line1Groups;
		
		// Adding the line
		$lines = array ($line1);
		$request->addresseeLines = $lines;
		
		// Subject, message and sender notification level
		$request->subject = "iTramits."; //lang('message_lang.titulo_sol_idigital'); // "Sol·licitud d'ajuts per al disseny de plans de transformació digital en el marc del programa 'Idigital'";
		$request->message = "Document per signar"; //lang('message_lang.subtitulo_sol_idigital'); // "Convocatoria para la concesión de ayudas para el diseño de planes de transformación digital para el año 2020 destinados a la industria balear, en el marco de Idigital, estrategia de digitalización industrial.";					
		$request->senderNotificationLevel = "ALL";
		$request->signatureLevel = "ALL";
		$request->useDefaultStamp = true;
		// URL para los callbacks tras realizar una acción con la petición. Será un GET con los parámetros:
		// action (String con el tipo de acción), label (String con la public access id de la petición) y finished=ok (si está finalizada la petición. En caso contrario, no se incluirá).
		//$request->notificationUrl = "https://tramits.idi.es/public";
		
		// Adding a document to sign
		$doc = new Document;

		$doc->filename = $nombreDocumento;
		$doc->base64 = chunk_split(base64_encode(file_get_contents(WRITEPATH.'documentos/'.$nif.'/informes/'.$nombreDocumento)));	
		//$doc->base64 = chunk_split(base64_encode(file_get_contents(WRITEPATH.'documentos/'.$nif.'/informes/fichero_a_firmar.pdf')));
		
		$documentsToSign = array ($doc);
		$request->documentsToSign = $documentsToSign;
		
		// Set json
		$json = json_encode($request);
		$json = str_replace(array('\r','\n'),'',$json)."<br>";
		/* echo $json;  */
		$resultRequest = execute("requests", $json, __FUNCTION__);
		/* echo "<br><br>== ".$resultRequest." ==="; */
		printResult($resultRequest, $last_insert_id, $nombreDocumento);

	function execute($apiPath, $json, $methodName) {
		$url = REST_API_URL.$apiPath;
		// echo "<br><br>-- "."\nMethod URL: ".$url."\n\n"."  --  ";
		
		// Initiate curl
		$ch = curl_init();
		
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Set the url
		curl_setopt($ch, CURLOPT_URL, $url);
		
		if (is_null($json)) {
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
		} else {
			if ($methodName=='createUser') {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			} else {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Accept:application/json, text/javascript, */*; q=0.01"));
		}
		
		// Basic Authentication
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, REST_API_KEY.":".REST_API_PASS);
		
		// Execute
		$result = curl_exec($ch);
		/* echo "**--** ".$result." **--**"; */
		// Closing
		curl_close($ch);
		return $result;		
	}	
		
	function printResult($result, $last_insert_id, $tipo_Doc) {
		//echo "**** ".$result." ****";
		$respuesta = json_decode ($result, true);
		$db      = \Config\Database::connect();
		$builder = $db->table('pindust_documentos_generados');
		$data = [
        'publicAccessId' => $respuesta['publicAccessId'],
		];

		$builder->where('id', $last_insert_id);
		$builder->update($data);	

		/**echo "<div class='further'>";
		echo "<div class='container'>";
		echo "<div style='margin-top:100px;'></div>";
		echo "<div class='alert alert-info'>S'ha generat correctament el document: <strong>".$tipo_Doc."</strong></div>";
		echo "<div class='alert alert-info'>En la teva safata d'entrada de correu electrònic tens una petició per a signar electrònicament aquest document.</div>";
		echo "<div><button class='btn-primary-itramits' onclick='goBack()'>Tornar</button></div>";
		echo "<br>";
		echo "</div>";
		echo "</div>";*/
	}
?>

		<script>
		function goBack() {
		    window.history.back();
		}
		</script>