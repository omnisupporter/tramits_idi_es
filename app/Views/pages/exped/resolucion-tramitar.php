<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="/assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<div class="further">

  <?php if($resoluciones): ?>
  <div class="row">
  	<div class="col-md-12">
     <table class="display responsive" id="resoluciones">
       <thead>
          <tr>
            <th>Tipus</th>
			<th>Motiu de la resolució</th>
			<th>Data resolució</th>
			<th>Díes des-de la resolució</th>
			<th>Enviada</th>				
            <th>Acció</th>		
          </tr>
       </thead>
       <tbody>

          <?php foreach($resoluciones as $resol_item): ?>
          <tr>
             <td><?php echo $resol_item['tipo_resolucion']; ?></td>
			 <td><?php echo $resol_item['motivo_resol']; ?></td>
             <td><?php echo date_format(date_create($resol_item['fecha_resol']), 'd/m/Y H:i:s'); ?></td>
             <td><?php $date1 = new DateTime($resol_item['fecha_resol']);
				$date2 = new DateTime("now");
				$interval = $date1->diff($date2);
				echo $interval->format('%R%a díes');?>
			</td>	
			<td>
			</td>
			<td> 
				<a id = "<?php echo $resol_item['id'];?>" href="<?php echo base_url('resoluciones/formEditaResol/'.$resol_item['id'].'/'.$expedientes['id']);?>" class="btn btn-info">Edita</a>
				<?php if (strlen($resol_item['nom_PDF']) != 0) {?>
				<a href="<?php echo base_url('resoluciones/verPDF/'.$resol_item['id_sol'].'/'.$resol_item['tipo_resolucion']);?>" class="btn btn-info">Ver PDF</a>
				<?php }?>
			</td>	
          </tr>
         <?php endforeach; ?>
       </tbody>
     </table>

	</div>
    <div class="col-md-12">	
          <div class="form-group">
			<button type="button" onclick ="javaScript: crearResolucion(<?php echo $resol_item['id'];?>);" id="nova_resol" class="btn btn-success">Afegir resolució</button>
          </div>		
	</div>	
  </div>
	<div id = "edita_resolucion" class = "row">	
	<h3>Expedient:</h3>   
    <form action="<?php echo base_url('resoluciones/update');?>" name="edit-resolucion" id="edit-resolucion" method="post" accept-charset="utf-8">
	<div class="col-md-12">		          
		<div class="form-group">
            <label for="email">Data de la sol·licitud:</label>
            <strong><?php echo date_format(date_create($expedientes['fecha_solicitud']), 'd/m/Y H:i:s'); ?></strong> 
        </div>
    </div> 		  
	<div class="col-md-6">	
           <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $expedientes['id']; ?>"> 
          <div class="form-group">
            <label for="empresa">Sol·licitant:</label>
            <input type="text" name="empresa" readonly class="form-control" id="empresa" placeholder="Nom del sol·licitant" value="<?php echo $expedientes['empresa']; ?>">
          </div> 
          <div class="form-group">
            <label for="nif">NIF:</label>
            <input type="text" name="nif" readonly class="form-control" id="nif" placeholder="NIF del sol·licitant" value="<?php echo $expedientes['nif']; ?>">
          </div> 
		  
          <div class="form-group">
            <label for="domicilio">Adreça:</label>
            <input type="text" name="domicilio" readonly class="form-control" id="domicilio" placeholder="Adreça del sol·licitant" value="<?php echo $expedientes['domicilio']; ?>">
          </div>
		  
			<div class="form-group">
            <label for="localidad">Població:</label>
			 <input type="text" name="localidad" readonly class="form-control" id="localidad" placeholder="Adreça del sol·licitant" value="<?php echo $expedientes['localidad']; ?>">
			</div>
		  
           <div class="form-group">
            <label for="telefono">Telèfon:</label>
            <input type="tel" name="telefono" readonly class="form-control" id="telefono" placeholder="Telèfon del sol·licitant" value="<?php echo $expedientes['telefono']; ?>">
          </div> 
          
		  <div class="form-group">
            <label for="email">Adreça electrònica:</label>
            <input type="email" name="email" readonly class="form-control" id="email" placeholder="E-mail del sol·licitant" value="<?php echo $expedientes['email']; ?>">
          </div>     
      </div> 
	 
	 <div class="col-md-12">	
