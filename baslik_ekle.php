<?php
include 'dbconnect.php';
if(!empty($_POST)){
$label=$_POST["label"];
$link=$_POST["link"];
$link=$link.'.php';
$sql="INSERT INTO basliklar (label,link) VALUES ('$label','$link')";
$myfile=fopen($link, "w");
  fwrite($myfile, '<?php include "index.php"; ?>');
  fclose($myfile);
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
    <form  enctype="multipart/form-data" action="baslik_ekle.php" method="post">
      <div class="form-group">
      <label>Label</label><input type="text" name="label" class="form-control"><br>
      <label>Href</label><input type="text" name="link" class="form-control"><span class="help-block">.php </span> <br/>
      <button class="form-control" type="submit">Kaydet </button>
    </div>
    </form>
    </div>
  </div>
</div>
  </body>
</html>
