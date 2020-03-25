<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ciudad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ciudad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centroide_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centroide_lon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamento_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamento_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCiudad')->textInput() ?>

    <?= $form->field($model, 'localidad_censal_id')->textInput() ?>

    <?= $form->field($model, 'localidad_censal_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idProvincia')->textInput() ?>

    <?= $form->field($model, 'provincia_nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
