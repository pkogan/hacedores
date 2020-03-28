<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntregaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrega-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idEntrega') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'imagen') ?>

    <?= $form->field($model, 'idProducto') ?>

    <?php // echo $form->field($model, 'idInstitucion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
