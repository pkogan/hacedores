<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsignacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asignacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idAsignacion') ?>

    <?= $form->field($model, 'idPedido') ?>

    <?= $form->field($model, 'idHacedor') ?>

    <?= $form->field($model, 'cantidadAsignada') ?>

    <?= $form->field($model, 'cantidadCreada') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
