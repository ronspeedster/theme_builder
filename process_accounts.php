<?php
    include('dbh.php');
    $editAccount = false;
    if(isset($_POST['save'])){
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $account_type = $_POST['account_type'];

        $mysqli->query("INSERT INTO accounts (username, password, full_name, account_type) VALUES('$user_name','$password','$full_name','$account_type') ") or die ($mysqli->error());
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: accounts.php");
    }
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $account_type = $_POST['account_type'];

        $mysqli->query(" UPDATE accounts
        SET username = '$user_name',
        password = '$password',
        full_name = '$full_name',
        account_type = '$account_type'
        WHERE id = '$id'
         ") or die ($mysqli->error());
        $_SESSION['message'] = "Account has been updated!";
        $_SESSION['msg_type'] = "success";

        header("location: accounts.php");
    }

    if(isset($_GET['editAccount'])){
        $editAccount = true;
        $id = $_GET['editAccount'];
        $getEditAccount = $mysqli->query(" SELECT * FROM accounts WHERE id = '$id' ") or die ($mysqli->error);
        $newEditAccount = $getEditAccount->fetch_array();
        $full_name = $newEditAccount['full_name'];
        $user_name = $newEditAccount['username'];
    }

?>