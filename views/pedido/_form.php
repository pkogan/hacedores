<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Institucion;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $options = [
        'options' => ['id' => 'idCiudad', 'placeholder' => 'Seleccionar ...'],
        'id' => 'idCuidad',
        'pluginOptions' => [
            'depends' => ['idProvincia'],
            'url' => \yii\helpers\Url::to(['/ciudad/combo'])
    ]];
    $optionsInstitucion = [
        'options' => ['id' => 'idInstitucion', 'placeholder' => 'Seleccionar ...'],
        'id' => 'idInstitucion',
        'pluginOptions' => [
            'depends' => ['idProvincia', 'idCiudad'],
            'url' => \yii\helpers\Url::to(['/institucion/combo'])
    ]];

    if (!is_null($model->idCiudad)) {
        $model->idProvincia = $model->idCiudad0->idProvincia;

        $options['data'] = yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia) and categoria<>" . '"ENTIDAD"')->orderBy('ciudad')->all(), 'idCiudad', 'ciudad');
        $optionsInstitucion['data'] = yii\helpers\ArrayHelper::map(\app\models\Institucion::find()->where("idCiudad in ($model->idCiudad) and idTipologia=10")->orderBy('nombre')->all(), 'idInstitucion', 'nombre');
        $optionsInstitucion['data'][Institucion::OTROID] = Institucion::NOMBRES[Institucion::OTROID];
        $optionsInstitucion['data'][Institucion::CENTROENSAMLADOID] = Institucion::NOMBRES[Institucion::CENTROENSAMLADOID];
        $optionsInstitucion['data'][Institucion::CENTRODISTSALUDID] = Institucion::NOMBRES[Institucion::CENTRODISTSALUDID];
    }


    echo $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(), 'idProvincia', 'provincia'), ['id' => 'idProvincia', 'prompt' => 'Seleccionar ...'])
    ?>

    <?=
    $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(), $options)
    ?>   


    <?= $form->field($model, 'idInstitucion')->widget(\kartik\depdrop\DepDrop::classname(), $optionsInstitucion) ?>


    <?php //echo $form->field($model, 'idSolicitante')->textInput()  ?>

    <?=
    $form->field($model, 'fecha')->widget(
            \kartik\date\DatePicker::className(), [
        'options' => ['placeholder' => 'Fecha de solicitud'],
        'convertFormat' => true,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-MM-dd',
        ],
    ])
    ?>


<?php //echo $form->field($model, 'imagen')->textInput(['maxlength' => true])  ?>

    <?=
    $form->field($model, 'idModelo')->dropdownList(
            app\models\Modelo::find()
                    ->select(['nombre'])
                    ->indexBy('idModelo')
                    ->column()
    )
    ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>
    <?= $form->field($model, 'observacion')->textarea(['maxlength' => true]) ?>

    <?php
    if (isset($model->idPedido)) {
        echo $form->field($model, 'idEstado')->dropdownList(
                app\models\Estado::find()
                        ->select(['estado'])
                        ->indexBy('idEstado')
                        ->column());
    }
    ?>

    <div class="form-group">
<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
