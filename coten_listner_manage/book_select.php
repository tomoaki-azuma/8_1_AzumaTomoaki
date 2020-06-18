<?php
    mb_language("uni");
    mb_internal_encoding("utf-8"); //内部文字コードを変更
    mb_http_input("auto");
    mb_http_output("utf-8");

    require 'funcs.php';
    $db = db_conn();

    $stmt = $db->prepare("SELECT * FROM tb_coten_book");
    $status = $stmt->execute();

    $book_data = array();

    if (status) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $theme_id = $row['theme_id'];
            $temp = Array($row['title'], $row['amazon_url'], $row['amazon_img_url'], $row['recommend']);
    
            if ( array_key_exists($row['theme_id'], $book_data) ) {
                array_push($book_data[$theme_id], $temp);
            } else {
                $book_data[$theme_id] = Array($temp);
            }
        }
    
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($book_data, JSON_UNESCAPED_UNICODE);
    } else {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    }
        
?>
