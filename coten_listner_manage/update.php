<?php
    ini_set( 'display_errors', 1 );
    require "funcs.php";

    $pdo = db_conn();

    $sql = "";
    if ($_POST['type'] == 'create') {
        $sql = "INSERT INTO tb_coten_radio (id, num, title, point, apple_podcast_url, google_podcast_url, youtube_url, theme_id, delivery_date) VALUES (NULL, :num, :title, :point, :apple_podcast_url, :google_podcast_url, :youtube_url, :theme_id, :delivery_date)";
    } else {
        $sql = "UPDATE tb_coten_radio SET title=:title, num=:num, point=:point, apple_podcast_url=:apple_podcast_url, google_podcast_url=:google_podcast_url, youtube_url=:youtube_url, theme_id=:theme_id, delivery_date=:delivery_date WHERE id = :id";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":num", $_POST["num"], PDO::PARAM_STR);
    $stmt->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(":point", $_POST["point"], PDO::PARAM_STR);
    $stmt->bindValue(":apple_podcast_url", $_POST["apple_podcast_url"], PDO::PARAM_STR);
    $stmt->bindValue(":google_podcast_url", $_POST["google_podcast_url"], PDO::PARAM_STR);
    $stmt->bindValue(":youtube_url", $_POST["youtube_url"], PDO::PARAM_STR);
    $stmt->bindValue(":theme_id", $_POST["theme_id"], PDO::PARAM_STR);
    $stmt->bindValue(":delivery_date", $_POST["delivery_date"], PDO::PARAM_STR);
    if ($_POST['type'] == 'update') {
        $stmt->bindValue(":id", $_POST["id"], PDO::PARAM_STR);
    }
    // $stmt->debugDumpParams();
    $status = $stmt->execute();
    
    if($status) {
        redirect('edit_list.html');
    }else{
        //SQLエラー関数
        $error = $stmt->errorInfo();
        sql_error($stmt);
    }
    
?>