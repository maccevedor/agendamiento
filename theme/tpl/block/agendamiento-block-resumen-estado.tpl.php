<?php 	
	  global $base_url;	
	  $path = drupal_get_path('module', 'agendamiento');
	  require_once "$path/agendamiento.include";
	  $textos=_agendamiento_get_textos();
	  $list_estados=_agendamiento_get_estados();	
  		
	  //Se construye el array de objetos para la generacion de la grafica
	  //y se envia el objet a javascript	
	  $total=0;
	  foreach($datos as $dato){
		  $total=$total+(int)$dato["cantidad"];
	  }
	  
	  $i=0;
	  $porcentajes["estados"]=array();
	  foreach($datos as $dato){
		 $porcentajes["estados"][$i]["label"]=strtoupper($list_estados[$dato["estado_id"]]);//$dato["nombre"];
		 $porcentajes["estados"][$i]["data"]= round($dato["cantidad"] / $total * 100, 1);
		 $porcentajes["estados"][$i]["color"]= null;
		 $i++;
	  }
	  
	  drupal_add_js( array( 'datos_porcentajes' => $porcentajes ), 'setting' );

	  	
?>
<?php if(count($datos)>0){?>
		  
			<div> 

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#grafica" aria-controls="grafica" role="tab" data-toggle="tab">Grafica</a></li>
                <li role="presentation"><a href="#tabla" aria-controls="tabla" role="tab" data-toggle="tab">Tabla</a></li>
                
              </ul>
             
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="grafica">
                    <div id="grafica-estados"></div>
                </div>
                <div role="tabpanel" class="tab-pane " id="tabla">
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
                                    <td><?php echo strtoupper($list_estados[$dato["estado_id"]]); ?></td>
                                    <td><?php echo $dato["cantidad"];?></td>
                                </tr>
                            <?php }?>        
                        </tbody>
                    </table>
                </div>
                
              </div>
            
			</div> 
          
         
<?php }else{?>
		<div class="no-data">
            <div class="text-big text-center text-primary">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            </div>        
            <h3 class="text-muted text-center">No hay <?php echo $textos["titulo_evento"];?></h3>
        </div>
<?php }?>


<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo $path;?>/theme/js/flot2/jquery.flot.js"></script>
<script src="<?php echo $path;?>/theme/js/flot2/jquery.flot.pie.js"></script>
<script src="<?php echo $path;?>/theme/js/evento.js"></script> 

<script type="text/javascript">
	(function($){
		
		var DSA=Drupal.settings.datos_porcentajes;
		var data_estados=DSA.estados;
		 
		$.plot($("#grafica-estados"), data_estados, {
			series: {
				pie: {
					innerRadius: 0.5,
					show: true
				}
			},
			legend: {
				labelBoxBorderColor: "none"
			}
		});
	}(jQuery));
</script>