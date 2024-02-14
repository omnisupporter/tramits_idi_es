window.addEventListener('load', (event) => {
    let intervaloActualizacion = (document.getElementById("updateInterval").value/4 * 60 * 1000)/10;
    if (intervaloActualizacion === 0) {
        intervaloActualizacion = 60000
    }
    intervaloActualizacion = intervaloActualizacion / 10
    intervaloActualizacion = 6000
    const googleId = document.querySelector(".unreadMails").id;

    getUnreadMessages(googleId)

    // Harcodeo todo lo que sigue por falta de tiempo. Cuando pueda, tengo que refactorizar.  (02/12/2021)

    /* totalSolicitudesPrograma('2020', 'Programa iDigital 20');

    totalSolicitudesPrograma('2021', 'Programa I');
    totalSolicitudesPrograma('2021', 'Programa II');
    totalSolicitudesPrograma('2021', 'Programa III');

    totalSolicitudesPrograma('2022', 'Programa I');
    totalSolicitudesPrograma('2022', 'Programa II');
    totalSolicitudesPrograma('2022', 'Programa III');

    totalSolicitudesPrograma('2022', 'ILS'); */

    /* importeTotalSolicitadoPrograma('2022', 'Programa I');
    importeTotalSolicitadoPrograma('2022', 'Programa II');
    importeTotalSolicitadoPrograma('2022', 'Programa III');

    
    importeTotalConcedidoPrograma('2022', 'Programa I');
    importeTotalConcedidoPrograma('2022', 'Programa II');
    importeTotalConcedidoPrograma('2022', 'Programa III');

    totalSolicitudesPorSituacion('2022', 'Programa I', 'Finalizado', 'totalSolicitudesIFinalizadas_2021');
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Finalizado', 'totalSolicitudesIIFinalizadas_2021');
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Finalizado', 'totalSolicitudesIIIFinalizadas_2021');

    totalSolicitudesPorSituacion('2022', 'Programa I', 'Denegado', 'totalSolicitudesIDenegadas_2021');
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Denegado', 'totalSolicitudesIIDenegadas_2021');
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Denegado', 'totalSolicitudesIIIDenegadas_2021');

    totalSolicitudesPorSituacion('2022', 'Programa I', 'pendiente', 'totalSolicitudesIPendientes_2021');
    totalSolicitudesPorSituacion('2022', 'Programa II', 'pendiente', 'totalSolicitudesIIPendientes_2021');
    totalSolicitudesPorSituacion('2022', 'Programa III', 'pendiente', 'totalSolicitudesIIIPendientes_2021');

    totalSolicitudesPorSituacion('2022', 'Programa I', 'nohapasadoREC', 'totalSolicitudesINoREC_2021');
    totalSolicitudesPorSituacion('2022', 'Programa II', 'nohapasadoREC', 'totalSolicitudesIINoREC_2021');
    totalSolicitudesPorSituacion('2022', 'Programa III', 'nohapasadoREC', 'totalSolicitudesIIINoREC_2021');

    totalSolicitudesPorSituacion('2022', 'Programa I', 'Justificado', 'totalSolicitudesIJustificado_2021');
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Justificado', 'totalSolicitudesIIJustificado_2021');
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Justificado', 'totalSolicitudesIIIJustificado_2021'); */

    //convo 2020

   /*  totalSolicitudesPrograma('2020', 'Programa iDigital 20');
    importeTotalSolicitadoPrograma('2020', 'Programa iDigital 20');
    importeTotalConcedidoPrograma('2020', 'Programa iDigital 20');  */
    
    //convo 2021

/*     totalSolicitudesPrograma('2021', 'Programa I');
    totalSolicitudesPrograma('2021', 'Programa II');
    totalSolicitudesPrograma('2021', 'Programa III');

    importeTotalSolicitadoPrograma('2021', 'Programa I'); 
    importeTotalSolicitadoPrograma('2021', 'Programa II'); 
    importeTotalSolicitadoPrograma('2021', 'Programa III');

    importeTotalConcedidoPrograma('2021', 'Programa I'); 
    importeTotalConcedidoPrograma('2021', 'Programa II'); 
    importeTotalConcedidoPrograma('2021', 'Programa III');


    totalSolicitudesPorSituacion('2021', 'Programa I', 'Finalizado', 'totalSolicitudesIFinalizadas_2021');
    totalSolicitudesPorSituacion('2021', 'Programa II', 'Finalizado', 'totalSolicitudesIIFinalizadas_2021');
    totalSolicitudesPorSituacion('2021', 'Programa III', 'Finalizado', 'totalSolicitudesIIIFinalizadas_2021');

    totalSolicitudesPorSituacion('2021', 'Programa I', 'Denegado', 'totalSolicitudesIDenegadas_2021');
    totalSolicitudesPorSituacion('2021', 'Programa II', 'Denegado', 'totalSolicitudesIIDenegadas_2021');
    totalSolicitudesPorSituacion('2021', 'Programa III', 'Denegado', 'totalSolicitudesIIIDenegadas_2021');

    totalSolicitudesPorSituacion('2021', 'Programa I', 'inicioConsultoria', 'totalSolicitudesIPendientes_2021');
    totalSolicitudesPorSituacion('2021', 'Programa II', 'inicioConsultoria', 'totalSolicitudesIIPendientes_2021');
    totalSolicitudesPorSituacion('2021', 'Programa III', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_2021');

    totalSolicitudesPorSituacion('2021', 'Programa I', 'nohapasadoREC', 'totalSolicitudesINoREC_2021');
    totalSolicitudesPorSituacion('2021', 'Programa II', 'nohapasadoREC', 'totalSolicitudesIINoREC_2021');
    totalSolicitudesPorSituacion('2021', 'Programa III', 'nohapasadoREC', 'totalSolicitudesIIINoREC_2021');

    totalSolicitudesPorSituacion('2021', 'Programa I', 'Justificado', 'totalSolicitudesIJustificado_2021');
    totalSolicitudesPorSituacion('2021', 'Programa II', 'Justificado', 'totalSolicitudesIIJustificado_2021');
    totalSolicitudesPorSituacion('2021', 'Programa III', 'Justificado', 'totalSolicitudesIIIJustificado_2021'); */

    
    //convo 2022

/*     totalSolicitudesPrograma('2022', 'Programa I')
    totalSolicitudesPrograma('2022', 'Programa II')
    totalSolicitudesPrograma('2022', 'Programa III')

    totalSolicitudesPrograma('2022', 'Programa I')
    totalSolicitudesPrograma('2022', 'Programa II')
    totalSolicitudesPrograma('2022', 'Programa III')

    importeTotalSolicitadoPrograma('2022', 'Programa I')
    importeTotalSolicitadoPrograma('2022', 'Programa II')
    importeTotalSolicitadoPrograma('2022', 'Programa III')

    
    importeTotalConcedidoPrograma('2022', 'Programa I')
    importeTotalConcedidoPrograma('2022', 'Programa II')
    importeTotalConcedidoPrograma('2022', 'Programa III')

    totalSolicitudesPorSituacion('2022', 'Programa I', 'Finalizado', 'totalSolicitudesIFinalizadas_2022')
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Finalizado', 'totalSolicitudesIIFinalizadas_2022')
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Finalizado', 'totalSolicitudesIIIFinalizadas_2022')
    totalSolicitudesPorSituacion('2022', 'ILS', 'empresaAdherida', 'totalSolicitudesILSAdheridas_2022')

    totalSolicitudesPorSituacion('2022', 'Programa I', 'Denegado', 'totalSolicitudesIDenegadas_2022')
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Denegado', 'totalSolicitudesIIDenegadas_2022')
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Denegado', 'totalSolicitudesIIIDenegadas_2022')
    totalSolicitudesPorSituacion('2022', 'ILS', 'empresaDenegada', 'totalSolicitudesILSDenegadas_2022')


    totalSolicitudesPorSituacion('2022', 'Programa I', 'inicioConsultoria', 'totalSolicitudesIPendientes_2022')
    totalSolicitudesPorSituacion('2022', 'Programa II', 'inicioConsultoria', 'totalSolicitudesIIPendientes_2022')
    totalSolicitudesPorSituacion('2022', 'Programa III', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_2022')
    totalSolicitudesPorSituacion('2022', 'ILS', 'inicioConsultoria', 'totalSolicitudesILSPendientes_2022')


    totalSolicitudesPorSituacion('2022', 'Programa I', 'nohapasadoREC', 'totalSolicitudesINoREC_2022')
    totalSolicitudesPorSituacion('2022', 'Programa II', 'nohapasadoREC', 'totalSolicitudesIINoREC_2022')
    totalSolicitudesPorSituacion('2022', 'Programa III', 'nohapasadoREC', 'totalSolicitudesIIINoREC_2022')
    totalSolicitudesPorSituacion('2022', 'ILS', 'nohapasadoREC', 'totalSolicitudesILSNoREC_2022')


    totalSolicitudesPorSituacion('2022', 'Programa I', 'Justificado', 'totalSolicitudesIJustificado_2022')
    totalSolicitudesPorSituacion('2022', 'Programa II', 'Justificado', 'totalSolicitudesIIJustificado_2022')
    totalSolicitudesPorSituacion('2022', 'Programa III', 'Justificado', 'totalSolicitudesIIIJustificado_2022') */


    //convo 2023

/*     totalSolicitudesPrograma('2023', 'Programa I');
    totalSolicitudesPrograma('2023', 'Programa II');
    totalSolicitudesPrograma('2023', 'Programa III');

    totalSolicitudesPrograma('2023', 'Programa I')
    totalSolicitudesPrograma('2023', 'Programa II')
    totalSolicitudesPrograma('2023', 'Programa III')

    importeTotalSolicitadoPrograma('2023', 'Programa I')
    importeTotalSolicitadoPrograma('2023', 'Programa II')
    importeTotalSolicitadoPrograma('2023', 'Programa III')

    
    importeTotalConcedidoPrograma('2023', 'Programa I')
    importeTotalConcedidoPrograma('2023', 'Programa II')
    importeTotalConcedidoPrograma('2023', 'Programa III')

    totalSolicitudesPorSituacion('2023', 'Programa I', 'Finalizado', 'totalSolicitudesIFinalizadas_2023')
    totalSolicitudesPorSituacion('2023', 'Programa II', 'Finalizado', 'totalSolicitudesIIFinalizadas_2023')
    totalSolicitudesPorSituacion('2023', 'Programa III', 'Finalizado', 'totalSolicitudesIIIFinalizadas_2023')
    totalSolicitudesPorSituacion('2023', 'ILS', 'empresaAdherida', 'totalSolicitudesILSAdheridas_2023')

    totalSolicitudesPorSituacion('2023', 'Programa I', 'Denegado', 'totalSolicitudesIDenegadas_2023')
    totalSolicitudesPorSituacion('2023', 'Programa II', 'Denegado', 'totalSolicitudesIIDenegadas_2023')
    totalSolicitudesPorSituacion('2023', 'Programa III', 'Denegado', 'totalSolicitudesIIIDenegadas_2023')
    totalSolicitudesPorSituacion('2023', 'ILS', 'empresaDenegada', 'totalSolicitudesILSDenegadas_2023')


    totalSolicitudesPorSituacion('2023', 'Programa I', 'inicioConsultoria', 'totalSolicitudesIPendientes_2023')
    totalSolicitudesPorSituacion('2023', 'Programa II', 'inicioConsultoria', 'totalSolicitudesIIPendientes_2023')
    totalSolicitudesPorSituacion('2023', 'Programa III', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_2023')
    totalSolicitudesPorSituacion('2023', 'ILS', 'inicioConsultoria', 'totalSolicitudesILSPendientes_2023')


    totalSolicitudesPorSituacion('2023', 'Programa I', 'nohapasadoREC', 'totalSolicitudesINoREC_2023')
    totalSolicitudesPorSituacion('2023', 'Programa II', 'nohapasadoREC', 'totalSolicitudesIINoREC_2023')
    totalSolicitudesPorSituacion('2023', 'Programa III', 'nohapasadoREC', 'totalSolicitudesIIINoREC_2023')
    totalSolicitudesPorSituacion('2023', 'ILS', 'nohapasadoREC', 'totalSolicitudesILSNoREC_2023')


    totalSolicitudesPorSituacion('2023', 'Programa I', 'Justificado', 'totalSolicitudesIJustificado_2023')
    totalSolicitudesPorSituacion('2023', 'Programa II', 'Justificado', 'totalSolicitudesIIJustificado_2023')
    totalSolicitudesPorSituacion('2023', 'Programa III', 'Justificado', 'totalSolicitudesIIIJustificado_2023') */

    //convo 2024

    totalSolicitudesPrograma('2024', 'Programa I')
    totalSolicitudesPrograma('2024', 'Programa II')
    totalSolicitudesPrograma('2024', 'Programa III actuaciones corporativas')
    totalSolicitudesPrograma('2024', 'Programa III actuaciones producto')
    totalSolicitudesPrograma('2024', 'Programa IV')

    /*     importeTotalSolicitadoPrograma('2024', 'Programa I')
    importeTotalSolicitadoPrograma('2024', 'Programa II')
    importeTotalSolicitadoPrograma('2024', 'Programa III actuaciones corporativas')
    importeTotalSolicitadoPrograma('2024', 'Programa III actuaciones producto')
    importeTotalSolicitadoPrograma('2024', 'Programa IV') */

    importeTotalConcedidoPrograma('2024', 'Programa I')
    importeTotalConcedidoPrograma('2024', 'Programa II')
    importeTotalConcedidoPrograma('2024', 'Programa III actuaciones corporativas')
    importeTotalConcedidoPrograma('2024', 'Programa III actuaciones producto')
    importeTotalConcedidoPrograma('2024', 'Programa IV')

    /*  totalSolicitudesPorSituacion('2024', 'Programa I', 'Finalizado', 'totalSolicitudesIFinalizadas_2024')
    totalSolicitudesPorSituacion('2024', 'Programa II', 'Finalizado', 'totalSolicitudesIIFinalizadas_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones corporativas', 'Finalizado', 'totalSolicitudesIIIFinalizadas_org_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones producto', 'Finalizado', 'totalSolicitudesIIIFinalizadas_prod_2024')
    totalSolicitudesPorSituacion('2024', 'Programa IV', 'Finalizado', 'totalSolicitudesIIIFinalizadas_2024')

    totalSolicitudesPorSituacion('2024', 'Programa I', 'Denegado', 'totalSolicitudesIDenegadas_2024')
    totalSolicitudesPorSituacion('2024', 'Programa II', 'Denegado', 'totalSolicitudesIIDenegadas_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones corporativas', 'Denegado', 'totalSolicitudesIIIDenegadas_org_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones producto', 'Denegado', 'totalSolicitudesIIIDenegadas_prod_2024')
    totalSolicitudesPorSituacion('2024', 'Programa IV', 'Denegado', 'totalSolicitudesIIIDenegadas_2024')

    totalSolicitudesPorSituacion('2024', 'Programa I', 'inicioConsultoria', 'totalSolicitudesIPendientes_2024')
    totalSolicitudesPorSituacion('2024', 'Programa II', 'inicioConsultoria', 'totalSolicitudesIIPendientes_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones corporativas', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_org_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones producto', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_prod_2024')
    totalSolicitudesPorSituacion('2024', 'Programa IV', 'inicioConsultoria', 'totalSolicitudesIIIPendientes_2024')
*/

    totalSolicitudesPorSituacion('2024', 'Programa I', 'nohapasadoREC', 'totalSolicitudesINoREC_2024')
    totalSolicitudesPorSituacion('2024', 'Programa II', 'nohapasadoREC', 'totalSolicitudesIINoREC_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones corporativas', 'nohapasadoREC', 'totalSolicitudesIIINoREC_org_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones producto', 'nohapasadoREC', 'totalSolicitudesIIINoREC_prod_2024')
    totalSolicitudesPorSituacion('2024', 'Programa IV', 'nohapasadoREC', 'totalSolicitudesIIINoREC_2024')
/*
    totalSolicitudesPorSituacion('2024', 'Programa I', 'Justificado', 'totalSolicitudesIJustificado_2024')
    totalSolicitudesPorSituacion('2024', 'Programa II', 'Justificado', 'totalSolicitudesIIJustificado_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones corporativas', 'Justificado', 'totalSolicitudesIIIJustificado_org_2024')
    totalSolicitudesPorSituacion('2024', 'Programa III actuaciones producto', 'Justificado', 'totalSolicitudesIIIJustificado_prod_2024')
    totalSolicitudesPorSituacion('2024', 'Programa IV', 'Justificado', 'totalSolicitudesIVJustificado_2024') */

   /*  setInterval(function(){ totalSolicitudesPorSituacion('2022', 'ILS', 'Justificado', 'totalSolicitudesILSJustificado_2022'); }, intervaloActualizacion); */

});

