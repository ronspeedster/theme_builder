<?php
require_once 'process_accounts.php';
include("sidebar.php");
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;

$getAccounts = $mysqli->query(' SELECT * FROM  accounts') or die ($mysqli->error);

?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#projetsDataTable').DataTable({
            "order": [[ 2, "asc" ]],
            "pageLength": 50
        } );
    } );
</script>
<title>Accounts</title>
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
                <h1 class="h3 mb-0 text-gray-800">Accounts</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <!-- Projects Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Accounts</h6>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <form action="process_accounts.php" method="post">
                                <table class="table">
                                    <thead>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>Password</th>
                                        <th>Account Type</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="full_name" class="form-control" value="<?php if($editAccount){echo $full_name;} ?>"></td>
                                            <td><input type="text" name="user_name" class="form-control"  value="<?php if($editAccount){echo $user_name;} ?>"></td>
                                            <td><input type="password" name="password" class="form-control"></td>
                                            <td>
                                                <select class="form-control" name="account_type">
                                                    <option value="general_manager">General Manager</option>
                                                    <option value="sales_marketing">Sales Marketing</option>
                                                    <option value="product_development">Product Development</option>
                                                    <option value="production_manager">Production Manager</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if(!$editAccount){ ?>
                                    <button type="submit" class="btn btn-primary btn-sm float-right" name="save"><i class="fas fa-save"></i> Save</button>
                                <?php } else { ?>
                                    <input type="text" name="id" value="<?php echo $id;?>" style="visibility:hidden;">
                                    <button type="submit" class="btn btn-success btn-sm float-right" name="update"><i class="fas fa-save"></i> Update</button>
                                <?php } ?>

                            </form>
                            <br/>
                            <br/>
                            <br/>

                            <table class="table" id="projetsDataTable">
                                <thead>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Account Type</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                <?php while ($newAccounts = $getAccounts->fetch_assoc()){ ?>
                                    <tr>
                                        <td><?php echo $newAccounts['full_name'];?></td>
                                        <td><?php echo $newAccounts['username'];?></td>
                                        <td><?php echo $newAccounts['account_type'];?></td>
                                        <td><a class="btn btn-sm btn-warning text-gray-900" href="accounts.php?editAccount=<?php echo $newAccounts['id']; ?>">Edit</a> </td>
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
s