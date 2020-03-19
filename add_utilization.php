<?php
require_once 'dbh.php';

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

if(isset($_GET['projectID'])){
    $projectID = $_GET['projectID'];
    $getProjects = $mysqli->query("SELECT * FROM  project WHERE id = '$projectID' ") or die ($mysqli->error);
    $newProject = $getProjects->fetch_array();
    $itemID = $newProject['item_id'];
    $qty = $newProject['qty'];

    #Sculpture
    $getSculpture = $mysqli->query(" SELECT sm.id, sm.description, sm.price FROM item_sculpture_material ism
    JOIN sculpture_materials sm
    ON sm.id = ism.sculpture_id
    WHERE item_id = '$itemID' ") or die ($mysqli->error);

    $getUtilizationSculpture = $mysqli->query("SELECT * FROM utilization WHERE project_id = '$projectID' AND material = 'sculpture' ");
    $projectExist = true;
    if(mysqli_num_rows($getUtilizationSculpture)==0){
        $projectExist = false;
    }

    #Casting
    $getCasting = $mysqli->query(" SELECT sm.id, sm.description, sm.price FROM item_sculpture_material ism
    JOIN casting_materials sm
    ON sm.id = ism.sculpture_id
    WHERE item_id = '$itemID' ") or die ($mysqli->error);

    $getUtilizationCasting = $mysqli->query("SELECT * FROM utilization WHERE project_id = '$projectID' AND material = 'casting' ");
    $projectCastingExist = true;
    if(mysqli_num_rows($getUtilizationCasting)==0){
        $projectCastingExist = false;
    }



}
else{
   header("location: utilization_module.php");
}

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

                    <!-- Sculpture Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Process: Sculpture</h6>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <form action="process_utilization.php" method="post">
                            <table class="table">
                                <thead>
                                    <th>Material</th>
                                    <th>Budget Cost</th>
                                    <th>Actual Cost</th>
                                    <th>Budget - Actual</th>
                                    <th>%</th>
                                </thead>
                                <tbody>
                                <?php
                                $budgetCostSculpture = array();
                                $index = 0;
                                while($newSculptureMaterial = $getSculpture->fetch_assoc()){
                                    $index++;
                                    $materialID = $newSculptureMaterial['id'];
                                    if($projectExist) {
                                        $getSculptureMaterialInProject = $mysqli->query("SELECT * FROM utilization WHERE project_id = '$projectID' && material_id = '$materialID' && material = 'sculpture'  ");
                                        $newSculptureMaterialInProject = $getSculptureMaterialInProject->fetch_array();
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $newSculptureMaterial['description']; ?></td>
                                        <td>
                                            <?php echo $budgetCostSculptureTemp = (float) $newSculptureMaterial['price']*$qty;?>
                                            <input type="text" value="<?php echo $materialID; ?>" name="sculptureMaterialID<?php echo $index; ?>" style="visibility: hidden; width: 0px;">
                                        </td>
                                        <td>
                                            <?php if($projectExist){ ?>
                                                <input type="number" value="<?php echo $newSculptureMaterialInProject['actual_cost']?>" step="0.0001" min="0" class="form-control" name="sculptureActualCost<?php echo $index;?>">
                                            <?php } else { ?>
                                                <input type="number" placeholder="1.0" step="0.0001" min="0" class="form-control" name="sculptureActualCost<?php echo $index;?>" required>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($projectExist){
                                                $diff = $budgetCostSculptureTemp - $newSculptureMaterialInProject['actual_cost'];
                                                ?>
                                                <label><?php echo $diff; ?></label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($projectExist){
                                                $percent = ($diff / $budgetCostSculptureTemp) * 100;
                                                ?>
                                                <label><?php echo $percent; ?>%</label>
                                            <?php } ?>
                                        </td>

                                <?php
                                    array_push($budgetCostSculpture,$budgetCostSculptureTemp);
                                    }
                                ?>
                                    </tr>
                                </tbody>
                            </table>
                                <input type="text" name="index" value="<?php echo $index; ?>" style="visibility: hidden; width: 0px;">
                                <input type="text" name="projectID" value="<?php echo $projectID; ?>" style="visibility: hidden; width: 0px;">
                                <?php if(!$projectExist){ ?>
                                    <button type="submit" name="saveUtilizationSculpture" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Save</button>
                                <?php } else  { ?>
                                    <button type="submit" name="updateUtilizationSculpture" class="btn btn-sm btn-success float-right"><i class="fas fa-save"></i> Update</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>


                    <!-- Casting Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Process: Sculpture</h6>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <form action="process_utilization.php" method="post">
                            <table class="table">
                                <thead>
                                    <th>Material</th>
                                    <th>Budget Cost</th>
                                    <th>Actual Cost</th>
                                    <th>Budget - Actual</th>
                                    <th>%</th>
                                </thead>
                                <tbody>
                                <?php
                                $budgetCostCasting = array();
                                $index = 0;
                                while($newCastingMaterial = $getCasting->fetch_assoc()){
                                    $index++;
                                    $materialID = $newCastingMaterial['id'];
                                    if($projectCastingExist) {
                                        $getCastingMaterialInProject = $mysqli->query("SELECT * FROM utilization WHERE project_id = '$projectID' && material_id = '$materialID' && material = 'casting'  ");
                                        $newCastingMaterialInProject = $getCastingMaterialInProject->fetch_array();
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $newCastingMaterial['description']; ?></td>
                                        <td>
                                            <?php echo $budgetCostCastingTemp = (float) $newCastingMaterial['price']*$qty;?>
                                            <input type="text" value="<?php echo $materialID; ?>" name="castingMaterialID<?php echo $index; ?>" style="visibility: hidden; width: 0px;">
                                        </td>
                                        <td>
                                            <?php if($projectCastingExist){ ?>
                                                <input type="number" value="<?php echo $newCastingMaterialInProject['actual_cost']?>" step="0.0001" min="0" class="form-control" name="castingActualCost<?php echo $index;?>">
                                            <?php } else { ?>
                                                <input type="number" placeholder="1.0" step="0.0001" min="0" class="form-control" name="castingActualCost<?php echo $index;?>" required>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($projectCastingExist){
                                                $diff = $budgetCostCastingTemp - $newCastingMaterialInProject['actual_cost'];
                                                ?>
                                                <label><?php echo $diff; ?></label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if($projectCastingExist){
                                                $percent = ($diff / $budgetCostSculptureTemp) * 100;
                                                ?>
                                                <label><?php echo $percent; ?>%</label>
                                            <?php } ?>
                                        </td>

                                <?php
                                    array_push($budgetCostCasting,$budgetCostCastingTemp);
                                    }
                                ?>
                                    </tr>
                                </tbody>
                            </table>
                                <input type="text" name="castingIndex" value="<?php echo $index; ?>" style="visibility: hidden; width: 0px;">
                                <input type="text" name="projectID" value="<?php echo $projectID; ?>" style="visibility: hidden; width: 0px;">
                                <?php if(!$projectCastingExist){ ?>
                                    <button type="submit" name="saveUtilizationCasting" class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i> Save</button>
                                <?php } else  { ?>
                                    <button type="submit" name="updateUtilizationCasting" class="btn btn-sm btn-success float-right"><i class="fas fa-save"></i> Update</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php include("footer.php"); ?>
