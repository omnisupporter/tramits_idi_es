var interval = 0;

const mainNode = document.querySelector('body');  
const selladorBtn = document.getElementById('selladorBtn');
//selladorBtn.addEventListener('click', setInterval(selladoDedocumentoAdjuntado, 5000))

mainNode.onload = estadoSello_OnLoad;

const h1Display = document.querySelector('#js-counter');
//referenciar boton con id btn_stop_Stamping
const btnDecrement = document.querySelector('#btn_stop_Stamping');
//referenciar boton con id btn_start_Stamping
const btnIncrement = document.querySelector('#btn_start_Stamping');
//referenciar elemento checkbox cb_enabled
const chcbox = document.querySelector('#cb_enabled');
//añadir event listener onclick btn_stop_Stamping
btnDecrement.addEventListener('click', decrementCounter);
//añadir event listener onclick btn_start_Stamping
btnIncrement.addEventListener('click', incrementCounter);

function decrementCounter() {
		clearInterval(interval);
		h1Display.innerHTML = "Sellado parado.";
		btnDecrement.disabled = true;
		btnIncrement.disabled = false;
	}

function incrementCounter(chcboxState) {
		interval = setInterval(selladoDedocumentoAdjuntado, 3000);
		h1Display.innerHTML = "Sellando documentación adjunta a la solicitud ...";
		btnDecrement.disabled = false;
		btnIncrement.disabled = true;
	}

async function selladoDedocumentoAdjuntado() {
	let resultadoP = document.getElementById("resultados");
	let obtieneDocumento = "/public/assets/utils/seleccionaDocumentoAdjuntadoSinCustodia.php";
	let rutaDelDocumento = "";
	await fetch(obtieneDocumento)
		.then((response) => response.text())
		.then((data) => {
			rutaDelDocumento = data;
			if (rutaDelDocumento == "Nada que sellar.") {
				let row = document.createElement("tr");
				let cell = document.createElement("td");
				let cellText = document.createTextNode('TODO SELLADO.');
				cell.appendChild(cellText);
				row.appendChild(cell);
				resultadoP.appendChild(row);
				decrementCounter();
			}	
		});

	let sellaElDocumento ="/public/assets/utils/sellado-diferido-de-documentacion.php?urlDocumento="+ rutaDelDocumento;
	await fetch(sellaElDocumento)
		.then((response) => response.text())
		.then((data) => {
			let row = document.createElement("tr");
			let cell = document.createElement("td");
			let cellText = document.createTextNode(data);
			cell.appendChild(cellText);
			row.appendChild(cell);
			resultadoP.appendChild(row);
			resultadoP.setAttribute("border", "2");
		});
}

// -------------------- SELLADO DE DOCUMENTOS JUSTIFICACIÓN ---------------------------------------------------------------------------------------//
const justificacionDisplay = document.querySelector('#titulo_doc_justificacion');
//referenciar boton con id btn_decrement
const btnSellarJustific = document.querySelector('#btn_sellar_justificacion');
//referenciar boton con id btn_start_Stamping
const btnPararSellarJustific = document.querySelector('#btn_parar_sellar_justificacion');

//añadir event listener onclick btn_decrement
btnSellarJustific.addEventListener('click', sellarJustific);
//añadir event listener onclick btn_start_Stamping
btnPararSellarJustific.addEventListener('click', pararSellarJustific);
function pararSellarJustific() {
		clearInterval(interval);
		justificacionDisplay.innerHTML = "Sellado parado.";
		btnPararSellarJustific.disabled = true;
		btnSellarJustific.disabled = false;
	}

function sellarJustific() {
		interval = setInterval(selladoDeJustificacion, 3000);
		justificacionDisplay.innerHTML = "Sellando documentos de la justificación ...";
		btnPararSellarJustific.disabled = false;
		btnSellarJustific.disabled = true;
	}

