<?php

/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_hoy(){	
	global $user;
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";

	drupal_add_css($path.'/theme/css/agendamiento.css');
	
	
	$user_data = user_load($user->uid);
	$id_aplicacion=_agendamiento_get_aplicacion_current_user($user_data);
	$id_servicio=_agendamiento_get_servicio_current_user($user_data);
	
	$datos=array();
	$datos["id_aplicacion"]=$id_aplicacion;
	$datos["id_servicio"]=$id_servicio;
	$datos["id_especialista"]=$user->uid;
	$datos["id_especialidad"]=isset($user_data->field_agespc[LANGUAGE_NONE])?$user_data->field_agespc[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_sede"]=isset($user_data->field_agsede[LANGUAGE_NONE])?$user_data->field_agsede[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_ciudad"]=isset($user_data->field_ciudad[LANGUAGE_NONE])?$user_data->field_ciudad[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_depto"]=isset($user_data->field_depto[LANGUAGE_NONE])?$user_data->field_depto[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_pais"]=isset($user_data->field_pais[LANGUAGE_NONE])?$user_data->field_pais[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_estado"]=1;//se desea solo ver las citas activas
	$datos["inicio"]=date("m-d-Y")."00:00";
	$datos["fin"]=date("m-d-Y")."23:59";
	
	$resultado=_agendamiento_db_get_evento_hora($datos);
	
	$output = theme('agendamiento_block_hoy',array('datos' => $resultado)); 
	return $output;
}

/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_manana(){
	global $user;
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";
		
	drupal_add_css($path.'/theme/css/agendamiento.css');	
		
	$user_data = user_load($user->uid);
	$id_aplicacion=_agendamiento_get_aplicacion_current_user($user_data);
	$id_servicio=_agendamiento_get_servicio_current_user($user_data);
	
	$datos=array();
	$datos["id_aplicacion"]=$id_aplicacion;
	$datos["id_servicio"]=$id_servicio;
	$datos["id_especialista"]=$user->uid;
	$datos["id_especialidad"]=isset($user_data->field_agespc[LANGUAGE_NONE])?$user_data->field_agespc[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_sede"]=isset($user_data->field_agsede[LANGUAGE_NONE])?$user_data->field_agsede[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_ciudad"]=isset($user_data->field_ciudad[LANGUAGE_NONE])?$user_data->field_ciudad[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_depto"]=isset($user_data->field_depto[LANGUAGE_NONE])?$user_data->field_depto[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_pais"]=isset($user_data->field_pais[LANGUAGE_NONE])?$user_data->field_pais[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_estado"]=1;//se desea solo ver las citas activas
	$datos["inicio"] = date('m-d-Y 00:00', strtotime('+1 day')) ;
	$datos["fin"] = date('m-d-Y 23:59', strtotime('+1 day')) ;
	
	$resultado=_agendamiento_db_get_evento_hora($datos);
	
	$output = theme('agendamiento_block_manana',array('datos' => $resultado)); 
	return $output;
}

/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_resumen_estado(){
	global $user;
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";
		
	drupal_add_css($path.'/theme/css/agendamiento.css');	
		
	$user_data = user_load($user->uid);
	$id_aplicacion=_agendamiento_get_aplicacion_current_user($user_data);
	$id_servicio=_agendamiento_get_servicio_current_user($user_data);
	
	$datos=array();
	$datos["id_aplicacion"]=$id_aplicacion;
	$datos["id_servicio"]=$id_servicio;
	$datos["id_especialista"]=$user->uid;
	$datos["id_especialidad"]=isset($user_data->field_agespc[LANGUAGE_NONE])?$user_data->field_agespc[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_sede"]=isset($user_data->field_agsede[LANGUAGE_NONE])?$user_data->field_agsede[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_ciudad"]=isset($user_data->field_ciudad[LANGUAGE_NONE])?$user_data->field_ciudad[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_depto"]=isset($user_data->field_depto[LANGUAGE_NONE])?$user_data->field_depto[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_pais"]=isset($user_data->field_pais[LANGUAGE_NONE])?$user_data->field_pais[LANGUAGE_NONE][0]["tid"]:0;
	$datos["inicio"] = date('m-d-Y 00:00', strtotime('+1 day')) ;
	$datos["fin"] = date('m-d-Y 23:59', strtotime('+1 day')) ;
	
	$resultado=_agendamiento_db_get_evento_estado($datos);
		
	$output = theme('agendamiento_block_resumen-estado',array('datos' => $resultado)); 
	//$output .= theme('agendamiento_block_flot',array('datos' => $resultado)); 
	return $output;
}

/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_resumen_tipo(){
	global $user;
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";
		
	drupal_add_css($path.'/theme/css/agendamiento.css');	
		
	$user_data = user_load($user->uid);
	$id_aplicacion=_agendamiento_get_aplicacion_current_user($user_data);
	$id_servicio=_agendamiento_get_servicio_current_user($user_data);
	
	$datos=array();
	$datos["id_aplicacion"]=$id_aplicacion;
	$datos["id_servicio"]=$id_servicio;
	$datos["id_especialista"]=$user->uid;
	$datos["id_especialidad"]=isset($user_data->field_agespc[LANGUAGE_NONE])?$user_data->field_agespc[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_sede"]=isset($user_data->field_agsede[LANGUAGE_NONE])?$user_data->field_agsede[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_ciudad"]=isset($user_data->field_ciudad[LANGUAGE_NONE])?$user_data->field_ciudad[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_depto"]=isset($user_data->field_depto[LANGUAGE_NONE])?$user_data->field_depto[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_pais"]=isset($user_data->field_pais[LANGUAGE_NONE])?$user_data->field_pais[LANGUAGE_NONE][0]["tid"]:0;
	$datos["inicio"] = date('m-d-Y 00:00', strtotime('+1 day')) ;
	$datos["fin"] = date('m-d-Y 23:59', strtotime('+1 day')) ;
	
	$resultado=_agendamiento_db_get_evento_tipo($datos);
		
	$output = theme('agendamiento_block_resumen-tipo',array('datos' => $resultado)); 
	return $output;
}

/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_resumen_medio(){
	global $user;
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";
		
	drupal_add_css($path.'/theme/css/agendamiento.css');	
		
	$user_data = user_load($user->uid);
	$id_aplicacion=_agendamiento_get_aplicacion_current_user($user_data);
	$id_servicio=_agendamiento_get_servicio_current_user($user_data);
	
	$datos=array();
	$datos["id_aplicacion"]=$id_aplicacion;
	$datos["id_servicio"]=$id_servicio;
	$datos["id_especialista"]=$user->uid;
	$datos["id_especialidad"]=isset($user_data->field_agespc[LANGUAGE_NONE])?$user_data->field_agespc[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_sede"]=isset($user_data->field_agsede[LANGUAGE_NONE])?$user_data->field_agsede[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_ciudad"]=isset($user_data->field_ciudad[LANGUAGE_NONE])?$user_data->field_ciudad[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_depto"]=isset($user_data->field_depto[LANGUAGE_NONE])?$user_data->field_depto[LANGUAGE_NONE][0]["tid"]:0;
	$datos["id_pais"]=isset($user_data->field_pais[LANGUAGE_NONE])?$user_data->field_pais[LANGUAGE_NONE][0]["tid"]:0;
	$datos["inicio"] = date('m-d-Y 00:00', strtotime('+1 day')) ;
	$datos["fin"] = date('m-d-Y 23:59', strtotime('+1 day')) ;
	
	$resultado=_agendamiento_db_get_evento_medio($datos);
				
	$output = theme('agendamiento_block_resumen-medio',array('datos' => $resultado)); 
	return $output;
}


/**
  * _agendamiento_get_children_jerarquia
  * obtiene la jerarquia de una array, teniendo en cuenta la recursividad de los hijos.
**/
function _agendamiento_get_block_actual(){	
	$path = drupal_get_path('module', 'agendamiento');
	drupal_add_css($path.'/theme/css/agendamiento.css');
		 
	$output = theme('agendamiento_block_actual'); 
	return $output;
}