<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Viafirma Inbox v3 REST API examples</title>
</head>
<body>
	<div>
		<ul>
			<li><a href="?method=createUser" title="Crear un nuevo usuario">Crear un nuevo usuario</a></li>
			<li><a href="?method=getUser" title="Obtener un usuario dado su NIF">Obtener un usuario dado su NIF</a></li>
			<li><a href="?method=searchUser" title="Buscar usuario">Buscar usuario por texto</a></li>
			<li><a href="?method=createParallelRequest" title="Crear petición en paralelo">Crear petición en paralelo</a></li>
			<li><a href="?method=createCascadeRequest" title="Crear petición en cascada">Crear petición en cascada</a></li>
			<li><a href="?method=getRequest" title="Obtener una petición dado su ID">Obtener una petición dado su ID</a></li>
			<li><a href="?method=downloadSignedDocument" title="Descargar un documento firmado dado su ID">Descargar un documento firmado dado su ID</a></li>
		</ul>
	</div>
<?php
	define("REST_API_URL", "https://testservices.viafirma.com/inbox/api/v3/");
	define("REST_API_KEY", "dev_idi");
	define("REST_API_PASS", "V3CBFZVZS6THXSWZG9HL3AFF06KD4NGAQHGXGF6Y");

	error_reporting(E_ALL);

	if ($_GET["method"] == 'createUser') {
		createUser();
	} elseif ($_GET["method"] == 'getUser') {
		//Get by testing nif
		getUser("Q5755018H");
    } elseif ($_GET["method"] == 'searchUser') {
		searchUser();
	} elseif ($_GET["method"] == 'createParallelRequest') {
		createParallelRequest();
	} elseif ($_GET["method"] == 'createCascadeRequest') {
		createCascadeRequest();
	} elseif ($_GET["method"] == 'getRequest') {
		getRequest();
	} elseif ($_GET["method"] == 'downloadSignedDocument') {
		downloadSignedDocument();
	}

	function getRequest() {
		//Example request public access id
		$requestPublicAccessId = "DEGN-0ZQE-7ZZJ-ERMT";
		$request=execute("requests/".$requestPublicAccessId, null, __FUNCTION__);
		printResult($request);
	}
	
	function createUser() {
		require_once dirname(__FILE__) . '/model/User.php';
		require_once dirname(__FILE__) . '/model/UserEntityEmail.php';
		require_once dirname(__FILE__) . '/model/UserCmis.php';

		// Construct User to create
		$user = new User;
		$user->userCode="51346578A"; //Example nif
		$user->name="Prueba";
		$user->surname1="Apellido 1";
		$user->surname2="Apellido 2";
		$user->phone="+34123456789"; //Example phone
		$user->notificationsLevel="HIGH";
		$user->timezone="EUROPE_MADRID";
		
		$userEntityEmail = new userEntityEmail;
		$userEntityEmail->email="artista1122.vf@yopmail.com"; //Example mail
		$userEntityEmail->entityCode="default";
		$userEntityEmail->isDefault = true;
		
		$user->isExternalSign = true;
		$user->defaultExternalSign = "PLATFORM";
		
		$user->entities=array($userEntityEmail);
		
		// Set json
		$json = json_encode($user);

		$createdUser=execute("users/update", $json, __FUNCTION__);
		printResult($createdUser);
	}

   	function getUser($nif) {
		$resultUser=execute("users/".$nif, null, __FUNCTION__);
		printResult($resultUser);
    }
	
	function searchUser() {
		require_once dirname(__FILE__) . '/model/UserSearch.php';

		// Construct UserSearch object
		$userSearch = new UserSearch;

		$userSearch->searchTerm = "Prueba"; // Example
		$userSearch->entityCode = "default";
		
		// Set json
		$json = json_encode($userSearch);

		$resultUser=execute("users/search", $json, __FUNCTION__);
		printResult($resultUser);
	}
	
	function createParallelRequest() {
		require_once dirname(__FILE__) . '/model/AddresseeActionInfo.php';
		require_once dirname(__FILE__) . '/model/AddresseeGroup.php';
		require_once dirname(__FILE__) . '/model/AddresseeLine.php';
		require_once dirname(__FILE__) . '/model/AddresseeUserEntity.php';
		require_once dirname(__FILE__) . '/model/Document.php';
		require_once dirname(__FILE__) . '/model/Item.php';
		require_once dirname(__FILE__) . '/model/Job.php';
		require_once dirname(__FILE__) . '/model/Request.php';
		require_once dirname(__FILE__) . '/model/StampPosition.php';
		require_once dirname(__FILE__) . '/model/Template.php';
		require_once dirname(__FILE__) . '/model/UserEntity.php';
		require_once dirname(__FILE__) . '/model/VerificationAccess.php';
		
		// INFO: En este ejemplo se creará una petición en paralelo que constará de dos líneas de firma:
		// Línea 1: Usuario 12345678A (VISTO BUENO) > Usuario 12345678B (FIRMA)
		// Línea 2: Grupo ZFLVHE6AAJ (FIRMA)
		
		// Construct Request object
		
		$request = new Request;
		
		$sender = new UserEntity;
		$sender->entityCode = "default";
		$sender->userCode = "43036826P";
		$request->sender = $sender;
		
		// Line 1
		$user1 = new AddresseeUserEntity;
		$user1->action = "APPROVAL";
		$user1->entityCode = "default";
		$user1->userCode = "12345678A";
		
		$line1 = new AddresseeLine;
		$group1Line1 = new AddresseeGroup;
		$group1Line1Users = array ($user1);
		$group1Line1->userEntities = $group1Line1Users;
		
		$user2 = new AddresseeUserEntity;
		$user2->action = "SIGN";
		$user2->entityCode = "default";
		$user2->userCode = "12345678B";
		
		$group2Line1 = new AddresseeGroup;
		$group2Line1Users = array ($user2);
		$group2Line1->userEntities = $group2Line1Users;
		
		$line1Groups = array ($group1Line1, $group2Line1);
		$line1->addresseeGroups = $line1Groups;
		
		// Line 2
		$line2 = new AddresseeLine;
		$exampleGroup = new AddresseeUserEntity;
		$exampleGroup->action = "SIGN";
		$exampleGroup->groupCode = "ZFLVHE6AAJ"; // Example group id
		$group1Line2 = new AddresseeGroup;
		$group1Line2->isOrGroup = false;
		$group3Line2Users = array ($exampleGroup);
		$group1Line2->userEntities = $group3Line2Users;
		
		$line2Groups = array ($group1Line2);
		$line2->addresseeGroups = $line2Groups;
		
		// Adding both lines
		$lines = array ($line1, $line2);
		$request->addresseeLines = $lines;
		
		// Subject, message and sender notification level
		$request->subject = "Asunto de ejemplo 1";
		$request->message = "Mensage de ejemplo";
		$request->senderNotificationLevel = "ALL";
		
		// URL para los callbacks tras realizar una acción con la petición. Será un GET con los parámetros:
		// action (String con el tipo de acción), label (String con la public access id de la petición) y finished=ok (si está finalizada la petición. En caso contrario, no se incluirá).
		$request->notificationUrl = "http://webejemplovf.com";
		
		// Adding a document to sign
		$doc = new Document;
		$doc->filename = "fichero_a_firmar.pdf";
		$doc->base64 = chunk_split(base64_encode(file_get_contents("fichero_a_firmar.pdf")));
		$documentsToSign = array ($doc);
		$request->documentsToSign = $documentsToSign;
		
		// Set json
		$json = json_encode($request);

		$resultRequest=execute("requests", $json, __FUNCTION__);
		printResult($resultRequest);
	}
	
	function createCascadeRequest() {
		require_once dirname(__FILE__) . '/model/AddresseeActionInfo.php';
		require_once dirname(__FILE__) . '/model/AddresseeGroup.php';
		require_once dirname(__FILE__) . '/model/AddresseeLine.php';
		require_once dirname(__FILE__) . '/model/AddresseeUserEntity.php';
		require_once dirname(__FILE__) . '/model/Document.php';
		require_once dirname(__FILE__) . '/model/Item.php';
		require_once dirname(__FILE__) . '/model/Job.php';
		require_once dirname(__FILE__) . '/model/Request.php';
		require_once dirname(__FILE__) . '/model/StampPosition.php';
		require_once dirname(__FILE__) . '/model/Template.php';
		require_once dirname(__FILE__) . '/model/UserEntity.php';
		require_once dirname(__FILE__) . '/model/VerificationAccess.php';
		
		// INFO: En este ejemplo se creará una petición en cascada que constará de una línea de firma:
		// Línea 1: Artista Usuario Externo (FIRMA) > Usuario Interno (FIRMA)
		
		// Construct Request object
		
		$request = new Request;
		
		$sender = new UserEntity;
		$sender->entityCode = "default";
		$sender->userCode = "12345678C";
		$request->sender = $sender;
		
		// Line 1
		$user1 = new AddresseeUserEntity;
		$user1->action = "SIGN";
		$user1->entityCode = "default";
		$user1->userCode = "21346578A";
		
		$line1 = new AddresseeLine;
		$group1Line1 = new AddresseeGroup;
		$group1Line1Users = array ($user1);
		$group1Line1->userEntities = $group1Line1Users;
		
		$user2 = new AddresseeUserEntity;
		$user2->action = "SIGN";
		$user2->entityCode = "default";
		$user2->userCode = "12345678A";
		
		$group2Line1 = new AddresseeGroup;
		$group2Line1Users = array ($user2);
		$group2Line1->userEntities = $group2Line1Users;
		
		$line1Groups = array ($group1Line1, $group2Line1);
		$line1->addresseeGroups = $line1Groups;
		
		// Adding both lines
		$lines = array ($line1);
		$request->addresseeLines = $lines;
		
		// Subject, message and sender notification level
		$request->subject = "Acuerdo 1";
		$request->message = "Mensage de ejemplo";
		$request->senderNotificationLevel = "ALL";
		
		// URL para los callbacks tras realizar una acción con la petición. Será un GET con los parámetros:
		// action (String con el tipo de acción), label (String con la public access id de la petición) y finished=ok (si está finalizada la petición. En caso contrario, no se incluirá).
		$request->notificationUrl = "http://webejemplovf.com";
		
		// Adding a document to sign
		$doc = new Document;
		$doc->filename = "fichero_a_firmar.pdf";
		$doc->base64 = chunk_split(base64_encode(file_get_contents("fichero_a_firmar.pdf")));
		$documentsToSign = array ($doc);
		$request->documentsToSign = $documentsToSign;
		
		// Set json
		$json = json_encode($request);

		$resultRequest=execute("requests", $json, __FUNCTION__);
		printResult($resultRequest);
	}
	
	function downloadSignedDocument() {
		$documentPublicAccessId = "MNSQSVRN88"; // Example document public access id
		$request=execute("documents/".$documentPublicAccessId."/signed", null, __FUNCTION__);
		$jsonArray=json_decode($request,true);
		$decoded=base64_decode($jsonArray["base64"]);
		$file = $jsonArray["filename"];
		file_put_contents($file, $decoded);
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: '.filesize($file));
		readfile($file);
		exit;
	}

	function printResult($result) {
		echo '<div>';
		echo $result;
		echo '</div>';
	}

	function execute($apiPath, $json, $methodName) {
		$url=REST_API_URL.$apiPath;
		//echo "\nMethod URL: ".$url."\n\n";
		
		//  Initiate curl
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
?>
</body>
</html>