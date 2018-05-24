     <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVIGATION</li>

          <li id="dashboard"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <li id="catalog" class=" treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Catalog</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="attributes"><a href="<?php echo site_url('ak-admin/attributes'); ?>"><i class="fa fa-circle-o"></i>Attributes</a></li>
              <li id="categories"><a href="<?php echo site_url('ak-admin/categories'); ?>"><i class="fa fa-circle-o"></i>Categories</a></li>
              <li id="subcategories"><a href="<?php echo site_url('ak-admin/sub-categories'); ?>"><i class="fa fa-circle-o"></i>Subcategories</a></li>
              <li id="products"><a href="<?php echo site_url('ak-admin/products'); ?>"><i class="fa fa-circle-o"></i>Products</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i>Discounts</a></li>
              <li id="stocks"><a href="<?php echo site_url('ak-admin/stocks'); ?>"><i class="fa fa-circle-o"></i>Stocks</a></li>
              
            </ul>
          </li>
          <li id="order" class=" treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Orders</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="ordersId"><a href="<?php echo site_url('ak-admin/orders'); ?>"><i class="fa fa-circle-o"></i>Orders</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i>Invoices</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i>Credit Slips</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i>Delivery Slips</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i>Shopping Cart</a></li>
              
            </ul>
          </li>
          <li id="customersId"><a href="<?php echo site_url('ak-admin/categories'); ?>"><i class="fa fa-tag"></i> <span>Customers</span></a>
          </li>


          <!-- <li id="subcategories" class=" treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Subcategories</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url('admin/subcategories/subcategorie_view'); ?>"><i class="fa fa-circle-o"></i>Add</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i> Manage</a></li>

            </ul>
          </li>

          <li id="subcategories" class=" treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Weight</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url('admin/weight'); ?>"><i class="fa fa-circle-o"></i>Add</a></li>
              <li><a href="<?php echo site_url('ak-admin/manage_subcategories'); ?>"><i class="fa fa-circle-o"></i> Manage</a></li>

            </ul>
          </li>


          <li id="products" class="treeview">
           <a href="#">
            <i class="fa fa-th"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li id="add"><a href="<?php echo site_url('admin/product/add'); ?>"><i class="fa fa-circle-o"></i> Add</a></li>
           <li id="add"><a href="<?php echo site_url('admin/manage'); ?>"><i class="fa fa-circle-o"></i>Manage</a></li> 
         </ul>
       </li>

       <li id="order" class="treeview">
         <a href="#">
          <i class="fa fa-th"></i>
          <span>orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
         <li id="add"><a href="<?php echo site_url('admin/order/add'); ?>"><i class="fa fa-circle-o"></i> Add</a></li>
         <li id="add"><a href="<?php echo site_url('admin/order'); ?>"><i class="fa fa-circle-o"></i>Manage</a></li> 
       </ul>
     </li> -->


   </ul>
 </section>
 <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
 <section class="content-header">
  <h1>
    <?php echo $header;?>
    <small><?php echo $sub_header;?></small>
  </h1>
