async function totalSolicitudesPrograma(convo, stage) {
    let resultadoP;
	let recurso = '/public/assets/utils/numSolicitudesPrograma.php?convocatoria="'+ convo + '"/tipo_tramite="' + stage +'"'
	const totalSolicitudes = await fetch(recurso).then(res => res.json())
    if (stage == 'Programa iDigital 20') { resultadoP = document.getElementById("totaliDigital2020"); }
    if (stage == 'Programa I') {resultadoP = document.getElementById("totalSolicitudesI_"+convo)}
    if (stage == 'Programa II') {resultadoP = document.getElementById("totalSolicitudesII_"+convo)}
    if (stage == 'Programa III actuaciones corporativas') {resultadoP = document.getElementById("totalSolicitudesIII_org_"+convo)}
    if (stage == 'Programa III actuaciones producto') {resultadoP = document.getElementById("totalSolicitudesIII_prod_"+convo)}
    if (stage == 'Programa IV') {resultadoP = document.getElementById("totalSolicitudesIV_"+convo)}
    if (stage == 'ILS')  { resultadoP = document.getElementById("totalSolicitudesILSAdheridas"); }
    resultadoP.innerHTML = "Sol·licituds aprovades: "+ totalSolicitudes;

}

async function importeTotalSolicitadoPrograma(convo, stage) {
    let resultadoP;
	let recurso = '/public/assets/utils/importeTotalSolicitadoPrograma.php?convocatoria="'+ convo + '"/tipo_tramite="' + stage +'"';
	const importeSolicitado = await fetch(recurso).then(res => res.json());
    /*     console.log(JSON.stringify(importeSolicitado));
    console.log ("Importe total solicitado: "+convo+" "+stage+" "+importeSolicitado); */
    //if (stage == 'Programa iDigital 20')  { resultadoP = document.getElementById("importeTotaliDigital2020"); }
    if (stage == 'Programa I')  { resultadoP = document.getElementById("importeTotalI_"+convo); }
    if (stage == 'Programa II')  { resultadoP = document.getElementById("importeTotalII_"+convo); }
    /* if (stage == 'Programa III')  { resultadoP = document.getElementById("importeTotalIII_"+convo); } */
    if (stage == 'Programa III actuaciones corporativas') { resultadoP = document.getElementById("importeTotalIII_org_"+convo); }
    if (stage == 'Programa III actuaciones producto') { resultadoP = document.getElementById("importeTotalIII_prod_"+convo); }
    if (stage == 'Programa IV') { resultadoP = document.getElementById("importeTotalIV_"+convo); }
    console.log (`convo: ${convo} stage: ${stage} resultadoP: ${resultadoP}`)
    //resultadoP.innerHTML = "Import total sol·licitat: "+ new Intl.NumberFormat().format(importeSolicitado) + " €";
}

