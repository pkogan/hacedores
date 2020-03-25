<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'Intitucion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Completar Registro', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
