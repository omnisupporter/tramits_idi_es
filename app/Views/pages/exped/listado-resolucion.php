<!--<div class="further">-->
<!--<div class="container">-->
    <!--<a href="<?php echo base_url('expedientes/create') ?>" class="btn btn-success mb-2">Crea</a>-->
    <?php
     if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
      }
     ?>
  <div class="row">
  <div class="col-md-12">
     <table class="display responsive" id="expedientes">
       <thead>
          <tr>
            <th>Empresa</th>
			<th>Ajut / Subvenció</th>
			<th>Data sol·licitud</th>
			<th>Díes des-de la sol·licitud</th>		
            <th>Resolucions</th>		
          </tr>
       </thead>
       <tbody>
          <?php if($expedientes): ?>
		<?php 
			$db = \Config\Database::connect();
			$db = db_connect();
		?>
          <?php foreach($expedientes as $exped_item): ?>
          <tr>
             <td><?php echo $exped_item['empresa']; ?></td>
			 <td><?php echo $exped_item['tipo_tramite']; ?></td>
             <td><?php echo date_format(date_create($exped_item['fecha_solicitud']), 'd/m/Y H:i:s'); ?></td>
             <td><?php 
				$date1 = new DateTime($exped_item['fecha_solicitud']);
				$date2 = new DateTime("now");
				$interval = $date1->diff($date2);
				echo $interval->format('%R%a díes');
			 
			?></td>			 	 
			<td> 
			<?php
				$sql = "SELECT Count(id) as numResol FROM pindust_resoluciones WHERE id_sol =". $exped_item['id'];
				$query = $db->query($sql);
				foreach ($query->getResult() as $row)
					{
					$numResol = $row->numResol;
					}
				if ($numResol > 0) {?>
					<a href="<?php echo base_url('resoluciones/tramitar/'.$exped_item['id']);?>" class="btn btn-info">+Info</a>
			<?php	} else { ?>
					<a href="<?php echo base_url('resoluciones/crear/'.$exped_item['id']);?>" class="btn btn-success">Crea</a>			
			<?php } ?>
			</td>	
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
  </div>
  </div>
<!--</div>-->
<!--</div>-->

<?php
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
?>
	
<script>
    $(document).ready( function () {
         $('#expedientes').DataTable( {
		"responsive": true,	 
        "order": [[ 4, "desc" ]],
		"language": {
            "lengthMenu": "Mostrar _MENU_ expedients per pàgina",
            "zeroRecords": "De moment, no hi ha expedients",
            "info": "Mostrant pàgina _PAGE_ de _PAGES_",
            "infoEmpty": "No hi ha expedients disponibles.",
            "infoFiltered": "(filtrats de _MAX_ expedients totals)"
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