<?php
echo "<div class='further'>";
		echo "<div class='container'>";
		echo "<div style='margin-top:100px;'></div>";
		echo "<div class='alert alert-info'>S'ha generat correctament el document: <strong>".$tipoDoc."</strong></div>";
		if ($conVIAFIRMA) {
			echo "<div class='alert alert-info'>En la teva safata d'entrada de correu electrònic tens una petició per a signar electrònicament aquest document.</div>";
		}
		echo "<div><button class='btn-primary-itramits' onclick='goBack()'>Tornar</button></div>";
		echo "<br>";
		echo "</div>";
		echo "</div>";