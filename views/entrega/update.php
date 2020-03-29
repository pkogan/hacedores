<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entrega */

$this->title = 'Update Entrega: ' . $model->idEntrega;
//$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idEntrega, 'url' => ['view', 'id' => $model->idEntrega]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entrega-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
          <?= Html::a('Eliminar', ['delete', 'id' => $model->idEntrega], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de eliminar la entrega?',
                'method' => 'post',
            ],
        ]) ?>


</div>
