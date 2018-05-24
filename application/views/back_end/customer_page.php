<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Orders List</h3>
    </div>
   <div class="box-body">
   
      <table id="customersTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>number</th>
            <th>action</th>
          </tr>
        </thead>

        <tbody>
         <?php
         foreach ($users as $key => $u) {
          ?>
          <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $u->fname; ?></td>
            <td><?php echo $u->lname; ?></td>
            <td><?php echo $u->email; ?></td>
            <td><?php echo $u->number; ?></td>
            <td>
             <button type="button" class="btn btn-primary btn-xs " data-toggle="modal" data-target="#updateModal<?php echo $u->user_id ?>"><i class="fa fa-eye"></i></button>
             <button  type="button" class="btn btn-danger btn-xs " data-toggle="modal" data-target="#deleteModal<?php echo $u->user_id ?>"><i class="fa fa-trash"></i></button>
           </td>
          </tr>
          <?php
          }
        ?>
        </tbody>

         <tfoot>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>number</th>
            <th>action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <?php
  foreach ($users as $key => $u) {
    ?>

    <div class="modal modal-danger fade" id="deleteModal<?php echo $u->user_id ?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Delete <?php echo $u->fname?> Details</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete??</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">close</button>
              <a href="<?php echo site_url('admin/Customers/deleteuser/'.$u->user_id); ?>" class="btn btn-success">Yes</a>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="updateModal<?php echo $u->user_id ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit <?php echo $u->fname?> Details</h4>
              </div>
              <form action="<?php echo site_url('admin/Customers/updateCustomer/'.$u->user_id); ?>" method="post">
                <div class="modal-body">
                  <div class="form-group">
                    <label class="control-label" for="categories">First Name </label>
                    <input type="text" class="form-control" value="<?php echo $u->fname; ?>"
                    id="categories"  autofocus="" name="fname" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="categories">Last Name </label>
                    <input type="text" class="form-control" value="<?php echo $u->lname; ?>"
                    id="categories"  autofocus="" name="lname" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="categories">Email </label>
                    <input type="email" class="form-control" value="<?php echo $u->email; ?>"
                    id="categories"  autofocus="" name="email" required>
                  </div>

                  <div class="form-group">
                    <label class="control-label" for="categories">Number </label>
                    <input type="text" class="form-control" value="<?php echo $u->number; ?>"
                    id="categories"  autofocus="" name="number" required>
                  </div>

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


    <?php } ?>
</section>
<!-- /.content -->

<script type="text/javascript">
$(document).ready(function() {
    $('#customersId').addClass('active');
    
    $('#customersTable').DataTable();
    $('.dateinput').datepicker({ format: "yyyy/mm/dd" });

}); 
</script>

</body>
</html>
