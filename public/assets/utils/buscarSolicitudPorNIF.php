<?php
require_once 'conectar_a_bbdd.php';
// $nif = mysqli_real_escape_string($conn, $_POST["nif"]);
$query = "SELECT * FROM pindust_expediente  WHERE  nif = '". $_POST["nif"] ."'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       $response = $row["nif"]
       ."#". $row["empresa"]
       ."#".$row["domicilio"]
       ."#".$row["localidad"]
       ."#".$row["cpostal"]
       ."#".$row["telefono"]
       ."#".$row["iae"]
       ."#".$row["nombre_rep"]
       ."#".$row["nif_rep"]
       ."#".$row["telefono_rep"]
       ."#".$row["email_rep"]

       ."#".$row["file_escritura_empresa"]
       ."#".$row["file_memoriaTecnica"]
       ."#".$row["file_certificadoIAE"]
       
       ."#".$row["file_nifEmpresa"]

       ."#".$row["tipo_tramite"]
       ."#".$row["convocatoria"]
       ;
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
echo $response;
?>