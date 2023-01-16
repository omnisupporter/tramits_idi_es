function analiza_NIF (cif)
{
	/* Esta función comprueba que la estructura de un CIF es correcta */
	/* La estructura correcta de un CIF es: */
	/* OPPNNNNNC, donde: */
	/* O: organización, PP: código de dos díditos de la provincia, NNNNN: numeración secuencial */
	/* C: dígito de control */
	var cif = cif.toUpperCase();
	var motivo = "OK";
// De entrada, supongo que todos los códigos son erróneos.
	var organizacion_OK = false;
	var provincia_OK = false;
	var numeracion_OK = false;
	var dControl_OK = false;
	var esCIF_OK = false;
// Mostraré el resultado en el elemento HTML con id = info_lbl
	document.getElementById("info_lbl").innerHTML = "";
// Creo los arrays con todos los posibles valores de organización, provincia y letras y números de control
	var organizacionCodigo = ["A","B","C","D","E","F","G","H","K","L","M","N","P","Q","S"];
// Los códigos de provincia, los separo en varios arrays por comodidad de lectura
	var provinciaCodigo_1 = ["01", "02", "03", "53", "54", "04", "05", "06", "07", "57", "08"];
	var provinciaCodigo_2 = ["58", "59", "60", "61", "62", "63", "64", "09", "10", "11", "72"];
	var provinciaCodigo_3 = ["12", "13", "14", "56", "15", "70", "16", "17", "55", "18"];
	var provinciaCodigo_4 = ["19", "20", "71", "21", "22", "23", "24", "25", "26", "27"];
	var provinciaCodigo_5 = ["28", "78", "79", "80", "81", "82", "83", "84", "29", "92"];
	var provinciaCodigo_6 = ["93", "30", "73", "31", "32", "33", "74", "34", "35", "76"];
	var provinciaCodigo_7 = ["36", "94", "37", "38", "75", "39", "40", "41", "91", "42"];
	var provinciaCodigo_8 = ["43", "77", "44", "45", "46", "96", "97", "98", "47", "48"];
	var provinciaCodigo_9 = ["95", "49", "50", "99", "51", "52"];
// Los concatenaré en un único array al que llamo provinciaCodigo, 
	var provinciaCodigo = provinciaCodigo_1.concat(provinciaCodigo_2);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_3);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_4);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_5);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_6);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_7);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_8);
	provinciaCodigo = provinciaCodigo.concat(provinciaCodigo_9);

	var letraControl = ["K", "P", "Q", "S"];
	var numeroControl = ["A", "B", "E", "H"];
// Mientras la longitud el CIF no sea de nueve caractes, lo seguiré pidiendo.
	while (cif.length != 9) {
		cif = prompt("Introduzca un número de CIF [OPPNNNNNC]:", "");
		if (cif.length != 9) {
			alert ("El número " + cif + " debe tener NUEVE dígitos");
			}
		cif = cif.toUpperCase();	
		}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
	document.getElementById("nif").value = cif;
// Separo la parte que corresponde a la Organización y lo convierto todo a mayúsculas	
	var organizacion = cif.substring(0, 1).toUpperCase();
// Separo la parte que corresponde a la provincia
	var provincia = cif.substring(1, 3);
// Separo la parte correspondiente a la numeración secuencial
	var numeracion = cif.substring(3, 8);
// Separo la parte correspondiente al dígito de control
	var dControl = cif.substring(8, 9).toUpperCase();
// Verifico que el código de la organización sea un valor correcto, si es así, asigno el valor verdadero
	if (organizacionCodigo.indexOf(organizacion ) != -1) {
		organizacion_OK = true;
	}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + " Organización: " + organizacion_OK + "<br>";
// Compruebo que el código de provincia sea un valor correcto, si es así, asigno el valor verdadero
	if (provinciaCodigo.indexOf(provincia ) != -1) {
		provincia_OK = true;
	}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + " Provincia: " + provincia_OK + "<br>";
// Compruebo que la secuencia de numeración sea un número y, entonces, que no existan letras ni caracteres no numéricos
	if (!isNaN(numeracion )) {
		numeracion_OK = true;
	}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + " Numeración: " + numeracion_OK + "<br>";
