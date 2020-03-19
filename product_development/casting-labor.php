<?php
require_once 'dbh.php';
include("sidebar.php");
$getItems = $mysqli->query('SELECT i.* FROM item i
    LEFT JOIN casting_labor cl
    ON cl.item_id = i.id
    WHERE cl.item_id IS NULL
    ') or die ($mysqli->error);

$getCastingMaterials = $mysqli->query('SELECT i.item_code, i.item_description, cl.days, cl.id
FROM item i
JOIN casting_labor cl
ON cl.item_id = i.id') or die ($mysqli->error);
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#itemSculptureMaterials').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 50
        } );
    } );
</script>
<title>Sculpture Materials</title>
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
                <h1 class="h3 mb-0 text-gray-800">Casting Labor</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <form action="process_item.php" method="POST" class="mb-1">
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Labor value in hours</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" name="item_code" required>
                                                <option value="" disabled selected>---</option>
                                                <?php while ($newItems = $getItems->fetch_assoc()){ ?>
                                                    <option value="<?php echo $newItems['id'];?>"><?php echo $newItems['item_code']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" placeholder="1.0001" name="item_labor" class="form-control" step="0.00001"  required>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                                <button type="submit" class="btn btn-primary btn-sm mb-1 float-right" name="save_casting_labor"><i class="far fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-12" style="padding: 2%;">
                        <table class="table" id="itemSculptureMaterials">
                            <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Labor in Hours</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($newCastingMaterials=$getCastingMaterials->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $newCastingMaterials['item_code']; ?></td>
                                    <td><?php echo $newCastingMaterials['item_description']; ?></td>
                                    <td><?php echo $newCastingMaterials['days']; ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger float-left" data-toggle="modal" data-target="#exampleModal<?php echo $newCastingMaterials['id']; ?>">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $newCastingMaterials['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $newCastingMaterials['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $newCastingMaterials['item_code'];  ?>'s record? You cannot undo the changes</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="process_item.php?deleteCastingLabor=<?php echo $newCastingMaterials['id']; ?>" class="btn btn-sm btn-danger">Confirm</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal -->
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <!-- Start Row -->
            <div class="row">




            </div>
            <!-- End Row -->
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("footer.php"); ?>
