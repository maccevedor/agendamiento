<?php 	
	  global $base_url;	
	  $path = drupal_get_path('module', 'agendamiento');
	  require_once "$path/agendamiento.include";
	  $textos=_agendamiento_get_textos();	
	  $list_estados=_agendamiento_get_estados();	
	  
	  

?>
<?php if(count($datos)>0){?>
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asunto</th>
                    <th>Cliente</th>
                    <th>Especialista</th>
                    <th>Medio atención</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
					$actual=date("H:i");
					foreach($datos as $dato){  
					
						//Especialista
						$especialista="";
						if(is_numeric($dato['especialista_id'])){
							$user_data = user_load($dato['especialista_id']);						
							$especialista=trim(strtoupper($user_data->field_alusno[LANGUAGE_NONE][0]["value"]))." ".trim(strtoupper($user_data->field_alusap[LANGUAGE_NONE][0]["value"]));
						}
					    
						//Medio atencion 
						$medio_atencion="";
						$medios=taxonomy_get_tree(596);
						$codigo_id=0;
						foreach($medios as $medio){
							$term = taxonomy_term_load($medio->tid);
							if(isset($term->field_agmacd[LANGUAGE_NONE])){
								$codigo_id=$term->field_agmacd[LANGUAGE_NONE][0]["value"];	
								if($dato['medio_atencion_id']==$codigo_id){
									$medio_atencion=$term->name;
									continue;
								}
							}
						}

						               										
						$fecha=explode(" ",$dato["fecha_inicial"]);
						$texto_hora="text-success";
						$texto_alt="Activa";
						if($actual>$fecha[1]){
							$texto_hora="text-muted";
							$texto_alt="Vencida";
						}						
                    ?>
                    <tr>
                       <td><a id="enlace-eventoto" href="<?php echo $base_url;?>/agendamiento/calendario/evento/<?php echo $dato["id"];?>"><?php echo $dato["codigo"]; ?> </a></td>
                       <td><?php echo $fecha[0]; ?> </td>
                       <td><?php echo $fecha[1]; ?> </td>
                       <td><?php echo $dato["asunto"];?></td>
                   	  <td><?php echo $dato["nombre"]." ".$dato["apellido"]; ?> </td>
                       <td><?php echo $especialista; ?> </td>
                       <td><?php echo $medio_atencion; ?> </td>
                       <td><?php echo $list_estados[$dato["estado_cita"]]; ?> </td>	
                    </tr>
                <?php }?>        
            </tbody>
        </table>
       <!-- <div class="row">
        	<div class="col-sm-12">
           	<ul class="pagination">
                  <li><a href="#">1</a></li>
                  <li class="active"><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
              </ul> 
           </div>
        </div>-->       
          
        
<?php }else{?>
		<div class="no-data">
            <div class="text-big text-center text-primary">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </div>        
            <h3 class="text-muted text-center">No hay <?php echo $textos["titulo_evento"];?></h3>
        </div>
<?php }?>