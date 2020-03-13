<?php
require_once 'process_materials.php';
include("sidebar.php");

$getSculptureMaterials = $mysqli->query('SELECT * FROM sculpture_materials') or die ($mysqli->error);

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
                <h1 class="h3 mb-0 text-gray-800">Add / Edit Sculpture Materials</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <form action="process_materials.php" method="POST" class="mb-1">
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sculpture Materials</th>
                                        <th>Value / Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="sculpture_materials" placeholder="1cm spag resin" value="<?php if($update_sculpture_materials){echo $newSculptureMaterial['description'];} ?>" required></td>
                                        <td><input type="number" class="form-control" name="value_price" placeholder="1.001" step="0.00001" value="<?php if($update_sculpture_materials){echo $newSculptureMaterial['price'];} ?>" required></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary btn-sm mb-1 float-right" name="save_sculpture_materials" style="<?php if($update_sculpture_materials){echo"display: none;";}?> margin: 2px;"><i class="far fa-save"></i> Save</button>
                                <button type="submit" class="btn btn-success btn-sm mb-1 float-right" name="update_sculpture_materials" style="<?php if(!$update_sculpture_materials){echo"display: none;";}?>  margin: 2px;"><i class="far fa-save"></i> Update</button>
                                <a href="add-sculpture-materials.php" class="btn btn-sm btn-warning float-right text-gray-900" style=" margin: 2px;"><i class="fas fa-sync"></i> Refresh / Reset</a>
                                <?php if($update_sculpture_materials){ ?>
                                    <input type="text" name="id" style="visibility: hidden;" value="<?php echo $newSculptureMaterial['id']; ?>">
                                <?php } ?>
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
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($newSculptureMaterials=$getSculptureMaterials->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $newSculptureMaterials['description']; ?></td>
                                    <td><?php echo $newSculptureMaterials['price']; ?></td>
                                    <td>
                                        <a style="" href="add-sculpture-materials.php?edit_sculpture_materials=<?php echo $newSculptureMaterials['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $newSculptureMaterials['id']; ?>">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $newSculptureMaterials['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $newSculptureMaterials['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $newSculptureMaterials['description'];  ?>'s record? You cannot undo the changes</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="process_materials.php?deleteSculptureMaterials=<?php echo $newSculptureMaterials['id']; ?>" class="btn btn-sm btn-danger">Confirm</a>
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
