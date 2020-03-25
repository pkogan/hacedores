<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoNombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput() ?>

    <?= $form->field($model, 'Localidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impresores')->textInput() ?>

    <?= $form->field($model, 'modelos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoFilamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recursos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comentario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impresoras')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PLA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ABS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PETG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FLEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HIPS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCiudad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
