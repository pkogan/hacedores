<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitante */

$this->title = 'Update Solicitante: ' . $model->idSolicitante;
$this->params['breadcrumbs'][] = ['label' => 'Solicitantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idSolicitante, 'url' => ['view', 'id' => $model->idSolicitante]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitante-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
