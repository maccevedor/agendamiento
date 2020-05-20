<?php 

$path = drupal_get_path('module', 'agendamiento');
global $base_url,$user;
$variables=_agendamiento_get_variables();

$textos=_agendamiento_get_textos();

$list_tipos_eventos=_agendamiento_get_tipos_evento();
$list_estados=_agendamiento_get_estados();
$list_tipos_documento=_agendamiento_get_tipos_documento();
$list_colores_estado=_agendamiento_get_color_estado();

$reagendamientos=0;
$reagendamientos=_agendamiento_get_reagendamientos_evento($datos[0]['agendamiento_id']);
$reagendamientos--; // se resta uno, porque el primero es la copia de la creación

$revisiones=_agendamiento_get_revisiones($datos[0]['agendamiento_id']);

//Campos del cliente

//Pais 
$pais_cliente="";
if(is_numeric($datos[0]['pais_cliente'])){
	$term = taxonomy_term_load($datos[0]['pais_cliente']);//									
	$pais_cliente=$term->name;
}

//Depto 
$depto_cliente="";
if(is_numeric($datos[0]['depto_cliente'])){
	$term = taxonomy_term_load($datos[0]['depto_cliente']);//									
	$depto_cliente=$term->name;
}


//Ciudad 
$ciudad_cliente="";
if(is_numeric($datos[0]['ciudad_cliente'])){
	$term = taxonomy_term_load($datos[0]['ciudad_cliente']);//									
	$ciudad_cliente=$term->name;
}


//Campos de la cita

//Especialidad 
$especialidad="";
if(is_numeric($datos[0]['especialidad_id'])){
	$term = taxonomy_term_load($datos[0]['especialidad_id']);//									
	$especialidad=trim(strtoupper($term->name));
}

//Pais 
$pais_cita="";
if(is_numeric($datos[0]['pais_cita'])){
	$term = taxonomy_term_load($datos[0]['pais_cita']);//									
	$pais_cita=$term->name;
}

//Depto 
$depto_cita="";
if(is_numeric($datos[0]['depto_cita'])){
	$term = taxonomy_term_load($datos[0]['depto_cita']);//									
	$depto_cita=$term->name;
}


//Ciudad 
$ciudad_cita="";
if(is_numeric($datos[0]['ciudad_cita'])){
	$term = taxonomy_term_load($datos[0]['ciudad_cita']);//									
	$ciudad_cita=$term->name;
}

//Ciudad 
$sede="";
if(is_numeric($datos[0]['sede_id'])){
	$term = taxonomy_term_load($datos[0]['sede_id']);//									
	$sede=$term->name;
}

//Especialista
$especialista="";
if(is_numeric($datos[0]['especialista_id'])){
	$user_data = user_load($datos[0]['especialista_id']);						
	$especialista=trim(strtoupper($user_data->field_alusno[LANGUAGE_NONE][0]["value"]))." ".trim(strtoupper($user_data->field_alusap[LANGUAGE_NONE][0]["value"]));
}

//Creador
$usuario_creo="";
if(is_numeric($datos[0]['usuario_creo_id'])){
	$user_data = user_load($datos[0]['usuario_creo_id']);						
	$usuario_creo=trim(strtoupper($user_data->field_alusno[LANGUAGE_NONE][0]["value"]))." ".trim(strtoupper($user_data->field_alusap[LANGUAGE_NONE][0]["value"]));
}

//Modificador
$usuario_actualizo="";
if(is_numeric($datos[0]['usuario_actualizo_id'])){
	$user_data = user_load($datos[0]['usuario_actualizo_id']);						
	$usuario_actualizo=trim(strtoupper($user_data->field_alusno[LANGUAGE_NONE][0]["value"]))." ".trim(strtoupper($user_data->field_alusap[LANGUAGE_NONE][0]["value"]));
}


//Motivo cita 
$motivo_cita="";
if(is_numeric($datos[0]['motivo_cita_id'])){
	$term = taxonomy_term_load($datos[0]['motivo_cita_id']);//									
	$motivo_cita=trim(strtoupper($term->name));
}

//Medio atencion 
$medio_atencion="";
$medios=taxonomy_get_tree(596);
$codigo_id=0;
foreach($medios as $medio){
	$term = taxonomy_term_load($medio->tid);
	if(isset($term->field_agmacd[LANGUAGE_NONE])){
		$codigo_id=$term->field_agmacd[LANGUAGE_NONE][0]["value"];	
		if($datos[0]['medio_atencion_id']==$codigo_id){
			$medio_atencion=$term->name;
			continue;
		}
	}
}


