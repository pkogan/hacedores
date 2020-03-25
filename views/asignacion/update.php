<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Asignacion */

$this->title = 'Update Asignacion: ' . $model->idAsignacion;
$this->params['breadcrumbs'][] = ['label' => 'Asignacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAsignacion, 'url' => ['view', 'id' => $model->idAsignacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asignacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
