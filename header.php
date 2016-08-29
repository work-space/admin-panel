<?php
echo ' <nav class="navbar navbar-default ">
      <div class="container-fluid">
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

          <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav"> ';
                include 'dbconnect.php';
                $sql="SELECT * FROM `basliklar`";
                $result=$conn->query($sql);
                $li_class="";
                while($row=mysqli_fetch_assoc($result)){
                  echo '<li class='.$li_class.'><a href='.$row['link'].' id="ana">'.$row['label'].'</a></li>';
                  $li_class="";
                }


              echo '</ul>
          </div>
      </div>
  </nav>

';

?>
