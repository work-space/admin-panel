<?php
include 'dbconnect.php';


$sql2="SELECT * FROM `basliklar` ORDER BY sira";
$gelen_sira="SELECT sira FROM basliklar ORDER BY sira";
$sira_sonuc=array();
$sira_sonuc1 = $conn->query($gelen_sira);
while ($g_l2 = mysqli_fetch_assoc($sira_sonuc1)){
  $sira_sonuc[]= $g_l2;
}


$result2 = $conn->query($sql2);
$result_copy=$result2;
if(!empty($_POST)){
  switch ($_POST["submit"]) {
    case 'kaydet':
      $label=$_POST["label"];
      $sira=$_POST["sira"];
      $link=$_POST["link"];
      $link=$link.'.php';
      $sql="INSERT INTO basliklar (label,link,sira) VALUES ('$label','$link','$sira')";
      $myfile=fopen($link, "w");
      fwrite($myfile, '<?php include "index.php"; ?>');
      fclose($myfile);
      $conn->query($sql);
      $page = $_SERVER['PHP_SELF'];
      $sec = "0";
      header("Refresh: $sec; url=$page");
      break;
    case 'sil':
      $baslik = $_POST["basliklar"];
      echo $baslik[0];
      foreach($baslik as $ia){
        $sql_del="DELETE FROM basliklar WHERE id='$ia'";
        $conn->query($sql_del);
      }
      $page = $_SERVER['PHP_SELF'];
      $sec = "0";
      header("Refresh: $sec; url=$page");
      break;
    case 'güncelle':
      $sira=$_POST["sira"];
      $label=$_POST["label"];
      $eski_sira=$_POST["eski_sira"];
      $id=$_POST["id"];
      foreach($sira_sonuc as $siralar){
        echo 'siralar =>'.implode($siralar).' sira=>'.$sira;
        if(implode($siralar) == $sira){
          $kontrol=true;
          echo 'truee';
          break;
        }else{
          $kontrol=false;
        }
      }
    if($kontrol==true){
      echo 'if kontrol içi';
      foreach($result_copy as $as_gelen){
        if($as_gelen["sira"]==$sira){
          echo 'bulundu';
          $old_id=$as_gelen["id"];
          $old_sira=$as_gelen["sira"];
          $old_label=$as_gelen["label"];
          $sql_old = "UPDATE basliklar SET sira='$eski_sira' , label='$old_label'  WHERE id='$old_id'";
          $yeni_guncelle="UPDATE basliklar SET sira='$sira' , label='$label'  WHERE id='$id'";
          $conn->query($sql_old);
          $conn->query($yeni_guncelle);
          $page = $_SERVER['PHP_SELF'];
          $sec = "0";
          header("Refresh: $sec; url=$page");
          break;
        }
      }
      }else {
        echo 'else içi';
      $sql = "UPDATE basliklar SET sira='$sira' , label='$label'  WHERE id='$id'";
      $conn->query($sql);
      $page = $_SERVER['PHP_SELF'];
      $sec = "0";
      header("Refresh: $sec; url=$page");

    }
      break;
    default:
      echo "SELAAAM";
      break;
  }
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
  <script >
    angular.module("baslikApp",['ngAnimate']).controller("controllerBaslik",function ($scope) {
      $scope.basliklar=[];
      $scope.baslik_id='';
      $scope.baslik_label='';
      $scope.eski_sira='';
      $scope.edit_open=false;
      $scope.sil = function(id) {
        if($scope.basliklar.indexOf(id)>-1){
          $scope.idex= $scope.basliklar.indexOf(id);
          $scope.basliklar.splice($scope.idex,1);
          console.log($scope.basliklar);
        }else{
          $scope.basliklar.push(id);
          console.log($scope.basliklar);
        }
      }
      $scope.editbttn = function (id,label,sira) {
        $scope.edit_open=true;
        $scope.baslik_id=id;
        $scope.baslik_label=label;
        $scope.eski_sira=sira
      }
      $scope.addbttn=function () {
        $scope.edit_open=false;
        $scope.baslik_id='';
        $scope.baslik_label='';
      }

    });
  </script>
  <div class="container" ng-app="baslikApp" ng-controller="controllerBaslik">
    <div class="row">
  <?php  include 'header.php';
  echo '
     <form  enctype="multipart/form-data" action="baslik_ekle.php" method="post" style="margin-top: 70px">
    <div class="row">
    ';
  while ($row = mysqli_fetch_assoc($result2)) {
    echo '
        <div class="col m4 l3 s6" style="margin-bottom: 25px">
        <div style="margin-left: 10px;margin-bottom: -25px" ng-click="editbttn('.$row["id"].', \' '.$row["label"].'\',\' '.$row["sira"].'\')"><i class=" hoverable edit material-icons left">mode_edit</i></div> 
        <input type="checkbox" value="'.$row["id"].'" ng-checked="basliklar.indexOf('.$row["id"].')>-1" name="basliklar[]" >
        <div class="card-panel hoverable" ng-click="sil('.$row["id"].')" ng-style="basliklar.indexOf('.$row["id"].')>-1 ? {\'background-color\':\'#eeff41\',\'transition\':\'0.8s\'} : {\'transition\':\'0.8s\',opacity:1,border:none}">
         '.$row["label"].'
        </div>
        </div>
        
    ';

  }
  echo '
    </div>
    <style>
        .edit{
        margin-right:3px
        display:flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: 2s;
        border-radius: 10px;
        }
     
        .labeller{
            transition: 0.4s;
            padding: 10px;
            border: 1px solid black ;
            cursor: pointer;
            border-radius: 10px;
        }
        .labeller:hover{
            transition: :0.4s;
            background-color: #adadad;
            padding: 15px;
            font-weight: bold;
        }
        input[type=checkbox]{
        visibility: hidden;
        }
    </style>
    <button type="submit" name="submit" value="sil" style="margin-top: 20px" class="btn waves-effect waves-light red push-m4 col m4 push-s4 push-l4 s4 l4" >Sil</button>
    </form>
  
  ';

  ?>
<div class="container col offset-m3 m6 offset-s3 s6" style="margin-top:10px">


      <div ng-if="edit_open" class="anim m12 s12 l12 col">
        <h2>{{baslik_label}}</h2>
        <form  enctype="multipart/form-data" action="baslik_ekle.php" method="post">
            <div class="input-field"> <label>Label</label><input type="text"  name="label" class="form-control" style="margin-bottom: 10px"></div><br>
              <div class="input-field"> <label>Sıra</label><input type="text" name="sira" class="form-control" style="margin-bottom: 10px"></div>
            <input ng-hide="true" type="text" ng-value="baslik_id" name="id">
            <input ng-hide="true" type="text" ng-value="eski_sira" name="eski_sira">
            <button type="submit" name="submit" value="güncelle" class="btn waves-effect waves-light col m5 s5 l5" >Güncelle</button>
            <div style="cursor: pointer; " ng-click="addbttn()" class="btn waves-effect waves-light col push-m2 m5 push-s-2  push-l2  l5" >Vazgeç</div>
        </form>
      </div>


  <div ng-if="!edit_open"  class="anim m12 s12 l12">
    <form  enctype="multipart/form-data" action="baslik_ekle.php" method="post">
      <div class="input-field"><label for="label_kaydet">Label</label><input id="label_kaydet" type="text" name="label" class="form-control"></div><br>
        <div class="input-field"><label for="sira_kaydet">Sıra</label><input id="sira_kaydet" type="text" name="sira" class="form-control"></div><br>
          <div class="input-field"><label for="href_kaydet" >Href</label><input id="href_kaydet" type="text" name="link" class="form-control"><span class="help-block">.php </span></div> <br/>
        <button type="submit" name="submit" value="kaydet" class="btn waves-effect waves-light blue push-m2 col m8 push-s2 push-l2 s8 l8" >Kaydet</button>
    </form>
    </div>

</div>
      <style>
        .anim.ng-enter{
          transition: 0.5s linear all;
          position: absolute;

          opacity: 0;
        }
        .anim.ng-enter.ng-enter-active{
          opacity: 1;
        }
        .anim.ng-leave{
          transition: 0.5s linear all;
          position: absolute;
          opacity: 1;
        }
        .anim.ng-leave-active{
          opacity: 0;
        }
      </style>
  </div>
</div>
  </body>
</html>
