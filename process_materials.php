<?php
    include("dbh.php");
    $update_sculpture_materials = false;
    $update_casting_materials = false;
    if(isset($_POST['save_sculpture_materials'])){
        $sculpture_materials = $_POST['sculpture_materials'];
        $value_price = $_POST['value_price'];

        $mysqli->query("INSERT INTO sculpture_materials (description, price) VALUES('$sculpture_materials','$value_price' )") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: add-sculpture-materials.php");
    }

    if(isset($_POST['update_sculpture_materials'])){
        $id = $_POST['id'];
        $sculpture_materials = $_POST['sculpture_materials'];
        $value_price = $_POST['value_price'];

        $mysqli->query("UPDATE sculpture_materials SET price = '$value_price', description = '$sculpture_materials' WHERE id = '$id' ") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: add-sculpture-materials.php");
    }

    if(isset($_GET['edit_sculpture_materials'])){
        $update_sculpture_materials = true;
        $id = $_GET['edit_sculpture_materials'];
        $getSculptureMaterials = $mysqli->query("SELECT * FROM sculpture_materials WHERE id = '$id' ") or die ($mysqli->error);

        $newSculptureMaterial = $getSculptureMaterials->fetch_assoc();
    }

    if(isset($_GET['deleteSculptureMaterials'])){
        $id = $_GET['deleteSculptureMaterials'];

        $mysqli->query(" DELETE FROM sculpture_materials WHERE id= '$id'  ") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: add-sculpture-materials.php");
    }

    if(isset($_POST['save_casting_materials'])){
        echo $casting_materials = $_POST['casting_materials'];
        echo $value_price = $_POST['value_price'];

        $mysqli->query("INSERT INTO casting_materials (description, price) VALUES('$casting_materials','$value_price' )") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: add-casting-materials.php");
    }

    if(isset($_GET['edit_casting_materials'])){
        $update_casting_materials = true;
        $id = $_GET['edit_casting_materials'];
        $getCastingMaterials = $mysqli->query("SELECT * FROM casting_materials WHERE id = '$id' ") or die ($mysqli->error);

        $newCastingMaterials = $getCastingMaterials->fetch_assoc();
    }

    if(isset($_POST['update_casting_materials'])){
        $id = $_POST['id'];
        $sculpture_materials = $_POST['casting_materials'];
        $value_price = $_POST['value_price'];

        $mysqli->query("UPDATE casting_materials SET price = '$value_price', description = '$sculpture_materials' WHERE id = '$id' ") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: add-casting-materials.php");
    }

    if(isset($_GET['deleteCastingMaterials'])){
        $id = $_GET['deleteCastingMaterials'];

        $mysqli->query(" DELETE FROM casting_materials WHERE id= '$id'  ") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: add-casting-materials.php");
    }

