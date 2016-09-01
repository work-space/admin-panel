<?php
include 'dbconnect.php';
$sql2="SELECT * FROM `header_color`";
$sonuc=$conn->query($sql2);
while($renk = mysqli_fetch_assoc($sonuc)) {
    echo ' 
 <nav class="navbar navbar-default" ng-style="header" style="background-color: '.$renk["background"].' ">
      <div>
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                      aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Deneme Sitesi</a>
          </div>

          <div id="navbar" class="navbar-collapse collapse ">
              <ul class="nav navbar-nav" > ';
    include 'dbconnect.php';
    $sql = "SELECT * FROM `basliklar`";
    $result = $conn->query($sql);
    $li_class = "tab";
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li style="margin-right:2px;margin-bottom:2px" ><a class="tab" ng-mouseenter="hover=true" ng-mouseleave="hover=false" ng-style="baslik_renk" style="color:'.$renk["label"].';background-color:'.$renk["list_back"].';font-weight:bold;border-radius:10px"  href=' . $row['link'] . ' >' . $row['label'] . '</a></li>';
    }

    echo '</ul>
                      <style>
          .tab:hover{
          background-color: '.$renk["hover"].' !important;
          }
        </style>
          </div>
      </div>
  </nav>

';
}
?>
