<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hacedor */

$this->title = 'Update Hacedor: ' . $model->idHacedor;
$this->params['breadcrumbs'][] = ['label' => 'Hacedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idHacedor, 'url' => ['view', 'id' => $model->idHacedor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hacedor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
