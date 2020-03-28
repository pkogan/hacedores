<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nombreUsuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clave')->passwordInput(['maxlength' => true]) ?>

 
    <p> Si se da de alta como Maker Voluntario debe tener una impresora 3d  y si se da de alta como gestor puede gestionar los pedidos</p>
    <?= $form->field($model, 'idRol')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Rol::find()->all(),'idRol','nombre')) ?>
    <?php //echo  $form->field($model, 'idRol')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
