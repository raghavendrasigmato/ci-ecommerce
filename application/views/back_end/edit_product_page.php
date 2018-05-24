<style type="text/css">
.err{
	color: #d42a2a;
	font-size: 13px;
}
</style>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Edit Products</li>
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
					<li class="pull-right"><button type="button" id="formSubmitBtn" class="btn btn-success">Update Product</button></li>
				</ul>
				<form class="form-horizontal" id="productForm" action="<?php echo site_url('admin/product/productEditFormSubmit/'.@$products->pid); ?>" method="post" enctype="multipart/form-data">
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
													<option value="<?php echo $cat->categories_id; ?>" <?php if(@$products->cat_id == $cat->categories_id){echo "selected";}?>><?php echo $cat->categories_name; ?></option>
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
												<?php 
												$subcategories = $this->Generic_model->general_fetch_array_return_result('subcategories',array('categories_id'=>@$products->cat_id,'active_status'=>'1'));

												foreach ($subcategories as $key => $i) { ?>
													<option value="<?php echo $i->subcategories_id; ?>" <?php if(@$products->sub_cat_id == $i->subcategories_id){echo "selected";}?>><?php echo $i->subcategories_name; ?></option>
													<?php
												}?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3" for="prod_name">Product Name <span class="err">*</span>:</label>
										<div class="col-md-9">
											<input type="text" name="prod_name" id="prod_name" class="form-control" value="<?php echo @$products->name?>" required="" />
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
											<textarea id="summary" name="summary" rows="10" cols="80"> <?php echo @$products->summary?>
										</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="description" class="control-label col-md-3">Description :</label>
									<div class="col-md-9">
										<textarea id="description" name="description" rows="10" cols="80">
											<?php echo @$products->description?>
										</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="" class="control-label col-md-3"> Images <span class="err">*</span>:</label>
									<div class="col-md-9">
										<!--  <img src="<?php echo base_url($img->image_path)?>" alt="" class="img-responsive"> -->
										<p>Images will come here</p>
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
							<?php
							foreach($stock_master_details as $k => $st)
							{
								$map_row = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('map_id'=>$st->map_id));
								$attributeValues = $this->Generic_model->general_fetch_array_return_result('map_attributes_values', array('attribute_id'=>$map_row->attribute_id));
								?>
								<input type="hidden" value="<?php echo $st->stock_master_id; ?>" name="stockMasterId[]">
								<div class="col-md-12">
									<div class="panel panel-info">
										<div class="panel-heading">
											Details
											<button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#add-variant">Add new variant</button>
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
																<option value="<?php echo $attr->attribute_id; ?>" <?php if($map_row->attribute_id == $attr->attribute_id){ echo "selected"; } ?>><?php echo $attr->attribute_name ?></option>
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
															<?php
															foreach ($attributeValues as $key => $attrValues) {
																?>
																<option value="<?php echo $attrValues->value; ?>" 
																	<?php
																	if($map_row->value == $attrValues->value){
																		echo "selected";
																	}
																	?>
																	><?php echo $attrValues->value; ?></option>
																	<?php
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label col-md-3" for="skuid_1">SKU ID : <a href="javascript:generateSkuid(1)">(auto generate)</a></label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="skuid_1" name="skuid[]" value="<?php echo $st->skuid?>" />
															<input type="hidden" value="" id="generatedFlag">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label col-md-3" for="qty_1">Quantity <span class="err">*</span>:</label>
														<div class="col-md-9">
															<input type="number" min="0" class="form-control" id="qty_1" name="qty[]" value="<?php echo $st->instock?>" />
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label col-md-3" for="reorder_1">Re-order level <span class="err">*</span>:</label>
														<div class="col-md-9">
															<input type="number" min="0" class="form-control" id="reorder_1" name="reorder[]" value="<?php echo $st->reorder_level?>" />
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label col-md-3" for="min_qty_1">Minimum quantity to order <span class="err">*</span>:</label>
														<div class="col-md-9">
															<input type="number" min="1" class="form-control" id="min_qty_1" name="min_qty[]" value="<?php echo $st->min_qty_to_order?>" />
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="oos" class="control-label col-md-3">Behaviour when out of stock :</label>
														<div class="col-md-9">
															<div class="radio">
																<label>
																	<input type="radio" id="optionsRadios1" name="oos<?php echo $k; ?>" value="0" <?php if($st->oos_status == '0'){ echo "checked"; } ?>>
																	Deny Order (By displaying <i>Out Of Stock</i>)
																</label>
															</div>
															<div class="radio">
																<label>
																	<input type="radio" id="optionsRadios2" name="oos<?php echo $k; ?>" value="1" <?php if($st->oos_status == '1'){ echo "checked"; } ?>>
																	Allow Orders
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
								}?>
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
												<button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#add-row">
												Add Row</botton>
											</th>
										</tr>
										<?php
										foreach($shippingdetails as $sp)
										{
											$map_row = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('map_id'=>$sp->map_id));
											$attributeValues = $this->Generic_model->general_fetch_array_return_result('map_attributes_values', array('attribute_id'=>$map_row->attribute_id));
											?>
											<input type="hidden" value="<?php echo $sp->shipping_master_id; ?>" name="shippingMasterId[]">
											<tr>
												<td>
													<select class="form-control" id="attr_values_1" onchange="javascript: fetchValues(1)" name="attr[]">
														<option value="" selected="">Select attribute</option>
														<?php
														foreach ($attributes_select as $key => $attr) {
															?>
															<option value="<?php echo $attr->attribute_id; ?>"
																<?php
																if($map_row->attribute_id == $attr->attribute_id){ echo "selected"; }
																?>
																><?php echo $attr->attribute_name; ?></option>
																<?php
															}
															?>
														</select>
													</td>
													<td>
														<select class="form-control" id="values_select_1" name="values[]">
															<option value="" selected="">Select value</option>
															<?php
															foreach ($attributeValues as $key => $attrValues) {
																?>
																<option value="<?php echo $attrValues->value; ?>"
																	<?php
																	if($map_row->value == $attrValues->value){ echo "selected"; }
																	?>
																	><?php echo $attrValues->value; ?></option>
																	<?php
																}
																?>
															</select>
														</td>
														<td>
															<input type="text" class="form-control" placeholder="(INR)" id="cost" name="cost[]" value="<?php echo $sp->cost?>">
														</td>
														<td>
															<button type="button" class="btn btn-danger btn-xs">Remove</button>
														</td>
													</tr>
													<?php
												}
												?>
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
                  <?php
                  foreach($pricingdetails as $pc)
                  	{
                  		$map_row = $this->Generic_model->general_fetch_array_return_row('map_attributes_values', array('map_id'=>$pc->map_id));
                  		$attributeValues = $this->Generic_model->general_fetch_array_return_result('map_attributes_values', array('attribute_id'=>$map_row->attribute_id));
                  		?>
                  		<div id="priceStructureBody">
                  			<div class="col-md-12">
                  				<div class="panel panel-info">
                  					<div class="panel-heading">
                  						Details
                  						<button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#add-structure">Add structure</button>
                  					</div>
                  					<input type="hidden" value="<?php echo $pc->structure_id; ?>" name="structureId[]">
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
                  											<option value="<?php echo $attr->attribute_id; ?>"
                  												<?php
                  												if($map_row->attribute_id == $attr->attribute_id){ echo "selected"; }
                  												?>
                  												><?php echo $attr->attribute_name; ?></option>
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
                  										<?php
                  										foreach ($attributeValues as $key => $attrValues) {
                  											?>
                  											<option value="<?php echo $attrValues->value; ?>" <?php if($map_row->value == $attrValues->value){ echo "selected"; } ?> ><?php echo $attrValues->value; ?></option>
                  												<?php
                  											}
                  											?>
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
                  										<input type="text" class="form-control" placeholder="(INR)" id="price_tax_excl_1" name="price_tax_excl_struct[]"  value="<?php echo $pc->retail_price?>"/>
                  									</div>
                  								</div>
                  							</div>
                  							<div class="col-md-6">
                  								<div class="form-group">
                  									<label class="control-label col-md-3" for="price_tax_incl_1">Price (tax incl.)</label>
                  									<div class="col-md-9">
                  										<input type="text" class="form-control" placeholder="(INR)" id="price_tax_incl_1" name="price_tax_incl_struct[]" value="<?php echo $pc->retail_price_tax?>"/>
                  									</div>
                  								</div>
                  							</div>
                  							<div class="col-md-6">
                  								<div class="col-md-3"></div>
                  								<div class="col-md-9" style="padding-left: 7px;">
                  									<label class="control-label">
                  										<input type="checkbox" class="minimal" name="onSaleStruct[]" <?php if($pc->on_sale_status == '1'){ echo "checked"; } ?> value="<?php echo $pc->on_sale_status?>"/>&nbsp;
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
                  										<input type="text" class="form-control" placeholder="(INR)" id="cost_price_tax_excl_1" name="cost_price_tax_excl_struct[]" value="<?php echo $pc->cost_price?>"/>
                  									</div>
                  								</div>
                  							</div>
                  						</div>
                  					</div>
                  				</div>
                  			</div>
                  		</div>
                  		<?php
                  	}
                  	?>
                  </div>
                </div>
                <!-- /.tab-pane -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="add-row">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    				<h4 class="modal-title">Add Row</h4>
    			</div>
    			<form action="<?php echo site_url('admin/product/addNewShippingRow/'.$this->uri->segment(4)); ?>" class="form" method="post">
    				<div class="modal-body">
    					<div class="form-group">
	    					<label class="control-label">Attribute :</label>
	    					<select class="form-control" name="newRowAttr" id="newRowAttr" onchange="javascript:fetchRowNewValues();">
	    						<option value="" selected="" disabled="">Select attribute</option>
	    						<?php
	    						foreach ($attributes_select as $key => $attr) {
	    						?>
	    						<option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option>
	    						<?php
	    						}
	    						?>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Value :</label>
	    					<select class="form-control" name="newRowValue" id="newRowValue">
	    						<option value="" selected="" disabled="">Select value</option>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Cost :</label>
	    					<input type="text" class="form-control" id="costRowNew" name="costRowNew" />
	    				</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    					<button type="submit" class="btn btn-primary">Save</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <div class="modal fade" id="add-variant">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    				<h4 class="modal-title">Add New Variant</h4>
    			</div>
    			<form action="<?php echo site_url('admin/product/addNewVariant/'.$this->uri->segment(4)); ?>" class="form" method="post">
    				<div class="modal-body">
    					<div class="form-group">
	    					<label class="control-label">Attribute :</label>
	    					<select class="form-control" name="newAttr" id="newAttr" onchange="javascript:fetchNewValues();">
	    						<option value="" selected="" disabled="">Select attribute</option>
	    						<?php
	    						foreach ($attributes_select as $key => $attr) {
	    						?>
	    						<option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option>
	    						<?php
	    						}
	    						?>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Value :</label>
	    					<select class="form-control" name="newValue" id="newValue">
	    						<option value="" selected="" disabled="">Select value</option>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">SKU ID : <a href="javascript:generateNewSkuid()">(auto generate)</a></label>
	    					<input type="text" class="form-control" id="skuidNew" name="skuidNew" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Quantity :</label>
	    					<input type="number" min="1" value="1" class="form-control" id="qtyNew" name="qtyNew" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Re-order level :</label>
	    					<input type="number" min="0" class="form-control" id="reorderLevelNew" name="reorderLevelNew" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Minimum quantity to order :</label>
	    					<input type="number" min="1" value="1" class="form-control" id="minQtyNew" name="minQtyNew" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Behaviour when out of stock :</label>
	    					<div class="radio">
	    						<label>
	    							<input type="radio" name="oosNew" value="0" checked>
	    							Deny Order (By displaying <i>Out Of Stock</i>)
	    						</label>
	    					</div>
	    					<div class="radio">
	    						<label>
	    							<input type="radio" name="oosNew" value="1">
	    							Allow Orders
	    						</label>
	    					</div>
	    				</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    					<button type="submit" class="btn btn-primary">Save</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <div class="modal fade" id="add-structure">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    				<h4 class="modal-title">Add Structure</h4>
    			</div>
    			<form action="<?php echo site_url('admin/product/addNewStructureRow/'.$this->uri->segment(4)); ?>" class="form" method="post">
    				<div class="modal-body">
    					<div class="form-group">
	    					<label class="control-label">Attribute :</label>
	    					<select class="form-control" name="newStructureAttr" id="newStructureAttr" onchange="javascript:fetchStructureNewValues();">
	    						<option value="" selected="" disabled="">Select attribute</option>
	    						<?php
	    						foreach ($attributes_select as $key => $attr) {
	    						?>
	    						<option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option>
	    						<?php
	    						}
	    						?>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Value :</label>
	    					<select class="form-control" name="newStructureValue" id="newStructureValue">
	    						<option value="" selected="" disabled="">Select value</option>
	    					</select>
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Price (tax excl.) :</label>
	    					<input type="text" class="form-control" id="price" name="price" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Price (tax incl.) :</label>
	    					<input type="text" class="form-control" id="priceTax" name="priceTax" />
	    				</div>
	    				<div class="form-group">
	    					<label class="control-label">Cost price :</label>
	    					<input type="text" class="form-control" id="costPrice" name="costPrice" />
	    				</div>
	    				<div class="form-group">
	    					<input type="checkbox" id="onSaleStatus" class="minimal" name="onSaleStruct" />&nbsp;
	    					<label for="onSaleStatus">Display the "On Sale!" flag on the product page, and on product listings.</label>
	    				</div>
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    					<button type="submit" class="btn btn-primary">Save</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <?php $this->load->view('back_end/layout/scripts/add_product_scripts'); ?>
    <?php $this->load->view('back_end/layout/scripts/edit_product_scripts'); ?>