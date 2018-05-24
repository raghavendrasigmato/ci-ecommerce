<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</section>

<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Categories</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <?php 
    $attributes = array('class' => 'form-horizontal');
    echo form_open('ak-admin/categories', $attributes); 
    ?>
    <div class="box-body">
     <div class="form-group">
      <label for="categories" class="col-sm-2 control-label">Categories Name :</label>
      <div class="col-sm-8">
       <input type="text" class="form-control" id="categories" placeholder="categories" autofocus="" name="categories"/>
       <span style="color: #de2626;">
        <?php echo form_error('categories'); ?>
      </span>
    </div>

  </div>
</div>
<!-- /.box-body -->
<div class="box-footer">        
  <button type="submit" class="btn btn-success" value="Submit" name="submitBtn">Submit</button>
</div>
<!-- /.box-footer -->
</form>
</div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Categories</h3>
  </div>
  <div class="box-body">
    <table id="categoriesTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Categories Name</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
       <?php
       foreach ($categories as $key => $i) {
        ?>
        <tr>
          <td><?php echo $key+1; ?></td>
          <td><?php echo $i->categories_name; ?></td>
          <td>
            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateModal<?php echo $i->categories_id ?>">Edit</button>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $i->categories_id ?>">Remove</button>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>#</th>
        <th>Categories Name</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>
</div>
<?php
foreach ($categories as $key => $i) {
	?>
  <div class="modal fade" id="updateModal<?php echo $i->categories_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Categories Modal</h4>
          </div>
          <form action="<?php echo site_url('admin/categories/update/'.$i->categories_id); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label" for="categories">Categories </label>
                <input type="text" class="form-control" value="<?php echo $i->categories_name; ?>"
                id="categories"  autofocus="" name="categories" required>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal modal-danger fade" id="deleteModal<?php echo $i->categories_id ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Delete Modal</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">close</button>
              <a href="<?php echo site_url('admin/categories/inactive/'.$i->categories_id); ?>" class="btn btn-success">Yes</a>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </section>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('#catalog').addClass('active');
      $('#categories').addClass('active');
      $('#categoriesTable').DataTable();
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