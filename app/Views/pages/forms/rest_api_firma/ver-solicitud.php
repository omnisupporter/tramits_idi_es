<?php		
		$documentPublicAccessId = $PublicAccessId; // Document public access id
		$request = execute("documents/".$documentPublicAccessId, null, __FUNCTION__);
		$jsonArray = json_decode($request,true);
		var_dump ($jsonArray);
		return;
		$decoded = base64_decode($jsonArray["base64"]);
		$file = $jsonArray["filename"];
		if (strlen ($file) == 0) {
		
			echo "<div classs = 'isa_info'>Aquesta sol·licitud està pendent de signatura.</div>";
			return;
		}
		
		file_put_contents($file, $decoded);
	
		header('Content-Description: File Transfer');
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: '.filesize($file));
		readfile($file);
		exit;

	
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
		
	function printResult($result) {
		// echo '<div>- ';
		// echo $result;
		// echo ' -</div>';
		$respuesta = json_decode ($result, true);
		echo "<pre><code>".$respuesta['sender']['userCode']."</code></pre>";
		echo "<pre><code>".$respuesta['subject']."</code></pre>";
		echo "<pre><code>".$respuesta['notificationUrl']."</code></pre>";
		echo "<pre><code>".$respuesta['publicAccessId']."</code></pre>";
		echo "<pre><code>".$respuesta['documentsToSign'][0]['filename']."</code></pre>";
		echo "<pre><code>".$respuesta['documentsToSign'][0]['publicAccessId']."</code></pre>";
		echo "<pre><code>Le hemos enviado un correo electrónico con su solicitud para que la firme electrónicamente.</code></pre>";
		echo "<pre><code>Una vez firmada, procederemos a tramitarla.</code></pre>";
	}
?>