<form action =  "<?php echo base_url('resoluciones/generaPDF');?>" name = "form_crea_resol" id="form_crea_resol" method = "post" onSubmit = "return enviarSolicitud(event)" accept-charset="utf-8" enctype="multipart/form-data">
		  <div class="form-group">
            <label for="motivoDenegacion"><span class="flow-text">Tipus de resolució:</span></label>
            <div>
	<select required title="tipo_resolucion" id = "tipo_resolucion"  name = "tipo_resolucion" size="1">
		<option value=""></option>
		<option <?php if ($resol_item['tipo_resolucion'] == "deficiencias" ) echo 'selected' ; 
			?> value="deficiencias">Deficiències</option>
	<option <?php 					
				if ($resol_item['tipo_resolucion'] == "denegacion" ) echo 'selected' ; 
			?> value="denegacion">Denegació</option>
			<option <?php 					
				if ($resol_item['tipo_resolucion'] == "justificacion" ) echo 'selected' ; 
			?> value="justificacion">Justificació</option>
	</select>
		</div>
        </div>	
		<div class="form-group">
            <label for="fecha_resol"><span class="flow-text">Dada de la resolució:</span></label>
            <div><input type="date" id="fecha_resol" name="fecha_resol" value="<?php echo $resol_item['fecha_resol']; ?>" ></div>
        </div>

		
		<div class="form-group">
            <label for="motivo_resol"><span class="flow-text">Motius:</span></label>
            <div><textarea id="motivo_resol" name="motivo_resol" value="<?php echo $resol_item['motivo_resol']; ?>" rows="10" cols="70"></textarea></div>
        </div>
      </div> 

	<div class = "row">		  
	<div class="col-md-12">		          
          <div class="form-group">
				<a href="<?php echo base_url('resoluciones/actualiza/'.$resol_item['id']);?>" class="btn btn-info">Actualitza</a>

			<?php if (strlen($resol_item['nom_PDF']) == 0) {?>
				<a href="<?php echo base_url('resoluciones/generaPDF/'.$resol_item['id']);?>" class="btn btn-info">Crear PDF</a>
			<?php }?>		  
          </div>
    </div>
	</div>
</form>
<script>
function enviarSolicitud (e) {	
	alert (e);
}
</script>	
    </div>
		   <?php endif; ?>	 
<script>
function editarResolucion (id) {
	$('#edita_resolucion').css("display", "block");
	$('#crear_resolucion').css("display", "none");
	}
function crearResolucion (id) {
	$('#crear_resolucion').css("display", "block");
	$('#edita_resolucion').css("display", "none");
	}
    $(document).ready( function () {
		$('#edita_resolucion').css("display", "none");
		$('#crear_resolucion').css("display", "none");
        $('#resoluciones').DataTable( {
		"responsive": true,	 
        "order": [[ 4, "desc" ]],
		"language": {
            "lengthMenu": "Mostrar _MENU_ resolucions per pàgina",
            "zeroRecords": "De moment, no hi ha resolucions",
            "info": "Mostrant pàgina _PAGE_ de _PAGES_",
            "infoEmpty": "No hi ha resolucions disponibles.",
            "infoFiltered": "(filtrats de _MAX_ resolucions totals)"
        },
		"loadingRecords": "Carregant ...",
		"processing":     "Processant ...",
		"search":         "Cerca: ",
		"paginate": {
        "first":      "Primera",
        "last":       "Ultima",
        "next":       "Següent",
        "previous":   "Anterior"
    },
    "aria": {
        "sortAscending":  ": activar per ordenació ascendent",
        "sortDescending": ": activar per ordenació descendent"
    }
    } );
  } );
</script>

	<div id = "crear_resolucion" class = "row">	
	 <div class="col-md-12">	
		  <div class="form-group">
            <label for="motivoDenegacion"><span class="flow-text">Tipus de resolució:</span></label>
            <div>
			<select required title="Localitat" id = "localidad"  name = "localidad" size="1">
		<option value=""></option>
		<option value="deficiencias">Deficiències</option>
		<option value="denegacion">Denegació</option>
		<option value="justificacion">Justificació</option>
		</select>
		</div>
        </div>		  
		<div class="form-group">
            <label for="motivoDenegacion"><span class="flow-text">Motius:</span></label>
            <div><textarea id="motivoDenegacion" name="motivoDenegacion" rows="10" cols="70"></textarea></div>
        </div>
      </div> 

	<div class = "row">		  
	<div class="col-md-12">		          
          <div class="form-group">
           <button type="submit" id="send_form" class="btn btn-success">Crea</button>
          </div>
    </div>
	</div>	
	</div>
	
</div>


<script> // TinyMCE
tinymce.init({
  selector: 'textarea',
  language: 'ca',  // site absolute URL
  setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            })
			},
  plugins: 'image code print preview fullpage paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table',
  toolbar: 'undo redo | insertfile | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | media template link anchor codesample | ltr rtl',
  /* without images_upload_url set, Upload tab won't show up*/
  images_upload_url: 'postAcceptor.php',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Tahoma:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
  link_list: [
    { title: 'IDI', value: 'http://www.idi.es' },
    { title: 'ICAPE', value: 'http://www.icape.es' }
  ],
  image_list: [
    { title: 'IDI', value: 'http://www.idi.es' },
    { title: 'ICAPE', value: 'http://www.icape.es' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('http://extranet.icape.es/images/adjuntos_Email/', { text: 'adjuntos_Email/' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('http://extranet.icape.es/images/', { alt: 'imágenes' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'http://extranet.icape.es/images/' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %d/%m/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %d/%m/%Y : %H:%M:%S]',

  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  contextmenu: "link image imagetools table",
 });
</script>


    <br>
    <?= \Config\Services::validation()->listErrors(); ?>
 
    <span class="d-none alert alert-success mb-3" id="res_message"></span>

<script>
function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click(); 
</script>