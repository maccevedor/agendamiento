<?php 

$path = drupal_get_path('module', 'agendamiento');
global $base_url;
$variables=_agendamiento_get_variables();
$textos=_agendamiento_get_textos();

?>

<div class="contenedor">
	<div class="row">
    	<div class="col-xs-11 col-sm-11 col-md-11">
    		<div class="container-fluid">
				
                <ul class="nav nav-tabs">
                  <li role="presentation"><a href="<?php echo $base_url;?>/agendamiento/calendario">Calendario</a></li>
                    <?php if($variables["es_especialista"]==0){?>
                  		<li role="presentation"  class="active"><a href="<?php echo $base_url;?>/agendamiento/calendario/nuevo"><?php echo $textos["nuevo_evento"]?></a></li>
                	<?php }?>
                    <li role="presentation" ><a href="<?php echo $base_url;?>/agendamiento/calendario/consulta">Consultar <?php echo $textos["titulo_evento"]?></a></li>
                </ul>
                
                              
                <!--Inicio de formulario-->
                <div class="wrapper-form">
                    
                    <div class="alert alert-info" role="alert">
                    	Seleccione y complete todos los campos necesarios para la creación <?php echo $textos["mensaje_evento"];?>, el sistema le ira guiando con la información disponible, y solo le permitira la seleccion de la información real, de la misma forma, le sugerirá los valores por defecto que se encuentren, para que no tenga que perder tiempo seleccionando información.
                    </div>
                    
                    <!--Fila 1-->
                    <div class="row">
                     		<div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["especialidad"]);?> <div class="bloqueo"></div>  </div>
                     </div>
                    <!--Fila 2-->
                    <div class="row">        
                            <?php //se valida si se debe mostrar el pais para la captura, o si es automatico y solo se muestra el departamento								  	
							      if($variables["muestra_pais"]==0 || $variables["muestra_pais"]=="_none"){?>
                            		<div class="col-xs-12 col-sm-6 col-md-2"><?php print drupal_render($form["datos_evento"]["pais"]);?> <div class="bloqueo"></div></div>
                            		<div class="col-xs-12 col-sm-6 col-md-2"><?php print drupal_render($form["datos_evento"]["depto"]);?> <div class="bloqueo"></div></div>
                            <?php }else{?>
                            		<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="oculto">	
											<?php print drupal_render($form["datos_evento"]["pais"]);?><div class="bloqueo"></div>
                                        </div>    
										<?php print drupal_render($form["datos_evento"]["depto"]);?><div class="bloqueo"></div> </div>
                            <?php }?>
                            
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["ciudad"]);?> <div class="bloqueo"></div> </div>
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["sede"]);?> <div class="bloqueo"></div> </div>                            
                    </div>
                    <!--Fila 3-->
                    <div class="row">                            
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["especialista"]);?> <div class="bloqueo"></div> </div>                    
                             
                            <?php //Indica que no se usa la "fecha hasta", el evento toma el tiempo minimo de evento, y no muestra la fecha desde 
								  //basicamente lo que se hace es poner un div contendor con la clase oculto, de esta forma no mostrara la fecha hasta
								  //pero seguira presente en el formulario, para efectos de la aplicacion 
								  if($variables["habilita_fecha_hasta"]==0){?> 
                            		<div class="col-xs-6 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["fecha_desde"]);?> <div class="bloqueo"></div> 
                                    	<div class="oculto">
                                        	<?php print drupal_render($form["datos_evento"]["fecha_hasta"]);?> <div class="bloqueo"></div> 
                                        </div>    
                                    </div>
                                  <?php }else{?>  
                                  	<div class="col-xs-6 col-sm-4 col-md-2"><?php print drupal_render($form["datos_evento"]["fecha_desde"]);?> <div class="bloqueo"></div>  </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2"><?php print drupal_render($form["datos_evento"]["fecha_hasta"]);?> <div class="bloqueo"></div>  </div>                           	
                           <?php }?>                                                                              
                           <div class="col-xs-6 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["medio_atencion"]);?></div>                           
                                <div class="oculto">
									<?php print drupal_render($form["datos_evento"]["estado"]);?> 
                                    <?php print drupal_render($form["datos_basicos"]["cliente"]);?>     
                                </div>
                           </div>
                    </div> 
                    
                    <!-- Fila 4 -->
                    <div class="row"> 
                            <div class="col-xs-12 col-sm-8 col-md-8"><?php print drupal_render($form["datos_evento"]["asunto"]);?></div>
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_evento"]["motivo_cita"]);?></div>
                    </div>
                    
                    <!-- Fila 4 -->
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-12 col-md-12"><?php print drupal_render($form["datos_evento"]["descripcion"]);?></div>
                    </div> 
                    
                    <!-- Fila 4 -->
                    <div class="row"> 
                          	<div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["numero_documento"]);?></div>
                            <div class="col-xs-12 col-sm-4 col-md-8"><p class="text-justify">Ingrese el # documento del cliente, el sistema buscará información relacionada con este número, si se encuentra información del cliente se la completará, en caso contrario deberá ser diligenciada</p></div>
                    </div>
                    <div class="row">         
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["tipo_documento"]);?></div>
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["nombres_cliente"]);?></div>
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["apellidos_cliente"]);?></div>
                    </div> 
                    <!-- Fila 4 -->
                    <div class="row"> 
                    		<div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["telefono_fijo"]);?></div>
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["extension_fijo"]);?></div>   
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["telefono_celular"]);?></div>
                    </div>
                    <div class="row">         
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["fecha_nacimiento"]);?></div>                         
                            <div class="col-xs-12 col-sm-4 col-md-8"><?php print drupal_render($form["datos_basicos"]["correo_electronico"]);?></div>                         
                    </div>
                    <!-- Fila 5 -->
                    <div class="row"> 
                            <?php //se valida si se debe mostrar el pais para la captura, o si es automatico y solo se muestra el departamento								  	
							      if($variables["muestra_pais"]==0 || $variables["muestra_pais"]=="_none"){?>
                            		<div class="col-xs-12 col-sm-6 col-md-2"><?php print drupal_render($form["datos_basicos"]["pais_cliente"]);?> </div>
                            		<div class="col-xs-12 col-sm-6 col-md-2"><?php print drupal_render($form["datos_basicos"]["depto_cliente"]);?> </div>
                            <?php }else{?>
                            		<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="oculto">	
											<?php print drupal_render($form["datos_basicos"]["pais_cliente"]);?>
                                        </div>    
										<?php print drupal_render($form["datos_basicos"]["depto_cliente"]);?> </div>
                            <?php }?>
                            
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["ciudad_cliente"]);?></div> 
                            <div class="col-xs-12 col-sm-4 col-md-4"><?php print drupal_render($form["datos_basicos"]["direccion"]);?></div> 
                    </div> 
                	  
                    <div class="row">
                    		<div class="col-xs-12 col-sm-12 col-md-12">
                            	<div class="pull-right">
                            		<?php print drupal_render($form["datos_basicos"]["enviar"]);?>
								</div>
                          </div>	
                    </div>   
                    	   
                    <div class="modal fade" tabindex="-1" role="dialog" id="modal-final">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Mensaje</h4>
                          </div>
                          <div class="modal-body">                           
                           
                             
                          </div> 
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
                    
                    
                    <div class="modal fade" tabindex="-1" role="dialog" id="dialog-message">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Mensaje</h4>
                          </div>
                          <div class="modal-body">
                             
                          </div> 
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->   
                    
                    
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
                        
                        
                        
                        
                        
                        
                        </div>
                    </div>
                    <!--Fin column-->
                       
                       	
                </div>
                <!--Fin de formulario-->
				<?php print drupal_render_children($form);?>				
			</div>
    	</div><!--Fin de contenedor -->
		<div class="col-xs-1 col-sm-1 col-md-1">&nbsp;</div>    
	</div>
