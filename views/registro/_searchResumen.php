<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Asistencia;

/* @var $this yii\web\View */
/* @var $model app\models\AsistenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-search">

    <?php
    $form = ActiveForm::begin([
                'action' => [Yii::$app->controller->action->id],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
    ]);
    ?>



<?php // echo $form->field($model, 'Observacion')  ?>

    <div class="form-group">
     <?= $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->all(), 'idProvincia', 'provincia'), ['prompt' => 'Todos'])
    ?>   
<?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
<?php //echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
