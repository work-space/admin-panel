<?php
foreach($renkler as $renk) {
    echo '<div class="row">
<footer class="page-footer" style="background-color: '.$renk["background"].'">
    <div class="container">
        <div class="row">
            <div class="l6 s12">
                <h5 class="white-text">Footer Content</h5>
                
            </div>
        </div>
    </div>
    
        <div class="container">
        <div class="row" style="padding-bottom:10px">
        <div class="col m6 l6 s6" style="color:white;padding:10px">© 2014 Copyright Text</div>
        <div class="col m6 l6 s6 tab center" style="transition:0.8s;padding:10px" ><a style="color:'.$renk["label"].';"href="#header">More Links</a></div>
    </div>
    </div>
</footer>
</div>
';
    }
?>