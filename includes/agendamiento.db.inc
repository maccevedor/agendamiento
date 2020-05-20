<?php

/**
 * @file
 * Archivo de funciones generales que accesan a datos del modulo de Agendamiento.
 */

/* Obtiene el listado de terminos en jeraquia
 */
function _agendamiento_db_get_jerarquia($datos){           
 
 $result=db_query(" SELECT t.tid,t.name, 0 as padre
					FROM taxonomy_term_data t				 
					WHERE t.vid=221	  
					union					
					SELECT t.tid,t.name, p.FIELD_PAIS_TID as padre
					FROM taxonomy_term_data t		
					INNER JOIN field_data_field_pais p on t.tid=p.entity_id AND p.entity_type='taxonomy_term' AND p.bundle='departamento' 
					WHERE t.vid=222	  
					union					
					SELECT t.tid,t.name, p.FIELD_DEPTO_TID as padre
					FROM taxonomy_term_data t		
					INNER JOIN field_data_field_depto p on t.tid=p.entity_id AND p.entity_type='taxonomy_term' AND p.bundle='ciudad' 
					WHERE t.vid=241 
					union					
					SELECT t.tid,t.name, p.FIELD_CIUDAD_TID as padre
					FROM taxonomy_term_data t		
					INNER JOIN field_data_field_ciudad p on t.tid=p.entity_id AND p.entity_type='taxonomy_term' AND p.bundle='sede_agendamiento' 
					INNER JOIN field_data_field_app a on a.entity_id=t.tid AND a.FIELD_APP_TID=".$datos["id_aplicacion"]." and a.BUNDLE='sede_agendamiento'
                    INNER JOIN field_data_field_se s on s.entity_id=t.tid AND s.FIELD_SE_TID= ".$datos["id_servicio"]."  and s.BUNDLE='sede_agendamiento'
					WHERE t.vid=593   					
					ORDER BY 3,2");
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->tid;
  $data[$i]['nombre']=$record->name;
  $data[$i]['padre']=$record->padre;
  $i++;
 }
 return $data;
}


/* Obtiene el listado de terminos en jeraquia
 */
function _agendamiento_db_get_jerarquia_especialidad($datos){           
 
 $result=db_query(" SELECT t.tid,t.name, 0 as padre
					FROM taxonomy_term_data t
					INNER JOIN field_data_field_pais p on t.tid=p.field_pais_tid AND p.entity_type='taxonomy_term' AND p.bundle='departamento' 
					INNER JOIN field_data_field_depto d on p.entity_id=d.field_depto_tid AND d.entity_type='taxonomy_term' AND d.bundle='ciudad' 
					INNER JOIN field_data_field_ciudad c on d.entity_id=c.field_ciudad_tid AND c.entity_type='taxonomy_term' AND c.bundle='sede_agendamiento'
					INNER JOIN field_data_field_agsede e on c.entity_id=e.field_agsede_tid AND e.entity_type='taxonomy_term' AND e.bundle='especialidad_agendamiento'				 
					WHERE t.vid=221	
					AND e.entity_id=".$datos["id_especialidad"]."  
					union
					SELECT t.tid,t.name, p.FIELD_PAIS_TID as padre
					FROM taxonomy_term_data t		
					INNER JOIN field_data_field_pais p on t.tid=p.entity_id AND p.entity_type='taxonomy_term' AND p.bundle='departamento' 
					INNER JOIN field_data_field_depto d on t.tid=d.field_depto_tid AND d.entity_type='taxonomy_term' AND d.bundle='ciudad' 
					INNER JOIN field_data_field_ciudad c on d.entity_id=c.field_ciudad_tid AND c.entity_type='taxonomy_term' AND c.bundle='sede_agendamiento'
					INNER JOIN field_data_field_agsede e on c.entity_id=e.field_agsede_tid AND e.entity_type='taxonomy_term' AND e.bundle='especialidad_agendamiento'
					WHERE t.vid=222	
					AND e.entity_id=".$datos["id_especialidad"]."
					union
					SELECT t.tid,t.name, d.FIELD_DEPTO_TID as padre
					FROM taxonomy_term_data t	
					INNER JOIN field_data_field_depto d on t.tid=d.entity_id AND d.entity_type='taxonomy_term' AND d.bundle='ciudad' 
					INNER JOIN field_data_field_ciudad c on t.tid=c.field_ciudad_tid AND c.entity_type='taxonomy_term' AND c.bundle='sede_agendamiento'
					INNER JOIN field_data_field_agsede e on c.entity_id=e.field_agsede_tid AND e.entity_type='taxonomy_term' AND e.bundle='especialidad_agendamiento'
					WHERE t.vid=241	
					and e.entity_id=".$datos["id_especialidad"]."
					union					
					SELECT t.tid,t.name, c.FIELD_CIUDAD_TID as padre
					FROM taxonomy_term_data t		
					INNER JOIN field_data_field_ciudad c on t.tid=c.entity_id AND c.entity_type='taxonomy_term' AND c.bundle='sede_agendamiento' 
					INNER JOIN field_data_field_agsede e on t.tid=e.field_agsede_tid AND e.entity_type='taxonomy_term' AND e.bundle='especialidad_agendamiento'
					INNER JOIN field_data_field_app a on a.entity_id=t.tid AND a.FIELD_APP_TID=".$datos["id_aplicacion"]." and a.BUNDLE='sede_agendamiento'
                    INNER JOIN field_data_field_se s on s.entity_id=t.tid AND s.FIELD_SE_TID= ".$datos["id_servicio"]."  and s.BUNDLE='sede_agendamiento'
					WHERE t.vid=593 
					and e.entity_id=".$datos["id_especialidad"]."  					
					ORDER BY 3,2");
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->tid;
  $data[$i]['nombre']=$record->name;
  $data[$i]['padre']=$record->padre;
  $i++;
 }
 return $data;
}


