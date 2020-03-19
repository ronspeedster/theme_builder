<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    if(!isset($_SESSION['account'])){
        header("Location: login.php");
    }

    if($_SESSION['account'] == 'general_manager'){
        //header("Location: index.php");
    }
    else if($_SESSION['account'] == 'sales_marketing'){
        header("Location: ../sales_marketing");
    }
    else if($_SESSION['account'] == 'production_manager'){
        //header("Location: ../production_manager");
    }
    else if($_SESSION['account'] == 'product_development'){
        header("Location: ../product_development");
    }
    else {
        // Do nothing
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link rel="icon" href="../img/logo-theme-builder.png" type="image/gif" sizes="16x16">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <style type="text/css">
  ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    opacity: 0.7 !important; /* Firefox */
  }    
    .bg-gradient-primary {
    background-color: #252525 !important;
    background-image: none !important;
    background-size: cover !important;
  }
    nav ul{
      position: sticky !important;
      top: 0;
      z-index: 99;
      white-space: normal;
    }
    nav ul li a{
      white-space: normal !important;
    }
    body, input, textarea{
      /*font-family: 'Arial', sans-serif !important;*/
      /*font-size: 12.5px !important;*/
      scroll-behavior: smooth !important;
    }
  html{
      font-size: 14px !important;
  }
  </style> 
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <nav>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="mx-3">protheme global inc</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" style="display:none;">

      <!-- Heading -->
      <div class="sidebar-heading" style="display:none;">
        Utilities
      </div>
        <!-- Nav Items - Equipments -->
        <li class="nav-item" style="display:none;">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipments" aria-expanded="true" aria-controls="equipments">
                <i class="fas fa-toolbox"></i>
                <span>BOM</span>
            </a>
            <div id="equipments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize BOM:</h6>
                    <a class="collapse-item" href="item.php"><i class="fas fa-plus-square"></i> Add Item</a>
                </div>
            </div>
        </li>

        <li class="nav-item" style="display:none;">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#castingMaterials" aria-expanded="true" aria-controls="castingMaterials">
                <i class="fas fa-toolbox"></i>
                <span>Sculpture Materials</span>
            </a>
            <div id="castingMaterials" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize Materials:</h6>
                    <a class="collapse-item" href="sculpture-materials.php"><i class="fas fa-utensils"></i> Add Sculpture Materials to Items</a>
                    <a class="collapse-item" href="add-sculpture-materials.php"><i class="fas fa-edit"></i> Add / Edit Sculpture Materials</a>
                    <a class="collapse-item" href="sculpture-labor.php"><i class="far fa-clock"></i> Sculpture Labor</a>
                </div>
            </div>
        </li>

        <li class="nav-item" style="display:none;">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sculptureMaterials" aria-expanded="true" aria-controls="equipments">
                <i class="fas fa-toolbox"></i>
                <span>Casting Materials</span>
            </a>
            <div id="sculptureMaterials" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize Materials:</h6>
                    <a class="collapse-item" href="casting-materials.php"><i class="fas fa-utensils"></i> Add Casting Materials to Items</a>
                    <a class="collapse-item" href="add-casting-materials.php"><i class="fas fa-edit"></i> Add / Edit Casting Materials</a>
                    <a class="collapse-item" href="casting-labor.php"><i class="far fa-clock"></i> Casting Labor</a>
                </div>
            </div>
        </li>

        <!-- Production Plan -->
        <li class="nav-item" style="display:none;">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productionPlan" aria-expanded="true" aria-controls="equipments">
                <i class="far fa-clock"></i>
                <span>Production Plan</span>
            </a>
            <div id="productionPlan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize Materials:</h6>
                    <a class="collapse-item" href="production_plans.php"><i class="fas fa-eye"></i> View Projects</a>
                </div>
            </div>
        </li>

        <!-- Utilization  -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#utilizationModule" aria-expanded="true" aria-controls="equipments">
                <i class="fas fa-retweet"></i>
                <span>Utilization Module</span>
            </a>
            <div id="utilizationModule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize Projects:</h6>
                    <a class="collapse-item" href="utilization_module.php"><i class="fas fa-eye"></i> View Projects</a>
                </div>
            </div>
        </li>

        <!-- Accounts  -->
        <li class="nav-item" style="display:none;">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accountsModule" aria-expanded="true" aria-controls="equipments">
                <i class="fas fa-user-circle"></i>
                <span>Accounts</span>
            </a>
            <div id="accountsModule" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Customize Projects:</h6>
                    <a class="collapse-item" href="utilization_module.php"><i class="fas fa-user-circle"></i> View Projects</a>
                </div>
            </div>
        </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    </nav>
    <!-- End of Sidebar -->