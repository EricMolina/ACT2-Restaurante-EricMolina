<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&display=swap" rel="stylesheet">
    <title>ACT2-Restaurante-EricMolina</title>
</head>
<body>
    <div class="_topName">
        <p class="flex">Desarrollado por: Eric Molina Molina</p>
    </div>
    <div class="row _title flex">
        <img class="_titleImg" src="./img/Title.png" alt="">
    </div>
    <div class="row _arrow flex">
        <div id="arrow" class="_arrowContainer flex scaleHover" style="cursor: pointer;" onclick='window.location="#menu"; DisableArrow();'>
            <img src="./img/Arrow.png" alt="">
        </div>
    </div>
    <div class="row _separator"></div>
    <div id="menu">
        <!--<div class="row _typeTitle flex">
            <div class="column-1 _typeTitleContainer flex">
                <h1>Hamburguesas ejemplo</h1>
            </div>
        </div>-->
        <!--<div class="row _type">
            <div class="column-1 _typeContent">
                <div class="column-70 _typeValues">
                    <div class="column-70_type _typeValuesTitle flex">
                        <h1>Vacuno con queso</h1>
                    </div>
                    <div class="column-30 _typeValuesCost flex">
                        <h2>6€</h2>
                    </div>
                    <div class="column-1 _typeValuesText">
                        <p>texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo 
                        texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo 
                        texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo texto de ejemplo 
                        </p>
                    </div>
                    <div class="column-30 _typeValuesCalories flex">
                        <h3>450 kcal</h3>
                    </div>
                    <div class="_typeValuesTypes flex">
                        <img src="./img/Circle.png" alt="">
                        <img src="./img/Circle.png" alt="">
                        <img src="./img/Circle.png" alt="">
                        <img src="./img/Circle.png" alt="">
                    </div>
                </div>
                <div class="column-30_type _typeImage flex">
                    <img src="./img/Circle.png" alt="">
                </div>
            </div>
        </div>
        <div class="column-1 _separator"></div> -->
<?php

//COMPROBAR ARCHIVO Y VARIABLES NECESARIAS
if (file_exists("xml/restaurante.xml")) {
    $menu = simplexml_load_file("xml/restaurante.xml");
} else {
    exit("El archivo de datos no existe.");
}
$tipos = array();

//ORDENAR XML POR TIPOS EN $tipos
$tiposInsertados = array();
foreach($menu->plato as $plato) {
    if (!in_array((string)$plato["tipo"], $tiposInsertados)) {
        $tipoTexto = (string)$plato["tipo"];
        array_push($tiposInsertados, $tipoTexto);
        $actualTipo = array();
        foreach($menu->plato as $plato2) {
            if ($tipoTexto == (string)$plato2["tipo"]) {
                array_push($actualTipo, $plato2);
            }
        }
        array_push($tipos, $actualTipo);
    }
}

//IMPRIMIR POR PANTALLA LOS DATOS
$id_plato = 0;
$orden = true;
foreach($tipos as $tipo) {
    print('
        <div class="row _typeTitle noselect">
            <div class="column-1 _typeTitleContainer flex">
                <h1>'.$tipo[0]["tipo"].'</h1>
            </div>
        </div>
    ');
    foreach($tipo as $plato) {
        if ($orden) {
            print('
            <div class="row _type noselect">
                <div class="column-1 _typeContent" id="plato_'.$id_plato.'" style="margin-left: -6vw;">
                <div class="column-30 _typeImage flex">
                    <img class="scaleHover" src="./img/platos/'.$plato->imagen.'" alt="">
                </div>
            ');
        }
        else {
            print('
        <div class="row _type noselect">
            <div class="column-1 _typeContent" id="plato_'.$id_plato.'" style="margin-left: 6vw;">
        ');
        }
        print('
                <div class="column-70 _typeValues">
                    <div class="column-70 _typeValuesTitle flex">
                        <h1 class="scaleHover">'.$plato->nombre.'</h1>
                    </div>
                    <div class="column-30 _typeValuesCost flex">
                        <h2 class="scaleHover">'.$plato->precio.' €</h2>
                    </div>
                    <div class="column-1 _typeValuesText">
                        <p class="scaleHover">'.$plato->descripcion.'</p>
                    </div>
                    <div class="column-30 _typeValuesCalories flex">
                        <h3 class="scaleHover">'.$plato->calorias.' kcal</h3>
                    </div>
                    <div class="_typeValuesTypes flex">
        ');
        foreach($plato->caracteristicas as $caracteristica) {
            foreach($caracteristica as $car) {
                print('<img class="scaleHover" src="./img/favicon/'.$car.'.svg" alt="'.$car.'" style="filter: invert(1);">');
            }
        }
        print('
                    </div>
                </div>
        ');
        if (!$orden) {
            print('
                <div class="column-30 _typeImage flex">
                    <img class="scaleHover" src="./img/platos/'.$plato->imagen.'" alt="">
                </div>
            ');
        }
        
        print('
            </div>
        </div>
        ');

        $orden ? $orden = false : $orden = true;
        $id_plato++;
        echo "<script>console.log('".$orden."');</script>";
    }
    print('<div class="column-1 _separator"></div>');
}

?>
    </div>
    <div class="row">
        <div class="column-1 _footer">
            <p class="">Desarrollado por: Eric Molina Molina</p>
        </div>
    </div>
    <div class="black_overlay"></div>

    <script>
        $(".black_overlay").fadeOut(1000);
        $("._topName").fadeOut(0);
        $("._topName").fadeIn(6000);
        $("._title").fadeOut(0);
        $("._title").fadeIn(3500);
        $("._arrow").fadeOut(0);

        setTimeout(function(){ 
            $("._arrow").fadeIn(4000)
        }, 1000);
        
                
        window.onload = main;

        function main() {
            window.addEventListener("scroll", function(){
                // if(isElementIntoView("#summary")) document.getElementsByTagName("form")[0].style.opacity = "1" 
                <?php
                    $orden = true;
                    for ($i=0; $i < $id_plato; $i++) { 
                        print('
                        if(isElementIntoView("#plato_'.$i.'")) {
                            setTimeout(function(){ 
                                document.getElementById("plato_'.$i.'").style.opacity = "1" 
                                document.getElementById("plato_'.$i.'").style.marginLeft = 0
                            }, 200);
                        }
                        ');
                    }
                ?>
            });
            
        }

        function isElementIntoView(el) { 
            var e = document.querySelector(el);
            var rect = e.getBoundingClientRect();
            return  window.innerHeight-rect.top >= 0; 
            
        }

        function DisableArrow() {
            setTimeout(function(){ 
                document.getElementById("arrow").style.transform = "scale(0)";
            }, 200);
        }
    </script>
</body>
</html>