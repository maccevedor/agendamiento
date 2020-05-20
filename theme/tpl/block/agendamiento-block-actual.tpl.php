<?php 
	global $base_url;
	setlocale(LC_TIME,"es_ES");
	$dia=date("j");
	$semana=utf8_encode(strtoupper(strftime("%A")));
	$mes=strtoupper(strftime("%B"));
	$ano=date("Y");
	
	
?>
<div class="date-current">
	<div class="day"><a href="<?php echo $base_url;?>/agendamiento/calendario"><?php echo $dia;?></a></div>
    <div class="info">
        <div class="week-day"><?php echo $semana;?></div>   
        <div class="month-year"><?php echo $mes;?> - <?php echo $ano;?></div>
    </div>
</div>