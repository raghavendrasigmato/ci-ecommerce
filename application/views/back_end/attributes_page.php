<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Attributes</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Add Attributes</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo site_url('admin/attributes/addAttr'); ?>">
					<div class="box-body">
						<div class="form-group">
							<label for="attr" class="col-sm-2 control-label">Attribute :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="attr" placeholder="Attribute name" autofocus="" name="attr"/>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Reset</button>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Attributes</h3>
				</div>
				<div class="box-body">
					<table id="attr_table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Values</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($attributes as $key => $att) {
								?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $att->attribute_name; ?></td>
									<td>
										<?php
										$values = $this->Generic_model->general_fetch_array_return_result('map_attributes_values', array('attribute_id'=>$att->attribute_id));
										foreach ($values as $key => $v) {
										?>
										<div class="btn-group">
											<span role="button" class="btn btn-info btn-xs"><?php echo $v->value; ?></span>
											<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-danger<?php echo $v->map_id; ?>"><i class="fa fa-minus" aria-hidden="true"></i></button>
										</div>
										<div class="modal modal-danger fade" id="modal-danger<?php echo $v->map_id; ?>">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Alert</h4>
										      </div>
										      <div class="modal-body">
										        <p>Are you sure to delete value <i><u><?php echo $v->value; ?></u></i></p>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
										        <a href="<?php echo site_url('admin/attributes/removeValue/'.$v->map_id); ?>" role="button" class="btn btn-outline">Yes</a>
										      </div>
										    </div>
										  </div>
										</div>
										<?php
										}
										?>
									</td>
									<td>
										<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#add-value<?php echo $att->attribute_id; ?>">Add Values</button>
										<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-attr<?php echo $att->attribute_id; ?>">Edit</button>
										<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#remove-attr<?php echo $att->attribute_id; ?>">Remove</button>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Values</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
	foreach ($attributes as $key => $att) {
		?>
		<div class="modal fade" id="add-value<?php echo $att->attribute_id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Add Value</h4>
					</div>
					<form action="<?php echo site_url('admin/attributes/addValues/'.$att->attribute_id); ?>" class="form" method="post">
						<div class="modal-body">
							<label class="control-label">Value :</label>
							<input type="text" class="form-control" name="value" />
							<input type="hidden" name="attrId" value="<?php echo $att->attribute_id; ?>" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="edit-attr<?php echo $att->attribute_id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Update Attribute</h4>
					</div>
					<form action="<?php echo site_url('admin/attributes/updateAttr'); ?>" class="form" method="post">
						<div class="modal-body">
							<label for="attribute" class="control-label">Attribute :</label>
							<input type="text" class="form-control" id="attribute" name="attr" value="<?php echo $att->attribute_name; ?>" />
							<input type="hidden" name="attrId" value="<?php echo $att->attribute_id; ?>" />
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal modal-danger fade" id="remove-attr<?php echo $att->attribute_id; ?>">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Alert</h4>
		      </div>
		      <div class="modal-body">
		        <p>Are you sure to delete attribute <i><u><?php echo $att->attribute_name; ?></u></i></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
		        <a href="<?php echo site_url('admin/attributes/removeAttr/'.$att->attribute_id); ?>" role="button" class="btn btn-outline">Yes</a>
		      </div>
		    </div>
		  </div>
		</div>
		<?php
	}
	?>
	</section>
	<!-- /.content -->

	<script type="text/javascript">
		$(document).ready(function() {
			$('#catalog').addClass('active');
			$('#attributes').addClass('active');
			$('#attr_table').DataTable();
		}); 
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
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
	</script>
</body>
</html>
