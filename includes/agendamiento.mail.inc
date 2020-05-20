<?php

/**
 * @file
 * Archivo con funcionalidades de envio de correo.
 */
 
 function _agendamiento_send_mail($data){
	 
	$message["To"]=$data["To"];						// A quien va dirigido el correo																			
	$message["ToName"]=$data["ToName"];				// Nombre del propietario del correo	
	$message["Subject"]=$data["Subject"];	        // Asunto
	$message["Body"]=$data["Body"];					// Mensaje completo, incluido todo el codigo HTML 
	$message["WithAttach"]=$data["WithAttach"];		// Mensaje completo, incluido todo el codigo HTML 
	
	if($data["WithAttach"]){							//Evalua si el correo solicita un attach	
		$message["Attach"]=$data["Attach"];				// Ruta del archivo que se Adjunta, con el nombre del archivo
		$message["AttachName"]=$data["AttachName"];		// Nombre que aparecera en el archivo Adjunto
		$message["AttachBase"]=$data["AttachBase"];		// Base usada para enviar el archivo
		$message["AttachType"]=$AttachType["AttachBase"];// Tipo de archivo o Mime a utilizar en el adjunto					
	}
	
	$path = drupal_get_path('module', 'atenea');
    require_once "$path/includes/atenea.mail.inc";	
	
	$return=_atenea_send_mail($message);
	return $return;
 }
 
/**
 * @function
 * Funcion que envia correos a los usuarios indicados
 */
  
 function _agendamiento_speciality_mail($data){
	
	if(isset($data["usuarios"])){
		foreach($data["usuarios"] as $usuario){	
			$user_data = user_load($usuario); 
				
			 $message=array( 
				"To"=>$user_data->mail, 	// A quien va dirigido el correo		
				//"To"=>"mackpipe@gmail.com", 	
				//"To"=>"chavesinho07@gmail.com",	
				//"To"=>"lideres.alpina@interactivo.com.co",															
				"ToName"=>$user_data->field_alusno[LANGUAGE_NONE][0]['value'].' '.$user_data->field_alusap[LANGUAGE_NONE][0]['value'],					// Nombre del propietario del correo	
				"Subject"=>"Cita agendada",	        	// Asunto
				"Body"=>_agendamiento_speciality_html_mail($data),	// Mensaje completo, incluido todo el codigo HTML 					
				"WithAttach"=>false,						//Indica si el correo tendra un Archivo Adjunto
				);	
					
			_agendamiento_send_mail($message);	
		}
	}//Fin if de usuarios  
	
	if(isset($data["clientes"])){
		foreach($data["clientes"] as $cliente){		
			 $message=array( 
				"To"=>$cliente["mail"], 	// A quien va dirigido el correo		
				//"To"=>"mackpipe@gmail.com", 	
				//"To"=>"wilson.chaves@interactivo.com.co",	
				//"To"=>"lideres.alpina@interactivo.com.co",															
				"ToName"=>$cliente["nombre_cliente"],					// Nombre del propietario del correo	
				"Subject"=>"Cita solicitada",	        	// Asunto
				"Body"=>_agendamiento_speciality_html_mail($data),	// Mensaje completo, incluido todo el codigo HTML 					
				"WithAttach"=>false,						//Indica si el correo tendra un Archivo Adjunto
				);	
					
			_agendamiento_send_mail($message);	
		}
	}//Fin if de clientes
 }
 
/**
 * @function
 * Funcion que construye el html que va a incluirse en el mail en la opcion Body, estafuncion
 * hace el llamado a las funciones que construyen la cebecera, el cuertopo y el pie del correo,
 * No hay necesidad de modificarla, ya que el objetivo es mantener una estrucutra sintactica uniforme.
 * y esta funcion retorna esta estructura 
 */
function _agendamiento_speciality_html_mail($data){
	$output =_agendamiento_speciality_html_mail_body($data);
	return $output;	 
 }
 
 function _agendamiento_speciality_html_mail_header(){
	$path = drupal_get_path('module', 'atenea');
	require_once "$path/includes/atenea.mail.inc"; 
	$output=_atenea_html_mail_header();	
	return $output;	 
 }

 function _agendamiento_speciality_html_mail_body($data){
	global $base_url;
	$datos=_agendamiento_speciality_get_data_mail($data);
	
	$output = theme('agendamiento_mail_especialista',array('datos' => $datos)); 
	return $output;	
 }

 function _agendamiento_speciality_html_mail_footer(){
	 
	$path = drupal_get_path('module', 'atenea');
	require_once "$path/includes/atenea.mail.inc"; 
	$output=_atenea_html_mail_footer();	
	return $output;	 
 }

function _agendamiento_speciality_get_data_mail($data){
	global $user,$base_url;
	
	$path = drupal_get_path('module', 'agendamiento');
	require_once "$path/includes/agendamiento.db.inc";
	$datos["agendamiento_id"]=$data["agendamiento_id"];
	$datos["base_url"]=$base_url; 
	
	$resultado=_agendamiento_get_evento_datos($datos);
	
	return $resultado;
}