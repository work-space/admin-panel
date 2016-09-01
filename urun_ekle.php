<?php
include 'dbconnect.php';
include 'importer.php';
if(!empty($_POST)){
    $src=$_FILES["resim"]["name"];
    $aciklama=$_POST["aciklama"];
    $etiket=$_POST["etiket"];
    $uzanti=substr($src, -4, 4);
    $a=microtime();
    $b=str_replace(" ",'',$a);
    if($src){
        $numkeeper=rand(1, 10000);
        $numkeeper2=rand(100,9999999);
        $sonuc="urun_resim/"."resim".$numkeeper.$numkeeper2.$b.$uzanti;
        move_uploaded_file($_FILES["resim"]["tmp_name"],$sonuc);
    }
    $sql="INSERT INTO urunler (aciklama,resim,etiket) VALUES ('$aciklama','$sonuc','$etiket')";
    $conn->query($sql);
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kaydet</title>
    <?php include 'importer.php' ?>
</head>
<body>
<div class="container">
    <div class="row">
        <?php  include 'header.php'; ?>
        <div class="col-md-offset-3 col-md-6 col-xs-offset-3 col-xs-6" style="margin-top:10px">
            <form  enctype="multipart/form-data" action="urun_ekle.php" method="post">
                <div class="form-group">
                    <label>Etiket Ekle</label><input type="text" name="etiket" class="form-control"><br>
                    <label>Açıklama</label><textarea name="aciklama" class="form-control"></textarea><br>
                    <label>Fotoğraf</label><input class="form-control" type="file" name="resim"><br>
                    <button class="form-control" type="submit">Kaydet </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