if($reagendamientos==0){
	$color_estado=$list_colores_estado[$datos[0]['estado_cita']];
	$nombre_estado=$list_estados[$datos[0]['estado_cita']];
}else{
	if($reagendamientos==1){$veces="vez";}else{$veces="veces";}
	$color_estado=$list_colores_estado[6];//Se define como REAGENDADA, aunque siga siendo ACTIVA
	$nombre_estado=$list_estados[$datos[0]['estado_cita']]." pero ha sido ".$list_estados[6]." ".$reagendamientos." ".$veces;
}
?>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $base_url;?>/<?php echo $path;?>/theme/css/agendamiento.css">
		
                    <div class="contenedor">
                    <div class="container-fluid"> 
                        
                        <div class="panel panel-<?php echo $color_estado;?>">
                        		<div class="panel-heading"><strong><?php echo $textos["label_evento"];?></strong> se encuentra en estado <strong><?php echo $nombre_estado;?></strong></div>
                        </div> 
                                           
                      
                        <div>             
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#cita" aria-controls="cita" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Datos de <?php echo $textos["nombre_evento"];?></a></li>
                            <li role="presentation"><a href="#cliente" aria-controls="cliente" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Datos del Cliente</a></li> 
                            <li role="presentation"><a href="#control" aria-controls="control" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Datos de Control</a></li> 
                            <li role="presentation"><a href="#ayuda" aria-controls="ayuda" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ayuda</a></li>                
                          </ul>
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="cita">
                                <div class="wrapper-cita">
                                                                                                         
                                    <h3></h3>
                                    <div class="row">                          
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Código</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static text-danger"><strong><?php echo $datos[0]['codigo'];?></strong></p></div>                                         
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Medio atención</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $medio_atencion;?></p></div>
                                    </div>                                    
                                    
                                    <div class="row">                          
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Especialidad</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $especialidad;?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Especialista</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $especialista;?></p></div>
                                    </div>
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Fecha Inicio</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['fecha_inicial'];?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Fecha Fin</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['fecha_final'];?></p></div>
                                    </div>  
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Pais</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $pais_cita;?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Departamento</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $depto_cita;?></p></div>
                                    </div> 
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Ciudad</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $ciudad_cita;?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Sede</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $sede;?></p></div>
                                    </div>                                     
                                   
                                    <div class="row">
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Motivo cita</label></div>
                                         <div class="col-xs-12 col-sm-10 col-md-10"><p class="form-control-static"><?php echo $motivo_cita;?></p></div>
                                    </div> 
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Asunto</label></div>
                                         <div class="col-xs-12 col-sm-10 col-md-10"><p class="form-control-static"><?php echo $datos[0]['asunto'];?></p></div>
                                    </div> 
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Descripción</label></div>
                                         <div class="col-xs-12 col-sm-10 col-md-10"><p class="form-control-static text-justify"><?php echo $datos[0]['descripcion'];?></p></div>
                                    </div>
                                    
                                </div><!--Datos de la cita-->    
                            </div><!-- Fin tab cita-->
                            
                            <div role="tabpanel" class="tab-pane " id="cliente">
                                <div class="wrapper-cliente"> 
                                    <h3></h3>
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">T.Doc</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $list_tipos_documento[$datos[0]['tipo_documento_id']];?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Documento</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['numero_documento'];?></p></div>
                                    </div>
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Nombres</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['nombre'];?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Apellidos</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['apellido'];?></p></div>
                                    </div>  
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Tel.Fijo</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['telefono'];?> Ext. <?php echo $datos[0]['extension'];?></p> </div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Tel.Celular</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['celular'];?></p></div>
                                    </div> 
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">F.Nacimiento</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['fecha_nacimiento'];?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Email</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['email'];?></p></div>
                                    </div> 
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Pais</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $pais_cliente;?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Departamento</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $depto_cliente;?></p></div>
                                    </div> 
                                    
                                    <div class="row">                            
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Ciudad</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $ciudad_cliente;?></p></div>
                                         <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Dirección</label></div>
                                         <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $datos[0]['direccion'];?></p></div>
                                    </div> 
                                 
                        		</div><!--Datos de la cliente-->
                            </div><!-- Fin tab cliente--> 
                            
                            <div role="tabpanel" class="tab-pane" id="control">
                                <div class="wrapper-control">
                                    <h3></h3>
                                    <div class="row">                          
                                         <div class="col-xs-12 col-sm-4 col-md-4"><label class="control-label">Fecha creación</label></div>
                                         <div class="col-xs-12 col-sm-8 col-md-8"><p class="form-control-static"><?php echo $datos[0]['fecha_registro'];?></p></div> 
                                    </div>
                                    <div class="row">      
                                         <div class="col-xs-12 col-sm-4 col-md-4"><label class="control-label">Fecha modificación</label></div>
                                         <div class="col-xs-12 col-sm-8 col-md-8"><p class="form-control-static"><?php echo $datos[0]['fecha_modificacion'];?></p></div>
                                    </div>
                                    <div class="row">     
                                         <div class="col-xs-12 col-sm-4 col-md-4"><label class="control-label">Usuario creador</label></div>
                                         <div class="col-xs-12 col-sm-8 col-md-8"><p class="form-control-static"><?php echo $usuario_creo;?></p></div>                                        
                                    </div> 
                                    
                                    <div class="row">     
                                         <div class="col-xs-12 col-sm-4 col-md-4"><label class="control-label">Usuario que la modifico</label></div>
                                         <div class="col-xs-12 col-sm-8 col-md-8"><p class="form-control-static"><?php echo $usuario_actualizo;?></p></div>
                                    </div>
                                    <h2>Historico</h2>
                                    
                                    <table class="table">
                                    	<thead>
                                        	<tr>
                                           		<td class="col-md-3">Fecha registro</td>
                                               <td class="col-md-3">Fecha evento</td>
                                               <td class="col-md-1">Estado</td>
                                               <td class="col-md-5">Observación</td> 
                                           </tr>
                                        </thead>
                                        <tbody>
                                        	<?php foreach($revisiones as $revision){?>
                                            <tr>
                                           		<td><?php echo $revision["fecha_modificacion"];?></td>
                                                <td><?php echo $revision["fecha_inicial"];?></td>
                                               <td><?php echo $list_estados[$revision["estado_cita"]];?></td>
                                               <td class="text-justify"><?php echo $revision["descripcion"];?></td> 
                                           </tr>
                                           <?php }?>
                                         
                                        </tbody>
                                    </table>
                                </div><!--Datos de control-->    
                            </div><!-- Fin tab control-->
                            
                            <div role="tabpanel" class="tab-pane" id="ayuda">
                                <div class="wrapper-ayuda">
                                    <h3></h3>
                                    <p>Los colores representan el estado de la <?php echo strtolower($textos["nombre_evento"]);?> al igual que los botones de cada acción, a continuación se describe los posibles estados con su correspondiente color asociado.</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-info btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> ACTIVA</strong></button>
                                        </div> <!--col-->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-success btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> ATENDIDA</strong></button>
                                        </div> <!--col-->
                                 	</div>
                                    <p>&nbsp;</p>
                                    <div class="row">       
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-warning btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> NO ATENDIDA </strong></button>
                                        </div> <!--col-->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-primary btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> REAGENDADA</strong></button>
                                        </div> <!--col-->
                                   	</div><!--row-->
                                    <p>&nbsp;</p>
                                    <div class="row">       
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-inverse btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> CANCELADA</strong></button>
                                        </div> <!--col-->
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <button type="button" class="btn btn-danger btn-lg btn-block"><strong><?php echo strtoupper($textos["nombre_evento"]);?> ANULADA</strong></button>
                                        </div> <!--col-->
                                   	</div><!--row--> 
                                    <div class="recomendaciones-evento">
                                        <h2>Recomendaciones</h2>
                                        <ul>
                                            <li>Solo los usuarios con el permiso de <em>Atender</em> podrán cambiar una <?php echo strtolower($textos["nombre_evento"]);?> a estado <button type="button" class="btn btn-success btn-sm">ATENDIDA</button></li>
                                            <li>Solo los usuarios con el permiso de <em>No Atender</em> podrán cambiar una <?php echo strtolower($textos["nombre_evento"]);?> a estado <button type="button" class="btn btn-warning btn-sm">NO ATENDIDA</button></li>
                                            <li>Solo los usuarios con el permiso de <em>Anular</em> podrán cambiar una <?php echo strtolower($textos["nombre_evento"]);?> a estado <button type="button" class="btn btn-danger btn-sm">ANULADA</button></li>
                                            <li>Solo los usuarios con el permiso de <em>Cancelar</em> podrán cambiar una <?php echo strtolower($textos["nombre_evento"]);?> a estado <button type="button" class="btn btn-inverse btn-sm">CANCELADA</button></li>
                                            <li>Solo los usuarios con el permiso de <em>Reagendar</em> podrán reagendar una <?php echo strtolower($textos["nombre_evento"]);?></li>
                                            <li>Una <?php echo strtolower($textos["nombre_evento"]);?> puede ser reagendada hasta <strong class="text-danger"><?php echo $variables["maximo_reagendamientos"];?></strong> veces.</li>
                                            <li>Las <?php echo strtolower($textos["titulo_evento"]);?> reagendadas se ven en el calendario como <button type="button" class="btn btn-info btn-sm">ACTIVAS</button> sin embargo, en el detalle de la cita se ven como <button type="button" class="btn btn-primary btn-sm">REAGENDADAS</button></li>
												 <li>Solo se puede cambiar de estado una <?php echo strtolower($textos["nombre_evento"]);?> en estado <button type="button" class="btn btn-info btn-sm">ACTIVA</button> ó en estado <button type="button" class="btn btn-primary btn-sm">REAGENDADA</button> </li>	
                                            <li>Las <?php echo strtolower($textos["titulo_evento"]);?> solo deben ser <button type="button" class="btn btn-inverse btn-sm">CANCELADAS</button> si el cliente lo solicita, en caso que haya quedado mal creada, o no se desee tener la <?php echo strtolower($textos["nombre_evento"]);?> se debe usar la opción de <button type="button" class="btn btn-danger btn-sm">ANULAR</button>  </li>                                             	
                                        </ul> 
                                    </div>           
                                </div><!--Datos de ayuda-->    
                            </div><!-- Fin tab ayuda-->
                                           
                          </div><!-- Fin tab content-->                        
                        </div> <!-- Fin div tabs-->
                    </div><!--fin container fluid-->    
                </div><!--fin contenedor-->     		
       
                <div class="modal-footer">
					  <?php if(user_access("no atender evento") && $datos[0]['estado_cita']==1){?> <button type="button" class="btn btn-warning boton-estado" value="3|<?php echo $textos["no_atendido"];?>"><?php echo $textos["noatender_evento"];?></button><?php }?>
                    <?php if(user_access("atender evento") && $datos[0]['estado_cita']==1){?>  <button type="button" class="btn btn-success boton-estado" value="2|<?php echo $textos["atendido"];?>" ><?php echo $textos["atender_evento"];?></button><?php }?>
                    <?php if(user_access("reagendar evento") && $datos[0]['estado_cita']==1 && $reagendamientos<$variables["maximo_reagendamientos"]){?><button type="button" class="btn btn-primary boton-reagenda"><?php echo $textos["reagendar_evento"];?></button><?php }?>
                    <?php if(user_access("cancelar evento") && $datos[0]['estado_cita']==1){?> <button type="button" class="btn btn-muted boton-estado" value="4|<?php echo $textos["cancelado"];?>"><?php echo $textos["cancelar_evento"];?></button><?php }?>
                    <?php if(user_access("anular evento") && $datos[0]['estado_cita']==1){?>   <button type="button" class="btn btn-danger boton-estado" value="5|<?php echo $textos["anulado"];?>"><?php echo $textos["anular_evento"];?></button><?php }?>   	                    
                </div>   
     			            
        <!-- modal-atender-evento: atiende el evento -->
        <form id="form-evento" name="form_evento"> 
        <div id="modal-evento" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">   
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Atender</h4>
                    </div><!-- /.modal-header -->
                    <div class="modal-body">
                        <p>Escriba una observación para registrar la cita como <strong><span id="estado_text"></span></strong>, esto es importante para el historial del cliente.</p>
                        <div class="form-group">
                            <label for="observacion" class="col-sm-2 control-label">Observación</label>
                            <textarea id="observacion" name="observacion" class="form-control required" rows="6" maxlength="480"></textarea>
                            <span id="count_message"></span>
                        </div><!-- /.form-group -->  
                        
                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default" id="btnAtenderCancel">Cerrar</button>
                        <button type="submit" id="submit" class="btn btn-primary">Guardar observación</button>
                        <input type="hidden"  id="estado_id" name="estado_id" value="0">
                        <input type="hidden"  id="agendamiento_id" name="agendamiento_id" value="<?php echo $datos[0]["agendamiento_id"];?>">
                    </div><!-- /.modal-footer -->
                </div><!-- /.modal-content -->               
            </div><!-- /.modal-dialog -->    
        </div><!-- /.modal -->      
         </form><!-- /.form --> 
         
         
        <!-- modal-evento-reagenda-->
        <div id="modal-evento-reagenda" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">   
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Reagendar</h4>
                    </div><!-- /.modal-header -->
                    <div class="modal-body">
                        <p>Esta a punto de <strong><?php echo $textos["label_reagendar"];?></strong>, tenga presente que este proceso solo permite cambiar los siguientes datos:</p>
                         <ul>
                         		<li>Sede</li>
                             <li>Especialista (siempre y cuando no sea automatico)</li>
                             <li>Fecha y Hora</li>
                             <li>Medio de atención</li>
                         </ul> 
                      <p> En caso que sea necesario cambiar algun otro dato, debe proceder a la cancelación, y posteriormente <?php echo $textos["label_posterior"];?>.</p>    
                        
                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default" id="btnAtenderCancel">Cerrar</button>
                        <button type="button" id="enviar-reagendar" class="btn btn-primary">Entendido, quiero reagendar</button>
                    </div><!-- /.modal-footer -->
                </div><!-- /.modal-content -->               
            </div><!-- /.modal-dialog -->    
        </div><!-- /.modal -->      
               
            
 
          
            

