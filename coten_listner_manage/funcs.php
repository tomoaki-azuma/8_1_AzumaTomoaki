<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn() {
  try {
    //Password:MAMP='root',XAMPP=''
    return new PDO('mysql:dbname=coten_listner;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
  sql_error($stmt);
}

//リダイレクト
function redirect($file_name){
  header("Location: ".$file_name);
  exit();
}

?>