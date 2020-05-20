<?php 

$path = drupal_get_path('module', 'agendamiento');
global $base_url,$user;
$variables=_agendamiento_get_variables();

$textos=_agendamiento_get_textos();

?>
    
            <div class="contenedor">
            	<div class="container-fluid">
                	
                    <ul class="nav nav-tabs">
                  <li role="presentation"><a href="<?php echo $base_url;?>/agendamiento/calendario">Calendario</a></li>
                    <?php if($variables["es_especialista"]==0){?>
                  		<li role="presentation"><a href="<?php echo $base_url;?>/agendamiento/calendario/nuevo"><?php echo $textos["nuevo_evento"]?></a></li>
                	<?php }?>
                    <li role="presentation" class="active"><a href="<?php echo $base_url;?>/agendamiento/calendario/consulta">Consultar <?php echo $textos["titulo_evento"]?></a></li>	
                </ul>
                
                              
                <!--Inicio de formulario-->
                <div class="wrapper-form">
                    <div class="page-header">
                        <div class="pull-right form-inline">       
                            <div class="btn-group">
                                <button type="button" class="btn btn-success" id="filtros">
                                   Filtros
                                 </button>
                            </div>             
                        </div>
                        <h3>Consulta de citas</h3>
                    </div>    
                    <div id="wrapper-listado"></div>
                        
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
                	
                    <form name="filtros_listado" id="filtros-listado">
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
                      <div class="col-xs-12 col-sm-6 col-md-6">
                        <label for="especialista" class="control-label">#Documento cliente</label>
                        <input type"text" name="numero_documento" id="numero_documento" class="form-control" value="">
                      </div>  
                        <div class="col-xs-12 col-sm-6 col-md-6">
                          <label for="especialista" class="control-label">Código</label>
                          <input type"text" name="codigo" id="codigo" class="form-control" value="">
                        </div>
                      </div>                      
                      <br>
                     
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
                     	<br>           
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
         
                 
                       
        </div><!--fin container fluid-->    
    </div><!--fin contenedor-->     		
       
    
               
            
 
          
            

<link rel="stylesheet" href="<?php echo $base_url;?>/<?php echo drupal_get_path('theme', 'bootstrap');?>/css/overrides.css">
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/underscore-min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo $base_url;?>/<?php echo $path;?>/theme/js/jquery.validate.min.js"></script>


<script type="text/javascript">
	(function($){	

			// se define la variable que trae la configuracion para la personalizacion del calendario,
			var DSA=Drupal.settings.agendamiento_vars;	
			
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
				
				var datastring = $("#agendamiento-consulta-eventos").serialize(); 
				
				jQuery.ajax({
					url: Drupal.settings.base_url +'/agendamiento/calendario/consulta/listado',
					
					data: datastring,
					type: 'POST',
					dataType: 'json',
					success: function(data){																								
							$("#wrapper-listado").html(data.html);
							$('#Modal-filter').modal('hide');	
							//Todo este proceso se ejecuta despues del retorno de la configuracion del usuario	
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus + errorThrown); //Better diagnostics
					}
				});	
						
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
			   
   		
		$("#wrapper-listado").on("click","#enlace-eventoto",function(e){
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
		
		
		$("#filtros").on("click",function(e){
			$('#Modal-filter').modal('show');		
		});
		
		
	}(jQuery));
</script>