async function importeTotalConcedidoPrograma(convo, stage) {
    let resultadoP;
	let recurso = '/public/assets/utils/importeTotalConcedidoPrograma.php?convocatoria="'+ convo + '"/tipo_tramite="' + stage +'"';
	const importeConcedido = await fetch(recurso).then(res => res.json())
    //if (stage == 'Programa iDigital 20')  { resultadoP = document.getElementById("importeConcedidoiDigital2020"); }
    if (stage == 'Programa I')  { resultadoP = document.getElementById("importeConcedidoI_"+convo); }
    if (stage == 'Programa II')  { resultadoP = document.getElementById("importeConcedidoII_"+convo); }
    /* if (stage == 'Programa III')  { resultadoP = document.getElementById("importeConcedidoIII_"+convo); } */
    if (stage == 'Programa III actuaciones corporativas') { resultadoP = document.getElementById("importeConcedidoIII_org_"+convo); }
    if (stage == 'Programa III actuaciones producto') { resultadoP = document.getElementById("importeConcedidoIII_prod_"+convo); }
    if (stage == 'Programa IV') { resultadoP = document.getElementById("importeConcedidoIV_"+convo); }
    resultadoP.innerHTML = "Import concedit: "+ new Intl.NumberFormat().format(importeConcedido) + " €";
}

