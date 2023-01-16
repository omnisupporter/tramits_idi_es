<?php
$rutaDocumento = "";
require_once 'conectar_a_bbdd.php';

$query = 'SELECT * FROM pindust_documentos_justificacion WHERE custodiado = false order by id ASC LIMIT 1';
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       $cifnif_propietario = $row["cifnif_propietario"];
       $selloDeTiempo = $row["selloDeTiempo"];
       $name = $row["name"];
       $idDoc = $row["id"];
       $idSol = $row["id_sol"];
       $convocatoria = $row["convocatoria"];
    $rutaDocumento = $cifnif_propietario.'/'.$selloDeTiempo.'/'. $name.'/'.$idDoc.'/'.$idSol.'/'.$convocatoria;
    }
}

echo $rutaDocumento;
mysqli_close($conn);
?>