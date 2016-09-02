<?php
include 'dbconnect.php';
include 'importer.php';
$sql_urunler = "SELECT * FROM `urunler`";
$urunler = $conn->query($sql_urunler);
if (!empty($_POST)) {
    switch ($_POST["submit"]) {
        case 'kaydet':
            $src = $_FILES["resim"]["name"];
            $aciklama = $_POST["aciklama"];
            $etiket = $_POST["etiket"];
            $uzanti = substr($src, -4, 4);
            $a = microtime();
            $b = str_replace(" ", '', $a);
            if ($src) {
                $numkeeper = rand(1, 10000);
                $numkeeper2 = rand(100, 9999999);
                $sonuc = "urun_resim/" . "resim" . $numkeeper . $numkeeper2 . $b . $uzanti;
                move_uploaded_file($_FILES["resim"]["tmp_name"], $sonuc);
            }
            $sql = "INSERT INTO urunler (aciklama,resim,etiket) VALUES ('$aciklama','$sonuc','$etiket')";
            $conn->query($sql);
            $page = $_SERVER['PHP_SELF'];
            $sec = "0";
            header("Refresh: $sec; url=$page");
            break;
        case 'sil':
            $urun_id=$_POST["urunler"];
            foreach($urun_id as $uruns){
                $sql_del="DELETE FROM urunler WHERE id='$uruns'";
                $conn->query($sql_del);
            }
            $page = $_SERVER['PHP_SELF'];
            $sec = "0";
            header("Refresh: $sec; url=$page");
            break;
        case 'güncelle':
            $urun_id=$_POST["id"];
            $src = $_FILES["resim"]["name"];
            $etiket=$_POST["etiket"];
            $aciklama=$_POST["aciklama"];
            $uzanti = substr($src, -4, 4);
            $a = microtime();
            $b = str_replace(" ", '', $a);
            if ($src) {
                $numkeeper = rand(1, 10000);
                $numkeeper2 = rand(100, 9999999);
                $sonuc = "urun_resim/" . "resim" . $numkeeper . $numkeeper2 . $b . $uzanti;
                move_uploaded_file($_FILES["resim"]["tmp_name"], $sonuc);
            }
            echo $urun_id,$aciklama,$etiket,$src;
            $sql_urun_guncelle = "UPDATE urunler SET etiket='$etiket' , aciklama='$aciklama', resim='$sonuc'  WHERE id='$urun_id'";
            $conn->query($sql_urun_guncelle);
            $page = $_SERVER['PHP_SELF'];
            $sec = "0";
            header("Refresh: $sec; url=$page");
            break;
        default:
            echo 'başarısız';
            break;
    }
};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kaydet</title>

</head>
<body>
<script>
    angular.module("urunlerApp", ['ngAnimate']).controller("controllerUrunler", function ($scope) {
        $scope.urunler = [];
        $scope.urunler_id = '';
        $scope.etiket = '';
        $scope.edit_urun_open = false;
        $scope.urun_sil = function (id) {
            if ($scope.urunler.indexOf(id) > -1) {
                $scope.idex = $scope.urunler.indexOf(id);
                $scope.urunler.splice($scope.idex, 1);
                console.log($scope.urunler);
            } else {
                $scope.urunler.push(id);
                console.log($scope.urunler);
            }
        };
        $scope.editurunlerbttn = function (id, etiket) {
            $scope.edit_urun_open = true;
            $scope.etiket = etiket;
            $scope.urunler_id = id;
        };
        $scope.addurunlerbttn = function () {
            $scope.edit_urun_open = false;
            $scope.urunler_id = '';
            $scope.etiket = '';
        }

    });
