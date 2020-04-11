<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalle de Entregas';
$this->params['breadcrumbs'][] = ['label' => 'Resumen Entregas', 'url' => ['resumen']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($dataProvider->count>0){?>
    <h3>
    <?= $dataProvider->models[0]->ciudad->ciudad?>
    -
    <?= $dataProvider->models[0]->institucion->nombre?>
    </h3>
    <?php }?>


        <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions' => function ($model, $index, $widget, $grid) {

            return [
                'id' => $model['idEntrega'],
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('entrega/view')
                . '&id="+(this.id);'
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                //'ciudad.ciudad',
                //'institucion.nombre',
                'fecha',
                //['label' => 'Departamento',  'value' => 'ciudad.departamento_nombre'],
                'cantidad',
                'receptor',
               'observacion'
                //['label' => 'HIPS', 'value' => 'HIPS']
                 
        //['label' => 'Estado','attribute' => 'idEstadoAsistencia0.Descripcion'],
        //'Lugar',
        //'Observacion:ntext',
        //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
