<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Products</li>
</ol>
</section>
<section class="content">
  <!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Add Products</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <?php
      $attributes = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'); 
      echo form_open('admin/product/addProduct', $attributes);
      ?>
    <div class="box-body">
      <div class="col-md-6">
        <div class="form-group">
          <label for="categories" class="col-sm-2 control-label">Categories <span style="color: #de2626;l">*</span></label>
          <div class="col-sm-10">
            <select class="form-control" name="categories_id" id="categories"  required="">
              <option selected="" disabled="" value="">Selected Category</option>
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
          <label for="subcategories" class="col-sm-2 control-label">Sub Categories <span style="color: #de2626;l">*</span></label>
          <div class="col-sm-10">
            <select class="form-control" name="subcategories_id" id="subcategories"  >
              <option selected="" disabled="" value="">Selected SubCategory</option>
              <?php
                foreach ($subcategories as $key => $i) {
                  ?>
              <option value="<?php echo $i->subcategories_id ?>"><?php echo $i->subcategories_name; ?></option>
              <?php
                }
                ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Product Name</label>
          <div class="col-sm-10">
            <input type="text" id="name" placeholder="Product Name" class="form-control" name="name" value="<?php echo set_value('product_name') ?>">
            <span style="color: #de2626;">
            <?php echo form_error('name'); ?>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label for="price" class="col-sm-2 control-label">Product price</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="price" placeholder="price" name="price" value="<?php echo set_value('product_price') ?>">
            <span style="color: #a9a9a9;">
            <?php echo form_error('price'); ?>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label for="weight" class="col-sm-2 control-label">Product weight</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="weight" placeholder="weight" name="weight" value="<?php echo set_value('product_weight') ?>">
            <span style="color: #a9a9a9;">
            <?php echo form_error('weight') ?>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="photo" class="col-sm-2 control-label">Images</label>                
          <div class="col-sm-10">
            <input type="file" class="inputfile" id="photo" placeholder="Image" name="images[]" multiple="" >
            <label for="photo">Upload Images</label>
            <span style="color: #a9a9a9;" id="img_tag">
            </span>
          </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-2 control-label"> Description </label>
          <div class="col-sm-10">
            <textarea  class="form-control" rows="5"
              id="desc" placeholder="Description " name="desc" value="<?php echo set_value('product_info') ?>">
            </textarea> 
          </div>
        </div>
        <!--   </div> -->
      </div>
      <!-- /.box-body -->
      <div class="col-md-12">
        <div class="box-footer">
          <input type="submit" class="btn btn-success" value="Submit" name="submitBtn">
        </div>
      </div>
      <!-- /.box-footer -->
      </form>
    </div>
    <!-- /.box -->
  </div>
</section>