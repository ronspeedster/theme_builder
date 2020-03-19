<?php
require_once 'dbh.php';
if(isset($_GET['projectID'])){
    $projectID = $_GET['projectID'];
    $getProjects = $mysqli->query(" SELECT * FROM  project WHERE id = '$projectID' ") or die ($mysqli->error);
    $newProject = $getProjects->fetch_array();
    $itemID = $newProject['item_id'];

    $qty = $newProject['qty'];
    $unit_flanges = $newProject['unit_flanges'];
    $unit_cbm = $newProject['unit_cbm'];
    $total_unit_flanges = $unit_flanges * $qty;
    $total_unit_cbm = $unit_cbm * $qty;

    $getItem = $mysqli->query(" SELECT * FROM item WHERE id = '$itemID' ") or die ($mysqli->error);
    $newItem = $getItem->fetch_array();
}
else{
    header("location: index.php");
}
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;
$itemID=0;
include("sidebar.php");
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#projetsDataTable').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 50
        } );
    } );
</script>
<title>Print</title>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include("topbar.php");
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
                <?php
            }
            ?>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Print</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                <!-- Projects Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">PROJECT TITLE:  <?php echo  $newProject['project_title'];?></h6>
                    </div>
                    <div class="card-body" style="padding: 2%; overflow-x: auto;">
                        <div style="text-align: center;">
                            <h3><?php echo $newProject['client_name']; ?></h3>
                            REQ PO # <?php echo $newProject['id']; ?>

                        </div>
                        <label class="float-left text-danger font-weight-bold">Target Loading Month: <?php echo $newProject['order_target']; ?></label>
                        <label class="float-right">Order Date: <?php echo $newProject['order_date']; ?></label>
                        <table class="table">
                            <thead>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Material</th>
                                <th>Finish</th>
                                <th>Remarks</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Unit Flanges</th>
                                <th>Total Flanges</th>
                                <th>Unit CBM</th>
                                <th>Total CBM</th>
                            </thead>
                            <tbody>
                                <td><?php echo $newItem['item_code']; ?></td>
                                <td><?php echo $newItem['item_description']; ?></td>
                                <td><?php echo $newItem['material']; ?></td>
                                <td><?php echo $newItem['finish']; ?></td>
                                <td><?php echo $newProject['remarks']; ?></td>
                                <td><?php echo $newProject['qty']; ?></td>
                                <td><?php echo 'PC'; ?></td>
                                <td><?php echo $unit_flanges; ?></td>
                                <td><?php echo $total_unit_flanges; ?></td>
                                <td><?php echo $unit_cbm; ?></td>
                                <td><?php echo $total_unit_cbm; ?></td>

                            </tbody>
                        </table>
                        <br>
                        <table class="table table-borderless">
                            <tr>
                                <td style="text-align: center;">Prepared by:</td>
                                <td style="text-align: center;">Received by:</td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td style="text-align: center;"><u>Ronaldo Aborde</u>
                                    <br>Casting
                                </td>
                                <td style="text-align: center;"><u>Edgaret Amarante</u>
                                    <br>Assembly
                                </td>
                                <td style="text-align: center;"><u>Sofia Go / Louie Miranda</u>
                                    <br>Sofia Go / Louie Miranda
                                </td>

                            </tr>
                            <tr>
                                <td style="text-align: center;"><u>Ryan Villapaña</u>
                                    <br>Metal
                                </td>
                                <td style="text-align: center;"><u>Angelie Amarante</u>
                                    <br>Detailing and Sanding
                                </td>
                                <td style="text-align: center;"><u>Darwin/Eugene/Riodan</u>
                                    <br>Mixing
                                </td>

                            </tr>
                            <tr>
                                <td style="text-align: center;"><u>Gilbert Bautista</u>
                                    <br>Finishing
                                </td>
                                <td style="text-align: center;"><u>Oliver Tanglao</u>
                                    <br>Packing
                                </td>
                                <td style="text-align: center;" class="text-danger font-weight-bold">DATE: <?php echo date("Y/m/d"); ?></td>
                            </tr>

                        </table>
                    </div>
                </div>


            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("footer.php"); ?>