// El dígito de control, si es una letra, organización debe ser K,P,Q,S 
	if ((isNaN(dControl)) && (organizacion == "K" || organizacion == "P" || organizacion == "Q" || organizacion == "S")) {
		dControl_OK = true;
	}
// El dígito de control, si es un número, organización debe ser A,B,E,H
	else if ((!isNaN(dControl)) && (organizacion == "A" || organizacion == "B" || organizacion == "E" || organizacion == "H")) {
		dControl_OK = true;
	}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + " Control: " + dControl + " " + dControl_OK + "<br>";
// Si, todos los códigos anteriores son correctos, el CIF es correcto
	if (organizacion_OK && provincia_OK && numeracion_OK && dControl_OK) {
		esCIF_OK = true;
	}
// Muestro el valor entrado en el elemento HTML con id = info_lbl
// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + " ¿Es un CIF correcto? " + esCIF_OK + "<br>";
// En otro caso, indico en que códigos está el error
if (!organizacion_OK ||  !provincia_OK || !numeracion_OK  || !dControl_OK ) {
		motivo = "Alguna part del CIF no està correcte:\n";
	}

	if (!organizacion_OK) {
		motivo = motivo + "Organización equivocada\n";
	}
	if (!provincia_OK) {
		motivo = motivo + "Provincia equivocada\n";
	}
	if (!numeracion_OK) {
		motivo = motivo + "Numeración equivocada\n";
	}
	if (!dControl_OK) {
		motivo = motivo + "Dígito de control equivocado\n";
	}
	// Muestro el valor entrado en el elemento HTML con id = info_lbl
	// document.getElementById("info_lbl").innerHTML = document.getElementById("info_lbl").innerHTML + motivo;
	if (motivo == "OK") {
		document.getElementById("nif").value = cif;
		}
	else {
		document.getElementById("nif").focus();
		document.getElementById("nif").value = "";
		document.getElementById("info_lbl").value = motivo;
	}
}

function analiza_DNI (dni)
{
	// La operación consiste en una división del número del DNI entre 23. 
	// El número del DNI debe tomarse como un entero, por ello los ceros que se encuentre la izquierda no serán válidos. 
	// Al dividir entre 23 tendremos 23 posibles resultados.  'T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E'
	// $posiblesLetrasDNI = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
	// El valor que debemos tomar para el cálculo de la letra del DNI es el resto qué se obtiene de la resta anteriormente indicada. 
	// Tendremos pues vete tres posibles resultados desde cero a 22. 
	// Cada letra tiene un valor entre 0 y 22 que coincidirá pues con el resto que hemos obtenido de la operación aritmética. 
	// coincide el último dígito con el resultado de la operación de comprobación.
		var currentDNI = dni.toUpperCase();
		alert (currentDNI);
		// primer dígito numérico
		var primerDigito = currentDNI.slice(0, 1);
		// intermedio dígito numérico
		var intermedioDigito = currentDNI.slice(1, 8);	
		// último dígito alfabético
		var ultimoDigito = currentDNI.slice(8, 9);
		currentDNI = currentDNI.toUpperCase();
	if(currentDNI.length == 9)
		{
		// Comprueba si se trata de un número de extranjería: ADDDDDDDB, A={X,Y,Z}	
		if (!isNaN(ultimoDigito))
			{
				$("#dni").val("");
				$("#dni").focus();
				return;	
			}
			
		if (isNaN(primerDigito) && isNaN(ultimoDigito))
			{
			if (!isNaN(intermedioDigito))
			{
				$("#dni").val(currentDNI.toUpperCase());
				return;	
			}
			}
		// Comprueba si es dni correcto
		var posiblesLetrasDNI = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
		var dniSinLetra = currentDNI.slice(0, 8);
		var i = dniSinLetra % 23;
		var letraDNI = posiblesLetrasDNI[i];
		console.log ("ultimoDigito: " + ultimoDigito + " " + letraDNI + ' ' + dniSinLetra);
		$("#dni").val(dniSinLetra+letraDNI);
		}
	else
		{
		alert ("La longitud del DNI/NIE ha de ser de NOU dígits.");
		$("#dni").val("");
		$("#dni").focus();
		}
}