/* Obtiene el listado de medios de pqr
 */
function _agendamiento_db_get_motivos_cita($datos){           

 $result=db_query("   
    select  t.tid as id
          ,t.name as nombre
      from taxonomy_term_data t 
      inner join taxonomy_term_hierarchy h on t.tid = h.tid
      and h.parent=(select  t.tid as id       
                    from taxonomy_term_data t 
                     inner join taxonomy_term_hierarchy h on t.tid = h.tid      
                    inner join field_data_field_app a on a.entity_id=t.tid AND a.FIELD_APP_TID=".$datos["id_aplicacion"]." and a.BUNDLE='motivo_cita_agendamiento'
                    inner join field_data_field_se s on s.entity_id=t.tid AND s.FIELD_SE_TID= ".$datos["id_servicio"]."  and s.BUNDLE='motivo_cita_agendamiento'
                    where h.parent=0)
      where t.vid=597
      order by t.name");
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->id;
  $data[$i]['nombre']=$record->nombre;
  $i++;
 }
 return $data;
}



/* Obtiene el listado de medios de pqr
 */
function _agendamiento_db_get_especialidades($datos){           

 $result=db_query("   
    select  t.tid as id
          ,t.name as nombre
      from taxonomy_term_data t 
      inner join taxonomy_term_hierarchy h on t.tid = h.tid
      and h.parent=(select  t.tid as id       
                    from taxonomy_term_data t 
                     inner join taxonomy_term_hierarchy h on t.tid = h.tid      
                    inner join field_data_field_app a on a.entity_id=t.tid AND a.FIELD_APP_TID=".$datos["id_aplicacion"]." and a.BUNDLE='especialidad_agendamiento'
                    inner join field_data_field_se s on s.entity_id=t.tid AND s.FIELD_SE_TID= ".$datos["id_servicio"]."  and s.BUNDLE='especialidad_agendamiento'
                    where h.parent=0)
      where t.vid=594
      order by t.name");
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->id;
  $data[$i]['nombre']=$record->nombre;
  $i++;
 }
 return $data;
}


/* Obtiene el listado de medios de pqr
 */
function _agendamiento_db_get_especialistas($datos){           
 
 $result=db_query('   
    select u."UID" as id
      	   ,n.field_alusno_value as nombre 
	       ,ap.field_alusap_value as apellido
	from users u
	inner join users_roles r on u."UID"=r."UID" and r.RID=523
	inner join field_data_field_alusno n on n.entity_id=u."UID"
	inner join field_data_field_alusap ap on ap.entity_id=u."UID"
	inner join field_data_field_app a on a.entity_id=u."UID" AND a.FIELD_APP_TID='.$datos["id_aplicacion"].'  and a.BUNDLE=\'user\'
	inner join field_data_field_se s on s.entity_id=u."UID" AND s.FIELD_SE_TID='.$datos["id_servicio"].'   and s.BUNDLE=\'user\'
	inner join field_data_field_agsede sd on sd.entity_id=u."UID" AND sd.FIELD_AGSEDE_TID='.$datos["id_sede"].'   and sd.BUNDLE=\'user\'
	inner join field_data_field_agespc sd on sd.entity_id=u."UID" AND sd.FIELD_AGESPC_TID='.$datos["id_especialidad"].'   and sd.BUNDLE=\'user\'
	where u.status=1');
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->id;
  $data[$i]['nombre']=$record->nombre." ".$record->apellido;
  $i++;
 }

 return $data;
}

/* Obtiene el listado de medios de pqr
 */
function _agendamiento_db_get_especialista_automatico($datos){           
 
 $result=db_query('
 	select * from (
				    select u."UID" as id
				      	   ,n.field_alusno_value as nombre 
					       ,ap.field_alusap_value as apellido
					       ,count(agendamiento_id) as eventos
					from users u
					inner join users_roles r on u."UID"=r."UID" and r.RID=523
					inner join field_data_field_alusno n on n.entity_id=u."UID"
					inner join field_data_field_alusap ap on ap.entity_id=u."UID"
					inner join field_data_field_app a on a.entity_id=u."UID" AND a.FIELD_APP_TID='.$datos["id_aplicacion"].'  and a.BUNDLE=\'user\'
					inner join field_data_field_se s on s.entity_id=u."UID" AND s.FIELD_SE_TID='.$datos["id_servicio"].'   and s.BUNDLE=\'user\'
					inner join field_data_field_agsede sd on sd.entity_id=u."UID" AND sd.FIELD_AGSEDE_TID='.$datos["id_sede"].'   and sd.BUNDLE=\'user\'
					inner join field_data_field_agespc sd on sd.entity_id=u."UID" AND sd.FIELD_AGESPC_TID='.$datos["id_especialidad"].'   and sd.BUNDLE=\'user\'
					left join agendamiento ag on ag.especialista_id=u."UID" 
     					  and ag.especialidad_id='.$datos["id_especialidad"].'
     					  and ag.aplicacion_id='.$datos["id_aplicacion"].'
     					  and ag.servicio_id='.$datos["id_servicio"].'
					where u.status=1
					group by u."UID",n.field_alusno_value,ap.field_alusap_value
					order by count(agendamiento_id) asc
				 )
	where ROWNUM=1');
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->id;
  $data[$i]['nombre']=$record->nombre." ".$record->apellido;
  $i++;
 }

 return $data;
}


/* Obtiene el listado de medios de pqr
 */
