<?php
echo '
<link rel="stylesheet" type="text/css" href="style/css/custom.css">
<script src="js/angular.js"></script>
<script src="js/angular-animate.js"></script>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jssor.slider-21.1.5.min.js"></script>
    
<script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $(\'.carousel.carousel-slider\').carousel({full_width: false,indicators:true});
        $(\'.parallax\').parallax();
    });
</script>
';
 ?>
