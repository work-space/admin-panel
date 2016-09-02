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
    <form  enctype="multipart/form-data" action="create.php" method="post" style="margin-top: 70px">
      <div class="row" > ';
        foreach($data as  $foto){
          echo '
        <div class=" m6 s6 l6">
            <input type="checkbox" value="'.$foto["id"].'" ng-checked="fotos.indexOf('.$foto["id"].')>-1" name="fotos[]" ><img style="margin-bottom:20px" class="img-responsive hoverable col m6 s6 l6" ng-click="delete('.$foto["id"].')" ng-style="fotos.indexOf('.$foto["id"].')>-1 ? {opacity:0.5,\'transition\':\'0.8s\'} : {\'transition\':\'0.8s\',opacity:1,border:none}" src="'.$foto["src"].'"  >
        </div>
        ';}
echo '
    </div>
    <div class="row"><button type="submit" name="submit" value="sil" class="btn waves-effect waves-light red push-m3 col m6 push-s3 push-l3 s6 l6" >Sil</button></div>

        </form>
        <div class="row">
        <form  enctype="multipart/form-data" action="create.php" method="post">
        <div class="col push-m2 m8 s8 push-s2 l8 push-l2" style="margin-top:10px">
      <div class="input-field"><label>Başlık</label><input placeholder="Başlık" type="text" name="baslik"></div><br>
      <div class="input-field"><label>Açıklama</label><input placeholder="Açıklama" type="text" name="dsc" ></div><br>
      <div class="input-field file-field"><div class="btn">Fotoğraf</div><input class="validate" type="file" name="src"><div class="file-path-wrapper"><input class="file-path validate" type="text"></div></div></<br>
      <input type="submit" name="submit" value="kaydet" class="btn waves-effect waves-light blue push-m2 col m8 push-s2 push-l2 s8 l8" />
    </div>
    </form>
    </div>
    ';
    include 'footer.php';
    echo '
    </div>
  </div>
  </body>
</html>
';
?>