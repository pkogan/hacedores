<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $registros[] app\models\Registro */
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;

// first lets setup the center of our map
//print_r($registros);
// The Tile Layer (very important)
$markers = [];
foreach ($registros as $registro) {
   
        $center = new LatLng(['lat' => $registro['centroide_lat'], 'lng' => $registro['centroide_lon']]);

// now lets create a marker that we are going to place on our map
        $descripcion = $registro['ciudad'].', '. $registro['voluntarios']. ' voluntarios'.', '. $registro['impresoras']. ' impresoras';
        $marker = new Marker(['latLng' => $center, 'popupContent' => $descripcion
        ]);
        $markers[] = $marker; // add the marker (addLayer is used to add different layers to our map)
   
}

$tileLayer = new TileLayer([
    'urlTemplate' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    'clientOptions' => [
        'attribution' => '' .
        'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    //'subdomains' => 'nix'
    ]
        ]);

// now our component and we are going to configure it



// finally render the widget
// we could also do
// echo $leaflet->widget();


$this->title = 'Mapa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php 
    if (count($markers) > 0) {
    $leaflet = new LeafLet([
        'tileLayer' => $tileLayer, // set the TileLayer
        'center' => $center, // set the center
        'zoom'=>6,
    ]);

    foreach ($markers as $marker) {
        $leaflet->addLayer($marker);
    }
    echo Map::widget(['leafLet' => $leaflet,'options' => ['style' => 'min-height: 400px']]);
} else{
    echo 'No tiene puntos para mostrar';
}
     ?>


</div>
