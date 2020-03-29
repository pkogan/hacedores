<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'marca')->textInput(['maxlength' => true]): ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoNombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput() ?>

    <?php
    $options = [
        //'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
        'options' => ['id' => 'idCiudad', 'placeholder' => 'Seleccionar ...'],
        //'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'id' => 'idCuidad',
        'pluginOptions' => [
            'depends' => ['idProvincia'],
            //'placeholder' => 'Seleccionar...',
            'url' => \yii\helpers\Url::to(['/ciudad/combo'])
    ]];
    if (!is_null($model->idCiudad)) {
        $model->idProvincia = $model->idCiudad0->idProvincia;

        $options['data'] = yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia)")->orderBy('ciudad')->all(), 'idCiudad', 'ciudad');
    }
    echo $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(), 'idProvincia', 'provincia'), ['id' => 'idProvincia','prompt' => 'Seleccionar ...'])
    ?>
    <?php //print_r($model->idCiudad0->idProvincia); print_r($model->idCiudad); print_r($options);//exit();?>
    <?=
    $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(),$options)
    ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impresores')->textInput() ?>

    <?= $form->field($model, 'modelos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoFilamento')->textInput(['maxlength' => true]) ?>
    <p>Stock de Material disponible en Kg.</p>
    <?= $form->field($model, 'PLA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ABS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PETG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FLEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HIPS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'recursos')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'Comentario')->textarea(['maxlength' => true]) ?>





    <div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
