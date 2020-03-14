<?php
    include("dbh.php");
    if(isset($_POST['save'])){
        $item_code = $_POST['item_code'];
        $description = $_POST['description'];
        $material = $_POST['material'];
        $finish = $_POST['finish'];

        $mysqli->query("INSERT INTO item (item_code, item_description, material, finish) VALUES('$item_code','$description','$material','$finish' )") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: item.php");
    }

    #Sculpture

    if(isset($_POST['save_sculpture_materials'])){
        $item_code = $_POST['item_code'];
        $sculpture_material = $_POST['sculpture_material'];
        $item_value = $_POST['item_value'];

        $mysqli->query("INSERT INTO item_sculpture_material (item_id, sculpture_id, item_value) VALUES('$item_code','$sculpture_material','$item_value' )") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: sculpture-materials.php");
    }

    if(isset($_POST['save_sculpture_labor'])){
        $item_code = $_POST['item_code'];
        $item_labor = $_POST['item_labor'];

        $mysqli->query("INSERT INTO sculpture_labor (item_id, days) VALUES('$item_code','$item_labor' )") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: sculpture-labor.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $mysqli->query(" DELETE FROM item WHERE id= '$id'  ") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: sculpture_materials_consolidated.php");
    }

    if(isset($_GET['deleteSculptureMaterials'])){
        $id = $_GET['deleteSculptureMaterials'];

        $mysqli->query(" DELETE FROM sculpture_materials WHERE id= '$id'  ") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: sculpture-materials.php");
    }

    if(isset($_GET['deleteSculptureLabor'])){
        $id = $_GET['deleteSculptureLabor'];

        $mysqli->query(" DELETE FROM sculpture_labor WHERE id= '$id'  ") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: sculpture-labor.php");
    }

    #Casting
    if(isset($_POST['save_casting_materials'])){
        $item_code = $_POST['item_code'];
        $sculpture_material = $_POST['casting_material'];
        $item_value = $_POST['item_value'];

        $mysqli->query("INSERT INTO item_casting_material (item_id, sculpture_id, item_value) VALUES('$item_code','$sculpture_material','$item_value' )") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: casting-materials.php");
    }

    if(isset($_POST['save_casting_labor'])){
        $item_code = $_POST['item_code'];
        $item_labor = $_POST['item_labor'];

        $mysqli->query("INSERT INTO casting_labor (item_id, days) VALUES('$item_code','$item_labor' )") or die ($mysqli->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: casting-labor.php");
    }

    if(isset($_GET['deleteCastingLabor'])){
        $id = $_GET['deleteCastingLabor'];

        $mysqli->query(" DELETE FROM casting_labor WHERE id= '$id'  ") or die ($mysqli->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "success";
        header("location: casting-labor.php");
    }