</script>
<div class="container" ng-app="urunlerApp" ng-controller="controllerUrunler">
    <div class="row">
        <?php include 'header.php'; ?>
        <form enctype="multipart/form-data" action="urun_ekle.php" method="post" style="margin-top: 70px">

                <div class="row" >
                    <?php
                    while ($urun = mysqli_fetch_assoc($urunler)) {
                        echo '
                       <div class="col m4 l3 s6" style="margin-bottom: 25px">
                            <div  style="margin-left: 10px;margin-bottom: -30px"  ng-click="editurunlerbttn(' . $urun["id"] . ',\'' . $urun["etiket"] . '\')"  ><i class="material-icons left hoverable" style="cursor:pointer">mode_edit</i></div> 
                            <input type="checkbox" value="' . $urun["id"] . '" ng-checked="urunler.indexOf(' . $urun["id"] . ')>-1" name="urunler[]" >
                            <div class="hoverable card-panel" style="cursor:pointer" ng-click="urun_sil(' . $urun["id"] . ')" ng-style="urunler.indexOf(' . $urun["id"] . ')>-1 ? {\'background-color\':\'#eeff41\',\'transition\':\'0.8s\'} : {\'transition\':\'0.8s\',opacity:1,border:none}">
                            ' . $urun["etiket"] . '
                            </div>
                            
                        </div>
                   
                   ';
                    }
                    ?>
                </div>
            <div class="row">
            <button type="submit" name="submit" value="sil" style="margin-top: 20px"
                   class="btn waves-effect waves-light red push-m4 col m4 push-s4 push-l4 s4 l4">Sil</button>
            </div>
            <style>
                .edit_urun {
                    margin-right: 3px
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    transition: 2s;
                    border-radius: 10px;
                }

                .edit_urun:hover {
                    background-color: #2e6da4;

                    transition: 2s;
                    width: 30px;
                    height: 30px;
                    animation: edit_urun 1s linear infinite alternate backwards;
                }

                @keyframes edit_urun {
                    from {
                        font-size: 20px;
                    }
                    to {
                        font-size: 30px;
                    }
                }

                .labeller {
                    padding: 10px;
                    border: 1px solid black;
                    cursor: pointer;
                    border-radius: 10px;
                }
                input[type=checkbox] {
                    visibility: hidden;
                }
            </style>
        </form>

        <div class="container" style="margin-top:10px">
            <div ng-if="edit_urun_open" class="anim m12 s12 l12 col">
                <h2>{{etiket}}</h2>
                <form enctype="multipart/form-data" action="urun_ekle.php" method="post">
                    <div class="form-group">
                        <div class="input-field"><label>Etiket</label><input type="text" name="etiket" class="validate" style="margin-bottom: 10px"></div><br>
                            <div class="input-field"><label>Açıklama</label><textarea name="aciklama" class="validate materialize-textarea" style="margin-bottom: 10px"></textarea></div><br>

                        <div class="input-field file-field"><div class="btn">Fotoğraf</div><input class="validate" type="file" name="resim"><div class="file-path-wrapper"><input class="file-path validate" type="text"></div></div></<br>

                        <input ng-hide="true" type="text" ng-value="urunler_id" name="id">
                        <input type="submit" name="submit" value="güncelle" class="btn waves-effect waves-light blue col m5 s5 l5"/>

                        <div style="cursor: pointer; " ng-click="addurunlerbttn()"
                             class="btn waves-effect waves-light col push-m2 m5 push-s-2 red push-l2  l5">
                            Vazgeç
                        </div>
                    </div>
                </form>
            </div>

            <div ng-if="!edit_urun_open" class="anim m12 s12 l12 col">
                <form enctype="multipart/form-data" action="urun_ekle.php" method="post">
                        <div class="input-field"><label class="active" for="etiket_kaydet">Etiket Ekle</label><input id="etiket_kaydet" type="text" name="etiket" class="validate"></div><br>
                            <div class="input-field"><label class="active" for="acikama_kaydet">Açıklama</label><textarea id="acikama_kaydet" name="aciklama" class="validate materialize-textarea"></textarea></div><br>
                        <div class="input-field file-field"><div class="btn">Fotoğraf</div><input class="validate" type="file" name="resim"><div class="file-path-wrapper"><input class="file-path validate" type="text"></div></div></<br>
                        <button type="submit" name="submit" value="kaydet" class="btn waves-effect waves-light blue push-m2 col m8 push-s2 push-l2 s8 l8" >Kaydet</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        .anim.ng-enter {
            transition: 0.5s linear all;
            position: absolute;

            opacity: 0;
        }

        .anim.ng-enter.ng-enter-active {
            opacity: 1;
        }

        .anim.ng-leave {
            transition: 0.5s linear all;
            position: absolute;
            opacity: 1;
        }

        .anim.ng-leave-active {
            opacity: 0;
        }
    </style>
    </div>
</div>
</body>
</html>
