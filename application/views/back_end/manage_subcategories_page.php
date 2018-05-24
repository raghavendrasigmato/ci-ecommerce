    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Products</li>
  </ol>
  </section>


  <section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Subcategories</h3>
    </div>





    <div class="box-body">
      <table id="categoriesTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Subcategories Name</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
         <?php
         foreach ($subcategories as $key => $i) {
          ?>
          <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $i->subcategories_name; ?></td>
           
               
            <td>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#updateModal<?php echo $i->subcategories_id ?>"><i class="fa fa-pencil"></i></button>
              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal<?php echo $i->subcategories_id ?>"><i class="fa fa-trash"></i></button>
            </td>
          </tr>
         <?php
          }
          ?>
      </tbody>

       <tfoot>
          <tr>
            <th>#</th>
              <th>Subcategories Name</th>

            <th>Action</th>
          </tr>

        </tfoot>
    </table>
  </div>

  </div>
  <?php
  foreach ($subcategories as $key => $i) {
    ?>

        <div class="modal fade" id="updateModal<?php echo $i->subcategories_id ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Subcategories Modal</h4>
                </div>
            <form action="<?php echo site_url('admin/subcategories/update/'.$i->subcategories_id); ?>" method="post">

                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label" for="subcategories">SubCategories </label>
                 <input type="text" class="form-control" value="<?php echo $i->subcategories_name; ?>"
                 id="subcategories"  autofocus="" name="subcategories">
               </div>
             </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


         


  <div class="modal modal-danger fade" id="deleteModal<?php echo $i->subcategories_id ?>">
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
                   <a href="<?php echo site_url('admin/subcategories/inactive/'.$i->subcategories_id); ?>" class="btn btn-success">Yes</a>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


  <?php
      }
      ?>
    


  </section>
 <script type="text/javascript">
  jQuery(document).ready(function($) {
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



