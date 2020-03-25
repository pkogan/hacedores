<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ciudad */

$this->title = $model->idCiudad;
$this->params['breadcrumbs'][] = ['label' => 'Ciudads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ciudad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idCiudad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCiudad], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'categoria',
            'centroide_lat',
            'centroide_lon',
            'departamento_id',
            'departamento_nombre',
            'fuente',
            'idCiudad',
            'localidad_censal_id',
            'localidad_censal_nombre',
            'municipio_id',
            'municipio_nombre',
            'ciudad',
            'idProvincia',
            'provincia_nombre',
        ],
    ]) ?>

</div>
