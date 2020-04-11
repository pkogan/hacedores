<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Asistencia;
use app\models\Institucion;

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
        
       <?php
    $options = [
        'options' => ['id' => 'idCiudad', 'placeholder' => 'Todas'],
        'id' => 'idCuidad',
        'pluginOptions' => [
            'depends' => ['idProvincia'],
            'url' => \yii\helpers\Url::to(['/ciudad/combo'])
    ]];
        $optionsInstitucion=[
        'options' => ['id' => 'idInstitucion', 'placeholder' => 'Todas'],
        'id' => 'idInstitucion',
        'pluginOptions' => [
            'depends' => ['idProvincia','idCiudad'],
            'url' => \yii\helpers\Url::to(['/institucion/combo'])
    ]];

    if (!is_null($model->idProvincia)&&$model->idProvincia!='') {
        //$model->idProvincia = $model->ciudad->idProvincia;

        $options['data'] = yii\helpers\ArrayHelper::map(\app\models\Ciudad::find()->where("idProvincia in ($model->idProvincia) and categoria<>".'"ENTIDAD"')->orderBy('ciudad')->all(), 'idCiudad', 'ciudad');
        //$optionsInstitucion['data'] = yii\helpers\ArrayHelper::map(\app\models\Institucion::find()->where("idCiudad in ($model->idCiudad) and idTipologia=10")->orderBy('nombre')->all(), 'idInstitucion', 'nombre');
        $optionsInstitucion['data'][Institucion::OTROID]=Institucion::NOMBRES[Institucion::OTROID];
        
        //if(Yii::$app->user->identity->idRol== \app\models\Rol::ROL_MAKER){
            $optionsInstitucion['data'][Institucion::CENTROENSAMLADOID]= Institucion::NOMBRES[Institucion::CENTROENSAMLADOID];
            $optionsInstitucion['data'][Institucion::CENTRODISTSALUDID]= Institucion::NOMBRES[Institucion::CENTRODISTSALUDID];

    }
    

    echo $form->field($model, 'idProvincia')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->orderBy('provincia')->all(), 'idProvincia', 'provincia'), ['id' => 'idProvincia', 'prompt' => 'Todas'])
    ?>

    <?=
    $form->field($model, 'idCiudad')->widget(\kartik\depdrop\DepDrop::classname(), $options)
    ?>   
    
  <?= $form->field($model, 'idInstitucion')->widget(\kartik\depdrop\DepDrop::classname(), $optionsInstitucion) ?>

  
        
  
<?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
<?php //echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
