<?php 	
	  global $base_url;	
	  $path = drupal_get_path('module', 'agendamiento');
	  require_once "$path/agendamiento.include";
	  $textos=_agendamiento_get_textos();
	  $list_tipos_eventos=_agendamiento_get_tipos_evento();	
?>
<?php if(count($datos)>0){?>

         <table class="table">
            <thead>
                <tr>
                   <th>Estado</th>
                   <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos as $dato){?>
                    <?php ?>
                    <tr>
                        <td><?php echo strtoupper($list_tipos_eventos[$dato["tipo_evento"]]); ?></td>
                        <td><?php echo $dato["cantidad"];?></td>
                    </tr>
                <?php }?>        
            </tbody>
        </table>
<?php }else{?>
		<div class="no-data">
            <div class="text-big text-center text-primary">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </div>        
            <h3 class="text-muted text-center">No hay <?php echo $textos["titulo_evento"];?></h3>
        </div>
<?php }?>