<?php
    ini_set( 'display_errors', 1 );
    require "funcs.php";

    $pdo = db_conn();

    $stmt = $pdo->prepare("DELETE FROM tb_coten_radio WHERE id = :id");
    $stmt->bindValue(":id", $_POST["id"], PDO::PARAM_STR);

    $status = $stmt->execute();
    
    if($status) {
        redirect('edit_list.html');
    }else{
        //SQLエラー関数
        $error = $stmt->errorInfo();
        sql_error($stmt);
    }
    
?>