function _agendamiento_db_get_medios_atencion($datos){           

 $result=db_query("   
    select  t.tid as id
          ,t.name as nombre
          ,cd.field_agmacd_value as codigo
      from taxonomy_term_data t 
      inner join field_data_field_agmacd cd  on t.tid = cd.entity_id
      inner join taxonomy_term_hierarchy h on t.tid = h.tid
      and h.parent=(select  t.tid as id       
                    from taxonomy_term_data t 
                     inner join taxonomy_term_hierarchy h on t.tid = h.tid      
                    inner join field_data_field_app a on a.entity_id=t.tid AND a.FIELD_APP_TID=".$datos["id_aplicacion"]." and a.BUNDLE='medio_atencion_agendamiento'
                    inner join field_data_field_se s on s.entity_id=t.tid AND s.FIELD_SE_TID= ".$datos["id_servicio"]."  and s.BUNDLE='medio_atencion_agendamiento'
                    where h.parent=0)
      where t.vid=596
      order by t.name");
 $i=0;
 $data=array();
  foreach ($result as $record) {                              
  $data[$i]['id']=$record->codigo;
  $data[$i]['nombre']=$record->nombre;
  $i++;
 }
 return $data;
}


function _agendamiento_db_get_eventos($datos){
	 $url=$datos["base_url"]."/agendamiento/calendario/evento";
	 
	 $and="";
	 
	 if($datos["id_aplicacion"]!=0){
		$and .=" and aplicacion_id=".$datos["id_aplicacion"]." ";
	 }
	 
	 if($datos["id_servicio"]!=0){
		$and .=" and servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and especialista_id=".$datos["id_especialista"]." ";
	 }	 
	 
	 $query='
		select agendamiento_id
		      ,sede_id
			  ,especialidad_id
			  ,especialista_id
			  ,asunto
			  ,tipo_evento			  
			  ,cliente_id
			  ,estado_id
			  ,TO_char(FECHA_INICIAL,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_inicial
			  ,TO_char(FECHA_FINAL,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_final			  
		from agendamiento
		where fecha_inicial >= to_date(\''.$datos["inicio"].'\',\'DD-MM-YYYY\') 
		and  fecha_final <= to_date(\''.$datos["fin"].'\',\'DD-MM-YYYY\') 
		'.$and.' 
		'.$datos["filtro_estado"].' 
		order by estado_id DESC ';
	 
	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 $list_estados=_agendamiento_get_estados();
	 foreach ($result as $record) {                              	 
	  $data[$i]['id']=$record->agendamiento_id;
	  $data[$i]['title']=$record->asunto;
	  $data[$i]['url']=$url."/".$record->agendamiento_id;
	  $data[$i]['class']=$record->tipo_evento;
	  $data[$i]['start']=strtotime($record->fecha_inicial) . '000';
	  $data[$i]['end']=strtotime($record->fecha_final) .'000';
	  $data[$i]['status_id']=$record->estado_id;
	  $data[$i]['status']=$list_estados[$record->estado_id];
	  $data[$i]['client']=$record->cliente_id;
	  $data[$i]['specialist']=$record->especialista_id;
	  $data[$i]['specialty']=$record->especialidad_id;   
	  $i++; 
	 }
	
	
	 return $data;	
}

 function _agendamiento_db_get_listado_eventos($datos){
	 $url=$datos["base_url"]."/agendamiento/calendario/evento";
	 
	 $and="";
	 
	 if($datos["id_aplicacion"]!=0){
		$and .=" and a.aplicacion_id=".$datos["id_aplicacion"]." ";
	 }
	 
	 if($datos["id_servicio"]!=0){
		$and .=" and a.servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and a.especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and a.pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and a.depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and a.ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and a.sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and a.especialista_id=".$datos["id_especialista"]." ";
	 }
	 
	 if($datos["medio_atencion"]!=0){
		$and .=" and a.medio_atencion_id=".$datos["medio_atencion"]." ";
	 }
	 
	 if($datos["numero_documento"]!=0){
		$and .=" and c.numero_documento='".$datos["numero_documento"]."' ";
	 }	
	 if($datos["codigo"]!=0){
		$and .=" and a.codigo=".$datos["codigo"]." ";
	 } 	 	  
 
	 $query='SELECT * FROM (
	    
		select ROWNUM  AS registro
		    ,a.agendamiento_id
			,a.sede_id
			,a.especialidad_id
			,a.especialista_id
			,a.asunto
			,a.descripcion
			,a.tipo_evento	
			,a.medio_atencion_id
			,a.pais_id AS pais_cita
			,a.depto_id AS depto_cita
			,a.ciudad_id AS ciudad_cita
			,a.estado_id AS estado_cita	
			,a.codigo AS codigo	  
			,TO_char(a.fecha_inicial,\'YYYY-MM-DD HH24:MI\') AS fecha_inicial
			,TO_char(a.fecha_final,\'YYYY-MM-DD HH24:MI\') AS fecha_final	
			,a.usuario_creo_id
			,a.usuario_actualizo_id
			,a.aplicacion_id
			,a.servicio_id
			,TO_char(a.fecha_registro,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_registro
			,TO_char(a.fecha_modificacion,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_modificacion	
			,c.cliente_id
			,c.tipo_documento_id
			,c.numero_documento
			,c.nombre AS nombre
			,c.apellido AS apellido
			,c.telefono AS telefono
			,c.celular AS celular
			,TO_char(c.fecha_nacimiento,\'MM/DD/YYYY\') AS fecha_nacimiento
			,c.email AS email
			,c.pais_id AS pais_cliente
			,c.depto_id AS depto_cliente
			,c.ciudad_id AS ciudad_cliente
			,c.direccion AS direccion
			,c.extension As extension	
  		from agendamiento a
		inner join agendamiento_cliente c on a.cliente_id=c.cliente_id
		where a.fecha_inicial >= to_date(\''.$datos["inicio"].'\',\'DD-MM-YYYY\') 
		and   a.fecha_inicial <= to_date(\''.$datos["fin"].'\',\'DD-MM-YYYY\') 
		'.$and.' 
		'.$datos["filtro_estado"].' 
		order by fecha_registro ) 
		WHERE registro BETWEEN ('.$datos["pagina"].' - 1) * '.$datos["registros"].' + 1 
		AND  '.$datos["pagina"].' * '.$datos["registros"].'';
	
	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 $list_estados=_agendamiento_get_estados();
	 foreach ($result as $record) {                              	 
	  $data[$i]['id']=$record->agendamiento_id;
	  $data[$i]['asunto']=$record->asunto;
	  $data[$i]['descripcion']=$record->descripcion;
	  $data[$i]['url']=$url."/".$record->agendamiento_id;
	  $data[$i]['tipo_evento']=$record->tipo_evento;
	  $data[$i]['medio_atencion_id']=$record->medio_atencion_id;	  
	  $data[$i]['fecha_inicial']=$record->fecha_inicial;
	  $data[$i]['fecha_final']=$record->fecha_final;
	  $data[$i]['sede_id']=$record->sede_id;
	  $data[$i]['cliente_id']=$record->cliente_id;
	  $data[$i]['especialista_id']=$record->especialista_id;
	  $data[$i]['especialidad_id']=$record->especialidad_id;
	  $data[$i]['pais_cita']=$record->pais_cita;
	  $data[$i]['depto_cita']=$record->depto_cita;
	  $data[$i]['ciudad_cita']=$record->ciudad_cita;
	  $data[$i]['estado_cita']=$record->estado_cita;
	  $data[$i]['codigo']=$record->codigo;
	  $data[$i]['tipo_documento_id']=$record->tipo_documento_id;
	  $data[$i]['numero_documento']=$record->numero_documento;
	  $data[$i]['nombre']=$record->nombre;
	  $data[$i]['apellido']=$record->apellido;
	  $data[$i]['telefono']=$record->telefono;
	  $data[$i]['celular']=$record->celular; 
	  $data[$i]['fecha_nacimiento']=$record->fecha_nacimiento; 
	  $data[$i]['email']=$record->email; 
	  $data[$i]['pais_cliente']=$record->pais_cliente; 
	  $data[$i]['depto_cliente']=$record->depto_cliente; 
	  $data[$i]['ciudad_cliente']=$record->ciudad_cliente; 
	  $data[$i]['direccion']=$record->direccion; 
	  $data[$i]['extension']=$record->extension; 
	  $data[$i]['usuario_creo_id']=$record->usuario_creo_id; 
	  $data[$i]['usuario_actualizo_id']=$record->usuario_actualizo_id; 
	  $data[$i]['fecha_registro']=$record->fecha_registro; 
	  $data[$i]['fecha_modificacion']=$record->fecha_modificacion;
	  $data[$i]['aplicacion_id']=$record->aplicacion_id; 
	  $data[$i]['servicio_id']=$record->servicio_id;   
	  $i++; 
	 }
	 return $data;	
	 
}
 
 
function _agendamiento_db_get_evento_hora($datos){
		 
	 $and="";
	 
	 if($datos["id_aplicacion"]!=0){
		$and .=" and aplicacion_id=".$datos["id_aplicacion"]." ";
	 }
	 
	 if($datos["id_servicio"]!=0){
		$and .=" and servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and especialista_id=".$datos["id_especialista"]." ";
	 }
	 
	 if(isset($datos["id_estado"]) && $datos["id_estado"]!=0){
		$and .=" and estado_id=".$datos["id_estado"]." ";
	 }	 
	 
	 $query='
		select agendamiento_id
			  ,codigo
			  ,asunto
			  ,TO_char(fecha_inicial,\'YYYY-MM-DD HH24:MI\') AS fecha_inicial
			  ,TO_char(fecha_final,\'YYYY-MM-DD HH24:MI\') AS fecha_final			  
		from agendamiento
		where fecha_inicial >= to_date(\''.$datos["inicio"].'\',\'MM-DD-YYYY HH24:MI\') 
		and  fecha_final <= to_date(\''.$datos["fin"].'\',\'MM-DD-YYYY HH24:MI\') 
		'.$and.' 
		order by fecha_inicial
		';

	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 foreach ($result as $record) {                              	 
	  $data[$i]['id']=$record->agendamiento_id;
	  $data[$i]['codigo']=$record->codigo;
	  $data[$i]['asunto']=$record->asunto;
	  $data[$i]['fecha_inicial']=$record->fecha_inicial;
	  $data[$i]['fecha_final']=$record->fecha_final;	   
	  $i++; 
	 }	
	
	 return $data;	
}


function _agendamiento_db_get_evento_estado($datos){
		 
	 $and="";
	 
	 /*if($datos["id_aplicacion"]!=0){
		$and .=" and aplicacion_id=".$datos["id_aplicacion"]." ";
	 }*/
	 
	 if($datos["id_servicio"]!=0){
		$and .=" and servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and especialista_id=".$datos["id_especialista"]." ";
	 }	 
	 
	 $query='
		select estado_id
			  ,count(estado_id) as cantidad
		from agendamiento
		where aplicacion_id='.$datos["id_aplicacion"].' 
		'.$and.'
		group by estado_id
		
		';

	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 foreach ($result as $record) {                              	 
	  $data[$i]['estado_id']=$record->estado_id;
	  $data[$i]['cantidad']=$record->cantidad;	     
	  $i++; 
	 }	
	
	 return $data;	
}

function _agendamiento_db_get_evento_tipo($datos){
		 
	 $and="";
	 
	 /*if($datos["id_aplicacion"]!=0){
		$and .=" and aplicacion_id=".$datos["id_aplicacion"]." ";
	 }*/
	 
	 if($datos["id_servicio"]!=0){
		$and .=" and servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and especialista_id=".$datos["id_especialista"]." ";
	 }	 
	 
	 $query='
		select tipo_evento
			  ,count(tipo_evento) as cantidad
		from agendamiento
		where aplicacion_id='.$datos["id_aplicacion"].' 
		'.$and.'
		group by tipo_evento
		
		';

	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 foreach ($result as $record) {                              	 
	  $data[$i]['tipo_evento']=$record->tipo_evento;
	  $data[$i]['cantidad']=$record->cantidad;	     
	  $i++; 
	 }	
	
	 return $data;	
}


function _agendamiento_db_get_evento_medio($datos){
		 
	 $and="";
 
	 if($datos["id_servicio"]!=0){
		$and .=" and servicio_id=".$datos["id_servicio"]." ";
	 }
	 
	 if($datos["id_especialidad"]!=0){
		$and .=" and especialidad_id=".$datos["id_especialidad"]." ";
	 }
	 
	 if($datos["id_pais"]!=0){
		$and .=" and pais_id=".$datos["id_pais"]." ";
	 }
	 
	 if($datos["id_depto"]!=0){
		$and .=" and depto_id=".$datos["id_depto"]." ";
	 }
	 
	 if($datos["id_ciudad"]!=0){
		$and .=" and ciudad_id=".$datos["id_ciudad"]." ";
	 }
	 
	 if($datos["id_sede"]!=0){
		$and .=" and sede_id=".$datos["id_sede"]." ";
	 }	 
	 
	 if($datos["id_especialista"]!=0){
		$and .=" and especialista_id=".$datos["id_especialista"]." ";
	 }	 
	 
	 $query='
		select medio_atencion_id
			  ,count(medio_atencion_id) as cantidad
		from agendamiento
		where aplicacion_id='.$datos["id_aplicacion"].' 
		'.$and.'
		group by medio_atencion_id
		
		';

	 $result=db_query($query);
	 $i=0;
	 $data=array();
	 foreach ($result as $record) {                              	 
	  $data[$i]['medio_atencion_id']=$record->medio_atencion_id;
	  $data[$i]['cantidad']=$record->cantidad;	     
	  $i++; 
	 }	
	
	 return $data;	
}


function _agendamiento_db_get_evento($datos){
	 $url=$datos["base_url"]."/agendamiento/calendario/evento";
	 
	 $query='
		select a.agendamiento_id
			,a.sede_id
			,a.especialidad_id
			,a.especialista_id
			,a.asunto
			,a.descripcion
			,a.tipo_evento	
			,a.medio_atencion_id
			,a.motivo_cita_id
			,a.pais_id AS pais_cita
			,a.depto_id AS depto_cita
			,a.ciudad_id AS ciudad_cita
			,a.estado_id AS estado_cita	
			,a.codigo AS codigo	  
			,TO_char(a.fecha_inicial,\'YYYY-MM-DD HH24:MI\') AS fecha_inicial
			,TO_char(a.fecha_final,\'YYYY-MM-DD HH24:MI\') AS fecha_final	
			,a.usuario_creo_id
			,a.usuario_actualizo_id
			,a.aplicacion_id
			,a.servicio_id
			,TO_char(a.fecha_registro,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_registro
			,TO_char(a.fecha_modificacion,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_modificacion	
			,c.cliente_id
			,c.tipo_documento_id
			,c.numero_documento
			,c.nombre AS nombre
			,c.apellido AS apellido
			,c.telefono AS telefono
			,c.celular AS celular
			,TO_char(c.fecha_nacimiento,\'MM/DD/YYYY\') AS fecha_nacimiento
			,c.email AS email
			,c.pais_id AS pais_cliente
			,c.depto_id AS depto_cliente
			,c.ciudad_id AS ciudad_cliente
			,c.direccion AS direccion
			,c.extension As extension	
  		from agendamiento a
		inner join agendamiento_cliente c on a.cliente_id=c.cliente_id
		where a.agendamiento_id='.$datos["agendamiento_id"].'
		';
	 $result=db_query($query);
	 $i=0; 
	 $data=array();
	 foreach ($result as $record) {                              	 
	  $data[$i]['agendamiento_id']=$record->agendamiento_id;
	  $data[$i]['asunto']=$record->asunto;
	  $data[$i]['descripcion']=$record->descripcion;
	  $data[$i]['url']=$url."/".$record->agendamiento_id;
	  $data[$i]['tipo_evento']=$record->tipo_evento;
	  $data[$i]['medio_atencion_id']=$record->medio_atencion_id;
	  $data[$i]['motivo_cita_id']=$record->motivo_cita_id;	  
	  $data[$i]['fecha_inicial']=$record->fecha_inicial;
	  $data[$i]['fecha_final']=$record->fecha_final;
	  $data[$i]['sede_id']=$record->sede_id;
	  $data[$i]['cliente_id']=$record->cliente_id;
	  $data[$i]['especialista_id']=$record->especialista_id;
	  $data[$i]['especialidad_id']=$record->especialidad_id;
	  $data[$i]['pais_cita']=$record->pais_cita;
	  $data[$i]['depto_cita']=$record->depto_cita;
	  $data[$i]['ciudad_cita']=$record->ciudad_cita;
	  $data[$i]['estado_cita']=$record->estado_cita;
	  $data[$i]['codigo']=$record->codigo;
	  $data[$i]['tipo_documento_id']=$record->tipo_documento_id;
	  $data[$i]['numero_documento']=$record->numero_documento;
	  $data[$i]['nombre']=$record->nombre;
	  $data[$i]['apellido']=$record->apellido;
	  $data[$i]['telefono']=$record->telefono;
	  $data[$i]['celular']=$record->celular; 
	  $data[$i]['fecha_nacimiento']=$record->fecha_nacimiento; 
	  $data[$i]['email']=$record->email; 
	  $data[$i]['pais_cliente']=$record->pais_cliente; 
	  $data[$i]['depto_cliente']=$record->depto_cliente; 
	  $data[$i]['ciudad_cliente']=$record->ciudad_cliente; 
	  $data[$i]['direccion']=$record->direccion; 
	  $data[$i]['extension']=$record->extension; 
	  $data[$i]['usuario_creo_id']=$record->usuario_creo_id; 
	  $data[$i]['usuario_actualizo_id']=$record->usuario_actualizo_id; 
	  $data[$i]['fecha_registro']=$record->fecha_registro; 
	  $data[$i]['fecha_modificacion']=$record->fecha_modificacion;
	  $data[$i]['aplicacion_id']=$record->aplicacion_id; 
	  $data[$i]['servicio_id']=$record->servicio_id; 
	  
	    
	  $i++; 
	 }
	
	
	 return $data;	
}

function _agendamiento_db_get_reagendamientos_evento($datos){
	
	$result=db_query(' 	
		select count(r.agendamiento_id) AS cantidad
		from agendamiento_revision r
		where  r.agendamiento_id=:agendamiento_id
		   and r.estado_id=:estado_id 		
		',array(":agendamiento_id"=>$datos["agendamiento_id"],":estado_id"=>$datos["estado_id"]));
	  
	  $i=0;
	  $data=array();
	  foreach ($result as $record) { 
		  $data[$i]['cantidad']=$record->cantidad;		  	
		  $i++;
		 }

 	return $data;
	  
}


function _agendamiento_db_get_cliente($datos){
	$result=db_query(' 	
		select c.cliente_id
			   	,c.tipo_documento_id
				,c.nombre
				,c.apellido
				,c.telefono
				,c.celular
				,TO_char(c.fecha_nacimiento,\'MM/DD/YYYY\') AS fecha_nacimiento
				,c.email
				,c.pais_id
				,c.depto_id
				,c.ciudad_id
				,c.direccion
				,c.extension
		from agendamiento_cliente c
		where  c.numero_documento=:numero_documento
			  and c.aplicacion_id='.$datos["id_aplicacion"].'
			  and c.servicio_id='.$datos["id_servicio"].'					
		',array(":numero_documento"=>$datos["numero_documento"]));
	  
	  
	  $i=0;
	  $data=array();
	  $data[0]["existe"]=0;
	  foreach ($result as $record) { 
	  	  $data[$i]["existe"]=1; 	                             
		  $data[$i]['cliente_id']=$record->cliente_id;
		  $data[$i]['tipo_documento_id']=$record->tipo_documento_id;
		  $data[$i]['nombre']=$record->nombre;
		  $data[$i]['apellido']=$record->apellido;
		  $data[$i]['telefono']=$record->telefono;
		  $data[$i]['celular']=$record->celular;
		  $data[$i]['fecha_nacimiento']=$record->fecha_nacimiento;
		  $data[$i]['email']=$record->email;
		  $data[$i]['pais_id']=$record->pais_id;
		  $data[$i]['depto_id']=$record->depto_id;
		  $data[$i]['ciudad_id']=$record->ciudad_id;
		  $data[$i]['direccion']=$record->direccion;
		  $data[$i]['extension']=$record->extension;
		  $i++;
		 }

 	return $data;
}


function _agendamiento_db_get_revisiones($datos){
	$result=db_query(' 	
		select a.agendamiento_id
			,a.sede_id
			,a.especialidad_id
			,a.especialista_id
			,a.asunto
			,a.descripcion
			,a.tipo_evento	
			,a.medio_atencion_id
			,a.pais_id AS pais_cita
			,a.depto_id AS depto_cita
			,a.ciudad_id AS ciudad_cita
			,a.estado_id AS estado_cita	
			,a.codigo AS codigo	  
			,TO_char(a.fecha_inicial,\'YYYY-MM-DD HH24:MI\') AS fecha_inicial
			,TO_char(a.fecha_final,\'YYYY-MM-DD HH24:MI\') AS fecha_final	
			,a.usuario_creo_id
			,a.usuario_actualizo_id
			,a.aplicacion_id
			,a.servicio_id
			,TO_char(a.fecha_registro,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_registro
			,TO_char(a.fecha_modificacion,\'YYYY-MM-DD HH24:MI:SS\') AS fecha_modificacion
		from agendamiento_revision a
		where  a.agendamiento_id=:agendamiento_id	
		order by agendamiento_revision_id asc				
		',array(":agendamiento_id"=>$datos["agendamiento_id"]));
	  
	  
	  $i=0;
	  $data=array();
	  $data[0]["existe"]=0;
	  foreach ($result as $record) { 
	  	  $data[$i]['agendamiento_id']=$record->agendamiento_id;
		  $data[$i]['asunto']=$record->asunto;
		  $data[$i]['descripcion']=$record->descripcion;
		  $data[$i]['tipo_evento']=$record->tipo_evento;
		  $data[$i]['medio_atencion_id']=$record->medio_atencion_id;	  
		  $data[$i]['fecha_inicial']=$record->fecha_inicial;
		  $data[$i]['fecha_final']=$record->fecha_final;
		  $data[$i]['sede_id']=$record->sede_id;
		  $data[$i]['especialista_id']=$record->especialista_id;
		  $data[$i]['especialidad_id']=$record->especialidad_id;
		  $data[$i]['pais_cita']=$record->pais_cita;
		  $data[$i]['depto_cita']=$record->depto_cita;
		  $data[$i]['ciudad_cita']=$record->ciudad_cita;
		  $data[$i]['estado_cita']=$record->estado_cita;
		  $data[$i]['codigo']=$record->codigo;
		  $data[$i]['usuario_creo_id']=$record->usuario_creo_id;
		  $data[$i]['usuario_actualizo_id']=$record->usuario_actualizo_id;
		  $data[$i]['fecha_registro']=$record->fecha_registro;
		  $data[$i]['fecha_modificacion']=$record->fecha_modificacion;
		  $i++;
		 }

 	return $data;
}

function _agendamiento_db_get_secuencia_cliente(){
	$result=db_query(' 	
			select last_number 
			from user_sequences 
			where sequence_name=\'AGENDAMIENTO_CLIENTE_SEQ\'
		');
	  
	  
	  $i=0;
	  $data=array();
	  foreach ($result as $record) {                            
		  $data[$i]['cliente_id']=$record->last_number;
		  $i++;
		 }

 	return $data;
}

function _agendamiento_db_get_secuencia_agendamiento(){
	$result=db_query(' 	
			select last_number 
			from user_sequences 
			where sequence_name=\'AGENDAMIENTO_SEQ\'
		');
	  
	  
	  $i=0;
	  $data=array();
	  foreach ($result as $record) {                            
		  $data[$i]['agendamiento_id']=$record->last_number;
		  $i++;
		 }

 	return $data;
}

function _agendamiento_db_get_serial($datos){
	
	$result=db_query(' 	
		select s.serial
		      ,s.valor_inicial
		from agendamiento_serial s
		where  s.aplicacion_id=:id_aplicacion
			  and s.servicio_id=:id_servicio				
		',array(":id_aplicacion"=>$datos["id_aplicacion"],":id_servicio"=>$datos["id_servicio"]));
	  
	  
	  $i=0;
	  $data=array();
	  foreach ($result as $record) { 
		  $data[$i]['valor_inicial']=$record->valor_inicial;	
		  $data[$i]['serial']=$record->serial;		  	
		  $i++;
		 }

 	return $data;
	  
}

function _agendamiento_db_insert_cliente($datos){
	
	$query='
	    insert into agendamiento_cliente(
			    tipo_documento_id
				,numero_documento
				,nombre
				,apellido
				,telefono
				,celular
				,fecha_nacimiento
				,email
				,pais_id
				,depto_id
				,ciudad_id
				,direccion
				,extension
				,aplicacion_id
				,servicio_id
		)values(
			'.$datos["tipo_documento"].'
		   ,\''.$datos["numero_documento"].'\'
		   ,\''.$datos["nombres_cliente"].'\'
		   ,\''.$datos["apellidos_cliente"].'\'
		   ,\''.$datos["telefono_fijo"].'\'
		   ,\''.$datos["telefono_celular"].'\'
		   ,TO_TIMESTAMP(\''.$datos["fecha_nacimiento"].'\', \'MM/DD/YYYY\')
		   ,\''.$datos["correo_electronico"].'\'
		   ,'.$datos["pais_cliente"].'
		   ,'.$datos["depto_cliente"].'
		   ,'.$datos["ciudad_cliente"].'
		   ,\''.$datos["direccion"].'\'
		   ,\''.$datos["extension_fijo"].'\'
		   ,'.$datos["id_aplicacion"].'
		   ,'.$datos["id_servicio"].'
		)				
		';
	
	$result=db_query($query);

	$last_id=_agendamiento_db_get_secuencia_cliente();
	 
	$return[0]["status"]=1;
	$return[0]["id_cliente"]=$last_id[0]["cliente_id"] -1;
	return $return;
	   
}

function _agendamiento_db_update_cliente($datos){
	$query=' 
	    update agendamiento_cliente set 
			    tipo_documento_id='.$datos["tipo_documento"].'
				,nombre=\''.$datos["nombres_cliente"].'\'
				,apellido=\''.$datos["apellidos_cliente"].'\'
				,telefono=\''.$datos["telefono_fijo"].'\'
				,celular=\''.$datos["telefono_celular"].'\'
				,fecha_nacimiento=TO_TIMESTAMP(\''.$datos["fecha_nacimiento"].'\', \'MM/DD/YYYY\')
				,email=\''.$datos["correo_electronico"].'\'
				,pais_id='.$datos["pais_cliente"].'
				,depto_id='.$datos["depto_cliente"].'
				,ciudad_id='.$datos["ciudad_cliente"].'
				,direccion=\''.$datos["direccion"].'\'
				,extension=\''.$datos["extension_fijo"].'\'
				,aplicacion_id='.$datos["id_aplicacion"].'
				,servicio_id='.$datos["id_servicio"].'
		where cliente_id='.$datos["id_cliente"].' and numero_documento=\''.$datos["numero_documento"].'\'				
		';
	
	$result=db_query($query);
	
	$return[0]["status"]=1;
	$return[0]["id_cliente"]=$datos["id_cliente"];
	return $return;  
}



function _agendamiento_db_insert_agendamiento($datos){
	$query='
	    insert into agendamiento(
			    fecha_inicial
				,fecha_final
				,asunto
				,descripcion
				,tipo_evento
				,sede_id
				,especialidad_id
				,especialista_id
				,pais_id
				,depto_id
				,ciudad_id
				,estado_id
				,cliente_id
				,aplicacion_id
				,servicio_id
				,usuario_creo_id
				,usuario_actualizo_id
				,fecha_registro
				,fecha_modificacion
				,codigo
				,medio_atencion_id
				,motivo_cita_id
		)values(
			TO_TIMESTAMP(\''.$datos["fecha_desde"].'\', \'MM/DD/YYYY HH24:MI\')
		   ,TO_TIMESTAMP(\''.$datos["fecha_hasta"].'\', \'MM/DD/YYYY HH24:MI\')
		   ,\''.$datos["asunto"].'\'
		   ,\''.$datos["descripcion"].'\'
		   ,\''.$datos["tipo_evento"].'\'
		   ,'.$datos["sede"].'
		   ,'.$datos["especialidad"].'
		   ,'.$datos["especialista"].'
		   ,'.$datos["pais"].'
		   ,'.$datos["depto"].'
		   ,'.$datos["ciudad"].'
		   ,'.$datos["estado"].'
		   ,'.$datos["cliente"].'
		   ,'.$datos["id_aplicacion"].'
			,'.$datos["id_servicio"].'
		   ,'.$datos["usuario_crea"].'
		   ,'.$datos["usuario_actualiza"].'
		   ,TO_TIMESTAMP(\''.$datos["fecha_creacion"].'\', \'MM/DD/YYYY HH24:MI:SS\')
		   ,TO_TIMESTAMP(\''.$datos["fecha_actualizacion"].'\',\'MM/DD/YYYY HH24:MI:SS\')
		   ,'.$datos["codigo"].'
		   ,'.$datos["medio_atencion"].'
		   ,'.$datos["motivo_cita"].'
		)				
		';
	
	$result=db_query($query);
	
	$last_id=_agendamiento_db_get_secuencia_agendamiento();
	
	$return[0]["status"]=1;
	$return[0]["agendamiento_id"]=$last_id[0]["agendamiento_id"] -1;
	$return[0]["codigo"]=$datos["codigo"]; 
	return $return;
	  
}


function _agendamiento_db_insert_agendamiento_revision($datos){
	$query='
	    insert into agendamiento_revision(
			    agendamiento_id
				,fecha_inicial
				,fecha_final
				,asunto
				,descripcion
				,tipo_evento
				,sede_id
				,especialidad_id
				,especialista_id
				,pais_id
				,depto_id
				,ciudad_id
				,estado_id
				,cliente_id
				,aplicacion_id
				,servicio_id
				,usuario_creo_id
				,usuario_actualizo_id
				,fecha_registro
				,fecha_modificacion
				,codigo
				,medio_atencion_id
				,motivo_cita_id
		)values(
		   '.$datos["agendamiento_id"].'
		   ,TO_TIMESTAMP(\''.$datos["fecha_desde"].'\', \'MM/DD/YYYY HH24:MI\')
		   ,TO_TIMESTAMP(\''.$datos["fecha_hasta"].'\', \'MM/DD/YYYY HH24:MI\')
		   ,\''.$datos["asunto"].'\'
		   ,\''.$datos["descripcion"].'\'
		   ,\''.$datos["tipo_evento"].'\'
		   ,'.$datos["sede"].'
		   ,'.$datos["especialidad"].'
		   ,'.$datos["especialista"].'
		   ,'.$datos["pais"].'
		   ,'.$datos["depto"].'
		   ,'.$datos["ciudad"].'
		   ,'.$datos["estado"].'
		   ,'.$datos["cliente"].'
		   ,'.$datos["id_aplicacion"].'
			,'.$datos["id_servicio"].'
		   ,'.$datos["usuario_crea"].'
		   ,'.$datos["usuario_actualiza"].'
		   ,TO_TIMESTAMP(\''.$datos["fecha_creacion"].'\', \'MM/DD/YYYY HH24:MI:SS\')
		   ,TO_TIMESTAMP(\''.$datos["fecha_actualizacion"].'\',\'MM/DD/YYYY HH24:MI:SS\')
		   ,'.$datos["codigo"].'
		   ,'.$datos["medio_atencion"].'
		   ,'.$datos["motivo_cita"].'
		)				
		';
	
	$result=db_query($query);
	
	$last_id=_agendamiento_db_get_secuencia_agendamiento();
	
	$return[0]["status"]=1;
	$return[0]["agendamiento_id"]=$last_id[0]["agendamiento_id"] -1;
	$return[0]["codigo"]=$datos["codigo"]; 
	return $return;
	  
}



function _agendamiento_db_update_agendamiento_cambia_estado($datos){
	$query=' 
	    update agendamiento set 
			    fecha_modificacion=TO_TIMESTAMP(\''.$datos["fecha_actualizacion"].'\', \'MM/DD/YYYY HH24:MI:SS\')
				,usuario_actualizo_id='.$datos["usuario_actualiza"].'
				,estado_id='.$datos["estado"].'
				,tipo_evento=\''.$datos["tipo_evento"].'\'
		where agendamiento_id='.$datos["agendamiento_id"].'				
		';
	
	$result=db_query($query);
	
	$return[0]["status"]=1;
	return $return;  
}

function _agendamiento_db_update_agendamiento_reagendar($datos){
	$query=' 
	    update agendamiento set 
			     sede_id='.$datos["sede"].'
				,especialista_id='.$datos["especialista"].'
				,fecha_inicial=TO_TIMESTAMP(\''.$datos["fecha_desde"].'\', \'MM/DD/YYYY HH24:MI\')
				,fecha_final=TO_TIMESTAMP(\''.$datos["fecha_hasta"].'\', \'MM/DD/YYYY HH24:MI\')
				,tipo_evento=\''.$datos["tipo_evento"].'\'
				,medio_atencion_id='.$datos["medio_atencion"].'
				,estado_id='.$datos["estado"].'
				,asunto=\''.$datos["asunto"].'\'
				,descripcion=\''.$datos["descripcion"].'\'
				,fecha_modificacion=TO_TIMESTAMP(\''.$datos["fecha_actualizacion"].'\', \'MM/DD/YYYY HH24:MI:SS\')
				,usuario_actualizo_id='.$datos["usuario_actualiza"].'
		where agendamiento_id='.$datos["agendamiento_id"].'				
		';
	
	$result=db_query($query);
	
	$return[0]["status"]=1;
	return $return;  
}




function _agendamiento_db_insert_serial($datos){
	
	$result=db_query(' 	
		 insert into agendamiento_serial(		 		
				 aplicacion_id
			 	,servicio_id
				,valor_inicial
				,serial
		 )values(
		 		 '.$datos["id_aplicacion"].'
		   		,'.$datos["id_servicio"].'
				,'.$datos["valor_inicial"].'
				,'.$datos["serial"].'
		 )');
	$return[0]["status"]=1;
	return $return;	  
}  
 
function _agendamiento_db_update_serial($datos){
	
	$result=db_query(' 	
		 update agendamiento_serial set serial='.$datos["serial"].'
		 where  aplicacion_id='.$datos["id_aplicacion"].'
			  and servicio_id='.$datos["id_servicio"].'				
		');
		
	$return[0]["status"]=1;
	return $return;	  
}