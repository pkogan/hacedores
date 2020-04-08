<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */

$this->title = 'Resumen Entrega #' . $model->idEntrega;
//$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entrega-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $qrCode = (new QrCode(\yii\helpers\Url::base('http') . '?r=entrega/view&id=' . $model->idEntrega))
            ->setSize(150)
            ->setMargin(5);
    //->useForegroundColor(51, 153, 255);
// now we can display the qrcode in many ways
// saving the result to a file:

    $qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified
// display directly to the browser 
    header('Content-Type: ' . $qrCode->getContentType());
//echo $qrCode->writeString();
    ?> 

 <p>
        <?php
        if (Yii::$app->user->identity->idRol == \app\models\Rol::ROL_MAKER || $model->producto->hacedor->idUsuario==Yii::$app->user->identity->idUsuario) {
            echo Html::a('Volver a Inicio', ['/site'], ['class' => 'btn btn-success']). ' ';
            echo Html::a('Editar', ['update', 'id' => $model->idEntrega], ['class' => 'btn btn-primary']). ' ';
            echo Html::a('Eliminar', ['delete', 'id' => $model->idEntrega], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de borrar esta Entrega?',
                    'method' => 'post',
                ],
            ]).' ';
            
        }
        ?>

        <?php
        if (in_array(Yii::$app->user->identity->idRol, [\app\models\Rol::ROL_GESTOR, \app\models\Rol::ROL_ADMIN])&&  $model->producto->hacedor->idUsuario!=Yii::$app->user->identity->idUsuario) {
            echo Html::a('Volver a Inicio', ['index'], ['class' => 'btn btn-success']). ' ';
            if ($model->idEstado == 0) {
                echo Html::a('Validar', ['validar', 'id' => $model->idEntrega, 'idEstado' => 1], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Esta seguro de Validar esta Entrega?',
                        'method' => 'post',
                    ],
                ]);
            } else {
                echo Html::a('Cambiar En espera', ['validar', 'id' => $model->idEntrega, 'idEstado' => 0], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Esta seguro de Cambiar estado a En espera, de esta Entrega?',
                        'method' => 'post',
                    ],
                ]);
            }
        }
        ?>

    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idEntrega',

            'fecha',
                ['label' => 'Maker', 'attribute' => 'producto.hacedor.apellidoNombre'],
                'ciudad.ciudad',
                ['label' => 'Institución', 'attribute' => 'institucion.nombre'],
            'receptor',
                ['label' => 'Modelo Nombre', 'attribute' => 'producto.modelo.nombre'],
                ['label' => 'Modelo Descripcion', 'attribute' => 'producto.modelo.descripcion'],
            'cantidad',
            'observacion',
                ['label' => 'QR', 'value' => $qrCode->writeDataUri(), 'format' => ['image', []]],
            'estado.estado'
        ],
    ])
    ?>
   
</div>
