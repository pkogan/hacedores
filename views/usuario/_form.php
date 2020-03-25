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

    <?= $form->field($model, 'nombreApellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <p> Si se da de alta como Maker Voluntario debe tener una impresora 3d  y si se da de alta como Institución es para realizar un pedido</p>
    <?= $form->field($model, 'idRol')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Rol::find()->all(),'idRol','nombre')) ?>
    <?php //echo  $form->field($model, 'idRol')->textInput() ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>

    <?= //Html::dropDownList('idProvincia', 58, yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(),'idProvincia','provincia'))
            $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(),'idProvincia','provincia'),['id'=>'idProvincia']) ?>
    
    <?= $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(), [
     'options' => [
         //'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
         //'data'=>yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia)")->orderBy('ciudad')->all(),'idCiudad','ciudad'),
         'id'=>'idCuidad'],
     'pluginOptions'=>[
         'depends'=>['idProvincia'],
         'placeholder' => 'Seleccionar...',
         'url' => \yii\helpers\Url::to(['/ciudad/combo'])
     ]
 ])
            //dropDownList(yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where('idProvincia in (58,62)')->orderBy('ciudad')->all(),'idCiudad','ciudad')) ?>
    <?php //echo $form->field($model, 'idCiudad')->textInput() ?>

 
    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