async function totalSolicitudesPorSituacion(convo, stage, situacion, elementID) {
    let resultadoP;
	let recurso = '/public/assets/utils/totalSolicitudesPorSituacion.php?convocatoria="' + convo + '"/tipo_tramite="' + stage + '"/situacion="' + situacion +'"';
	const totalSolicitudes = await fetch(recurso).then(res => res.json());
    
    if (situacion == 'nohapasadoREC') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds pendents'
    }

    if (situacion == 'inicioConsultoria') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds en INICI CONSULTORIA';
    }

    if (situacion == 'Denegado') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds DENEGADES'
    }

    if (situacion == 'empresaDenegada') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds DENEGADES'
    }

    if (situacion == 'Finalizado') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds FINALITZADES'
    }

    if (situacion == 'empresaAdherida') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> empreses ADHERIDES'
    }

    if (situacion == 'Justificado') {
        situacion = ' <strong>' + new Intl.NumberFormat().format(totalSolicitudes) + '</strong> sol·licituds JUSTIFICADES'
    }

    console.log (`Total pendientes: ${convo} ${stage} ${situacion} ${totalSolicitudes}`)
    if (stage == 'Programa iDigital 20')  { resultadoP = document.getElementById("totalSolicitudesiDigital2020Pendientes"); }
    if (stage == 'Programa I')  { resultadoP = document.getElementById(elementID); }
    if (stage == 'Programa II')  { resultadoP = document.getElementById(elementID); }
    if (stage == 'Programa III actuaciones corporativas')  { resultadoP = document.getElementById(elementID); }
    if (stage == 'Programa III actuaciones producto')  { resultadoP = document.getElementById(elementID); }
    if (stage == 'Programa IV')  { resultadoP = document.getElementById(elementID); }

    if (stage == 'ILS')  { resultadoP = document.getElementById(elementID); }
    console.log ("situacion ", situacion)
    resultadoP.innerHTML = "<strong>" + situacion + "</strong>";

}