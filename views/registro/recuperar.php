<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ingrese el email de registro y le llegará un correo con los pasos a seguir</p>
    <div class="registro-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'captcha')->widget(yii\captcha\Captcha::className()) ?>


        <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>