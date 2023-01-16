<?php	
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeActionInfo.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeLine.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeUserEntity.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Document.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Item.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Job.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Request.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/StampPosition.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Template.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/UserEntity.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/VerificationAccess.php';

		// Construir la ruta del documento a firmar
		$url =  $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		
		$items = parse_url( $url);
		$itemsArray = explode  ("/", $items['query']);
		$itemsArray = str_replace("urlDocumento=","",$itemsArray);
		$documentoASellar =   $itemsArray[0]."/".$itemsArray[1]."/".$itemsArray[2];
		$documentoASellarFormateado =  "<td>".$itemsArray[4]."/". $itemsArray[5]."</td><td>".$itemsArray[0]."</td><td>".$itemsArray[1]."</td><td>".$itemsArray[2]."</td>";
		
		// aqui el código de viafirma para el sellado desatendido
			$publicAccessId ="AAAAAAAAAAA";
		// hasta aquí el código de viafirma para el sellado desatendido

		require_once 'conectar_a_bbdd.php';
		$sql = "UPDATE pindust_documentos SET custodiado = 1, fechaCustodiado = CURDATE(), publicAccessIdCustodiado ='".$publicAccessId."' WHERE id=".$itemsArray[3]."; ";
		if ($conn->query($sql) === TRUE) {
			echo "HE PUESTO UN SELLO en ".$documentoASellarFormateado;
		  } else {
			echo "Error updating record: " . $conn->error;
		  }
		  
		  $conn->close();
		// return;

		// INFO: En este ejemplo se creará una petición en paralelo que constará de dos líneas de firma:
		// Línea 1: Usuario 12345678A (VISTO BUENO) > Usuario 12345678B (FIRMA)
	 
		// Usuario remitente del formulario, a partir del $nif firma el/los documentos (FIRMA)
		// Línea 2: Grupo ZFLVHE6AAJ (FIRMA)
		
		// Construct Request object
		$request = new Request;
		
		$sender = new UserEntity;
		$sender->entityCode = "default";
		$sender->userCode = "viafirmacloud";
		$request->sender = $sender;

		$user = new AddresseeUserEntity;
		$user->action = "SIGN";  
		$user->userCode = $adreca_mail; 
		$user->userName = "Firma desatendida"; 
		$user->userSurname1 = $nif;
		$user->userSurname2 = "";
		$user->userPhone = "+34".$telefono_cont;

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
		$request->subject = lang('message_lang.titulo_sol_idigital'); // "Sol·licitud d'ajuts per al disseny de plans de transformació digital en el marc del programa 'Idigital'";
		$request->message = lang('message_lang.subtitulo_sol_idigital'); // "Convocatoria para la concesión de ayudas para el diseño de planes de transformación digital para el año 2020 destinados a la industria balear, en el marco de Idigital, estrategia de digitalización industrial.";					
		$request->senderNotificationLevel = "ALL";
		$request->stampName = "qr_code";
		// URL para los callbacks tras realizar una acción con la petición. Será un GET con los parámetros:
		// action (String con el tipo de acción), label (String con la public access id de la petición) y finished=ok (si está finalizada la petición. En caso contrario, no se incluirá).
		$request->notificationUrl = "https://tramits.idi.es";
		
		// Adding a document to sign
		$doc = new Document;

		$doc->filename = $archivoConFirmaDesatendida;
		$doc->base64 = chunk_split(base64_encode(file_get_contents(WRITEPATH.'documentos/'.$documentoASellar)));	

		$documentsToSign = array ($doc);
		$request->documentsToSign = $documentsToSign;
		
		// Set json

		$json = json_encode($request);
		$resultRequest = execute("requests", $json, __FUNCTION__);
		printResult($resultRequest, $last_insert_id, $tipo_Doc);

	
	function execute($apiPath, $json, $methodName) {
		$url = REST_API_URL.$apiPath;
		// echo "\nMethod URL: ".$url."\n\n";
		
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

		// Closing
		curl_close($ch);
		return $result;		
	}	
		
	function printResult($result, $last_insert_id, $tipo_Doc) {
		$respuesta = json_decode ($result, true);
		echo "<div class='alert alert-info'>". lang('message_lang.generado_correctamente')."<strong>".$respuesta['subject']."</strong></div>";

		$db      = \Config\Database::connect();
		$builder = $db->table('pindust_expediente');
		$data = [
        'PublicAccessId' => $respuesta['publicAccessId']
		];
		$builder->where('id', $last_insert_id);
		$builder->update($data);	

		echo "<div class='alert alert-info'>".$respuesta['publicAccessId']."</div>";
		echo "<div class='alert alert-warning'>".$documentoASellar."</div>";
	}
?>