<style type="text/css">
  .err{
    color: #d42a2a;
    font-size: 13px;
  }
</style>
 <ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Products</li>
</ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Basics</a></li>
          <li><a href="#tab_2" data-toggle="tab">Quantities</a></li>
          <li><a href="#tab_3" data-toggle="tab">Shipping</a></li>
          <li><a href="#tab_4" data-toggle="tab">Pricing</a></li>
          <li class="pull-right"><button type="button" id="formSubmitBtn" class="btn btn-success">Add Product</button></li>
        </ul>
        <form class="form-horizontal" id="productForm" action="<?php echo site_url('admin/product/productFormSubmit'); ?>" method="post" enctype="multipart/form-data">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="box-body" style="margin-top: 15px;">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3" for="category_id">Category <span class="err">*</span>:</label>
                    <div class="col-md-9">
                      <select class="form-control" name="category_id" id="category_id" required="">
                        <option value="" selected="" disabled="">Select category</option>
                        <?php
                        foreach ($categories as $key => $cat) {
                        ?>
                        <option value="<?php echo $cat->categories_id; ?>"><?php echo $cat->categories_name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3" for="subcategory_id">Sub-Category <span class="err">*</span>:</label>
                    <div class="col-md-9">
                      <select class="form-control" name="subcategory_id" id="subcategory_id" required="">
                        <option value="" selected="" disabled="">Select subcategory</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3" for="prod_name">Product Name <span class="err">*</span>:</label>
                    <div class="col-md-9">
                      <input type="text" name="prod_name" id="prod_name" class="form-control" placeholder="Product name.." required="" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3" for="brand_id">Brand :</label>
                    <div class="col-md-9">
                      <select class="form-control" name="brand_id" id="brand_id">
                        <option selected="" disabled="" value="">Select brand</option>
                        <?php
                        foreach ($brands as $key => $brand) {
                        ?>
                        <option value="<?php echo $brand->brand_id; ?>"><?php echo $brand->brand_name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="summary" class="control-label col-md-3">Summary :</label>
                    <div class="col-md-9">
                      <textarea id="summary" name="summary" rows="10" cols="80">
                      </textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description" class="control-label col-md-3">Description :</label>
                    <div class="col-md-9">
                      <textarea id="description" name="description" rows="10" cols="80">

                      </textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label col-md-3">Select Images <span class="err">*</span>:</label>
                    <div class="col-md-9">
                      <label for="images" class="btn btn-info btn-sm">Upload</label>
                      <span hidden=""><input type="file" id="images" name="images[]" multiple=""></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
              <div class="box-body" style="margin-top: 15px;" id="variantsDiv">
                <div class="col-md-12">
                  <p style="font-size: 20px; font-weight: 600;">Quantities</p>
                  <p>Add instock quantity for the product's variants according to the attributes / features.</p>
                </div>
                <div class="col-md-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      Details
                      <button type="button" id="addVariant" class="btn btn-default btn-sm pull-right" data-id=2>Add new variant</button>
                    </div>
                    <div class="panel-body">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="attr_variant_1">Attribute <span class="err">*</span>:</label>
                          <div class="col-md-9">
                            <select class="form-control" id="attr_variant_1" onchange="javascript: attrVariantChanged(1)" name="attr_variant[]">
                              <option value="" selected="" disabled="">Select attribute</option>
                              <?php
                              foreach ($attributes_select as $key => $attr) {
                              ?>
                              <option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="value_variant_1">Value <span class="err">*</span>:</label>
                          <div class="col-md-9">
                            <select class="form-control" id="value_variant_1" name="value_variant[]">
                              <option value="" selected="" disabled="">Select value</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="skuid_1">SKU ID : <a href="javascript:generateSkuid(1)">(auto generate)</a></label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" id="skuid_1" name="skuid[]" placeholder="Stock keeping unit.." />
                            <input type="hidden" value="" id="generatedFlag">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="qty_1">Quantity <span class="err">*</span>:</label>
                          <div class="col-md-9">
                            <input type="number" min="0" class="form-control" id="qty_1" name="qty[]" placeholder="Number of quantities in stock.." />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="reorder_1">Re-order level <span class="err">*</span>:</label>
                          <div class="col-md-9">
                            <input type="number" min="0" class="form-control" id="reorder_1" name="reorder[]" placeholder="Re-order level.." />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3" for="min_qty_1">Minimum quantity to order <span class="err">*</span>:</label>
                          <div class="col-md-9">
                            <input type="number" min="1" class="form-control" id="min_qty_1" name="min_qty[]" value="1" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="oos" class="control-label col-md-3">Behaviour when out of stock :</label>
                          <div class="col-md-9">
                            <div class="radio">
                              <label>
                                <input type="radio" id="optionsRadios1" name="oos1" value="0" checked>
                                Deny Order (By displaying <i>Out Of Stock</i>)
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" id="optionsRadios2" name="oos1" value="1">
                                Allow Orders
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
              <div class="box-body" style="margin-top: 15px;">
                <div class="col-md-12">
                  <p style="font-size: 20px; font-weight: 600;">Shipping Policy</p>
                  <p>Charge additional shipping costs based on the attributes / features here.</p>
                </div>
                <div class="col-md-12">
                  <table class="table table-bordered" id="shippingTable">
                    <tr>
                      <th>Attribute / Feature</th>
                      <th>Value</th>
                      <th>Cost</th>
                      <th>
                        Action
                        <button type="button" data-id=2 id="addShippingRow" class="btn btn-default btn-sm pull-right">Add Row</botton>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <select class="form-control" id="attr_values_1" onchange="javascript: fetchValues(1)" name="attr[]">
                          <option value="" selected="">Select attribute</option>
                          <?php
                          foreach ($attributes_select as $key => $attr) {
                          ?>
                          <option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </td>
                      <td>
                        <select class="form-control" id="values_select_1" name="values[]">
                          <option value="" selected="">Select value</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="(INR)" id="cost" name="cost[]">
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger btn-xs">Remove</button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_4">
              <div class="box-body" style="margin-top: 15px;">
                <!-- <div class="col-md-12">
                  <p style="font-size: 20px; font-weight: 600;">Retail price <button type="button" class="btn btn-info btn-xs" data-toggle="popover" data-trigger="focus" data-content="This is the net sales price for your customers.">?</button></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price_tax_excl" class="control-label col-md-3">Price (tax excl.)</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="price_tax_excl" id="price_tax_excl" placeholder="(INR)" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="price_tax_incl" class="control-label col-md-3">Price (tax incl.)</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="price_tax_incl" id="price_tax_incl" placeholder="(INR)" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="col-md-3"></div>
                  <div class="col-md-9" style="padding-left: 7px;">
                    <label class="control-label">
                      <input type="checkbox" class="minimal" name="onSale" />&nbsp;
                       Display the "On Sale!" flag on the product page, and on product listings.
                    </label>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                  <p style="font-size: 20px; font-weight: 600;">Cost price <button type="button" class="btn btn-info btn-xs" data-toggle="popover" data-trigger="focus" data-content="The cost price is the price you paid for the product. Do not include the tax. It should be lower than the net sales price: the difference between the two will be your margin.">?</button></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cost_price" class="control-label col-md-3">Price (tax excl.)</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="cost_price" id="cost_price" placeholder="(INR)" />
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <hr /> -->
                <div class="col-dm-12">
                  <p style="text-align: center; font-size: 20px;">Add pricing structure</p>
                </div>
                <div id="priceStructureBody">
                  <div class="col-md-12">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        Details
                        <button id="addStructureBtn" type="button" data-id=2 class="btn btn-default btn-sm pull-right">Add structure</button>
                      </div>
                      <div class="panel-body">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="attr_price_1" class="col-md-3 control-label">Attribute/Feature</label>
                            <div class="col-md-9">
                              <select class="form-control" id="attr_price_1" name="attr_price[]" onchange="javascript:attrPriceStructChange(1)">
                                <option value="" selected="" disabled="">Select attribute</option>
                                <option value="default">Default</option>
                                <?php
                                foreach ($attributes_select as $key => $attr) {
                                ?>
                                <option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="value_price_1" class="col-md-3 control-label">Value</label>
                            <div class="col-md-9">
                              <select class="form-control" id="value_price_1" name="value_price[]">
                                <option value="" selected="" disabled="">Select value</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12" style="background-color: #ecf0f1;">
                          <p style="font-size: 18px; margin-top: 10px;">Retail price <button type="button" class="btn btn-info btn-xs" data-toggle="popover" data-trigger="focus" data-content="This is the net sales price for your customers.">?</button></p>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3" for="price_tax_excl_1">Price (tax excl.)</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="(INR)" id="price_tax_excl_1" name="price_tax_excl_struct[]" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3" for="price_tax_incl_1">Price (tax incl.)</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="(INR)" id="price_tax_incl_1" name="price_tax_incl_struct[]" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-3"></div>
                            <div class="col-md-9" style="padding-left: 7px;">
                              <label class="control-label">
                                <input type="checkbox" class="minimal" name="onSaleStruct[]" />&nbsp;
                                 Display the "On Sale!" flag on the product page, and on product listings.
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12" style="background-color: #ecf0f1;">
                          <p style="font-size: 18px; margin-top: 10px;">Cost price <button type="button" class="btn btn-info btn-xs" data-toggle="popover" data-trigger="focus" data-content="The cost price is the price you paid for the product. Do not include the tax. It should be lower than the net sales price: the difference between the two will be your margin.">?</button></p>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label col-md-3" for="cost_price_tax_excl_1">Price (tax excl.)</label>
                              <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="(INR)" id="cost_price_tax_excl_1" name="cost_price_tax_excl_struct[]" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



<?php $this->load->view('back_end/layout/scripts/add_product_scripts'); ?>