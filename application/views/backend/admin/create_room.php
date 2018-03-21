<div class="row">
	<div class="col-md-8 col-sm-offset-2">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('create_room');?> &nbsp <small style="color: #0753A1;"><?php echo  $message; ?></small>
            	</div>
            </div>
			<div class="panel-body">
				<?php echo validation_errors(); ?>
                <?php echo form_open(base_url() . 'rooms/create_room/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('room_name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="room_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('room_number');?></label>

						<div class="col-sm-5">
							<input type="number" class="form-control" name="room_number" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>
						</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('create_room');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
   
</div>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>
