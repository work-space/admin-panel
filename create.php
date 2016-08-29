<?php
include 'dbconnect.php';
include 'importer.php';
if(!empty($_POST)){
$src=$_FILES["src"]["name"];
$dsc=$_POST["dsc"];
$baslik=$_POST["baslik"];
$uzanti=substr($src, -4, 4);
$a=microtime();
$b=str_replace(" ",'',$a);
if($src){
  $numkeeper=rand(1, 10000);
  $numkeeper2=rand(100,9999999);
  $sonuc="img/"."resim".$numkeeper.$numkeeper2.$b.$uzanti;
  move_uploaded_file($_FILES["src"]["tmp_name"],$sonuc);
}
$sql="INSERT INTO slider (dsc,src,baslik) VALUES ('$dsc','$sonuc','$baslik')";
$conn->query($sql);
};
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kaydet</title>
    <link rel="stylesheet" href="../style/css/bootstrap.css" />
  </head>
  <body>
    <div class="container">
      <div class="row">
  <?php  include 'header.php'; ?>
  <div class="col-md-offset-3 col-md-6 col-xs-offset-3 col-xs-6" style="margin-top:10px">
    <form  enctype="multipart/form-data" action="create.php" method="post">
      <div class="form-group">
      <label>Başlık</label><input type="text" name="baslik" class="form-control"><br>
      <label>Açıklama</label><input type="text" name="dsc" class="form-control"><br>
      <label>Dosya</label><input class="form-control" type="file" name="src"><br>
      <button class="form-control" type="submit">Kaydet </button>
    </div>
    </form>
    </div>
    </div>
  </div>
  </body>
</html>
