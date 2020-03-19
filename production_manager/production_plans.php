<?php
require_once 'dbh.php';

if(isset($_GET['projectID'])){
    $projectID = $_GET['projectID'];
    $getProjects = $mysqli->query(" SELECT * FROM  project WHERE id = '$projectID' ") or die ($mysqli->error);
    $newProject = $getProjects->fetch_array();
    $qty = $newProject['qty'];
    $itemID = $newProject['item_id'];
    #Sculpture
    $getSculptureLabor = $mysqli->query(" SELECT * FROM sculpture_labor WHERE item_id = '$itemID' ") or die ($mysqli->error);
    $newSculptureLabor = $getSculptureLabor->fetch_array();
    $sculptureHours = $newSculptureLabor['days'];
    $sculptureHours = $sculptureHours * $qty;
    $sculptureDays = $sculptureHours / 8;

    #Casting
    $getCastingLabor = $mysqli->query(" SELECT * FROM casting_labor WHERE item_id = '$itemID' ") or die ($mysqli->error);
    $newCastingLabor = $getCastingLabor->fetch_array();
    $castingHours = $newCastingLabor['days'];
    $castingHours = $castingHours * $qty;
    $castingDays = $castingHours / 8;
}
else{
    header("location: index.php");
}

include("sidebar.php");
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$sculptureMp = 1;
$CastingMP = 1;
if(isset($_GET['sculptureMp'])){
    $sculptureMp = $_GET['sculptureMp'];
    $sculptureDays = $sculptureHours / (8 * $sculptureMp);
}
$sculptureDays = round($sculptureDays);
$sculptureDaysHolder = $sculptureDays;

if(isset($_GET['CastingMP'])){
    $CastingMP = $_GET['CastingMP'];
    $castingDays = $castingHours / (8 * $CastingMP);
}
$castingDays = round($castingDays);
$castingDaysHolder = $castingDays;

$getDate = $newProject['order_date'];
//$getDate = date('Y/m/d', strtotime($getDate. ' + 166 days'));
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#projetsDataTable').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 50
        } );
    } );
</script>
<title>Production Plan</title>
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
                <h1 class="h3 mb-0 text-gray-800">Production Plan</h1>
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
                    <div class="card-body" style="overflow-x: auto; ">
                        <div class="row">
                            <div class="col">
                                Project: <?php echo $newProject['project_title']; ?>
                                <br>
                                Project No: <?php echo $newProject['id']; ?>
                                <br>
                                Total: <?php echo $qty; ?>
                            </div>
                            <div class="col bg-warning text-black-50">
                                PROJECT START DATE: <?php echo date('Y/m/d', strtotime($newProject['order_date']));?>
                                <br>
                                PROJECT DUE DATE: <?php echo date('Y/m/d', strtotime($newProject['order_target'])); ?>
                            </div>
                            <div class="col">
                                <img src="../img/prod_plan.png" width="450px;" class="float-right">
                            </div>
                        </div>
                        <br/>
                        <table class="table">
                            <tr style="">
                                <th>ITEM No.</th>
                                <th>PRODUCTION STAGE</th>
                                <th>No. of MP</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <?php
                                    $sculptureDays = $sculptureDays+$castingDays;
                                    while($sculptureDays>=0){
                                    $sculptureDays--;
                                    ?>
                                <th>
                                        <p style="font-size: xx-small"><?php echo
                                            $getDate = date('Y/m/d', strtotime($getDate));
                                            $getDate = date('Y/m/d', strtotime($getDate. ' + 1 days'));
                                        ?></p>
                                </th>
                                <?php } ?>

                            </tr>
                            <!-- Sculpture -->
                            <tr>
                                <td>1</td>
                                <td>Sculpture</td>
                                <td>
                                    <select class="form-control" onchange="location = this.value;" style="width: 100px; font-size: small;">
                                        <option value="<?php echo $getURI;?>&sculptureMp=1" <?php if($sculptureMp==1){echo 'selected';} ?> >1</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=2" <?php if($sculptureMp==2){echo 'selected';} ?> >2</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=3" <?php if($sculptureMp==3){echo 'selected';} ?>>3</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=4" <?php if($sculptureMp==4){echo 'selected';} ?>>4</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=5" <?php if($sculptureMp==5){echo 'selected';} ?>>5</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=6" <?php if($sculptureMp==6){echo 'selected';} ?>>6</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=7" <?php if($sculptureMp==7){echo 'selected';} ?>>7</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=8" <?php if($sculptureMp==8){echo 'selected';} ?>>8</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=9" <?php if($sculptureMp==9){echo 'selected';} ?>>9</option>
                                        <option value="<?php echo $getURI;?>&sculptureMp=10" <?php if($sculptureMp==10){echo 'selected';} ?>>10</option>
                                    </select>
                                </td>
                                <td style="font-size: xx-small"><?php echo $getDate = date('Y/m/d', strtotime($newProject['order_date'])); ?></td>
                                <td style="font-size: xx-small"><?php echo $getDate = date('Y/m/d', strtotime($newProject['order_date']."+".$sculptureDaysHolder."days")); ?></td>
                                <?php
                                $sculptureDays = $sculptureDaysHolder;
                                while ($sculptureDays>=0){
                                    $sculptureDays--;
                                ?>
                                    <td style="font-size: small;"><?php
                                        $hours = $sculptureMp*8;
                                        echo $hours;

                                        ?></td>
                                <?php } ?>
                            </tr>

                            <!-- Casting -->
                            <tr>
                                <td>2</td>
                                <td>Casting</td>
                                <td>
                                    <select class="form-control" onchange="location = this.value;" style="width: 100px; font-size: small;">
                                        <option value="<?php echo $getURI;?>&CastingMP=1" <?php if($CastingMP==1){echo 'selected';} ?> >1</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=2" <?php if($CastingMP==2){echo 'selected';} ?> >2</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=3" <?php if($CastingMP==3){echo 'selected';} ?>>3</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=4" <?php if($CastingMP==4){echo 'selected';} ?>>4</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=5" <?php if($CastingMP==5){echo 'selected';} ?>>5</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=6" <?php if($CastingMP==6){echo 'selected';} ?>>6</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=7" <?php if($CastingMP==7){echo 'selected';} ?>>7</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=8" <?php if($CastingMP==8){echo 'selected';} ?>>8</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=9" <?php if($CastingMP==9){echo 'selected';} ?>>9</option>
                                        <option value="<?php echo $getURI;?>&CastingMP=10" <?php if($CastingMP==10){echo 'selected';} ?>>10</option>
                                    </select>
                                </td>
                                <td style="font-size: xx-small"><?php echo $getDate = date('Y/m/d', strtotime($getDate)); ?></td>
                                <td style="font-size: xx-small"><?php echo $getDate = date('Y/m/d', strtotime($getDate."+".$castingDaysHolder."days")); ?></td>
                                <?php
                                $castingDays = $castingDaysHolder + $sculptureDaysHolder;
                                $sculptureDays = $sculptureDaysHolder;
                                $counter = 0;
                                while ($castingDays>=0){
                                    $castingDays--;
                                    if($sculptureDays<=0){
                                    ?>
                                    <td style="font-size: small;"><?php
                                        $hours = $CastingMP*8;
                                        echo $hours;
                                        ?></td>
                                <?php
                                    }
                                    else{
                                        ?>
                                     <td> - </td>
                                <?php
                                    }
                                    $sculptureDays--;
                                } ?>
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
