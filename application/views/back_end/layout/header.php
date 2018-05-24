<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Amruth Kesari</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php $this->load->view('back_end/layout/includes')?>
   
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
        <!-- Logo -->
     <a href="<?php echo base_url('ak-admin'); ?>" class="logo"> 
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Amruth</b>Kesari</span>

</a>
      <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="user user-menu">
            <a href="<?php echo site_url('admin/loginCtr/logout'); ?>">             
              <span class="hidden-xs">Signout</span>
            </a>           
          </li>
          <!-- Control Sidebar Toggle Button -->        
        </ul>
      </div>   
    </nav>   
  </header>
  <!-- Left side column. contains the logo and sidebar -->
 





