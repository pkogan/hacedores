<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'idPedido')->textInput() ?>

    <?php //$form->field($model, 'idSolicitante')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idModelo')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Modelo::find()->all(),'idModelo','nombre')) ?>
    <?php //$form->field($model, 'idModelo')->textInput() ?>

    <?php // $form->field($model, 'idEstado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
