<?php	

		// PRODUCCIÓN
    	define("REST_API_URL", "https://inbox.viafirma.com/inbox/api/v3/");
    	define("REST_API_KEY", "viafirma");
    	define("REST_API_PASS", "HXN91O5HBYNUNGVRVTQKBFXWDLPIOMBPKIBSJNCC");
		define("WRITEPATH",    "/home/tramitsidi/www/writable/");
		// DESARROLLO	
		//define("REST_API_URL", "https://testservices.viafirma.com/inbox/api/v3/");
		//define("REST_API_KEY", "dev_idi");
		//define("REST_API_PASS", "V3CBFZVZS6THXSWZG9HL3AFF06KD4NGAQHGXGF6Y");
		//define("WRITEPATH",    "/home/pre-tramitsidi/www/writable/");

		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeActionInfo.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeLine.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeGroup.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/AddresseeUserEntity.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Document.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Item.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Job.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/Request.php';
		//require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/pages/forms/rest_api_firma/model/StampPosition.php'; // COMENTADO PORQUE EN VERSIÓN PRODUCCIÓN NO ES COMPATIBLE
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
		$nif = $itemsArray[0];
		$selloDeTiempo = $itemsArray[1];
		$nombreDelArchivo = $itemsArray[2];

		// Construct Request object
		$request = new Request;
		
		$sender = new UserEntity;
		$sender->entityCode = "default";
		$sender->userCode = "Q5755018H";
		$request->sender = $sender;

		$user = new AddresseeUserEntity;
		$user->action = "SIGN";
		$user->userCode = "viafirmacloud";

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
		$request->subject = "Sellado electrónico";
		$request->message = "Se ha sellado el documento adjuntado"; 
		$request->senderNotificationLevel = "ALL";
		$request->stampName = "qr_code";
		// URL para los callbacks tras realizar una acción con la petición. Será un GET con los parámetros:
		// action (String con el tipo de acción), label (String con la public access id de la petición) y finished=ok (si está finalizada la petición. En caso contrario, no se incluirá).
		$request->notificationUrl = "https://tramits.idi.es";
		
		// Adding a document to sign
		$doc = new Document;

		$doc->filename = $nombreDelArchivo;
		$doc->base64 = chunk_split(base64_encode(file_get_contents(WRITEPATH.'documentos/'.$nif.'/'.$selloDeTiempo.'/'.$nombreDelArchivo)));
		$documentsToSign = array ($doc);
	
		$request->documentsToSign = $documentsToSign;
		
		// Set json
		$json = json_encode($request);
		//echo $json;
		$resultRequest = execute("requests", $json, __FUNCTION__);
		if (stripos($resultRequest,"Error")) {
			return;
		}
		printResult($resultRequest, $itemsArray[3], $nombreDelArchivo);
	
	function execute($apiPath, $json, $methodName) {
		$url = REST_API_URL.$apiPath;

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
		echo " ".$result." ";
		return $result;		
	}	
		
	function printResult($result, $idDoc, $nombreDelArchivo) {
		$respuesta = json_decode ($result, true);
		if ($respuesta['publicAccessId']) {
			require_once 'conectar_a_bbdd.php';
			$sql = "UPDATE pindust_documentos SET custodiado = 1, fechaCustodiado = CURDATE(), publicAccessIdCustodiado ='".$respuesta['publicAccessId']."' WHERE id=".$idDoc."; ";
			if ($conn->query($sql) === TRUE) {
				echo "<div class='alert alert-info'>".$nombreDelArchivo." SELLADO.</div>";
				echo "<div class='alert alert-info'>".$respuesta['publicAccessId']."</div>";
				echo "<div class='alert alert-info'>Nombre del documento sellado: <strong>".$nombreDelArchivo."</strong></div>";
				echo "<div class='alert alert-info'>".$respuesta['publicAccessId']."</div>";
				echo "<div class='alert alert-warning'>".$nombreDelArchivo."</div>";
			  } else {
				echo "Error updating record: " . $conn->error." ".$sql;
			  }
			  $conn->close();
			}
			else {
				echo "<div class='alert alert-warning'>".$nombreDelArchivo." HA FALLADO EL SELLO. Se intentará nuevamente más tarde.</div>";
			}
	}
?>