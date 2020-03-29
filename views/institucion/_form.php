<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Institucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?php
    $options = [
        'options' => ['id' => 'idCiudad', 'placeholder' => 'Seleccionar ...'],
        'id' => 'idCuidad',
        'pluginOptions' => [
            'depends' => ['idProvincia'],
            'url' => \yii\helpers\Url::to(['/ciudad/combo'])
    ]];
    if (!is_null($model->idCiudad)) {
        $model->idProvincia = $model->idCiudad0->idProvincia;

        $options['data'] = yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia)")->orderBy('ciudad')->all(), 'idCiudad', 'ciudad');
    }
    echo $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(), 'idProvincia', 'provincia'), ['id' => 'idProvincia', 'prompt' => 'Seleccionar ...'])
    ?>

    <?=
    $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(), $options)
    ?>


    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
