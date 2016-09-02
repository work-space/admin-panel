<?php
include 'dbconnect.php';
$sql2="SELECT * FROM header_color ";
$sonuc=$conn->query($sql2);
$basliklar=array();
$renkler=array();
while($renk = mysqli_fetch_assoc($sonuc)) {
    $renkler[]=$renk;
}

foreach($renkler as $renk) {
    echo '<div id="header" >
    
    <nav class="navbar-fixed" ng-style="header" style="background-color: '.$renk["background"].';transition:0.8s ">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo" style="margin-left: 10px">Logo</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
<ul class="right hide-on-med-and-down">
';
    $sql = "SELECT * FROM `basliklar` ORDER BY sira";
    $result = $conn->query($sql);
    $li_class = "tab";
    while ($row = mysqli_fetch_assoc($result)) {
        $basliklar[]=$row;
    }
    foreach ($basliklar as $row) {
        echo '<li style="margin-right:2px;margin-bottom:2px;" ><a class="tab" ng-mouseenter="hover=true" ng-mouseleave="hover=false" ng-style="baslik_renk" style="color:'.$renk["label"].';transition:0.8s;background-color:'.$renk["list_back"].';"  href=' . $row['link'] . ' >' . $row['label'] . '</a></li>';
    }

    echo '</ul>';
    echo '<ul class="side-nav" id="mobile-demo">';
    foreach ($basliklar as $row) {
        echo '<li style="margin-right:2px;margin-bottom:2px;" ><a class="tab" ng-mouseenter="hover=true" ng-mouseleave="hover=false" ng-style="baslik_renk" style="color:'.$renk["label"].';transition:0.8s;background-color:'.$renk["list_back"].';"  href=' . $row['link'] . ' >' . $row['label'] . '</a></li>';
    }
    echo' 
      </div>
  </nav>
  </div>
         
 <style>
          .tab:hover{
          background-color: '.$renk["hover"].' !important;
            }
          }
        </style>
         <script>
 $(document).on(\'click\', \'a\', function(event){
    $(\'html, body\').animate({
        scrollTop: $( $.attr(this, \'href\') ).offset().top
    }, 500);
    return false;
});
       </script>
          
';
}
?>
