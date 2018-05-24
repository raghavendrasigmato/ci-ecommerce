<script type="text/javascript">
	jQuery(document).ready(function($) {

		CKEDITOR.replace('summary');
		CKEDITOR.replace('description');
		$('#catalog').addClass('active');
		$('#products').addClass('active');
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": true,
			"positionClass": "toast-top-center",
			"preventDuplicates": false,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		<?php
		if($this->session->flashdata('success')){
			?>
			toastr.success('<?php echo $this->session->flashdata('success'); ?>');
			<?php
		}elseif($this->session->flashdata('failure')){
			?>
			toastr.error('<?php echo $this->session->flashdata('failure'); ?>');
			<?php
		}
		?>
	});
	function fetchNewValues(){
		$.ajax({
			url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
			type: 'POST',
			data: {attr_id: $('#newAttr').val()},
			success: function(reply){
				$('#newValue').html(reply);
			}
		});
	}
	function fetchRowNewValues(){
		$.ajax({
			url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
			type: 'POST',
			data: {attr_id: $('#newRowAttr').val()},
			success: function(reply){
				console.log(reply);
				$('#newRowValue').html(reply);
			}
		});
	}
	function fetchStructureNewValues(){
		$.ajax({
			url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
			type: 'POST',
			data: {attr_id: $('#newStructureAttr').val()},
			success: function(reply){
				console.log(reply);
				$('#newStructureValue').html(reply);
			}
		});
	}
	function generateNewSkuid(){
		$.ajax({
		  url: '<?php echo site_url("admin/product/Ajax_generate_sku"); ?>',
		  type: 'POST',
		  success: function(reply){
		    $('#skuidNew').val('<?php echo PREFIX;?>'+reply);
		  }
		});
	}
</script>

