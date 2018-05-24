<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
</ol>
</section>
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Orders List</h3>
		</div>
		<div class="box-body">
			<table id="ordersTable" class="table table-bordered table-striped">
				<div class="box-body">
					<thead>
						<tr>
							<th>#</th>
							<th>order id</th>
							<th>txnid</th>
							<th>user id</th>
							<th>name</th>
							<th>phone</th>
							<th>pincode</th>
							<th>order status</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($order as $key => $i) {
							?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $i->order_id; ?></td>
								<td><?php echo $i->txnid; ?></td>
								<td><?php echo $i->user_id; ?></td>
								<td><?php echo $i->name; ?></td>
								<td><?php echo $i->phone_no; ?></td>
								<td><?php echo $i->pincode; ?></td>
								<td><?php echo $i->order_status;?></td>
								<td>
									<a href="<?php echo site_url('admin/orders/view_order_page/'.$i->order_id); ?>"><button type="button" class="btn btn-primary btn-xs "><i class="fa fa-eye"></i></button></a>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>order id</th>
							<th>txnid</th>
							<th>user id</th>
							<th>name</th>
							<th>phone</th>
							<th>pincode</th>
							<th>order status</th>
							<th>action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#order').addClass('active');
			$('#ordersId').addClass('active');
			$('#ordersTable').DataTable();
		});
	</script>