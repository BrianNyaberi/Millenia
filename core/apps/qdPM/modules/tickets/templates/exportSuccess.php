<?php
/**
* WORK SMART
*/
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title"><?php echo __('Export') ?></h4>
</div>

<form class="form-horizontal" role="form"  method="post" action="<?php echo url_for('tickets/export') ?>">
<div class="modal-body">
  <div class="form-body">

<?php if($sf_request->hasParameter('projects_id')) echo input_hidden_tag('projects_id',$sf_request->getParameter('projects_id')) ?>

  <div class="form-group">
  	<label class="col-md-3 control-label"> <?php echo __('Select fields to export') ?> <?php echo '<a href="#" onClick="return checkAllInContainer(\'extport_fields\')">' . __('Select All') . '</a>' ?> </label>
  	<div class="col-md-9">
  		<div id="extport_fields"><?php echo select_tag('fields',array('name','TasksStatus'),array('choices'=>$columns,'expanded'=>true,'multiple'=>true)) ?></div>
  	</div>
  </div>
  
  <div class="form-group">
  	<label class="col-md-3 control-label"><?php echo __('Filename') ?></label>
  	<div class="col-md-9">
  		<div id="extport_fields"><?php echo input_tag('filename',__('Tickets'),array('class'=>'form-control input-medium')) ?></div>
  	</div>
  </div>
  
  <div class="form-group">
  	<label class="col-md-3 control-label"><?php echo __('Format') ?></label>
  	<div class="col-md-9">
  		<div id="extport_fields"><?php echo select_tag('format','csv',array('choices'=>array('csv'=>'csv','txt'=>'txt')),array('class'=>'form-control input-small')) ?></div>
  	</div>
  </div>

<?php echo input_hidden_tag('selected_items') ?>

  </div>
</div>

<?php echo ajax_modal_template_footer(__('Export')) ?>

</form>

<script>
  set_selected_items();
</script>
