<?php
    ini_set( 'display_errors', 1 );
    require "funcs.php";

    $pdo = db_conn();

    $stmt = $pdo->prepare("UPDATE tb_coten_theme SET title=:title, country=:country, img=:img WHERE id = :id");
    $stmt->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(":country", $_POST["country"], PDO::PARAM_STR);
    $stmt->bindValue(":img", $_FILES['userfile']['name'], PDO::PARAM_STR);
    $stmt->bindValue(":id", $_POST["id"], PDO::PARAM_STR);

    $status = $stmt->execute();
    
    $uploaddir = '/Applications/MAMP/htdocs/8_1_AzumaTomoaki/coten_listner_manage/img/';
    $uploaddir_browse = '/Applications/MAMP/htdocs/8_1_AzumaTomoaki/coten_listner/img/';
    $upload = $uploaddir.basename($_FILES['userfile']['name']);
    //var_dump($upload);
    //var_dump($_FILES['userfile']['tmp_name']);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.basename($_FILES['userfile']['name']));
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir_browse.basename($_FILES['userfile']['name']));

    if($status) {
        redirect('edit_theme.html');
    }else{
        //SQLエラー関数
        $error = $stmt->errorInfo();
        sql_error($stmt);
    }
    
?>