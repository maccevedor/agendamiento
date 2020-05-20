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

//Sede 
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

?>

<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="height:100%;margin:0;padding:0;width:100%;border-collapse:collapse;background-color:#f5f5f5">
            	<tbody><tr>
                	<td align="center" valign="top" style="height:100%;margin:0;padding:0;width:100%;padding-top:40px;padding-bottom:40px">
                    	
                        
                    	<table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:separate;background-color:#ffffff;border:1px solid #dddddd">

							
							<tbody><tr>
                            	<td align="center" valign="bottom">
                                	
                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                    	<tbody><tr>
                                        	<td align="center" valign="bottom">
                                            	
                                            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                                                	<tbody><tr>
                                                    	<td valign="bottom" width="600" style="padding-top:20px;padding-right:20px;padding-left:20px">


                                                            
                                                            
                                                            <table align="Left" border="0" cellpadding="0" cellspacing="0" width="260" style="border-collapse:collapse">
                                                                <tbody><tr>
                                                                    <td valign="bottom" style="color:#444;font-weight:600;letter-spacing:-1px;vertical-align:bottom;text-align:left">
                                                                        <h3 style="margin:0;padding:0;color:#53585f;font-family:Helvetica;font-size:25px;line-height:100%;text-align:left"><span class="il">Atenea</span> agendamiento</h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                            


                                                            
                                                            
                                                            


                                                        </td>
                                                    </tr>
                                                    
                                                </tbody></table>
                                                <hr width="95%" style="display:block;min-height:1px;border:0;border-top:1px solid #ccc;padding:0;width:560px">
                                                
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            


                            							
							<tr>
                            	<td align="center" valign="top">
                                	
                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                    	<tbody><tr>
                                        	<td align="center" valign="top">
                                            	
                                            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                                                	<tbody><tr>
                                                    	<td align="center" valign="top" width="600" style="padding-top:20px;padding-right:20px;padding-left:20px">


                                                            
                                                            
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                                                <tbody><tr>
                                                                    <td valign="top" style="padding-bottom:20px">
                                                                        <img width="560" style="max-width:560px;border:0;outline:none;text-decoration:none;min-height:auto">
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                            


                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                                
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            



                            
                            
							<tr>
                            	<td align="center" valign="top">
                                	
                                    
                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                    	<tbody><tr>
                                        	<td align="center" valign="top">
                                            	
                                                
                                            	<table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                                                	<tbody><tr>
                                                    	<td align="center" valign="top" width="600" style="padding-top:20px;padding-right:20px;padding-left:20px">


                                                            
                                                            
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                                                <tbody><tr>
                                                                    <td valign="top" style="color:#404040;font-family:Helvetica;font-size:16px;line-height:125%;text-align:left;padding-bottom:20px">
                                                                        <h1 style="margin:0;padding:0;color:#53585f;font-family:Helvetica;font-size:30px;line-height:100%;text-align:center;margin-bottom:0.8em;text-transform:uppercase">Nueva cita</h1>
																		<p style="margin:1em 0;color:#53585f;font-family:Helvetica;text-align:left"><strong><?php echo $datos[0]['nombre'];?>&nbsp;<?php echo $datos[0]['apellido'];?></strong> acaba de solicitar una cita con el especialista <strong><?php echo $especialista;?></strong>.</p>
																		<hr style="display:block;min-height:1px;border:0;border-top:1px solid #ccc;padding:0;width:560px">
																		<!--<p style="margin:1em 0;color:#53585f;font-family:Helvetica;text-align:left;font-size:20px;font-weight:400">El <span style="font-weight:600;color:#31708f">14-abr-2016</span> a las <span style="font-weight:600;color:#31708f">17:00</span>.</p>-->
                                                                        <p style="margin:1em 0;color:#53585f;font-family:Helvetica;text-align:left;font-size:20px;font-weight:400">En esta fecha y hora <span style="font-weight:600;color:#31708f"><?php echo $datos[0]['fecha_inicial'];?></span></p>
																		<hr style="display:block;min-height:1px;border:0;border-top:1px solid #ccc;padding:0;width:560px">
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                            


                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                                
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            


                            
                            <tr>
                                <td align="center" valign="top">
                                  <table border="0" cellpadding="10" cellspacing="0" width="95%" style="border-collapse:collapse;background-color:#ffffff;border:1px solid #dddddd;border-top:none;border-left:none;border-right:none;border-bottom:none;padding-top:130px">
                                      <tbody><tr>
                                          <th scope="col" valign="top" width="30%" style="background-color:#ffffff;color:#53585f;font-family:Helvetica;font-size:14px;font-weight:bold;line-height:150%;text-align:left">
                                              Detalles de la cita:
                                          </th>
                                      </tr>
                                      <tr>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">
                                              Cliente:
                                          </td>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">
												<?php echo $datos[0]['nombre'];?>&nbsp;<?php echo $datos[0]['apellido'];?>
                                          </td>
                                      </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Documento:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $list_tipos_documento[$datos[0]['tipo_documento_id']];?> - <?php echo $datos[0]['numero_documento'];?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Correo electr&oacute;nico: </td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><a href="mailto:<?php echo $datos[0]['email'];?>" target="_blank"><?php echo $datos[0]['email'];?></a></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Ciudad:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $ciudad_cita;?> - <?php echo $depto_cita;?> - <?php echo $pais_cita;?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Sede:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $sede;?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Direcci&oacute;n:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Calle 6C#70b-36</td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Tel&eacute;fono fijo: </td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['telefono'];?> Ext. <?php echo $datos[0]['extension'];?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Tel&eacute;fono celular:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['celular'];?></td>
									    </tr>
									  <tr>
									    <td colspan="2" valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><hr></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">C&oacute;digo cita:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['codigo'];?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Fecha y hora:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['fecha_inicial'];?></td>
									    </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Medio atenci&oacute;n</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $medio_atencion;?></td>
									    </tr>
									  <tr>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">
                                              Duraci&oacute;n:
                                          </td>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">
											20 minutos
                                          </td>
                                      </tr>
									  <tr>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">Asunto:</td>
									    <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['asunto'];?></td>
									    </tr>
									  <tr>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left">
                                              Notas:
                                          </td>
                                          <td valign="top" style="border-top:1px solid #dddddd;border-bottom:0;color:#53585f;font-family:Helvetica;font-size:12px;font-weight:400;line-height:150%;text-align:left"><?php echo $datos[0]['descripcion'];?>
											  
                                          </td>
                                      </tr>
							      </tbody></table>
                                </td>
                            </tr>
                            

                            

                            <tr>
                            	<td align="center" valign="top">
                                    
                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                    	<tbody><tr>
                                        	<td align="center" valign="top" style="padding-top:3em;padding-bottom:1em">
                                                                                           
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                                                    <tbody><tr>
                                                      <td align="center" valign="middle" style="padding-top:20px;padding-right:20px;padding-left:20px">
                                                          <div style="font-size:12px">
                                                            <p style="margin:1em 0;color:#53585f;font-family:Helvetica;text-align:justify">                                                                Protecci&oacute;n de Datos Con la expedici&oacute;n de la ley 1581 de 2012 y el Decreto 1377 de 2013, se desarrolla el principio constitucional que tienen todas las personas a conocer, actualizar y rectificar todo tipo de informaci&oacute;n recogida o, que haya sido objeto de tratamiento de datos personales en bancos o bases de datos y, en archivos de entidades p&uacute;blicas y/o privadas.En El Evento En Que Usted Considere Que Nuestra Empresa ha dado uso inadecuado o contrario al autorizado y a las leyes aplicables, podr&aacute; contactarnos a trav&eacute;s de una comunicaci&oacute;n motivada dirigida a la Gerencia general de la Compa&ntilde;&iacute;a a trav&eacute;s del correo contactenos@interactivo.com.co    
                                                              </p>
                                                          </div>
                                                        </td>
                                                    </tr>   
                                                </tbody></table>                                            
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            

                        </tbody></table>
                    	
                    </td>
                </tr>
                
            </tbody></table>