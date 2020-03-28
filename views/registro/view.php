<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */

$this->title = $model->idHacedor;
$this->params['breadcrumbs'][] = ['label' => 'Registros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN) {
            echo Html::a('Update', ['update', 'id' => $model->idHacedor], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->idHacedor], [
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
            'marca',
            'idHacedor',
            'idUsuario',
            'token',
            
            'mail',
            'apellidoNombre',
            'telefono',
            'idCiudad0.idProvincia0.provincia',
            'idCiudad0.ciudad',
            'direccion',
            'impresores',
            'modelos',
            'tipoFilamento',
            'stock',
            'PLA',
            'ABS',
            'PETG',
            'FLEX',
            'HIPS',
            'recursos',
            'contacto',
            'Comentario',
        ],
    ])
    ?>

</div>
