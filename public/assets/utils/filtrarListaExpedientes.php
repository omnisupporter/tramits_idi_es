<?php
require_once 'conectar_a_bbdd.php';
$query = "SELECT * FROM pindust_expediente WHERE tipo_tramite LIKE '" . $_POST["programa"] . "%'";
echo $query;
$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $expediente = $row["idExp"];
			   $solicitante = $row["empresa"];
			   echo "Exped: " . $expediente . "<br>";
			   echo "Solcitant: " . $solicitante . "<br>";
            }
	} else {
        echo "0 results";
    }