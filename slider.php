<?php
include 'dbconnect.php';
$sql="SELECT * FROM `slider`";
$result=$conn->query($sql);
$i="item active";
$p_id=0;
$p_class="active";
$gelen = array();
while ($gelen1 = mysqli_fetch_assoc($result)){
  $gelen[] = $gelen1;
}
        echo '<div style="margin-top:10px;">
            <div id="myCarousel" class="carousel slide "data-ride="carousel">
            <ol class="carousel-indicators" style="background-color:black;opacity:0.5;">';
        foreach($gelen as $row){
                echo '<li data-target="#myCarousel" data-slide-to="'.$p_id.'" class="'.$p_class.'"></li>';
                $p_id=$p_id + 1;
                $p_class="";
              };

        echo '</ol>
              <div class="carousel-inner" role="listbox">';
        foreach($gelen as $row2){
                echo '  <div class="'.$i.'">
                      <img src="'.$row2['src'].'" alt="Chania">
                      <div class="carousel-caption">
                          <h3>'.$row2['baslik'].'</h3>
                          <p>'.$row2['dsc'].'</p>
                      </div>
                  </div>';
                  $i="item";
              };
        echo '
        </div>
        <a class="carousel-control left" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control right" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

        </a>
    </div>

</div>';

?>
