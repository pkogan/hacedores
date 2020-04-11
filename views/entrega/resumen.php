<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resumen de Entregas';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$('.btn-search').click(function(){
    $('.search-form').toggle();
    return false;
});

");
?>
<div class="asistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>




    <?php echo Html::a('Busqueda Avanzada','#',array('class'=>'btn-search btn btn-success')); ?>
<div class="search-form" style="display:none">
    <?php echo $this->render('_searchResumen', ['model' => $searchModel]);  ?>
</div>
        <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showFooter' => true,
        'rowOptions' => function ($model, $index, $widget, $grid) {

            return [
                'id' => $model['idCiudad'].'|'.$model['idInstitucion'],
                
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('entrega/detalle')
                . '&id="+(this.id);'
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                ['label' => 'Provincia',  'value' => 'ciudad.idProvincia0.provincia'],
                //['label' => 'Departamento',  'value' => 'ciudad.departamento_nombre'],
                ['label' => 'Ciudad',  'value' => 'ciudad.ciudad'],
                ['label' => 'Institucion',  'value' => 'nombre','footer'=>'TOTAL'],
                ['label' => 'Entregadas', 'value' => 'entregados', 'footer'=>$total['entregados']]
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