<link rel="stylesheet" href="<?php echo $base_url;?>/<?php echo drupal_get_path('theme', 'bootstrap');?>/css/overrides.css">
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/underscore-min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/jquery.validate.min.js"></script>

<script type="text/javascript">
	(function($){	

			 //--------------------------------------------------------------------------------------------------
			 //				FUNCIONES DE FORMULARIO
			 //--------------------------------------------------------------------------------------------------		
	   		$.validator.messages.required = "";
			$("#form-evento").validate({
				invalidHandler: function(e, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						var message = errors == 1
							? 'Hace falta un campo por ser diligenciado o corregido, se ha demarcado el campo en rojo para su revisión'
							: 'Le hacen falta ' + errors + ' campos por diligenciar o corregir. se han demarcado en rojo para su revisión';
						$("div.error span").html(message);
						$("div.error").show();
					} else {
						$("div.error").hide();
					}
				},		
				// the errorPlacement has to take the table layout into account 
				errorPlacement: function(error, element) { 
				   
					if ( element.is(":radio") )
						error.appendTo( element.parent().parent().parent().parent() ); 
					else if ( element.is(":checkbox") )
						error.appendTo ( element.parent()); 
					else
						error.appendTo( element.parent()); 
								
				},
				onkeyup: false,
				submitHandler: function() {
					event.preventDefault();
					$("div.error").hide();	
					
					enviarInformacion();							
				},
				rules: {								
					"observacion":{minlength: 10,maxlength: 480,required: true},
				},
				messages: { 					
					"observacion":"Obligatorio, Mínimo debe ingresar 10 caracteres",				
				},
				debug:true
			});
	   
	   	//--------------------------------------------------------------------------------------------------
		//				FUNCIONES DE CAMBIO DE ESTADO
		//--------------------------------------------------------------------------------------------------
	   
	    var spinner=function(obj){
				obj.parent().append( "Procesando.." );
				obj.hide();	
			};
	   
	    var enviarInformacion=function(){
				var datastring = $("#form-evento").serialize(); 
				spinner($("#submit"));
				jQuery.ajax({
					url: '<?php echo $base_url;?>/agendamiento/calendario/evento/cambia-estado',
					data: datastring,
					type: 'POST',
					dataType: 'json',
					success: function(data){																	
						if(data[0].status==1){
							$('#modal-evento').modal('hide');
							document.location.reload();
						}
						
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
	   
	   $('#modal-evento').on('shown.bs.modal', function () {			
			$('#observacion').focus();
	   })
	   
	   var asignarEstado=function(obj){
		  	var estado=obj.val().split('|');
			$("#estado_id").val(estado[0]);
			$("#estado_text").html(estado[1]); 
	   };
	   
	   $('.boton-estado').click(function(e){
			e.preventDefault();
			e.stopPropagation();
			
			asignarEstado($(this));
			
			$('#modal-evento').modal({
				show:true,
				backdrop: 'static', 
				keyboard: false
			});
	   });  
	   
	   
	  $('.boton-reagenda').click(function(e){
			e.preventDefault();
			e.stopPropagation();
			
			$('#modal-evento-reagenda').modal({
				show:true,
				backdrop: 'static', 
				keyboard: false
			});

	   });  

	   $('#enviar-reagendar').click(function(e){
			e.preventDefault();
			e.stopPropagation();
			
			var id=$("#agendamiento_id").val();
			var url='<?php echo $base_url;?>/agendamiento/calendario/reagendar/'+id;
			parent.location.href=url;
	   });  
	   
	   
	    var text_max = 480;
		$('#count_message').html(text_max + ' restantes');
		$('#observacion').keyup(function(e) {
		  var text_length = $('#observacion').val().length;
		  var text_remaining = text_max - text_length;
		  $('#count_message').html(text_remaining + ' restantes');
		});
			   
   	
	}(jQuery));
</script>