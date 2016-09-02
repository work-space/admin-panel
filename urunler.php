<?php
include 'dbconnect.php';
$sql="SELECT * FROM `urunler`";
$urun_card=$conn->query($sql);
while ($row = mysqli_fetch_assoc($urun_card)) {

    echo '

    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="'.$row['resim'].'">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">'.$row['etiket'].'<i class="material-icons right">more_vert</i></span>

            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                <p>'.$row['aciklama'].'</p>
                <p><a href="#header">This is a link</a></p>
            </div>
        </div>
    </div> 
    

   
      ';
    }
?>