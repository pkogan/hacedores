<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hacedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hacedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'institucion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cantidadMaquinas')->textInput() ?>

    <?= $form->field($model, 'materialImprimir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Completar Registro', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
