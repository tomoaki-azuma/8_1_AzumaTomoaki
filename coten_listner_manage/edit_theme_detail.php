<?php
// GETでidを取得
$id = $_GET["id"];
$type = $_GET["type"];

$form_str = "";

if ($type == 'new') {
    $row['title'] = "";
    $row['country'] = "";
    $row['img'] = "";
    $form_str = "<form method='POST' action='create_theme.php'>";

} else {
    // DBに接続
    require "funcs.php";
    $pdo = db_conn();

    // 対象データ取得
    $stmt = $pdo->prepare("SELECT * FROM tb_coten_theme");
    $status = $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $form_str = "<form method='POST' action='update_theme.php'>";
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
                <h3>Edit Theme</h3>
            </div>
            <?= $form_str ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="<?=$row['title']?>">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" value="<?=$row['country']?>">
                </div>
                <div class="form-group">
                    <label for="img">img_url</label>
                    <input type="text" name="img" class="form-control" value="<?=$row['img']?>">
                </div>
                <div class="row my-3 mx-2 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <div class="mx-3"><a href="./edit_theme.html" class="btn btn-secondary" role="button">Cancel</a></div>
                </div>
                <input type="hidden" name="id" value="<?= $id ?>">
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