</div>

 	<script type="text/javascript">
		(function($){
			 // se define la variable que trae la configuracion para la personalizacion del calendario,
			 var DSA=Drupal.settings.agendamiento_vars;	
			 var text_max = 480;
			 //--------------------------------------------------------------------------------------------------
			 //				FUNCIONES DE FORMULARIO
			 //--------------------------------------------------------------------------------------------------
			 
			 
			 var ocultaDependenciasEspecialista=function(){
				$("#edit-fecha-desde").parent().hide();
				$("#edit-fecha-hasta").parent().hide();
				$("#edit-medio-atencion")	.parent().hide();
				$("#edit-tipo-evento").parent().hide();				
			};
			
			var mostrarDependenciasEspecialista=function(){
				$("#edit-fecha-desde").parent().show();
				$("#edit-fecha-hasta").parent().show();
				$("#edit-medio-atencion")	.parent().show();
				$("#edit-tipo-evento").parent().show();				
			}; 
			 
			 //se esconden los campos, que dependen directamente del especialista, para que solo sean 
			 //mostrados cuando se seleccione el especialista
			 ocultaDependenciasEspecialista();
			 
			 
			 var validarDisponibilidadEspecialista=function(numero_documento){
				var datastring = $("#agendamiento-node-form").serialize(); 
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/nuevo/validar',
					data: datastring,
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							if(data.existe==0){
								enviarInformacion();
							}else{
								$('#dialog-message .modal-body').html(data.msj);								
								$('#dialog-message').modal('show'); 
							}
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			 
			 var enviarInformacion=function(){
				
				$("#edit-enviar").parent().append( '<button type="submit" id="edit-spinner" class="btn btn-default">Procesando..</button>');
				$("#edit-enviar").hide();
				var datastring = $("#agendamiento-node-form").serialize(); 
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/nuevo/guardar',
					data: datastring,
					type: 'POST',
					dataType: 'json',
					success: function(data){																	
						
						$("#edit-spinner").html("Proceso terminado.");
						$('#modal-final .modal-body').html(data[0].html);
						$('#modal-final').modal('show');
						
						
						/*$("#edit-enviar").show(); */
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			 
	
			$.validator.addMethod("defaultInvalid", function(value, element) 
				{
						 switch (element.value){
							  case "_none":
								   if (element.name == "_none"){
									  return false;
								   }
							  break;
							  case "0":
								   if (element.name == "0"){
									  return false;
								   }
							  break;
							  default:
									return true;	  
									break;
						 }
					 
				});
			 
			$.validator.addMethod("onlyCharacter", function(value, element) 
				{
					return this.optional(element) || /^[a-zA-Z\s áéíóúAÉÍÓÚÑñ]+$/.test( value );
				});
				
			$.validator.addMethod("onlyDecimal", function(value, element) 
				{
					return this.optional(element) || /^[0-9\s .]+$/.test( value );
				});	
			
			$.validator.messages.required = "";
			$("#agendamiento-node-form").validate({
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
								
					validarDisponibilidadEspecialista();
					/*if(!validacionExtra()){			 
					  return false;
					}else{
						console.log("enviar");
						//ocultar_boton_submit(jQuery("#edit-submit"));
						//document.pqr_node_form.submit();
					}*/
				},
				rules: {			
					//datos cita
					"especialidad":"required defaultInvalid",
					"pais":"required defaultInvalid",
					"depto":"required defaultInvalid",
					"ciudad":"required defaultInvalid",
					"sede":"required defaultInvalid",
					"especialista":"required defaultInvalid",
					"fecha_desde":"required",
					"fecha_hasta":"required",
					"tipo_evento":"required defaultInvalid",
                  "medio_atencion":"required defaultInvalid",
					"asunto":{	minlength: 3,maxlength: 50,required: true},
					"motivo_cita":"required defaultInvalid",
					"descripcion":{	minlength: 3,maxlength: 500},
					//datos cliente
					"numero_documento":{minlength: 3,maxlength: 15,required: true},
					"tipo_documento":"required defaultInvalid",
					"nombres_cliente":{	minlength: 3,maxlength: 30,required: true},
					"apellidos_cliente":{minlength: 3,maxlength: 30,required: true},
					"telefono_fijo":{required:true, digits:true, rangelength:[7, 7]},
					"extension_fijo":{digits:true, maxlength: 5 },
					"telefono_celular":{required:true, digits:true, rangelength:[10, 10]},
					"fecha_nacimiento":"required",
					"correo_electronico":{required:true, email:true},
					"pais_cliente":"required defaultInvalid",
					"depto_cliente":"required defaultInvalid",
					"ciudad_cliente":"required defaultInvalid",
					"direccion":{minlength: 3,maxlength: 50,required: true},
					
											
				},
				messages: { 
					"especialidad":"Obligatorio",
					"pais":"Obligatorio",
					"depto":"Obligatorio",
					"ciudad":"Obligatorio",
					"sede":"Obligatorio",
					"especialista":"Obligatorio",
					"fecha_desde":"Obligatorio",
					"fecha_hasta":"Obligatorio",
					"tipo_evento":"Obligatorio",
                  "medio_atencion":"Obligatorio",
					"asunto":'Obligatorio',
					"motivo_cita":"Obligatorio",
					"descripcion":"Obligatorio, Entre 3 y 500 letras",
					//datos cliente
					"numero_documento":"Obligatorio",
					"tipo_documento":"Obligatorio",
					"nombres_cliente":"Obligatorio, Entre 3 y 30 letras",
					"apellidos_cliente":"Obligatorio, Entre 3 y 30 letras",
					"telefono_fijo":"7 digitos ",
					"extension_fijo":"Númerico",
					"telefono_celular":"10 digitos",
					"fecha_nacimiento":"Obligatorio",
					"correo_electronico":"Obligatorio, debe ser válido Ej: correo@dominio.",
					"pais_cliente":"Obligatorio",
					"depto_cliente":"Obligatorio",
					"ciudad_cliente":"Obligatorio",
					"direccion":"Obligatorio, Entre 3 y 30 letras",					
				},
				debug:true
			});
			
			$('#nuevo-evento-base').on("click",function(){
				$('#modal-final').modal('hide');	
			}); 
			 
			$('#modal-final').on('hidden.bs.modal', function (e) { 
			  
			  /*$('#modal-final .modal-body').html("");
			  jQuery("#agendamiento-node-form input.form-text").val("");
			  jQuery("#agendamiento-node-form select.form-select").val("_none"); 
			  jQuery("#agendamiento-node-form textarea.form-textarea").val(""); */
			  
			  if(DSA.hora_exacta==1){ 
			  		document.location.href=Drupal.settings.base_url +'/agendamiento/calendario';
			  }else{
				 document.location.reload(); 
			  }
			});
			
			/*Convierte el texto digitado a mayusculas excepto para los correos y solo 
			 aplica para los campos del cliente*/ 
			jQuery("#agendamiento-node-form input.form-text").keyup(function(event){
				id=jQuery(this).attr("id");				
				if((id!="edit-correo-electronico")){
					jQuery(this).val(jQuery(this).val().toUpperCase());			
				}else{
					jQuery(this).val(jQuery(this).val().toLowerCase());	
				}		
				
			});
			
			$('#edit-descripcion').attr('maxlength',480); 
			$('#edit-descripcion').parent().append('<span id="count_message"></span>');
			/*Validacion de descripcion*/
			$('#count_message').html(text_max + ' restantes');
			$('#edit-descripcion').keyup(function(e) {
			  var text_length = $('#edit-descripcion').val().length;
			  var text_remaining = text_max - text_length;
			  $('#count_message').html(text_remaining + ' restantes');
			});
			
			
			//Valida que los campos indicados solo acepten numeros
			jQuery("#edit-numero-documento").keydown(function(event) {
				permitir_numeros_letras_simbolos(event);
			});
			
			//Valida que los campos indicados solo acepten numeros
			jQuery("#edit-telefono-fijo").keydown(function(event) {
				permitir_solo_numeros(event);
			});
			
			//Valida que los campos indicados solo acepten numeros
			jQuery("#edit-telefono-celular").keydown(function(event) {
				permitir_solo_numeros(event);
			});
			
						//Valida que los campos indicados solo acepten numeros
			jQuery("#edit-extension-fijo").keydown(function(event) {
				permitir_solo_numeros(event);
			});			
			  
			//---------------------------------------------------------------------------------------------------
			//				FUNCIONALES DE ESPECIALIDAD
			//---------------------------------------------------------------------------------------------------
			
			var obtenerJerarquiaEspecialidad=function(id){
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/jerarquia',
					data: {'id_especialidad':+id},
					type: 'POST',
					dataType: 'json',
					success: function(data){																	
							cargarDefault("#edit-pais");
							cargarDefault("#edit-depto");
							cargarDefault("#edit-ciudad");
							cargarDefault("#edit-sede");
							cargarJerarquiaEspecialidad(data);	
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			var seleccionarDefault=function(obj){
				$(obj+" option").each(function(){												
					if(this.value!="_none"){ 							
						$(obj).val($.trim(this.value));
						$(obj).change();								
					}
				});
			};
			
			var cargarJerarquiaEspecialidad=function(data){						
				ubicacion=cargarUbicacion(data);
				cargarSelect(data,'#edit-pais');				
				if($("#edit-pais option").length==2){
					seleccionarDefault("#edit-pais");
					/*if($("#edit-depto option").length==2){
						seleccionarDefault("#edit-depto");
						if($("#edit-ciudad option").length==2){
							seleccionarDefault("#edit-ciudad");							
							if($("#edit-sede option").length==2){
								seleccionarDefault("#edit-sede");							
							}
						}
					}*/
				}									
			};	
			
			
			$("#edit-especialidad").change(function(){
				var id=jQuery(this).val();
				obtenerJerarquiaEspecialidad(id);								
			}); 
			 
			 
			 
			 
			//---------------------------------------------------------------------------------------------------
			//				FUNCIONALES DE FECHA
			//---------------------------------------------------------------------------------------------------
			 
			 $('#edit-fecha-desde').datetimepicker({               												
				locale: 'es',				
				format: 'MM/DD/YYYY HH:mm', //formato de fecha y hora
				daysOfWeekDisabled: DSA.dias_semana_no_habiles,//[0, 6]Bloquea el dia domingo, y el sabado como dias no habiles,
				//disabledDates:DSA.dias_no_habiles,											
				enabledHours: DSA.horas_habiles,//[0, 1, 2, 3, 4, 5, 6, 7, 8, 18, 19, 20, 21, 22, 23, 24]
				sideBySide: true,//Muestra el reloj al lado del calendario	
				calendarWeeks:true,//muestra el numero de semana
				stepping:DSA.tiempo_evento,//intervalo de minutos
				ignoreReadonly:true, // ingnora el comportamiento de readonly en el control, deja funcionar el calendario				
				widgetPositioning:{
					horizontal: 'auto',
					vertical: 'bottom'	
				},										
			});
			$('#edit-fecha-hasta').datetimepicker({
				
				locale: 'es',				
				format: 'MM/DD/YYYY HH:mm', //formato de fecha y hora
				daysOfWeekDisabled: DSA.dias_semana_no_habiles,//[0, 6]Bloquea el dia domingo, y el sabado como dias no habiles,				
				//disabledTimeIntervals: [[moment({ h: 0 }), moment({ h: 8 })], [moment({ h: 18 }), moment({ h: 24 })]],
				//disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 18, 19, 20, 21, 22, 23, 24],
				enabledHours: DSA.horas_habiles,
				//inline: true,//Muestra el calendario directo
				sideBySide: true,//Muestra el reloj al lado del calendario	
				calendarWeeks:true,//muestra el numero de semana
				stepping:DSA.tiempo_evento,//intervalo de minutos
				ignoreReadonly:true,				
				widgetPositioning:{
					horizontal: 'auto',
					vertical: 'bottom'	
				},										
			});	
			


			//Desabilita las fechas que no son habiles en el calendario
			$('#edit-fecha-desde').data('DateTimePicker').disabledDates(DSA.dias_no_habiles);
			$('#edit-fecha-hasta').data('DateTimePicker').disabledDates(DSA.dias_no_habiles);
			
			
			if(DSA.permite_fechas_pasado==0){
				//Setea el valor minimo de seleccion de fecha, al momento actual, para no permitir seleccionar fechas ni horas del pasado		
				
				var dia=moment().weekday();
				var hora=DSA.semana_horas_habiles[dia];
				
				$('#edit-fecha-desde').data('DateTimePicker').minDate(moment({hour: hora[0], minute: 0}).add(1,'d'));
				$('#edit-fecha-hasta').data('DateTimePicker').minDate(moment({hour: hora[0], minute: 0}).add(1,'d').add(DSA.tiempo_evento,'m'));				
				
				$('#edit-fecha-desde').data("DateTimePicker").date(moment({hour: hora[0], minute: 0}).add(1,'d'));
				$('#edit-fecha-hasta').data('DateTimePicker').date(moment({hour: hora[0], minute: 0}).add(1,'d').add(DSA.tiempo_evento,'m'));
				
				
			}			
		
			if(DSA.hora_exacta==1){
				$("#edit-especialidad").parent().next().show();//activa div, que bloque elemento 
				$("#edit-especialidad").val(DSA.id_especialidad_exacta);$("#edit-especialidad").change();
				
				//Asigna la fecha y hora seleccionada desde el calendario de eventos, esto con el fin de no dar opcion al usuario de 
				//poner otra hora o fecha diferente a la que selecciono desde el calendario de eventos.
				
				$("#edit-fecha-desde").parent().next().show();//activa div, que bloque elemento 
				$("#edit-fecha-hasta").parent().next().show();//activa div, que bloque elemento 
				
				
			}		
			
			$("#edit-fecha-desde").on("dp.change", function (e) {	
				//Se controla las horas habiles, por cada dia, dependiendo del especialista 
				if($("#edit-especialista").val()!="_none"){				
					var dia=moment(e.date,"MM/DD/YYYY hh:mm").weekday();
					$('#edit-fecha-desde').data('DateTimePicker').enabledHours(DSA.semana_horas_habiles[dia]);	
					$('#edit-fecha-desde').data('DateTimePicker').stepping(DSA.semana_tiempo_evento[dia]);
					
					$('#edit-fecha-hasta').data('DateTimePicker').enabledHours(DSA.semana_horas_habiles[dia]);	
					$('#edit-fecha-hasta').data('DateTimePicker').stepping(DSA.semana_tiempo_evento[dia]);
					
					$('#edit-fecha-hasta').data("DateTimePicker").minDate(moment(e.date).add(DSA.semana_tiempo_evento[dia],'m'));
					$('#edit-fecha-hasta').data("DateTimePicker").date(moment(e.date).add(DSA.semana_tiempo_evento[dia],'m'));
				}
				//Asigna a la fecha final, la misma fecha inicial y le adiciona el tiempo del evento, y le setea como minimo
				//este valor a la fecha hasta, el objetivo es que no se escoja una fecha menor de la "fecha desde" en la fecha hasta
				$('#edit-fecha-hasta').data("DateTimePicker").minDate(moment(e.date).add(DSA.tiempo_evento,'m'));
				
				//Se asigna a la fecha hasta, el tiempo de la cita, para que se calcule la fecha hasta, para dar fecha final al evento
				$('#edit-fecha-hasta').data("DateTimePicker").date(moment(e.date).add(DSA.tiempo_evento,'m'));
			});
			$("#edit-fecha-hasta").on("dp.change", function (e) {
				//Asigna a la fecha inicial, la misma fecha final y le resta el tiempo del evento, y le setea como minimo
				//este valor a la fecha desde, el objetivo es que no se escoja una fecha mayor de la "fecha hasta" en la fecha desde
				//$('#edit-fecha-desde').data("DateTimePicker").minDate(moment(e.date).subtract(DSA.tiempo_evento,'m'));
				
				//Se asigna a la fecha desde, el tiempo de la cita, para que se calcule la fecha desde, para dar fecha inicial al evento
				//$('#edit-fecha-desde').data("DateTimePicker").date(moment(e.date).subtract(DSA.tiempo_evento,'m'));
			});

						
			
			//---------------------------------------------------------------------------------------------------
			//				FUNCIONALES DE UBICACION GEOGRAFICA
			//---------------------------------------------------------------------------------------------------
			
			var cargarUbicacion=function(data){
				if(data)				
					return data;	
				else
					return Drupal.settings.jerarquia;		
			};
			
			var cargarDefault=function(obj){
				var html="<option value='_none'>Seleccione</option>";
				jQuery(obj).html(html);	
			} 


			var cargarOpciones=function(id,objeto){
				var opciones="<option value='_none'>Seleccione</option>";
				var result=$.grep(objeto, function (e) { return e.id == id; });
				if(result.length==1){
					var lista=result[0].children;				
					lista.forEach( function(value, index){
						//console.log(value);	
						opciones +="<option value='"+value.id+"'>"+value.text+"</option>";
						
					});
				}
				return opciones;
			};
			
			var cargarSelect=function(data,obj){
				//Se hace el cargue de las opciones del primer nivel
				var html="<option value='_none'>Seleccione</option>";
				data.forEach( function(value, index){	
					html +="<option value='"+value.id+"'>"+value.text+"</option>";
				});			
				$(obj).html(html);
			};
			
			var ubicacion=cargarUbicacion();
			cargarSelect(ubicacion,'#edit-pais');
			
				
			
			$("#edit-pais").change(function(){
				var id=$(this).val();
				var objeto=ubicacion;		
				var html=cargarOpciones(id,objeto);
				$("#edit-depto").html(html);				
				cargarDefault("#edit-ciudad");
				cargarDefault("#edit-sede");
				cargarDefault("#edit-especialista");
				ocultaDependenciasEspecialista();
				
				if(DSA.hora_exacta==1){
					$("#edit-depto").parent().next().show();//activa div, que bloque elemento 
				}
				
				if($("#edit-depto option").length==2){
					seleccionarDefault("#edit-depto");
				}else{ //si no, es porque hay mas opciones, y no se puede seleccionar una automatica, a no ser que se haya enviado desde el calendario
				       //en este caso, se seleccionara esa opcion en especial 
					if(DSA.hora_exacta==1){
						$("#edit-depto").val(DSA.id_depto_exacta);$("#edit-depto").change();  
					}
				}
				
				
								
			});
			
			$("#edit-depto").change(function(){
				var id=jQuery(this).val();
				var idNivel1=$("#edit-pais").val();			
				var resultNivel2=$.grep(ubicacion, function (e) { return e.id == idNivel1; });		
				var objeto=resultNivel2[0].children;					
				var html=cargarOpciones(id,objeto);	
				$("#edit-ciudad").html(html);					
				cargarDefault("#edit-sede");
				cargarDefault("#edit-especialista");
				ocultaDependenciasEspecialista();
				
				if(DSA.hora_exacta==1){
					$("#edit-ciudad").parent().next().show();//activa div, que bloque elemento 
				}
				
				if($("#edit-ciudad option").length==2){
					seleccionarDefault("#edit-ciudad");
				}else{ //si no, es porque hay mas opciones, y no se puede seleccionar una automatica, a no ser que se haya enviado desde el calendario
				       //en este caso, se seleccionara esa opcion en especial 
					if(DSA.hora_exacta==1){
						$("#edit-ciudad").val(DSA.id_ciudad_exacta);$("#edit-ciudad").change();  
					}
				}
			});
			
			$("#edit-ciudad").change(function(){
				var id=jQuery(this).val();
				var idNivel1=$("#edit-pais").val();
				var idNivel2=$("#edit-depto").val();			
				var resultNivel2=$.grep(ubicacion, function (e) { return e.id == idNivel1; });		
				var objeto=resultNivel2[0].children;
				var resultNivel3=$.grep(objeto, function (e) { return e.id == idNivel2; });		
				var objeto=resultNivel3[0].children;					
				var html=cargarOpciones(id,objeto);	
				$("#edit-sede").html(html);

				cargarDefault("#edit-especialista");
				ocultaDependenciasEspecialista();
				
				if(DSA.hora_exacta==1){
					$("#edit-sede").parent().next().show();//activa div, que bloque elemento 
				}
				
				if($("#edit-sede option").length==2){
					seleccionarDefault("#edit-sede");
				}else{ //si no, es porque hay mas opciones, y no se puede seleccionar una automatica, a no ser que se haya enviado desde el calendario
				       //en este caso, se seleccionara esa opcion en especial 
					if(DSA.hora_exacta==1){
						$("#edit-sede").val(DSA.id_sede_exacta);$("#edit-sede").change();  
					}
				}
			});			
			
			//Si la variable esta confifurada en 0, quiere decir que no se tiene pais, por defecto
			//razon por la cual se va a mostrar el campo pais, en el formulario, si llega a ser un valor 
			//diferente de cero (0), se asigna el valor al pais, y se activa el evento de change automatico
			//para cargar los departamentos.			
			if(DSA.muestra_pais!=0){
				$("#edit-pais").val(DSA.muestra_pais);$("#edit-pais").change();
			}
			
			
		
			
			//---------------------------------------------------------------------------------------------------
			//				FUNCIONALES DE ESPECIALISTAS
			//---------------------------------------------------------------------------------------------------
			
			var obtenerEspecialistas=function(id_especialidad,id_sede){
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/especialistas',
					data: {'id_especialidad':+id_especialidad,'id_sede':+id_sede},
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							cargarSelect(data,"#edit-especialista");
							
							if(DSA.hora_exacta==1){
								$("#edit-especialista").parent().next().show();//activa div, que bloque elemento 
							} 
							
							if($("#edit-especialista option").length==2){
								seleccionarDefault("#edit-especialista");
							}else{ //si no, es porque hay mas opciones, y no se puede seleccionar una automatica, a no ser que se haya enviado desde el calendario
								   //en este caso, se seleccionara esa opcion en especial 
								if(DSA.hora_exacta==1){
									$("#edit-especialista").val(DSA.id_especialista_exacta);$("#edit-especialista").change();  
								} 
							}	
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			var obtenerConfiguracionEspecialista=function(id){
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/especialistas/configuracion',
					data: {'id_especialista':+id},
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							//se asigna a los calendarios, las horas habiles y los dias en que el 
							//especialista no trabaja, para evitar que se seleccione hora y fecha 
							// en la cual no atiende el especialista		
							
							//Se asigna la variable de horas_semana_habiles, con la info obtenida de la configuracion
							//del usuario, estavariable esta disponible en todo el contexto, y se usara en el momento
							//de cambiar de dia.  Solo se reconstruira si se cambia de especialista.  
							
							mostrarDependenciasEspecialista();
							
							cargarSelect(data.medios_atencion,"#edit-medio-atencion");
							if($("#edit-medio-atencion option").length==2){
								seleccionarDefault("#edit-medio-atencion");
							} 
							
							
							DSA.semana_horas_habiles=data.semana_horas_habiles;
							DSA.semana_tiempo_evento=data.semana_tiempo_evento;
							DSA.dias_semana_no_habiles=data.dias_semana_no_habiles
	
							var dia=moment($('#edit-fecha-desde').val(),"MM/DD/YYYY hh:mm").weekday();
							
							//if(DSA.horas_semana_habiles[dia]!="undefined"){
								if(DSA.semana_horas_habiles[dia].length >0){
									$('#edit-fecha-desde').data('DateTimePicker').enabledHours(DSA.semana_horas_habiles[dia]);
									$('#edit-fecha-hasta').data('DateTimePicker').enabledHours(DSA.semana_horas_habiles[dia]);
								}
							//}
							
							//if(DSA.tiempo_evento_dia[dia]!="undefined"){
								if(DSA.semana_tiempo_evento[dia].length >0){
									$('#edit-fecha-desde').data('DateTimePicker').stepping(DSA.semana_tiempo_evento[dia]);
									$('#edit-fecha-hasta').data('DateTimePicker').stepping(DSA.semana_tiempo_evento[dia]);
								}
							//}												
						
							
							if(DSA.dias_semana_no_habiles.length >0){
								$('#edit-fecha-desde').data('DateTimePicker').daysOfWeekDisabled(DSA.dias_semana_no_habiles);
								$('#edit-fecha-hasta').data('DateTimePicker').daysOfWeekDisabled(DSA.dias_semana_no_habiles);
							}																		

						
							if(DSA.hora_exacta!=1){
								$('#edit-fecha-desde').data('DateTimePicker').minDate(moment({hour: hora[0], minute: 0}).add(1,'d'));
								$('#edit-fecha-desde').data("DateTimePicker").date(moment({hour: hora[0], minute: 0}).add(1,'d'));
								
								$('#edit-fecha-hasta').data('DateTimePicker').minDate(moment({hour: hora[0], minute: 0}).add(1,'d').add(DSA.semana_tiempo_evento[dia],'m'));				
								$('#edit-fecha-hasta').data('DateTimePicker').date(moment({hour: hora[0], minute: 0}).add(1,'d').add(DSA.semana_tiempo_evento[dia],'m'));
								
								$('#edit-fecha-desde').data('DateTimePicker').show();
								
							}else{
								$('#edit-fecha-desde').data('DateTimePicker').date(moment(DSA.fecha_hora_exacta,"MM/DD/YYYY hh:mm"));
								$('#edit-fecha-hasta').data('DateTimePicker').date(moment(DSA.fecha_hora_exacta,"MM/DD/YYYY hh:mm").add(DSA.semana_tiempo_evento[dia],'m'));	
							}
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			
			$("#edit-sede").change(function(){
				id_especialidad=$("#edit-especialidad").val();
				id_sede=$("#edit-sede").val();
				if(id_sede!="_none"){
					obtenerEspecialistas(id_especialidad,id_sede);
				}else{
					cargarDefault("#edit-especialista");	
					ocultaDependenciasEspecialista();
				} 
			});

			$("#edit-especialista").change(function(){
				var id=jQuery(this).val();
				if(id!="_none"){
					obtenerConfiguracionEspecialista(id);
				}else{
					ocultaDependenciasEspecialista();
				} 
				
			});
			
			
			//----------------------------------------------------------------------------------------------------- 
			//										FUNCIONES DE VALIDACION DE AGENDAMIENTO
			//-----------------------------------------------------------------------------------------------------
			
			
			
			//----------------------------------------------------------------------------------------------------- 
			//										FUNCIONES DE CLIENTE
			//-----------------------------------------------------------------------------------------------------
									
			var ubicacionCliente=Drupal.settings.jerarquia;
			cargarSelect(ubicacionCliente,'#edit-pais-cliente');
			
			$('#edit-fecha-nacimiento').datetimepicker({
				
				locale: 'es',				
				format: 'MM/DD/YYYY', //formato de fecha y hora												
				calendarWeeks:true,//muestra el numero de semana	
				maxDate:moment().subtract(DSA.edad_minima_cliente,'y'),			
				ignoreReadonly:true,				
				widgetPositioning:{
					horizontal: 'auto',
					vertical: 'bottom'	
				},										
			});	
			

			$("#edit-pais-cliente").change(function(){
				var id=$(this).val();
				var objeto=ubicacionCliente;		
				var html=cargarOpciones(id,objeto);
				$("#edit-depto-cliente").html(html);				
				cargarDefault("#edit-ciudad-cliente");
				
				if($("#edit-depto-cliente option").length==2){
					seleccionarDefault("#edit-depto-cliente");
				}				
			});
			
			$("#edit-depto-cliente").change(function(){
				var id=jQuery(this).val();
				var idNivel1=$("#edit-pais-cliente").val();			
				var resultNivel2=$.grep(ubicacionCliente, function (e) { return e.id == idNivel1; });		
				var objeto=resultNivel2[0].children;					
				var html=cargarOpciones(id,objeto);	
				$("#edit-ciudad-cliente").html(html);					

				if($("#edit-ciudad-cliente option").length==2){
					seleccionarDefault("#edit-ciudad-cliente");
					//if($("#edit-sede option").length==2){
					//	seleccionarDefault("#edit-sede");
					//}
				}
			});
			
			
			var obtenerDatosCliente=function(numero_documento){
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/cliente',
					data: {'numero_documento':+numero_documento},
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							console.log(data); 
							cargarDatosCliente(data);
							
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			var cargarDatosCliente=function(data){
				if(data[0].existe==1){
					$("#edit-cliente").val(data[0].cliente_id);
					$("#edit-tipo-documento").val(data[0].tipo_documento_id);
					$("#edit-nombres-cliente").val(data[0].nombre);
					$("#edit-apellidos-cliente").val(data[0].apellido);
					$("#edit-fecha-nacimiento").val(data[0].fecha_nacimiento);
					$("#edit-telefono-fijo").val(data[0].telefono);
					$("#edit-extension-fijo").val(data[0].extension);
					$("#edit-telefono-celular").val(data[0].celular);
					$("#edit-correo-electronico").val(data[0].email);
					$("#edit-direccion").val(data[0].direccion);
					$("#edit-pais-cliente").val(data[0].pais_id);$("#edit-pais-cliente").change();
					$("#edit-depto-cliente").val(data[0].depto_id);$("#edit-depto-cliente").change();
					$("#edit-ciudad-cliente").val(data[0].ciudad_id);
					
				}else{
					$("#edit-cliente").val(0);
					$("#edit-tipo-documento").val("_none");
					$("#edit-nombres-cliente").val("");
					$("#edit-apellidos-cliente").val("");
					$("#edit-fecha-nacimiento").val("");
					$("#edit-telefono-fijo").val("");
					$("#edit-extension-fijo").val("");
					$("#edit-telefono-celular").val("");
					$("#edit-correo-electronico").val("");
					$("#edit-direccion").val("");
					//$("#edit-pais-cliente").val("_none");$("#edit-pais-cliente").change();
					$("#edit-depto-cliente").val("_none");$("#edit-depto-cliente").change();
					$("#edit-ciudad-cliente").val("_none");
				}
					
			};
			
			jQuery("#edit-numero-documento").blur(function(event){		
				if(jQuery.trim(jQuery(this).val())!=""){
					obtenerDatosCliente(jQuery(this).val());		
				}
			});	
			
			//Si la variable esta confifurada en 0, quiere decir que no se tiene pais, por defecto
			//razon por la cual se va a mostrar el campo pais, en el formulario, si llega a ser un valor 
			//diferente de cero (0), se asigna el valor al pais, y se activa el evento de change automatico
			//para cargar los departamentos.			
			if(DSA.muestra_pais!=0){
				$("#edit-pais-cliente").val(DSA.muestra_pais);$("#edit-pais-cliente").change();
			}
			
			
			$("#modal-final").on("click","#enlace-eventoto",function(e){
				e.preventDefault();
				e.stopPropagation();
							
				var url=$(this).attr("href");
				
				ifrm = $(document.createElement("iframe"))
				.attr({
					width:       "100%",
					frameborder: "0"
				});
				
				ifrm.attr('src', url);
				$('#events-modal-load .modal-body').html(ifrm);
				
			
				
				$('#events-modal-load').on('shown.bs.modal', function (e) {
					var modal_body = $(this).find('.modal-body');
					//var height = modal_body.height() - parseInt(modal_body.css('padding-top'), 10) - parseInt(modal_body.css('padding-bottom'), 10);
					var height=modal_body.height()-5;
					$(this).find('iframe').height(Math.max(height, 50));
		
				});
				
				
		
													
				$('#events-modal-load').modal({
					show:true,
					backdrop: 'static', 
					keyboard: false
				});
			
			});	
			
			
			
		}(jQuery));
		
				
	</script>		