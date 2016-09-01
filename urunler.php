<?php
include 'dbconnect.php';
$sql="SELECT * FROM `urunler`";
$result=$conn->query($sql);
while ($row = mysqli_fetch_assoc($result)) {

    echo '<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="thumbnail">
              <img src='.$row['resim'].' alt="...">
              <div class="caption">
                  <h3>'.$row['etiket'].'</h3>
                  <p>'.$row['aciklama'].'</p>
                  <p>
                    <a href="#" class="btn btn-primary" role="button">DEVAMINI OKU...</a>
                    <a href="#"class="btn btn-default"role="button">Sonraki.</a>
                  </p>
              </div>
          </div>
      </div>';
    }
?>