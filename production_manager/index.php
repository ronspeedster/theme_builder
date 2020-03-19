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

  $getItems =  $mysqli->query(' SELECT * FROM  item') or die ($mysqli->error);
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
<title>Dashboard</title>
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Form Card -->
              <div class="card shadow mb-4">
                  <form action="process_projects.php" method="POST" class="mb-1">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Project: </h6><br/>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="PROJECT-TITLE" name="project_title" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="CLIENT-NAME" name="client_name" required>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label class="float-right"><b>Target Loading Month</b></label>
                        </div>
                        <div class="col">
                            <input type="date" name="order_target" class="form-control">
                        </div>
                        <div class="col">
                            <label class="float-right"><b>Order Date</b></label>
                        </div>
                        <div class="col">
                            <input type="date" name="order_date" class="form-control">
                        </div>
                    </div>
                    <br/>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Item Code - Description</th>
                                  <th>Remarks</th>
                                  <th>QTY</th>
                                  <th>Unit Flanges / item</th>
                                  <th>Unit CBM / item</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <select name="item_id" class="form-control" required>
                                          <option disabled value="0">ITEM CODE</option>
                                          <?php
                                            while ($newItem=$getItems->fetch_assoc()){
                                          ?>
                                           <option value="<?php echo /*$getURI.'&item_id='.*/$newItem['id']; ?>" <?php if($itemID==$newItem['id']){/*echo 'selected';*/}?> > <?php echo $newItem['item_code'].' - '.$newItem['item_description'];?></option>
                                            <?php } ?>
                                      </select>
                                  </td>
                                  <td>
                                      <input type="text" class="form-control" name="remarks" placeholder="OK" required>
                                  </td>
                                  <td>
                                      <input type="number" class="form-control" name="qty" placeholder="1" required>
                                  </td>
                                  <td>
                                      <input type="number" class="form-control" name="unit_flanges" placeholder="1" required>
                                  </td>
                                  <td>
                                      <input type="number" class="form-control" name="unit_cbm" placeholder="1" required>
                                  </td>




                              </tr>
                              <tr>

                              </tr>
                          </tbody>

                      </table>
                    <button type="submit" class="btn btn-primary btn-sm mb-1 float-right" name="save_project"><i class="far fa-save"></i> Save</button>
                  </form>
                </div>
              </div>

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
                                    <a href="production_plans.php?projectID=<?php echo $newProject['id']; ?>" class="btn btn-sm btn-primary" style="margin: 1px;"><i class="far fa-clock"></i> View Production Plan</a>
                                    <a href="print_project.php?projectID=<?php echo $newProject['id']; ?>" class="btn btn-sm btn-success" style="margin: 1px;"><i class="fas fa-print"></i> Print</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $newProject['id']; ?>" style="margin: 1px; display: none;">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $newProject['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $newProject['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $newProject['project_title'];  ?>'s record? You cannot undo the changes</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="process_projects.php?deleteProject=<?php echo $newProject['id']; ?>" class="btn btn-sm btn-danger">Confirm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal -->
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
