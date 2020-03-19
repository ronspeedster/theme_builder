<?php

    include('dbh.php');
    $getURI = $_SESSION['getURI'];
    #Sculpture
    if(isset($_POST['saveUtilizationSculpture'])){
        $indexController = 1;
        $index = $_POST['index'];
        $projectID = $_POST['projectID'];
        while($indexController<=$index){
            $materialID = $_POST['sculptureMaterialID'.$indexController];
            $sculptureActualCost = $_POST['sculptureActualCost'.$indexController];
            $mysqli->query(" INSERT INTO utilization (material, material_id, project_id, actual_cost) VALUES ('sculpture', '$materialID', '$projectID', '$sculptureActualCost') ") or die ($mysqli->error);
            $indexController++;
        }

        $_SESSION['message'] = "Project has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: ".$getURI);
    }

    if(isset($_POST['updateUtilizationSculpture'])){
        $indexController = 1;
        $index = $_POST['index'];
        $projectID = $_POST['projectID'];
        while($indexController<=$index){
            $materialID = $_POST['sculptureMaterialID'.$indexController];
            $sculptureActualCost = $_POST['sculptureActualCost'.$indexController];

            $mysqli->query(" UPDATE utilization SET actual_cost = '$sculptureActualCost'
            WHERE project_id = '$projectID'
            AND material = 'sculpture'
            AND material_id = '$materialID'
            ") or die ($mysqli->error);

            $indexController++;
        }

        $_SESSION['message'] = "Project has been updated!";
        $_SESSION['msg_type'] = "success";
        header("location: ".$getURI);
    }

    #Casting
    if(isset($_POST['saveUtilizationCasting'])){
        $indexController = 1;
        $index = $_POST['castingIndex'];
        $projectID = $_POST['projectID'];
        while($indexController<=$index){
            $materialID = $_POST['castingMaterialID'.$indexController];
            $sculptureActualCost = $_POST['castingActualCost'.$indexController];
            $mysqli->query(" INSERT INTO utilization (material, material_id, project_id, actual_cost) VALUES ('casting', '$materialID', '$projectID', '$sculptureActualCost') ") or die ($mysqli->error);
            $indexController++;
        }

        $_SESSION['message'] = "Project has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: ".$getURI);
    }

    if(isset($_POST['updateUtilizationCasting'])){
        $indexController = 1;
        $index = $_POST['castingIndex'];
        $projectID = $_POST['projectID'];
        while($indexController<=$index){
            $materialID = $_POST['castingMaterialID'.$indexController];
            $sculptureActualCost = $_POST['castingActualCost'.$indexController];
            $mysqli->query(" UPDATE utilization SET actual_cost = '$sculptureActualCost'
            WHERE project_id = '$projectID'
            AND material = 'casting'
            AND material_id = '$materialID'
            ") or die ($mysqli->error);
            $indexController++;
        }

        $_SESSION['message'] = "Project has been updated!";
        $_SESSION['msg_type'] = "success";
        header("location: ".$getURI);
    }


?>