<?php

/**
 * @file
 * Archivo para configuracion del modulo de PQRS.
 */

/**
 * Formulario que se ejecuta en el acceso de la configuracion
 *
 * @return form
 */


function agendamiento_festivos_settings() {
	
	$form['festivos'] = array(
		'#type' => 'fieldset',
		'#title' => t('Festivos Fijos'),
		'#collapsible' => TRUE, 
		'#collapsed' => FALSE,
	  );		
	$form['festivos']['festivos_fijos'] = array(
		'#type' => 'textarea',
		'#title' => t('Dias Festivos Fijos'),
		'#default_value' => variable_get('festivos_fijos', ''),
		'#width' => 40,
		'#height' => 10,
		'#description' => t("Ingrese por cada linea el dia festivo que es fijo para todos los años, ejemplo: 12/25/*. De esta forma siempre el 25 de dicimebre sera festivo, sin importar el año"),
	  ); 
	  
	$form['festivos']['festivos_variables'] = array(
		'#type' => 'textarea',
		'#title' => t('Festivos Variables'),
		'#default_value' => variable_get('festivos_variables', ''),
		'#width' => 40,
		'#height' => 10,
		'#description' => t("Ingrese por cada linea el dia festivo variable en formato MM/DD/YYYY"),
	  );   	


  return system_settings_form($form);
}