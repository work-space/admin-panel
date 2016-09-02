<?php
include 'dbconnect.php';

if(!empty($_POST)){
$background=$_POST["background"];
$label=$_POST["label"];
$hover=$_POST["hover"];
$list_back=$_POST["list_back"];
$sql="UPDATE header_color SET background='$background' , label='$label' , list_back='$list_back' , hover='$hover' WHERE id=1";
$conn->query($sql);
  $page = $_SERVER['PHP_SELF'];
  $sec = "0";
  header("Refresh: $sec; url=$page");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kaydet</title>
    <?php include 'importer.php' ?>

  </head>
  <body>
  <script>
    angular.module('appDemo',[]).controller('controllerDemo',function ($scope) {
      $scope.renk="";
      $scope.baslik_renk="";
      $scope.label_color="";
      $scope.back_color="";
      $scope.deneme1="";
      $scope.deneme2="";
      $scope.deneme3="";
      $scope.deneme4="";
      $scope.kontrol=false;

      $scope.deneme = function(deger,key) {
        $scope.header = {'background-color':deger};
        $scope.renk=deger;
        $scope.deneme1=key;
      }
      $scope.label=function (renk,key) {
        $scope.baslik_renk={'background-color':$scope.back_color,'color':renk};
        $scope.label_color=renk;
        $scope.deneme2=key;
      }
      $scope.back = function (renk,key) {
        $scope.baslik_renk={'background-color':renk, 'color':$scope.label_color};
        $scope.back_color=renk;
        $scope.deneme3=key;
      }
      $scope.hov=function (renk,key) {
        $scope.hovli_color={'background-color':renk, 'color':$scope.label_color};
        $scope.hov_color=renk;
        $scope.deneme4=key;
        $scope.kontrol=true;
        console.log(renk);
      }
    })
  </script>
  <style>

    input[type=radio]{
      visibility: hidden;
      width: 100%;
      height:100%
    }
    .check {
      margin: 1px;
      height: 50px;

      border-radius: 10px;
    }
      }
  </style>
    <div class="container" ng-app="appDemo" ng-controller="controllerDemo" >
      <div class="row">
  <?php  include 'header.php'; ?>
  <div class="col-md-12" style="margin-top:10px;">
    <form  enctype="multipart/form-data" action="bgr_settings.php" method="post">
      <div class="form-group">
          <div class="row" >
            <h2>Header Background Color</h2>
        <div style="display:flex;justify-content: space-around">
        <div class="m3 s3 l3 col check hoverable"  ng-click="deneme('#e67e22',1)" id="adiv" ng-style="renk == '#e67e22' ? { 'background-color' : '#e67e22' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#e67e22'} ">
          <input type="radio" name="background" ng-checked="deneme1 == 1" value="#e67e22" >
        </div>
        <div class="m3 s3 l3 col check hoverable" ng-click="deneme('#2980b9',2)" ng-style="renk == '#2980b9' ? { 'background-color' : '#2980b9' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#2980b9'}">
          <input type="radio" name="background" ng-checked="deneme1 == 2"  value="#2980b9">
        </div>

        <div class="m3 s3 l3 col check hoverable" ng-click="deneme('#ecf0f1',3)" ng-style="renk == '#ecf0f1' ? { 'background-color' : '#ecf0f1' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#ecf0f1'}">
          <input type="radio" name="background" ng-checked="deneme1 == 3" value="#ecf0f1">
        </div>

        <div class="m3 s3 l3 col check hoverable" ng-click="deneme('#d35400',4)" ng-style="renk == '#d35400' ? { 'background-color' : '#d35400' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#d35400'}">
          <input type="radio" name="background" ng-checked="deneme1 == 4" value="#d35400">
        </div>
        </div>
          </div>
        <div class="row">
    <h2>Header Label Color</h2>



          <div style="display:flex;justify-content: space-around">
          <div class="m3 s3 l3 col check hoverable" ng-click="label('#e67e22',1)" id="adiv" ng-style="label_color == '#e67e22' ? { 'background-color' : '#e67e22' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#e67e22'} ">
            <input type="radio" name="label" ng-checked="deneme2 == 1"  value="#e67e22" >
          </div>
          <div class="m3 s3 l3 col check hoverable" ng-click="label('#2980b9',2)" ng-style="label_color == '#2980b9' ? { 'background-color' : '#2980b9' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#2980b9'}">
            <input type="radio" name="label" ng-checked="deneme2 == 2" value="#2980b9">
          </div>

          <div class="m3 s3 l3 col check hoverable" ng-click="label('#ecf0f1',3)" ng-style="label_color == '#ecf0f1' ? { 'background-color' : '#ecf0f1' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#ecf0f1'}">
            <input type="radio" name="label" ng-checked="deneme2 == 3" value="#ecf0f1">
          </div>

          <div class="m3 s3 l3 col check hoverable " ng-click="label('#d35400',4)" ng-style="label_color == '#d35400' ? { 'background-color' : '#d35400' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#d35400'}">
            <input type="radio" name="label"ng-checked="deneme2 == 4" value="#d35400">
          </div>

        </div></div>
          <div class="row">
        <h2>Header List Background Color</h2>
          <div style="display:flex;justify-content: space-around">
        <style>
          .tab:hover{
          background-color: {{kontrol ? hov_color : null}} !important;
          }
        </style>


          <div class="m3 s3 l3 col check hoverable" ng-click="back('#e67e22',1)" id="adiv" ng-style="back_color == '#e67e22' ? { 'background-color' : '#e67e22' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#e67e22'} ">
            <input type="radio" name="list_back" ng-checked="deneme3 == 1"  value="#e67e22" >
          </div>
          <div class="m3 s3 l3 col check hoverable" ng-click="back('#2980b9',2)" ng-style="back_color == '#2980b9' ? { 'background-color' : '#2980b9' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#2980b9'}">
            <input type="radio" name="list_back" ng-checked="deneme3 == 2" value="#2980b9">
          </div>

          <div class="m3 s3 l3 col check hoverable" ng-click="back('#ecf0f1',3)" ng-style="back_color == '#ecf0f1' ? { 'background-color' : '#ecf0f1' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#ecf0f1'}">
            <input type="radio" name="list_back" ng-checked="deneme3 == 3" value="#ecf0f1">
          </div>

          <div class="m3 s3 l3 col check hoverable " ng-click="back('#d35400',4)" ng-style="back_color == '#d35400' ? { 'background-color' : '#d35400' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#d35400'}">
            <input type="radio" name="list_back"ng-checked="deneme3 == 4"  value="#d35400">
          </div>

        </div></div>
            <div class="row">
        <h2>Header List Hover Color</h2>
            <div style="display:flex;justify-content: space-around">


          <div class="m3 s3 l3 col check hoverable" ng-click="hov('#e67e22',1)" id="adiv" ng-style="hov_color == '#e67e22' ? { 'background-color' : '#e67e22' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#e67e22'} ">
            <input type="radio" name="hover" ng-checked="deneme4 == 1"  value="#e67e22" id="a" >
          </div>
          <div class="m3 s3 l3 col check hoverable" ng-click="hov('#2980b9',2)" ng-style="hov_color == '#2980b9' ? { 'background-color' : '#2980b9' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#2980b9'}">
            <input type="radio" name="hover" ng-checked="deneme4 == 2" value="#2980b9">
          </div>

          <div class="m3 s3 l3 col check hoverable" ng-click="hov('#ecf0f1',3)" ng-style="hov_color == '#ecf0f1' ? { 'background-color' : '#ecf0f1' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#ecf0f1'}">
            <input type="radio" name="hover" ng-checked="deneme4 == 3" value="#ecf0f1">
          </div>

          <div class="m3 s3 l3 col check hoverable " ng-click="hov('#d35400',4)" ng-style="hov_color == '#d35400' ? { 'background-color' : '#d35400' , 'opacity' : '0.4','transition':'0.8s','border':'2px solid blue'} :{ 'background-color' : '#d35400'}">
            <input type="radio" name="hover" ng-checked="deneme4 == 4" value="#d35400">
          </div>

        </div>
      <button class="btn waves-effect waves-light blue push-m2 col m8 push-s2 push-l2 s8 l8" style="margin-top:20px;" type="submit">Kaydet </button>
              </div>
    </div>
    </form>
    </div>

  </div>
</div>
  </body>
</html>
