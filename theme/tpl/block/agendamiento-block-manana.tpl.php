<?php 	
	  global $base_url;	
	  $path = drupal_get_path('module', 'agendamiento');
	  require_once "$path/agendamiento.include";
	  $textos=_agendamiento_get_textos();		
?>
<?php if(count($datos)>0){?>
        <table class="table">
            <thead>
                <tr>
                    <th>Hora</th>
                   <th>Asunto</th>
                </tr>
            </thead>
            <tbody>
                <?php 					
					$actual=date("H:i");
					foreach($datos as $dato){                     										
						$fecha=explode(" ",$dato["fecha_inicial"]);
						$texto_hora="text-success";
						$texto_alt="Activa";
						if($actual>$fecha[1]){
							$texto_hora="text-muted";
							$texto_alt="Vencida";
						}						
                    ?>
                    <tr>
                       <td><div class="<?php echo $texto_hora;?>" title="<?php echo $texto_alt;?>">
                        		<span class="glyphicon glyphicon-time" aria-hidden="true"><strong><?php echo $fecha[1]; ?></strong></span>
                             </div>
                       </td>
                       <td><a id="enlace-evento" href="<?php echo $base_url;?>/agendamiento/calendario/evento/<?php echo $dato["id"];?>" data-toggle="modal" data-target="#events-modal-load"><?php echo $dato["asunto"];?></a></td>
                    </tr>
                <?php }?>        
            </tbody>
        </table>
        
        <!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal-load">
		    <div class="modal-dialog modal-lg">
			    <div class="modal-content">			       
				    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo $textos["detalle_evento"]?></h4>
                    </div>
                    <div class="modal-body" style="height: 550px">
				         
				    </div>
                    <div class="modal-footer">					
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
                </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->      
        
<?php }else{?>
		<div class="no-data">
            <div class="text-big text-center text-primary">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </div>        
            <h3 class="text-muted text-center">No hay <?php echo $textos["titulo_evento"];?></h3>
        </div>
<?php }?>