<?php 

$path = drupal_get_path('module', 'agendamiento');
global $base_url;
$variables=_agendamiento_get_variables();
$textos=_agendamiento_get_textos();

?>

<div class="contenedor">
	<div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12">
    		<div class="container-fluid">             
                
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><a href="<?php echo $base_url;?>/agendamiento/calendario">Calendario</a></li>
                  <?php if($variables["es_especialista"]==0){?>
                  			<li role="presentation"><a href="<?php echo $base_url;?>/agendamiento/calendario/nuevo"><?php echo $textos["nuevo_evento"]?></a></li>
                  <?php }?>
                  <li role="presentation" ><a href="<?php echo $base_url;?>/agendamiento/calendario/consulta">Consultar <?php echo $textos["titulo_evento"]?></a></li>	
				</ul>
                
				<div class="row">
                    <div class="page-header">
                        <div class="pull-right form-inline">
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal-filter">
                              		Filtros
                            		</button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary" data-calendar-nav="prev"><< </button>
                                <button class="btn" data-calendar-nav="today">Hoy</button>
                                <button class="btn btn-primary" data-calendar-nav="next">>></button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-warning" data-calendar-view="year">Año</button>
                                <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                                <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                                <button class="btn btn-warning" data-calendar-view="day">Día</button>
                            </div>
                        </div>
                        <h3></h3>	
                    </div>                               
                </div> 
                <hr>
                <div class="row">
                    <div id="calendar"></div>
                </div>
                
               
  
        <!-- Modal -->
        <div class="modal fade" id="Modal-filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $textos["filtro_evento"]?></h4>
              </div>
              <div class="modal-body">
                <!--Inicia contenido-->
                	
                    <form >
                    		<?php //se muestran los filstros, solo si el usuario no es especialista
						  if($variables["es_especialista"]==1){?>
                      		 <div class="oculto">
                       <?php }?>
                        
                      <?php //se valida si se debe mostrar el pais para la captura, o si es automatico y solo se muestra el departamento								  	
					if($variables["muestra_pais"]!=0 && $variables["muestra_pais"]!='_none'){?>                    
                        <div class="row">                    	
                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <label for="especialidad" class="control-label">Especialidad</label>
                            <select name="especialidad" id="especialidad" class="form-control"></select>
                          </div>
                          <div class="oculto">
                              <div class="col-xs-12 col-sm-12 col-md-12">
                              <label for="pais" class="control-label">Pais</label>
                                <select name="pais" id="pais" class="form-control"></select>   
                                </div>
                            </div>
                        </div>                    
                      <?php }else{?> 
					  		
					  <div class="row">                    	
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <label for="especialidad" class="control-label">Especialidad</label>
                            <select name="especialidad" id="especialidad" class="form-control"></select>
                          </div>
                          <div class="oculto">
                              <div class="col-xs-12 col-sm-6 col-md-6">
                              <label for="pais" class="control-label">Pais</label>
                                <select name="pais" id="pais" class="form-control"></select>   
                                </div>
                            </div>
                        </div>
					  <?php }?>
                      
                     <br> 
                      <div class="row">                      
                        <div class="col-xs-12 col-sm-4 col-md-4">
                          <label for="depto" class="control-label">Departamento</label>
                          <select name="depto" id="depto" class="form-control"></select>
                        </div>
                         <div class="col-xs-12 col-sm-4 col-md-4">
                        <label for="ciudad" class="control-label">Ciudad</label>
                         <select name="ciudad" id="ciudad" class="form-control"></select>
                      </div> 
                      <div class="col-xs-12 col-sm-4 col-md-4">
                        <label for="sede" class="control-label">Sede</label>
                        <select name="sede" id="sede" class="form-control"></select>
                      </div> 
                      </div>
                     
                       <br>
                       <div class="row">                     
                      <div class="col-xs-12 col-sm-6 col-md-6">
                        <label for="especialista" class="control-label">Especialista</label>
                        <select name="especialista" id="especialista" class="form-control"></select>
                      </div>  
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <label for="especialista" class="control-label">Medio atención</label>
                          <select name="medio_atencion" id="medio_atencion" class="form-control"></select>
                        </div>
                      </div>                      
                      <br>
                     <?php //se muestran los filstros, solo si el usuario no es especialista
						  if($variables["es_especialista"]==1){?>
                      		 </div>
                     <?php }?> 
                      <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3">
                            	<label for="estados" class="control-label">Ver citas</label>
                            </div>
                            <div class="col-xs-12 col-sm-9 col-md-9">
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado_todos" id="estado_todos" value="0" checked="checked">TODOS LOS ESTADOS</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado[]" id="estado" value="1">ACTIVAS</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado[]" id="estado" value="2">ATENDIDAS</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado[]" id="estado" value="3">NO ATENDIDAS</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado[]" id="estado" value="4">CANCELADAS</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" name="estado[]" id="estado" value="5">ANULADAS</label>
                                </div>
                              
                            </div><!--./col, estados-->
                      </div>                   
                     	           
                    </form>                
                    
                <!--Finaliza contenido-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="filtrar">Filtrar</button>
              </div>
            </div>
          </div>
        </div>       
                
                
                
                
                
                
                
                
                
                

		<!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal">
		    <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $textos["detalle_evento"]?></h4>
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
</div>

    <script type="text/javascript">
	(function($){
		// se define la variable que trae la configuracion para la personalizacion del calendario,
		var DSA=Drupal.settings.agendamiento_vars;	
		
		//creamos la fecha actual 
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

		//establecemos los valores del calendario  
		var options = {
			events_source: Drupal.settings.base_url +'/agendamiento/calendario/eventos',
			hours_enabled:[],//DSA.horas_habiles,
			semana_horas_habiles:[],//DSA.semana_horas_habiles,
			dias_semana_no_habiles:[],
			dias_no_habiles:DSA.dias_no_habiles,
			es_especialista:DSA.es_especialista,
			base_url : Drupal.settings.base_url,
			view: DSA.vista_default_calendario, //Vista por defecto del calendario, Month, day, week, year
			language: 'es-ES',
			tmpl_path: Drupal.settings.base_url +'/'+Drupal.settings.agendamiento_path+'/theme/tmpls/',
			tmpl_cache: false,
			day: yyyy+"-"+mm+"-"+dd,
			time_start: DSA.hora_inicio,//Hora en que comienza labores y se puede adicionar eventos
			time_end: DSA.hora_fin, // hora final, a partir de esta hora no se pueden generar eventos
			time_split: DSA.tiempo_evento,//Tiempo del evento,
			width: '100%',
			modal:'#events-modal',
			modal_type:'iframe',
			onAfterEventsLoad: function(events) 
			{
				if(!events) 
				{
					return;
				}
				var list = $('#eventlist');
				list.html('');

				$.each(events, function(key, val) 
				{
					$(document.createElement('li'))
						.html('<a href="' + val.url + '">' + val.title + '</a>')
						.appendTo(list);
				});
			},
			onAfterViewLoad: function(view) 
			{
				$('.page-header h3').html(this.getTitle());
				$('.btn-group button').removeClass('active');
				$('button[data-calendar-view="' + view + '"]').addClass('active');
			},
			classes: {
				months: {
					general: 'label'
				}
			}
		};

		var calendar = $('#calendar').calendar(options);

		$('.btn-group button[data-calendar-nav]').each(function() 
		{
			var $this = $(this);
			$this.click(function() 
			{
				calendar.navigate($this.data('calendar-nav'));
			});
		});

		$('.btn-group button[data-calendar-view]').each(function() 
		{
			var $this = $(this);
			$this.click(function() 
			{
				calendar.view($this.data('calendar-view'));
			});
		});

		$('#first_day').change(function()
		{
			var value = $(this).val();
			value = value.length ? parseInt(value) : null;
			calendar.setOptions({first_day: value});
			calendar.view();
		});

		$('#events-in-modal').change(function()
		{
			//var val = $(this).is(':checked') ? $(this).val() : null;
			var val="#events-modal";
			calendar.setOptions(
				{
					modal: val,
					modal_type:'iframe'
				}
			);
		});
		
		
		
		//---------------------------------------------------------------------------------------------------
			//				FUNCIONALES DE UBICACION GEOGRAFICA
			//---------------------------------------------------------------------------------------------------
			
			var ocultaDependenciasEspecialista=function(){
				$("#medio_atencion").parent().hide();
			};
			
			var mostrarDependenciasEspecialista=function(){
				$("#medio_atencion").parent().show();
			};
			
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


			var cargarOpciones=function(id,objeto,label){
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
			
			var cargarSelect=function(data,obj,label){
				//Se hace el cargue de las opciones del primer nivel
				var html="<option value='_none'>Seleccione</option>";
				data.forEach( function(value, index){	
					html +="<option value='"+value.id+"'>"+value.text+"</option>";
				});			
				$(obj).html(html);
			};
			
			var especialidades=Drupal.settings.especialidades;	
			cargarSelect(especialidades,'#especialidad','Seleccione especialidad');
			
			
			var ubicacion=cargarUbicacion();
			cargarSelect(ubicacion,'#pais','Seleccione pais');
			
				
			
			$("#pais").change(function(){
				var id=$(this).val();
				var objeto=ubicacion;		
				var html=cargarOpciones(id,objeto,'Seleccione departamento');
				$("#depto").html(html);				
				cargarDefault("#ciudad");
				cargarDefault("#sede");
				cargarDefault("#especialista");
				cargarDefault("#medio_atencion");
				
				if($("#depto option").length==2){
					seleccionarDefault("#depto");
					/*if($("#edit-ciudad option").length==2){
						seleccionarDefault("#edit-ciudad");
						if($("#edit-sede option").length==2){
							seleccionarDefault("#edit-sede");
						}
					}*/
				}				
			});
			
			$("#depto").change(function(){
				var id=jQuery(this).val();
				var idNivel1=$("#pais").val();			
				var resultNivel2=$.grep(ubicacion, function (e) { return e.id == idNivel1; });		
				var objeto=resultNivel2[0].children;					
				var html=cargarOpciones(id,objeto,'Seleccione ciudad');	
				$("#ciudad").html(html);					
				cargarDefault("#sede");
				cargarDefault("#especialista");
				cargarDefault("#medio_atencion");
				
				if($("#ciudad option").length==2){
					seleccionarDefault("#ciudad");
					//if($("#edit-sede option").length==2){
					//	seleccionarDefault("#edit-sede");
					//}
				}
			});
			
			$("#ciudad").change(function(){
				var id=jQuery(this).val();
				var idNivel1=$("#pais").val();
				var idNivel2=$("#depto").val();			
				var resultNivel2=$.grep(ubicacion, function (e) { return e.id == idNivel1; });		
				var objeto=resultNivel2[0].children;
				var resultNivel3=$.grep(objeto, function (e) { return e.id == idNivel2; });		
				var objeto=resultNivel3[0].children;					
				var html=cargarOpciones(id,objeto,'Seleccione sede');	
				$("#sede").html(html);

				cargarDefault("#especialista");
				cargarDefault("#medio_atencion");
				
				if($("#sede option").length==2){
					seleccionarDefault("#sede");
				}
			});			
			
			//Si la variable esta confifurada en 0, quiere decir que no se tiene pais, por defecto
			//razon por la cual se va a mostrar el campo pais, en el formulario, si llega a ser un valor 
			//diferente de cero (0), se asigna el valor al pais, y se activa el evento de change automatico
			//para cargar los departamentos.			
			if(DSA.muestra_pais!=0){
				$("#pais").val(DSA.muestra_pais);$("#pais").change();
			}
			
			
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
							cargarDefault("#pais");
							cargarDefault("#depto");
							cargarDefault("#ciudad");
							cargarDefault("#sede");
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
				cargarSelect(data,'#pais','Seleccione pais');				
				if($("#pais option").length==2){
					seleccionarDefault("#pais");
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
			
			
			$("#especialidad").change(function(){
				var id=jQuery(this).val();
				cargarDefault("#especialista");
				obtenerJerarquiaEspecialidad(id);								
			});
			
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
							cargarSelect(data,"#especialista",'Seleccione especialista');
							if($("#especialista option").length==2){
								seleccionarDefault("#especialista");
							}	
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			var obtenerConfiguracionEspecialista=function(id_especialista){
				
				DSA.semana_horas_habiles=[];
				DSA.semana_tiempo_evento=[];
				DSA.dias_semana_no_habiles=[];
				
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/especialistas/configuracion',
					data: {'id_especialista':+id_especialista},
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							DSA.semana_horas_habiles=data.semana_horas_habiles;
							DSA.semana_tiempo_evento=data.semana_tiempo_evento;
							DSA.dias_semana_no_habiles=data.dias_semana_no_habiles;
							
							mostrarDependenciasEspecialista();
							
							cargarSelect(data.medios_atencion,"#medio_atencion");
							if($("#medio_atencion option").length==2){
								seleccionarDefault("#medio_atencion");
							} 			
							
							filtrarEventos();	
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});					
			};
			
			
			$("#sede").change(function(){
				id_especialidad=$("#especialidad").val();
				id_sede=$("#sede").val();
				obtenerEspecialistas(id_especialidad,id_sede);
			});
		
		
		
		
		//---------------------------------------------------------------------------------------------
		//									FUNCIONALIDADES DE FILTROS 
		//---------------------------------------------------------------------------------------------	
		
		var filtrarEventos=function(){
				//Carga las variables para los filtros
				var id_especialidad=$("#especialidad").val();
				var	id_pais=$("#pais").val();
				var	id_depto=$("#depto").val();
				var	id_ciudad=$("#ciudad").val();
				var	id_sede=$("#sede").val();
				var id_especialista=$("#especialista").val();
											
				var checkboxValues = "";
				$('input[name="estado[]"]:checked').each(function() {
					checkboxValues += $(this).val() + "|";
				});				
				
				//eliminamos la última coma.
				checkboxValues = checkboxValues.substring(0, checkboxValues.length-1);
				if($.trim(checkboxValues)==""){
					checkboxValues=0;
				}
				
				var id_estado=checkboxValues;
				
				if(id_especialista!=0&&id_especialista!="_none"){
					bloquea_add_hour=0;	//indica que se escojio el especialista, por lo tanto, dejara habilitar horas en el calendario la vista de dia
					es_especialista=1;
				}else{
					bloquea_add_hour=1;	//indica que no se ha seleccionado especialista, por tal razon, no se habilitaran las opciones de horas 	
					es_especialista=1;
				} 
					
				calendar.setOptions(
					{
						bloquea_add_hour:bloquea_add_hour,
						semana_horas_habiles:DSA.semana_horas_habiles,
						semana_tiempo_evento:DSA.semana_tiempo_evento,
						dias_semana_no_habiles:DSA.dias_semana_no_habiles,
						es_especialista:es_especialista,
						filter_url :{'id_especialidad': id_especialidad,'id_pais': id_pais,'id_depto': id_depto,'id_ciudad': id_ciudad,'id_sede': id_sede,'id_especialista': id_especialista,'id_estado':id_estado},
						events_source: Drupal.settings.base_url +'/agendamiento/calendario/eventos',
					}
				);
				calendar.view();
				$('#Modal-filter').modal('hide');	
				//Todo este proceso se ejecuta despues del retorno de la configuracion del usuario	
						
			};
		
		
		$("#especialista").change(function(){ 
			var id=$("#especialista").val();
			if(id!="_none"){
				obtenerConfiguracionEspecialista(id);
			}else{
				ocultaDependenciasEspecialista();	
			}
		});
		
		$("#filtrar").click(function(){
			filtrarEventos();	
		});
		
		$('input[name="estado_todos"]').change(function(e) {
			
			if($(this).is(":checked")){
				$('input[name="estado[]"]:checked').each(function() {
					$(this).prop('checked', false);
				});
			}else{
				var check=0;
				$('input[name="estado[]"]:checked').each(function() {
					check++;
				});
				if(check==0){
					$('input[name="estado_todos"]').prop('checked', true);
				}
			}
			
		}); 
		
		$('input[name="estado[]"]').change(function(e) {
			
			var check=0;
			$('input[name="estado[]"]:checked').each(function() {
				check++;
			});
			
			if(check==0){
				$('input[name="estado_todos"]').prop('checked', true);
			}else{
				$('input[name="estado_todos"]').prop('checked', false);
			}			
			
		}); 		
		
	}(jQuery));
    </script>