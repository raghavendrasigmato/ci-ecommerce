<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Products</li>
</ol>
</section>
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Products List</h3>
			<a class="btn btn-success btn-sm pull-right" href="<?php echo site_url('ak-admin/add-product'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
		</div>
		<div class="box-body">
			<table id="productsTable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Image</th>
						<th>Product Name</th>
						<th>Added on</th>
						<th>Featured status</th>
						<th>Active status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($products as $key => $prod) {
						?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td>
								<?php
								$img_url = $this->Generic_model->general_fetch_array_return_row('images', array('pid'=>$prod->pid))->image_path;
								?>
								<img src="<?php echo $img_url; ?>" alt="Img" class="img-thumbnail" style="width: 20%;height: auto;"/>
							</td>
							<td><?php echo $prod->name; ?></td>
							<td><?php echo date('d-m-Y', strtotime($prod->added_on)); ?></td>
							<td>
								<div class="form-group">
									<label>
										<input type="checkbox" class="myCheckbox flat-red" data-id="<?php echo $prod->pid;?>" <?php if($prod->featured_status == '1'){ echo 'checked'; } ?>>
									</label> 
								</div>
							</td>
							<td>
								<div class="form-group">
									<label>
										<input type="checkbox" class="myCheckboxStatus flat-red" data-id="<?php echo $prod->pid;?>" <?php if($prod->active_status == '1'){ echo 'checked'; } ?>>
									</label>
								</div>
							</td>
            <!-- <td>
              <div class="form-group">
                <label>
                  <input type="checkbox" class="flat-red" <?php if($prod->featured_status == '1'){ echo 'checked'; } ?>>
                </label>
              </div>
              </td>
              <td>
              <div class="form-group">
                <label>
                  <input type="checkbox" class="flat-red" <?php if($prod->active_status == '1'){ echo 'checked'; } ?>>
                </label>
              </div>
            </td> -->
            <td>
            	<a href="<?php echo site_url('admin/product/editProduct/'.$prod->pid);?>" class="btn btn-info btn-xs">Edit</a>
            	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $prod->pid ?>">Remove</button>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
      <tfoot>
      	<tr>
      		<th>#</th>
      		<th>Product Image</th>
      		<th>Product Name</th>
      		<th>Added on</th>
      		<th>Featured status</th>
      		<th>Active status</th>
      		<th>Action</th>
      	</tr>
      </tfoot>
    </table>
  </div>
</div>
<!--Delete Model-->
<?php
foreach ($products as $key => $prod) {
	?>
	<div class="modal modal-danger fade" id="deleteModal<?php echo $prod->pid ?>" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure to delete <?php echo $prod->name?> product ?</p>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-outline pull-left" role="button" data-dismiss="modal">Close</a>
					<a href="<?php echo site_url('admin/product/deleteProducts/'.$prod->pid); ?>" class="btn btn-outline pull-right">Delete</a>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<!--Delete Model-->
</section>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#catalog').addClass('active');
		$('#products').addClass('active');
		$('#productsTable').DataTable();
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
		
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      	checkboxClass: 'icheckbox_flat-green',
      	radioClass   : 'iradio_flat-green'
      })
      
      $('.myCheckbox').change(function() {
      	var featured_status = $(this).attr('data-id');
      	var checked_status = 0;
      	if ($(this).is(':checked')) {
      		checked_status = 1;
      	}
      	$.ajax({
      		type: "POST",
      		url: "<?php echo site_url('admin/product/update_featured_status'); ?>",
      		data: {
      			product_Id: featured_status,
      			checked_value: checked_status
      		},
      		success: function() {
      		},
      	});
      });
      $('.myCheckboxStatus').change(function() {
      	var active_status = $(this).attr('data-id');
      	var checked_status = 0;
      	if ($(this).is(':checked')) {
      		checked_status = 1;
      	}
      	$.ajax({
      		type: "POST",
      		url: "<?php echo site_url('admin/product/update_active_status'); ?>",
      		data: {
      			product_Id: active_status,
      			checked_value: checked_status
      		},
      		success: function() {
      		},
      	});
      });
    });
  </script>
</body>
</html>