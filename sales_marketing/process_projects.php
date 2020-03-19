<?php
    include('dbh.php');
    if(isset($_POST['save_project'])){
        $project_title = $_POST['project_title'];
        $order_date = $_POST['order_date'];
        $order_target = $_POST['order_target'];
        $itemID = $_POST['item_id'];
        $remarks = $_POST['remarks'];
        $qty = $_POST['qty'];
        $unit_flanges = $_POST['unit_flanges'];
        $unit_cbm = $_POST['unit_cbm'];
        $client_name = $_POST['client_name'];

        $mysqli->query(" INSERT INTO project (project_title, order_date, order_target, item_id, remarks, qty, unit_flanges, unit_cbm, client_name) VALUES ('$project_title','$order_date','$order_target','$itemID','$remarks','$qty','$unit_flanges','$unit_cbm', '$client_name') ") or die ($mysqli->error);

        $_SESSION['message'] = "Project has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }

    if(isset($_GET['deleteProject'])){
        $id = $_GET['deleteProject'];

        $mysqli->query(" DELETE FROM project WHERE id = '$id' ") or die ($mysqli->error);

        $_SESSION['message'] = "Project has been removed!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
    }
?>