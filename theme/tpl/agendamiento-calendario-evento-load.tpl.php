<?php 

$path = drupal_get_path('module', 'agendamiento');
global $base_url,$user;
$variables=_agendamiento_get_variables();

$textos=_agendamiento_get_textos();

$list_tipos_eventos=_agendamiento_get_tipos_evento();
$list_estados=_agendamiento_get_estados();
$list_tipos_documento=_agendamiento_get_tipos_documento();

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
	$especialista=trim(strtoupper($user_data->field_alusno[LANGUAGE_NONE][0]["value"]));
}

?>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $base_url;?>/<?php echo $path;?>/theme/css/agendamiento.css">
		
 <!--ventana modal para el calendario-->
<div class="modal fade" id="events-modal-load">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $textos["nombre_evento"]?></h4>
            </div>
            <div class="modal-body" style="height: 600px">
					<div class="contenedor">
                    <div class="container-fluid"> 
                        <div class="alert alert-info" role="alert">El tipo de <strong><?php echo $textos["nombre_evento"];?></strong> esta representado por su color distintivo.</div>            
                        <div class="wrapper-cliente"> 
                            <h3>Datos Cliente</h3>
                             <!--Datos cliente-->
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
                        </div>
                        <!--Datos de la cliente-->
                        <hr>                
                        <div class="wrapper-cita <?php echo $datos[0]['tipo_evento'];?>">
                                <h3><?php echo $textos["titulo_datos_evento"];?> <span class="text-info"><strong>#<?php echo $datos[0]['codigo'];?></strong></span></h3>
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
                                 <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Tipo</label></div>
                                 <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><span class="<?php echo $datos[0]['tipo_evento'];?>"><?php echo $list_tipos_eventos[$datos[0]['tipo_evento']];?></span></p></div>
                                 <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Estado</label></div>
                                 <div class="col-xs-12 col-sm-4 col-md-4"><p class="form-control-static"><?php echo $list_estados[$datos[0]['estado_cita']];?></p></div>
                            </div> 
                            
                            <div class="row">                            
                                 <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Asunto</label></div>
                                 <div class="col-xs-12 col-sm-10 col-md-10"><p class="form-control-static"><?php echo $datos[0]['asunto'];?></p></div>
                            </div> 
                            <div class="row">                            
                                 <div class="col-xs-12 col-sm-2 col-md-2"><label class="control-label">Descripción</label></div>
                                 <div class="col-xs-12 col-sm-10 col-md-10"><p class="form-control-static"><?php echo $datos[0]['descripcion'];?></p></div>
                            </div>
                        </div>
                        <!--Datos de la cita-->    
                    </div> 
                    <!--fin container fluid-->    
                </div>
                <!--fin contenedor-->
            </div>
            <!--fin content modal-->
            <div class="modal-footer">
                <?php if(user_access("no atender evento")){?><button type="button" class="btn btn-warning" data-dismiss="modal">No Atender</button><?php }?>
                <?php if(user_access("atender evento")){?><button type="button" class="btn btn-success" data-dismiss="modal">Atender</button><?php }?>
                <?php if(user_access("reagendar evento")){?><button type="button" class="btn btn-info" data-dismiss="modal">Reagendar</button><?php }?>
                <?php if(user_access("cancelar evento")){?><button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button><?php }?>
                <?php if(user_access("anular evento")){?><button type="button" class="btn btn-danger" data-dismiss="modal">Anular</button><?php }?>   	
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog --> 
</div><!-- /.modal -->   
    
        
    
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/underscore-min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>    