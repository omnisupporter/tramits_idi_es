<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<?php
	$requestPublicAccessId = $PublicAccessId; // document public access id
	$request = execute("requests/".$requestPublicAccessId, null, __FUNCTION__);
	printResult($request);

	//La petición: url-inbox/api/v3/requests/{publicAccessId}
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
		//var_dump($respuesta);
		echo "<div class='further'>";
		echo "<div class='container'>";
		echo "<pre><code>Ref. pùblica: ".$respuesta['publicAccessId']."</code></pre>";				
		echo "<pre><code>Assumpte: ".$respuesta['subject']."</code></pre>";
		echo "<pre><code>Missatge: ".$respuesta['message']."</code></pre>";
		echo "<pre><code>Data de creació: ".gmdate("d-m-Y H:i:s", intval ($respuesta['creationDate']/1000))."</code></pre>";
		echo "<pre><code>Data d'enviament: ".gmdate("d-m-Y H:i:s",intval ($respuesta['sendDate']/1000))."</code></pre>";
		
		echo "<pre><code>Segell electrònic: ".$respuesta['stampName']."</code></pre>";
		echo "<pre><code>";
		if ($respuesta['status'] == "REJECTED") {
			echo "<div class = 'warning-msg'><i class='fa fa-warning'></i><strong>SOL·LICITUD DE SIGNATURA REBUTJADA.</strong></div>";
		}
		echo "</code></pre>";

		echo "<div class='alert alert-info'><pre><code>".$respuesta['rejectInfo']['rejectType']."</code></pre></div>";
		echo "<div class='alert alert-info'><pre><code>".$respuesta['rejectInfo']['rejectReason']."</code></pre></div>";
		echo "<pre><code>Data rebuig: ".gmdate("d-m-Y H:i:s", intval ($respuesta['rejectInfo']['rejectDate']/1000))."</code></pre>";
		echo "<pre><code>".$respuesta['rejectInfo']['autoReminderPeriodicity']."</code></pre>";	
		echo "<pre><code>".$respuesta['rejectInfo']['autoReminderAttempts']."</code></pre>";	
		echo "<pre><code>Nom del document a signar: ".$respuesta['documentsToSign'][0]['filename']."</code></pre>";
		echo "<div><button class='btn btn-primary-itramits' onclick='goBack()'>Tornar</button></div>";
		echo "</div>";
		echo "</div>";

	}
?>
		<script>
		function goBack() {
		    window.history.back();
		}
		</script>