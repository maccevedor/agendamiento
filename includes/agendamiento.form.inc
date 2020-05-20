<?php

/**
 * @file
 * Archivo principal del modulo agendamiento para la construccion de todos los formularios.
 */

function _agendamiento_add_evento($form, &$form_state) {
	global $base_url;
	
	$path = drupal_get_path('module', 'agendamiento');
    require_once "$path/agendamiento.include";
	
	_agendamiento_evento_set_variables_nuevo();	//incluye todos los archivos js y css, necesarios para su funcionamiento
	
	$textos=_agendamiento_get_textos();
	$list_especialidades=_agendamiento_get_especialidades();	
	$list_especialistas=array();
	$list_paises=array();
	$list_departamentos=array();
	$list_ciudades=array();
	$list_sedes=array();
	$list_medios_atencion=array();
	$list_motivos_cita=_agendamiento_get_motivos_cita();	
	$list_estados=_agendamiento_get_estados();
	$list_tipos_documento=_agendamiento_get_tipos_documento();	
	 
	$valores_default=drupal_get_query_parameters();	
	
	$form['datos_basicos'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Datos básicos'),
	);
	
	$form['datos_evento'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Datos cita'),
	);	
	
	
	$form['datos_evento']['fecha_desde'] = array(
 		'#title' => t('Fecha/Hora cita'),		
 		'#type' => 'textfield',
 		'#description' => t('Fecha y hora de la cita / evento'),
		//'#default_value'=>isset($fecha_desde)?$fecha_desde:'',
		'#attributes' => array('readonly' => 'readonly'),
 	);
	
	$form['datos_evento']['fecha_hasta'] = array(
 		'#title' => t('Va hasta'),
 		'#type' => 'textfield',
 		'#description' => t('Fecha y hora fin de la cita / evento'),
		//'#default_value'=>isset($valores_default["fecha_hasta"])?$valores_default["fecha_hasta"]:'',
		'#attributes' => array('readonly' => 'readonly'),
 	);	
	
	$form['datos_evento']['especialidad'] = array(
		'#type' => 'select',
		'#title' => t('Especialidad'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_especialidades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la especialidad que requiere'),
	);
	
	$form['datos_evento']['pais'] = array(
		'#type' => 'select',
		'#title' => t('Pais'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '',  
		'#options' => $list_paises,
		//'#required' => TRUE,
		'#description' => t('Seleccione el pais'),
	);
		
	$form['datos_evento']['depto'] = array(
		'#type' => 'select',
		'#title' => t('Departamento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_sedes,
		//'#required' => TRUE,
		'#description' => t('Seleccione el departamento'),
	);
	
	$form['datos_evento']['ciudad'] = array(
		'#type' => 'select',
		'#title' => t('Ciudad'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_ciudades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la ciudad'),
	);
	
	$form['datos_evento']['sede'] = array(
		'#type' => 'select',
		'#title' => t('Sede'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_sedes,
		//'#required' => TRUE,
		'#description' => t('Seleccione la sede'),
	);	
	
	$form['datos_evento']['especialista'] = array(
		'#type' => 'select',
		'#title' => t('Especialista'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_especialistas,
		//'#required' => TRUE,
		'#description' => t('Seleccione el especialista'),
	);

	$form['datos_evento']['medio_atencion'] = array(
		'#type' => 'select',
		'#title' => t('Medio atención'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_medios_atencion,
		//'#required' => TRUE,
		'#description' => t('Seleccione el medio de atención'),
	);


	$form['datos_evento']['asunto'] = array(
		'#type' => 'textfield',
		'#title' => t('Asunto'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 50,
		'#description' => t('Ingrese el asunto de la cita'),
	);
	
	$form['datos_evento']['motivo_cita'] = array(
		'#type' => 'select',
		'#title' => t('Motivo cita'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_motivos_cita,
		//'#required' => TRUE,
		'#description' => t('Seleccione el motivo de cita'),
	);
	
	$form['datos_evento']['descripcion'] = array(
		'#type' => 'textarea',
		'#title' => t('Breve descripción de la Cita'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 480,
		'#description' => t('Ingrese una breve descripción de la cita'),
	);
	
	$form['datos_evento']['estado'] = array(
		'#type' => 'hidden', 
		'#value' => 1,
	);
	
	$form['datos_basicos']['cliente'] = array(
		'#type' => 'hidden', 
		'#value' => 0,
	);
	
	$form['datos_basicos']['tipo_documento'] = array(
		'#type' => 'select',
		'#title' => t('Tipo documento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#description' => t('Seleccione el tipo de documento'),
	);

	$form['datos_basicos']['numero_documento'] = array(
		'#type' => 'textfield',
		'#title' => t('# Documento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 15,
		'#description' => t('Ingrese el número de documento'),
	);

	$form['datos_basicos']['nombres_cliente'] = array(
		'#type' => 'textfield',
		'#title' => t('Nombres'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 30,
		'#description' => t('Ingrese el nombre'),
	);

	$form['datos_basicos']['apellidos_cliente'] = array(
		'#type' => 'textfield',
		'#title' => t('Apellidos'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE, 
		'#maxlength'=> 30,
		'#description' => t('Ingrese el apellido'),
	);

	$form['datos_basicos']['fecha_nacimiento'] = array(
		'#type' => 'textfield',
		'#title' => t('Fecha nacimiento'),
		//'#required' => TRUE,
		'#description' => t('Seleccione la fecha de nacimiento'),
		'#attributes' => array('readonly' => 'readonly'),
	);
	
	$form['datos_basicos']['telefono_fijo'] = array(
		'#type' => 'textfield',
		'#title' => t('Teléfono fijo'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 7,
		'#description' => t('Ingrese el teléfono fijo'),
	);

	$form['datos_basicos']['extension_fijo'] = array(
		'#type' => 'textfield',
		'#title' => t('Extensión'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 5,
		'#description' => t('Ingrese extensión si es necesario'),
	);
	
	$form['datos_basicos']['telefono_celular'] = array(
		'#type' => 'textfield',
		'#title' => t('Teléfono celular'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 10,
		'#description' => t('Ingrese el teléfono celular'),
	);

	$form['datos_basicos']['correo_electronico'] = array(
		'#type' => 'textfield',
		'#title' => t('Correo electrónico'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#description' => t('Ingrese el correo electrónico'),
	);	
	
	$form['datos_basicos']['pais_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Pais residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_paises,
		//'#required' => TRUE,
		'#description' => t('Seleccione el pais'),
	);
		
	$form['datos_basicos']['depto_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Departamento residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_departamentos,
		//'#required' => TRUE,
		'#description' => t('Seleccione el departamento'),
	);
	
	$form['datos_basicos']['ciudad_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Ciudad residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_ciudades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la ciudad'),
	);
	
	$form['datos_basicos']['direccion'] = array(
		'#type' => 'textfield',
		'#title' => t('Dirección'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 50,
		'#description' => t('Ingrese la dirección del lugar de residencia'),
	);
	
	
	$form['datos_basicos']['enviar'] = array(
		'#type' => 'submit',
		'#value' => t($textos["crear_evento"]),
		'#attributes' => array('class' => array('btn btn-info'))
	);
	
	$form["#attributes"]["name"]="agendamiento_node_form";//le pone el atributo name al formulario para despues poderlo usar para el submit
 	$form["#attributes"]["id"]="agendamiento-node-form";//le pone el atributo name al formulario para despues poderlo usar para el submit
	
	return $form;
}


/**
 * @file
 * Archivo principal del modulo agendamiento para la construccion de todos los formularios.
 */

function _agendamiento_reagendar_evento($form, &$form_state) {
	global $base_url;
	
	$path = drupal_get_path('module', 'agendamiento');
    require_once "$path/agendamiento.include";
	
	_agendamiento_evento_set_variables_reagendar();	//incluye todos los archivos js y css, necesarios para su funcionamiento
	
	$textos=_agendamiento_get_textos();
	
	$list_especialidades=_agendamiento_get_especialidades();	
	$list_especialistas=array();
	$list_paises=array();
	$list_departamentos=array();
	$list_ciudades=array();
	$list_sedes=array();
	$list_medios_atencion=array();
	
	$list_estados=_agendamiento_get_estados();
	$list_tipos_documento=_agendamiento_get_tipos_documento();	
	 
	$valores_default=drupal_get_query_parameters();	
	
	$form['datos_basicos'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Datos básicos'),
	);
	
	$form['datos_evento'] = array(
		'#type' => 'fieldset', 
		'#title' => t('Datos cita'),
	);	
	
	
	$form['datos_evento']['fecha_desde'] = array(
 		'#title' => t('Fecha/Hora cita'),		
 		'#type' => 'textfield',
 		'#description' => t('Fecha y hora de la cita / evento'),
		//'#default_value'=>isset($fecha_desde)?$fecha_desde:'',
		'#attributes' => array('readonly' => 'readonly'),
 	);
	
	$form['datos_evento']['fecha_hasta'] = array(
 		'#title' => t('Va hasta'),
 		'#type' => 'textfield',
 		'#description' => t('Fecha y hora fin de la cita / evento'),
		//'#default_value'=>isset($valores_default["fecha_hasta"])?$valores_default["fecha_hasta"]:'',
		'#attributes' => array('readonly' => 'readonly'),
 	);	
	
	$form['datos_evento']['especialidad'] = array(
		'#type' => 'select',
		'#title' => t('Especialidad'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_especialidades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la especialidad que requiere'),
	);
	
	$form['datos_evento']['pais'] = array(
		'#type' => 'select',
		'#title' => t('Pais'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '',  
		'#options' => $list_paises,
		//'#required' => TRUE,
		'#description' => t('Seleccione el pais'),
	);
		
	$form['datos_evento']['depto'] = array(
		'#type' => 'select',
		'#title' => t('Departamento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_sedes,
		//'#required' => TRUE,
		'#description' => t('Seleccione el departamento'),
	);
	
	$form['datos_evento']['ciudad'] = array(
		'#type' => 'select',
		'#title' => t('Ciudad'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_ciudades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la ciudad'),
	);
	
	$form['datos_evento']['sede'] = array(
		'#type' => 'select',
		'#title' => t('Sede'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_sedes,
		//'#required' => TRUE,
		'#description' => t('Seleccione la sede'),
	);	
	
	$form['datos_evento']['especialista'] = array(
		'#type' => 'select',
		'#title' => t('Especialista'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_especialistas,
		//'#required' => TRUE,
		'#description' => t('Seleccione el especialista'),
	);

	$form['datos_evento']['medio_atencion'] = array(
		'#type' => 'select',
		'#title' => t('Medio atención'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_medios_atencion,
		//'#required' => TRUE,
		'#description' => t('Seleccione el medio de atención'),
	);


	$form['datos_evento']['asunto'] = array(
		'#type' => 'textfield',
		'#title' => t('Asunto'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 50,
		'#description' => t('Ingrese el asunto de la cita'),
	);
	
	$form['datos_evento']['descripcion'] = array(
		'#type' => 'textarea',
		'#title' => t('Breve descripción de la Cita'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 480,
		'#description' => t('Ingrese una breve descripción de la cita'),
	);
	
	$form['datos_evento']['estado'] = array(
		'#type' => 'hidden', 
		'#value' => 1,
	);
	
	$form['datos_basicos']['cliente'] = array(
		'#type' => 'hidden', 
		'#value' => 0,
	);
	
	$form['datos_basicos']['tipo_documento'] = array(
		'#type' => 'select',
		'#title' => t('Tipo documento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#description' => t('Seleccione el tipo de documento'),
	);

	$form['datos_basicos']['numero_documento'] = array(
		'#type' => 'textfield',
		'#title' => t('# Documento'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 15,
		'#description' => t('Ingrese el número de documento'),
	);

	$form['datos_basicos']['nombres_cliente'] = array(
		'#type' => 'textfield',
		'#title' => t('Nombres'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 30,
		'#description' => t('Ingrese el nombre'),
	);

	$form['datos_basicos']['apellidos_cliente'] = array(
		'#type' => 'textfield',
		'#title' => t('Apellidos'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 30,
		'#description' => t('Ingrese el apellido'),
	);

	$form['datos_basicos']['fecha_nacimiento'] = array(
		'#type' => 'textfield',
		'#title' => t('Fecha nacimiento'),
		//'#required' => TRUE,
		'#description' => t('Seleccione la fecha de nacimiento'),
	);
	
	$form['datos_basicos']['telefono_fijo'] = array(
		'#type' => 'textfield',
		'#title' => t('Teléfono fijo'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 7,
		'#description' => t('Ingrese el teléfono fijo'),
	);

	$form['datos_basicos']['extension_fijo'] = array(
		'#type' => 'textfield',
		'#title' => t('Extensión'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 5,
		'#description' => t('Ingrese extensión si es necesario'),
	);
	
	$form['datos_basicos']['telefono_celular'] = array(
		'#type' => 'textfield',
		'#title' => t('Teléfono celular'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 10,
		'#description' => t('Ingrese el teléfono celular'),
	);

	$form['datos_basicos']['correo_electronico'] = array(
		'#type' => 'textfield',
		'#title' => t('Correo electrónico'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#description' => t('Ingrese el correo electrónico'),
	);	
	
	$form['datos_basicos']['pais_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Pais residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_paises,
		//'#required' => TRUE,
		'#description' => t('Seleccione el pais'),
	);
		
	$form['datos_basicos']['depto_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Departamento residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_departamentos,
		//'#required' => TRUE,
		'#description' => t('Seleccione el departamento'),
	);
	
	$form['datos_basicos']['ciudad_cliente'] = array(
		'#type' => 'select',
		'#title' => t('Ciudad residencia'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		'#options' => $list_ciudades,
		//'#required' => TRUE,
		'#description' => t('Seleccione la ciudad'),
	);
	
	$form['datos_basicos']['direccion'] = array(
		'#type' => 'textfield',
		'#title' => t('Dirección'),
		//'#default_value' => isset($valores_default["especialidad"]) ? $valores_default["especialidad"]: '', 
		//'#options' => $list_tipos_documento,
		//'#required' => TRUE,
		'#maxlength'=> 50,
		'#description' => t('Ingrese la dirección del lugar de residencia'),
	);
	
	
	$form['datos_basicos']['enviar'] = array(
		'#type' => 'submit',
		'#value' => t($textos["crear_reagendar"]),
		'#attributes' => array('class' => array('btn btn-primary'))
	);
	
	$form["#attributes"]["name"]="agendamiento_node_form";//le pone el atributo name al formulario para despues poderlo usar para el submit
 	$form["#attributes"]["id"]="agendamiento-node-form";//le pone el atributo name al formulario para despues poderlo usar para el submit
	
	return $form;
}



function _agendamiento_get_consulta_eventos($form, &$form_state){
	global $base_url;
	
	$path = drupal_get_path('module', 'agendamiento');
    require_once "$path/agendamiento.include";
	
	_agendamiento_evento_set_variables_listado();
	
	$textos=_agendamiento_get_textos();
	$list_especialidades=_agendamiento_get_especialidades();	
	$list_especialistas=array();
	$list_paises=array();
	$list_departamentos=array();
	$list_ciudades=array();
	$list_sedes=array();
	$list_medios_atencion=array();
		
	$form["#attributes"]["name"]="agendamiento_consulta_eventos";//le pone el atributo name al formulario para despues poderlo usar para el submit
 	$form["#attributes"]["id"]="agendamiento-consulta-eventos";//le pone el atributo name al formulario para despues poderlo usar para el submit
	
	return $form;
}



function _agendamiento_evento_set_variables_nuevo(){
	global $base_url;
	$variables=_agendamiento_get_variables();//se cargan las variables de configuracion
	
	$variables["hora_exacta"]=0;
	$variables["fecha_hora_exacta"]="";
	if(arg(3)=="directo"){
		if(arg(4)){ $default_fecha_desde=str_replace("-","/",arg(4));}else{$default_fecha_desde='';}
		if(arg(5)){ $default_hora_desde=arg(5);}else{$default_hora_desde='';}	
		if(arg(6)){ $id_especialidad=arg(6);}else{$id_especialidad='_none';}	
		if(arg(7)){ $id_pais=arg(7);}else{$id_pais='_none';}	
		if(arg(8)){ $id_depto=arg(8);}else{$id_depto='_none';}	
		if(arg(9)){ $id_ciudad=arg(9);}else{$id_ciudad='_none';}	
		if(arg(10)){ $id_sede=arg(10);}else{$id_sede='_none';}	
		if(arg(11)){ $id_especialista=arg(11);}else{$id_especialista='_none';}	
		
		$variables["fecha_hora_exacta"] = date("m/d/Y", strtotime($default_fecha_desde))." ".$default_hora_desde;	
		$variables["hora_exacta"]=1;
		$variables["id_especialidad_exacta"] =$id_especialidad;
		$variables["id_pais_exacta"] =$id_pais;
		$variables["id_depto_exacta"] =$id_depto;
		$variables["id_ciudad_exacta"] =$id_ciudad;
		$variables["id_sede_exacta"] =$id_sede;
		$variables["id_especialista_exacta"] =$id_especialista;
		
	}
		
	_agendamiento_evento_get_script($variables);
}



function _agendamiento_evento_set_variables_reagendar(){
	global $base_url;
	$variables=_agendamiento_get_variables();//se cargan las variables de configuracion
	
	$variables["hora_exacta"]=0;
	$variables["fecha_hora_exacta"]="";

	if(arg(2)=="reagendar"){
		if(arg(3)){ $id_evento=arg(3);}else{$id_evento=0;}	
		if($id_evento!=0){
			$datos=array();
			/*$datos["id_aplicacion"]=$id_aplicacion;
			$datos["id_servicio"]=$id_servicio;*/
			$datos["agendamiento_id"]=$id_evento;
			$datos["base_url"]=$base_url; 

			$evento=_agendamiento_get_evento_datos($datos);

			//Fecha viene YYYY-MM-DD
			$fecha_desde_array=explode(" ",$evento[0]["fecha_inicial"]);
			$fecha_desde_only=explode("-",$fecha_desde_array[0]);
			$fecha_desde_convert=$fecha_desde_only[1]."/".$fecha_desde_only[2]."/".$fecha_desde_only[0]." ".$fecha_desde_array[1];
			
			$variables["fecha_hora_exacta"] = $fecha_desde_convert;	
			$variables["hora_exacta"]=1;
			$variables["id_especialidad_exacta"] =$evento[0]["especialidad_id"];
			$variables["id_pais_exacta"] =$evento[0]["pais_cita"];
			$variables["id_depto_exacta"] =$evento[0]["depto_cita"];
			$variables["id_ciudad_exacta"] =$evento[0]["ciudad_cita"];
			$variables["id_sede_exacta"] =$evento[0]["sede_id"];
			$variables["id_especialista_exacta"] =$evento[0]["especialista_id"];
			$variables["numero_documento_exacta"] =$evento[0]["numero_documento"];
			
			$variables["tipo_documento_exacta"] =$evento[0]["tipo_documento_id"];
			$variables["nombres_cliente_exacta"] =$evento[0]["nombre"];
			$variables["apellidos_cliente_exacta"] =$evento[0]["apellido"];
			$variables["telefono_fijo_exacta"] =$evento[0]["telefono"];
			$variables["extension_fijo_exacta"] =$evento[0]["extension"];
			$variables["telefono_celular_exacta"] =$evento[0]["celular"];
			$variables["fecha_nacimiento_exacta"] =$evento[0]["fecha_nacimiento"];
			$variables["correo_electronico_exacta"] =$evento[0]["email"];
			$variables["pais_cliente_exacta"] =$evento[0]["pais_cliente"];
			$variables["depto_cliente_exacta"] =$evento[0]["depto_cliente"];
			$variables["ciudad_cliente_exacta"] =$evento[0]["ciudad_cliente"];
			$variables["direccion_exacta"] =$evento[0]["direccion"];
			$variables["asunto_exacta"] ="Reagendado - ".$evento[0]["asunto"];
			$variables["agendamiento_id_exacta"] =$id_evento;
		}
		
	}
		
	_agendamiento_evento_get_script($variables);
}

function _agendamiento_evento_set_variables_listado(){
	global $base_url;
	$variables=_agendamiento_get_variables();//se cargan las variables de configuracion
		
	_agendamiento_evento_get_script($variables);
}


function _agendamiento_evento_get_script($variables){
	global $base_url;
	
	$path = drupal_get_path('module', 'agendamiento');
	$especialidades=_agendamiento_get_especialidades_calendario();
	$jerarquia=_agendamiento_get_jerarquia();//se carga la jeraquia de Pais, Departamento, Ciudad, Sede		
	
	drupal_add_js( array( 'agendamiento_path' => $path ), 'setting' );
	drupal_add_js( array( 'base_url' => $base_url ), 'setting' );
	drupal_add_js( array( 'agendamiento_vars' => $variables ), 'setting' );
	drupal_add_js( array( 'jerarquia' => $jerarquia ), 'setting' );
	drupal_add_js( array( 'especialidades' => $especialidades ), 'setting' );
	 
	drupal_add_css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css','external');
	drupal_add_css($path.'/theme/css/bootstrap-datetimepicker.css'); 
	drupal_add_css($path.'/theme/css/agendamiento.css'); 
	 
	drupal_add_js($path.'/theme/js/jquery.min.js');
	drupal_add_js($path.'/theme/js/moment.js');
	//drupal_add_js('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js','external');
	drupal_add_js($path.'/theme/js/locales/bootstrap-datetimepicker.es.js');
	drupal_add_js($path.'/theme/js/bootstrap-datetimepicker.min.js');
	drupal_add_js($path.'/theme/js/jquery.validate.min.js');
	drupal_add_js($path.'/theme/js/evento.js');	
}