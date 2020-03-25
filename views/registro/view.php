<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */

$this->title = $model->idRegistro;
$this->params['breadcrumbs'][] = ['label' => 'Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN) {
            echo Html::a('Update', ['update', 'id' => $model->idRegistro], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->idRegistro], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>

    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idRegistro',
            'marca',
            'mail',
            'apellidoNombre',
            'telefono',
            'Localidad',
            'impresores',
            'modelos',
            'tipoFilamento',
            'stock',
            'recursos',
            'contacto',
            'provincia',
            'Comentario',
            'impresoras',
            'PLA',
            'ABS',
            'PETG',
            'FLEX',
            'HIPS',
            'ciudad',
            'idCiudad',
        ],
    ])
    ?>

</div>
