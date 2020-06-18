<?php
    ini_set( 'display_errors', 1 );
    require "funcs.php";

    $pdo = db_conn();

    $stmt = $pdo->prepare("UPDATE tb_coten_theme SET title=:title, country=:country, img=:img WHERE id = :id");
    $stmt->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(":country", $_POST["country"], PDO::PARAM_STR);
    $stmt->bindValue(":img", $_POST["img"], PDO::PARAM_STR);
    $stmt->bindValue(":id", $_POST["id"], PDO::PARAM_STR);

    $status = $stmt->execute();
    
    if($status) {
        redirect('edit_theme.html');
    }else{
        //SQLエラー関数
        $error = $stmt->errorInfo();
        sql_error($stmt);
    }
    
?>