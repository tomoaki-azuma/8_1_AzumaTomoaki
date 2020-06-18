<?php
// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "funcs.php";
$pdo = db_conn();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM tb_coten_radio WHERE id =:a1");
$stmt ->bindvalue(":a1",$id,PDO::PARAM_INT);//PDO::PARAM_STR
$status = $stmt->execute();

//結果をfetch()
if ($status) { 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[1]);
}

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM tb_coten_theme");
$status = $stmt->execute();

$select_options = "";
while($theme_row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $select_options .= "<option value='".$theme_row['id']."'>".$theme_row['title']."</option>";
}

?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COTEN LISTENER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169185052-1"></script>

</head>
<body>

    <div class="container-xs pt-3 mx-5">
        <div id="app">

        <div class="sticky-top ">
            <div class="row d-flex justify-content-center bg-warning text-white p-2">
                <div><h3 class="m-0 mx-2">COTEN LISTENER KANRI</h3></div>
            </div>
        </div>

        <div class="my-3">
            <div class="d-flex justify-content-center my-3">
                <h3>Edit Program</h3>
            </div>
            <form method="POST" action="update.php">
                <div class="form-group">
                    <label for="num" class="mr-3">No.</label>
                    <input type="text" name="num" value="<?=$row['num']?>">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="<?=$row['title']?>">
                </div>
                <div class="form-group">
                    <label for="point">Description</label>
                    <textarea name="point" class="form-control"><?=$row['point']?></textarea>
                </div>
                <div class="form-group">
                    <label for="apple_podcast_url">apple_podcast_url</label>
                    <input type="text" name="apple_podcast_url" class="form-control" value="<?=$row['apple_podcast_url']?>">
                </div>
                <div class="form-group">
                    <label for="google_podcast_url">google_podcast_url</label>
                    <input type="text" name="google_podcast_url" class="form-control" value="<?=$row['google_podcast_url']?>">
                </div>
                <div class="form-group">
                    <label for="youtube_url">youtube_url</label>
                    <input type="text" name="youtube_url" class="form-control" value="<?=$row['youtube_url']?>">
                </div>
                <div class="form-inline my-4">
                    <label for="theme_id" class="mr-3">テーマ</label>
                    <select name="theme_id">
                        <?= $select_options ?>
                    </select>
                    <div class="mx-4"></div>
                    <label for="delivery_date" class="mr-3">配信日</label>
                    <input type="text" name="delivery_date" value="<?=$row['delivery_date']?>">
                </div>
                <div class="row my-3 mx-2 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <div class="mx-3"><a href="./edit_list.html" class="btn btn-secondary" role="button">Cancel</a></div>
                </div>
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="type" value="update">
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>