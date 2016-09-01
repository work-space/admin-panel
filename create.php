<?php
include 'dbconnect.php';
$sql2="SELECT * FROM `slider`";
$sonuc=$conn->query($sql2);
$data = array();
while ($data1 = mysqli_fetch_assoc($sonuc)){
  $data[] = $data1;
}
if(!empty($_POST)){
switch ($_POST["submit"]) {
  case 'kaydet':
    $src = $_FILES["src"]["name"];
    $dsc = $_POST["dsc"];
    $baslik = $_POST["baslik"];
    $uzanti = substr($src, -4, 4);
    $a = microtime();
    $b = str_replace(" ", '', $a);
    if ($src) {
      $numkeeper = rand(1, 10000);
      $numkeeper2 = rand(100, 9999999);
      $sonuc = "img/" . "resim" . $numkeeper . $numkeeper2 . $b . $uzanti;
      move_uploaded_file($_FILES["src"]["tmp_name"], $sonuc);
    }
    $sql = "INSERT INTO slider (dsc,src,baslik) VALUES ('$dsc','$sonuc','$baslik')";
    $conn->query($sql);
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
    break;
  case 'sil':
    $fotos = $_POST["fotos"];
    echo $fotos[0];
    foreach($fotos as $i){
    $sql="DELETE FROM slider WHERE id='$i'";
    $conn->query($sql);
    }
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
    break;
  default:
    echo "deneme";
    break;
}
};
echo '<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kaydet</title>
    ';
include 'importer.php';
echo '
  </head>
  <body>
  <style>
  input[type=checkbox]{
  visibility: hidden;
  }
</style>
  <script >
    angular.module("slideApp",[]).controller("controllerSlide",function ($scope) {
       $scope.fotos=[];
    $scope.delete = function(id) {
        if($scope.fotos.indexOf(id)>-1){
           $scope.idex= $scope.fotos.indexOf(id);
           $scope.fotos.splice($scope.idex,1);
           console.log($scope.fotos);
        }else{
      $scope.fotos.push(id);
      console.log($scope.fotos);
   }   
    }

      
    });
    </script>
    <div class="container" ng-app="slideApp" ng-controller="controllerSlide">
    
      <div class="row">
  ';
include 'header.php';
echo'
  
    <form  enctype="multipart/form-data" action="create.php" method="post">
      <div class="form-group">
      
      <div class="container-fluid">
      ';
        foreach($data as  $foto){
          echo '
        <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs hidden-sm hidden-md " >
            <input type="checkbox" value="'.$foto["id"].'" ng-checked="fotos.indexOf('.$foto["id"].')>-1" name="fotos[]" ><img  ng-click="delete('.$foto["id"].')" ng-style="fotos.indexOf('.$foto["id"].')>-1 ? {opacity:0.5} : null" src="'.$foto["src"].'"  height="300" width="550">
        </div>

        ';};
echo '</div><br>
<input type="submit" name="submit" value="sil" class="btn btn-danger col-md-push-4 col-md-4 col-sm-push-4 col-sm-4 col-xs-push-4 col-xs-4" />
<br><br>
        </form>
        <form  enctype="multipart/form-data" action="create.php" method="post">
        <div class="col-md-push-2 col-md-8 col-xs-8 col-xs-push-2 col-sm-8 col-sm-push-2" style="margin-top:10px">
      <label>Başlık</label><input type="text" name="baslik" class="form-control"><br>
      <label>Açıklama</label><input type="text" name="dsc" class="form-control"><br>
      <label>Dosya</label><input class="form-control" type="file" name="src"><br>
      <input type="submit" name="submit" value="kaydet" class="btn btn-primary col-md-push-3 col-md-6 col-sm-push-3 col-sm-6 col-xs-push-3 col-xs-6" />
    </div>
    </form>
    </div>
    </div>
  </div>
  </body>
</html>
';
?>