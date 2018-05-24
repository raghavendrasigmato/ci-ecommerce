<script type="text/javascript">
  jQuery(document).ready(function($) {
    CKEDITOR.replace('summary');
    CKEDITOR.replace('description');
    $('#catalog').addClass('active');
    $('#products').addClass('active');
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
    $('#category_id').change(function(event) {
      $.ajax({
        url: '<?php echo site_url("admin/product/Ajax_fetch_sub_categories"); ?>',
        type: 'POST',
        data: {
          cat_id: $('#category_id').val()
        },
        success: function(reply){
          $('#subcategory_id').html(reply);
        }
      });
    });

    $('#addShippingRow').click(function(event) {
      var id = $(this).attr('data-id');
      var row = '<tr id="row_'+id+'"><td><select class="form-control" name="attr[]" id="attr_values_'+id+'" onchange="javascript:fetchValues('+id+')"><option value="" selected="">Select attribute</option><?php foreach ($attributes_select as $key => $attr) {?><option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option><?php }?></select></td><td><select class="form-control" name="values[]" id="values_select_'+id+'"><option value="" selected="">Select value</option></select></td><td><input type="text" name="cost[]" class="form-control" placeholder="(INR)" id="cost_'+id+'"></td><td><a href="javascript:removeRow('+id+')" type="button" class="btn btn-danger btn-xs">Remove</a></td></tr>';
      $('#shippingTable').append(row);
      $(this).attr('data-id', parseInt(id) + parseInt(1));
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });

    $('[data-toggle="popover"]').popover();

    $('#addVariant').click(function(event) {
      var id = $(this).attr('data-id');
      var box = '<div class="col-md-12" id="variantRow'+id+'"><div class="panel panel-info"><div class="panel-heading">Details<a href="javascript:removeVariant('+id+')" class="btn btn-danger btn-sm pull-right">Remove variant</a></div><div class="panel-body"><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="attr_variant_'+id+'">Attribute <span class="err">*</span>:</label><div class="col-md-9"><select class="form-control" name="attr_variant[]" onchange="javascript: attrVariantChanged('+id+')" id="attr_variant_'+id+'"><option value="" selected="" disabled="">Select attribute</option><?php foreach ($attributes_select as $key => $attr) { ?><option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name ?></option><?php }?></select></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="value_variant_'+id+'">Value <span class="err">*</span>:</label><div class="col-md-9"><select class="form-control" name="value_variant[]" id="value_variant_'+id+'"><option value="" selected="" disabled="">Select value</option></select></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="skuid_'+id+'">SKU ID : <a href="javascript:generateSkuid('+id+')">(auto generate)</a></label><div class="col-md-9"><input type="text" name="skuid[]" class="form-control" id="skuid_'+id+'" placeholder="Stock keeping unit.." /></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="qty_'+id+'">Quantity <span class="err">*</span>:</label><div class="col-md-9"><input type="number" name="qty[]" min="0" class="form-control" id="qty_'+id+'" placeholder="Number of quantities in stock.." /></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="reorder_'+id+'">Re-order level <span class="err">*</span>:</label><div class="col-md-9"><input type="number" min="0" class="form-control" name="reorder[]" id="reorder_'+id+'" placeholder="Re-order level.." /></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="min_qty_'+id+'">Minimum quantity to order <span class="err">*</span>:</label><div class="col-md-9"><input type="number" name="min_qty[]" min="1" class="form-control" id="min_qty_'+id+'" value="1" /></div></div></div><div class="col-md-6"><div class="form-group"><label for="oos_'+id+'" class="control-label col-md-3">Behaviour when out of stock :</label><div class="col-md-9"><div class="radio"><label><input type="radio" name="oos'+id+'" id="optionsRadios'+id+'" value="0" checked>Deny Order (By displaying <i>Out Of Stock</i>)</label></div><div class="radio"><label><input type="radio" name="oos'+id+'" id="optionsRadios'+id+'" value="1">Allow Orders</label></div></div></div></div></div></div></div>';
      $('#variantsDiv').append(box);
      $(this).attr('data-id', parseInt($(this).attr('data-id')) + parseInt(1));
    });

    $('#formSubmitBtn').click(function(event) {
      $('#productForm').submit();
    });

    $('#addStructureBtn').click(function(event) {
      if($('#attr_price_1').val() == null || $('#attr_price_1').val() == 'default'){
        toastr.error('Default or null attribute selected');
      }else{
        var id = $(this).attr('data-id');
        var box = '<div id="priceStructureRow'+id+'"><div class="col-md-12"><div class="panel panel-info"><div class="panel-heading">Details<a href="javascript:removeStructure('+id+')" class="btn btn-danger btn-sm pull-right">Remove structure</a></div><div class="panel-body"><div class="col-md-6"><div class="form-group"><label for="attr_price_'+id+'" class="col-md-3 control-label">Attribute/Feature</label><div class="col-md-9"><select class="form-control" id="attr_price_'+id+'" name="attr_price[]" onchange="javascript:attrPriceStructChange('+id+')"><option value="" selected="" disabled="">Select attribute</option><?php foreach ($attributes_select as $key => $attr) { ?><option value="<?php echo $attr->attribute_id; ?>"><?php echo $attr->attribute_name; ?></option><?php }?></select></div></div></div><div class="col-md-6"><div class="form-group"><label for="value_price_'+id+'" class="col-md-3 control-label">Value</label><div class="col-md-9"><select class="form-control" id="value_price_'+id+'" name="value_price[]"><option value="" selected="" disabled="">Select value</option></select></div></div></div><div class="col-md-12" style="background-color: #ecf0f1;"><p style="font-size: 18px; margin-top: 10px;">Retail price</p><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="price_tax_excl_'+id+'">Price (tax excl.)</label><div class="col-md-9"><input type="text" class="form-control" placeholder="(INR)" id="price_tax_excl_'+id+'" name="price_tax_excl_struct[]" /></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="price_tax_incl_'+id+'">Price (tax incl.)</label><div class="col-md-9"><input type="text" class="form-control" placeholder="(INR)" id="price_tax_incl_'+id+'" name="price_tax_incl_struct[]" /></div></div></div><div class="col-md-6"><div class="col-md-3"></div><div class="col-md-9" style="padding-left: 7px;"><label class="control-label"><input type="checkbox" class="minimal" name="onSaleStuct[]" />&nbsp;Display the "On Sale!" flag on the product page, and on product listings.</label></div></div></div><div class="col-md-12" style="background-color: #ecf0f1;"><p style="font-size: 18px; margin-top: 10px;">Cost price</p><div class="col-md-6"><div class="form-group"><label class="control-label col-md-3" for="cost_price_tax_excl_'+id+'">Price (tax excl.)</label><div class="col-md-9"><input type="text" class="form-control" placeholder="(INR)" id="cost_price_tax_excl_'+id+'" name="cost_price_tax_excl_struct[]" /></div></div></div></div></div></div></div></div>';
        $('#priceStructureBody').append(box);
        $(this).attr('data-id', parseInt($(this).attr('data-id')) + parseInt(1));
      }
    });
  });

  function fetchValues(id){
    $.ajax({
      url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
      type: 'POST',
      data: {attr_id: $('#attr_values_'+id).val()},
      success: function(reply){
        $('#values_select_'+id).html(reply);
      }
    });
  }

  function removeRow(id){
    $('#row_'+id).remove();
    $('#addShippingRow').attr('data-id', $('#addShippingRow').attr('data-id') - 1);
  }

  function attrVariantChanged(id){
    $.ajax({
      url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
      type: 'POST',
      data: {attr_id: $('#attr_variant_'+id).val()},
      success: function(reply){
        $('#value_variant_'+id).html(reply);
      }
    });
  }

  function attrPriceStructChange(id){
    $.ajax({
      url: '<?php echo site_url("admin/product/Ajax_fetch_values"); ?>',
      type: 'POST',
      data: {attr_id: $('#attr_price_'+id).val()},
      success: function(reply){
        console.log(reply);
        if($('#attr_price_'+id).val() == 'default'){
          $('#value_price_'+id).html('<option value="default">Default</option>');
        }else{
          $('#value_price_'+id).html(reply);
        }
      }
    });
  }

  function removeVariant(id){
    $('#variantRow'+id).remove();
  }

  function removeStructure(id){
    $('#priceStructureRow'+id).remove();
  }

  function generateSkuid(id){
    if($('#generatedFlag').val() == ''){
      $.ajax({
        url: '<?php echo site_url("admin/product/Ajax_generate_sku"); ?>',
        type: 'POST',
        success: function(reply){
          $('#skuid_'+id).val('<?php echo PREFIX;?>'+reply);
          $('#generatedFlag').val(reply);
        }
      });
    }else{
      var count = parseInt($('#generatedFlag').val()) + parseInt(1);
      $('#skuid_'+id).val('<?php echo PREFIX;?>'+count);
      $('#generatedFlag').val(count);
    }
    
  }
</script>