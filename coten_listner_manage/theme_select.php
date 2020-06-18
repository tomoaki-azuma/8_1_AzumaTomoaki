<?php
    mb_language("uni");
    mb_internal_encoding("utf-8"); //内部文字コードを変更
    mb_http_input("auto");
    mb_http_output("utf-8");

    require 'funcs.php';
    $db = db_conn();

    $stmt = $db->prepare("SELECT * FROM tb_coten_theme");
    $status = $stmt->execute();
    
    $program_data = array();

    if (status) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $program_data[]=array(
                'id'=>$row['id'],
                'title'=>$row['title'],
                'country'=>$row['country'],
                'img'=>'img/'.$row['img'],
             );
        }
    
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($program_data, JSON_UNESCAPED_UNICODE);
    } else {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    }
?>
