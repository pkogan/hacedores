<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HacedorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hacedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idHacedor') ?>

    <?= $form->field($model, 'idUsuario') ?>

    <?= $form->field($model, 'institucion') ?>

    <?= $form->field($model, 'cantidadMaquinas') ?>

    <?= $form->field($model, 'materialImprimir') ?>

    <?php // echo $form->field($model, 'link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
