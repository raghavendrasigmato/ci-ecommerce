<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Subcategories</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add Subcategories</h3>
      </div>
      <form class="form-horizontal" action="<?php echo site_url('admin/subcategories/add_subcategories'); ?>" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Category <span style="color: #de2626;">*</span>:</label>
            <div class="col-md-8">
              <select class="form-control" name="categories_id" id="categories" required="">                  
                <option selected="" disabled="" value="">Select category</option>                   
                <?php
                foreach ($categories as $key => $i) {
                 ?>
                 <option value="<?php echo $i->categories_id ?>"><?php echo $i->categories_name; ?></option>
                <?php
                }     
                ?>               
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="subcategories" class="col-sm-2 control-label">Sub Categories</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="subcategories" placeholder="Enter Subcategories" 
              name="subcategories">
              <span style="color: #de2626;">
                <?php echo form_error('subcategories'); ?>
              </span>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <input type="submit" class="btn btn-success" value="Submit" name="submitBtn">
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Manage Subcategories</h3>
      </div>
      <div class="box-body">
        <table id="subcategoriesTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Sub category Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($subcats as $key => $sub) {
            ?>
            <tr>
              <td><?php echo $key+1; ?></td>
              <td><?php echo $sub->categories_name; ?></td>
              <td><?php echo $sub->subcategories_name; ?></td>
              <td>
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateModal<?php echo $sub->subcategories_id ?>">Edit</button>
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $sub->subcategories_id ?>">Delete</button>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Sub category Name</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php
  foreach ($subcats as $key => $sub) {
  ?>
  <div class="modal fade" id="updateModal<?php echo $sub->subcategories_id ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Categories Modal</h4>
          </div>
          <form action="<?php echo site_url('admin/subcategories/update/'.$sub->subcategories_id); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label" for="categories">Category </label>
                <select class="form-control" name="cat_id">
                  <?php
                  foreach ($categories as $key => $cat) {
                  ?>
                  <option value="<?php echo $cat->categories_id; ?>" <?php if($cat->categories_id == $sub->categories_id){ echo "selected"; } ?>><?php echo $cat->categories_name; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="subcategories">Sub category </label>
                <input type="text" class="form-control" value="<?php echo $sub->subcategories_name; ?>"
                id="subcategories" name="subcategories" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal modal-danger fade" id="deleteModal<?php echo $sub->subcategories_id ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Delete Modal</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete subcategory <i><u><?php echo $sub->subcategories_name; ?></u></i></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">close</button>
              <a href="<?php echo site_url('admin/subcategories/inactive/'.$sub->subcategories_id); ?>" class="btn btn-success">Yes</a>
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
  jQuery(document).ready(function($) {
    $('#catalog').addClass('active');
    $('#subcategories').addClass('active');
    $('#subcategoriesTable').DataTable();
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





