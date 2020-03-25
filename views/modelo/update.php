<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Modelo */

$this->title = 'Update Modelo: ' . $model->idModelo;
$this->params['breadcrumbs'][] = ['label' => 'Modelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idModelo, 'url' => ['view', 'id' => $model->idModelo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
