<?php $path = drupal_get_path('module', 'agendamiento'); ?>
 
 
 <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tabla" aria-controls="tabla" role="tab" data-toggle="tab">Tabla</a></li>
    <li role="presentation"><a href="#grafica" aria-controls="grafica" role="tab" data-toggle="tab">Grafica</a></li>
  </ul>
 
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tabla">
    	<h1>jejeje</h1>
    </div>
    <div role="tabpanel" class="tab-pane" id="grafica">
    	<div id="placeholder"></div>
    </div>
  </div>

</div>
 
                     

        
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo $path;?>/theme/js/flot2/jquery.flot.js"></script>
<script src="<?php echo $path;?>/theme/js/flot2/jquery.flot.pie.js"></script>
<script src="<?php echo $path;?>/theme/js/evento.js"></script> 
		