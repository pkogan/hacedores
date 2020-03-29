<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'idInstitucion')->dropdownList(
            app\models\Institucion::find()
                    ->select(['nombre'])
                    ->indexBy('idInstitucion')
                    ->column()
    )
    ?>

    <?php //echo $form->field($model, 'idSolicitante')->textInput() ?>

    <?=
    $form->field($model, 'fecha')->widget(
            \kartik\date\DatePicker::className(), [
        'options' => ['placeholder' => 'Fecha de solicitud'],
        'convertFormat' => true,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-MM-dd',
        ],
    ])

    ?>


    <?php //echo $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

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

    <?php if(isset($model->idPedido)){
        echo $form->field($model, 'idEstado')->dropdownList(
        app\models\Estado::find()
                    ->select(['estado'])
                    ->indexBy('idEstado')
    ->column());}  ?>

    <div class="form-group">
<?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
