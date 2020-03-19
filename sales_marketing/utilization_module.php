<?php
require_once 'dbh.php';
include("sidebar.php");
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;
$itemID=0;
if(isset($_GET['item_id'])){
    $itemID = $_GET['item_id'];
}
else{
    $getURI=$getURI.'?item_id=0';
}

$getProjects = $mysqli->query(' SELECT * FROM  project') or die ($mysqli->error);

?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#projetsDataTable').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 50
        } );
    } );
</script>
<title>Utilization</title>
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
                <h1 class="h3 mb-0 text-gray-800">Utilization Module</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                <!-- Projects Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <table class="table" id="projetsDataTable">
                            <thead>
                            <th>Title</th>
                            <th>Target Loading Month</th>
                            <th>Order Date</th>
                            <th>Remarks</th>
                            <th>QTY</th>
                            <th>Flanges (total)</th>
                            <th>Unit CBM (total)</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            <?php while ($newProject=$getProjects->fetch_assoc()){
                                $qty = $newProject['qty'];
                                $unit_flanges = $newProject['unit_flanges'];
                                $unit_cbm = $newProject['unit_cbm'];
                                $unit_flanges = $unit_flanges * $qty;
                                $unit_cbm = $unit_cbm * $qty;

                                ?>
                                <tr>
                                    <td><?php echo $newProject['project_title']; ?></td>
                                    <td style="width: 100px;"><?php echo date('Y-m-d', strtotime($newProject['order_target'])); ?></td>
                                    <td style="width: 100px;"><?php echo date('Y-m-d', strtotime($newProject['order_date'])); ?></td>
                                    <td><?php echo $newProject['remarks']; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $unit_flanges; ?></td>
                                    <td><?php echo $unit_cbm; ?></td>
                                    <td>
                                        <a target="_blank" href="add_utilization.php?projectID=<?php echo $newProject['id']; ?>" class="btn btn-sm btn-primary" style="margin: 1px;"><i class="fa fa-plus-circle"></i> Add Utilization</a>

                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
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
