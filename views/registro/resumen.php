<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resumen de Producción';
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

<!--    <p>
    <?= Html::a('Create Asistencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->


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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                  ['label' => 'Provincia',  'value' => 'idCiudad0.idProvincia0.provincia'],
                ['label' => 'Departamento',  'value' => 'idCiudad0.departamento_nombre'],
                ['label' => 'Ciudad',  'value' => 'idCiudad0.ciudad','footer'=>'TOTAL'],
                ['label' => 'Makers',  'value' => 'voluntarios', 'footer'=>$total['voluntarios']],
                ['label' => 'Impresoras', 'value' => 'impresoras', 'footer'=>$total['impresoras']],
                ['label' => 'Impresiones', 'value' => 'productos1', 'footer'=>$total['productos1']],
                ['label' => 'Entregadas', 'value' => 'entregados', 'footer'=>$total['entregados']],
                ['label' => 'A Entregar', 'value' => 'aentregar', 'footer'=>$total['aentregar']],
                ['label' => 'PLA', 'value' => 'PLA', 'footer'=>$total['PLA']],
                ['label' => 'ABS', 'value' => 'ABS', 'footer'=>$total['ABS']],
                ['label' => 'PETG', 'value' => 'PETG', 'footer'=>$total['PETG']],
                ['label' => 'FLEX', 'value' => 'FLEX', 'footer'=>$total['FLEX']]
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