async function selladoDeJustificacion() {
	let resultadosJustificacion = document.getElementById("resultadosJustificacion");
	let obtieneDocumentoJusfiticacion = "/public/assets/utils/seleccionaDocumentoJustificacionSinCustodia.php";
	let rutaDelDocumentoJustificacion = "";
	await fetch(obtieneDocumentoJusfiticacion)
		.then((response) => response.text())
		.then((data) => {
			rutaDelDocumentoJustificacion = data;
		});

console.log ("ruta "+rutaDelDocumentoJustificacion);
let sellaElDocumentoJustificacion ="/public/assets/utils/sellado-diferido-de-documentacion-justificacion.php?urlDocumento="+ rutaDelDocumentoJustificacion;
await fetch(sellaElDocumentoJustificacion)
			.then((response) => response.text())
			.then((data) => {
				let row = document.createElement("tr");
				let cell = document.createElement("td");
				let cellText = document.createTextNode(data+" ruta: "+rutaDelDocumentoJustificacion);
				cell.appendChild(cellText);
				row.appendChild(cell);
				resultadosJustificacion.appendChild(row);
				resultadosJustificacion.setAttribute("border", "2");
		});
}

async function estadoSello (publicAccessId) {
	let obtieneSello = "/public/assets/utils/comprobarEstadoSello.php?publicAccessId="+ publicAccessId;
	const estadoSelloDoc = await fetch(obtieneSello)
		.then((response) => response.text())
		.then((data) => {
			return data;
		});
	let etiquetaPadre = document.getElementById(publicAccessId);
	var etiqueta = document.createElement("span");
	switch (estadoSelloDoc)
					{
					case 'NOT_STARTED':
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Document Pendent de custodiar</div>";				
					break;
					case 'REJECTED':
					$estado_firma = "<div class = 'warning-msg'><i class='fa fa-warning'></i> Completada-rebutjada</div>";			
					break;
					case 'COMPLETED':
					$estado_firma = "<div class='success-msg'><i class='fa fa-check'></i> Completada-signada</div>";						
					break;
					case 'IN_PROCESS':
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i> En curs</div>";
					break;					
					default:
					$estado_firma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Desconegut</div>";
					}

	etiquetaPadre.innerHTML = '<a href=".base_url(\'public/index.php/expedientes/muestrasolicitudfirmada/\'.$expedientes[\'PublicAccessId\']).">'+$estado_firma+'</a>';
}

async function estadoSello_OnLoad () {
	let obtieneSello, estadoFirma;
	let i=0, src, publicId;
	src = Array.prototype.slice.call(document.querySelectorAll('.verSello'));
	[].forEach.call(src, (e) => {
		publicId = src[i].id;
		obtieneSello = obtieneEstadoDelSello (publicId);
		let etiquetaPadre = document.getElementById (publicId);
		switch (obtieneSello)
		{
		case 'NOT_STARTED':
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Pendent de custodiar</div>";				
			break;
		case 'REJECTED':
			estadoFirma = "<div class = 'warning-msg'><i class='fa fa-warning'></i> Document rebutjat</div>";			
			break;
		case 'COMPLETED':
			estadoFirma = "<div class='success-msg'><i class='fa fa-check'></i> Document custodiat</div>";						
			break;
		case 'IN_PROCESS':
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> En curs</div>";
			break;					
		default:
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Desconegut</div>";
		}
		etiquetaPadre.innerHTML = estadoFirma;
		console.log(publicId+" "+estadoFirma+" "+obtieneSello)
		i++;
	});			
}

async function obtieneEstadoDelSello (publicId) {
	let API_URI = "/public/assets/utils/comprobarEstadoSello.php?publicAccessId="+ publicId;
	await fetch(API_URI)
		.then((response) => response.text())
		.then((data) => {
			switch (data)
		{
		case 'NOT_STARTED':
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Document Pendent de segellar</div>";				
			break;
		case 'REJECTED':
			estadoFirma = "<div class = 'warning-msg'><i class='fa fa-warning'></i> Document rebutjat</div>";			
			break;
		case 'COMPLETED':
			estadoFirma = "<div class = 'success-msg'><i class='fa fa-check'></i> Document custodiat</div>";						
			break;
		case 'IN_PROCESS':
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> En curs</div>";
			break;					
		default:
			estadoFirma = "<div class='info-msg'><i class='fa fa-info-circle'></i> Desconegut</div>";
		}
		document.getElementById (publicId).innerHTML = estadoFirma;
		});
}