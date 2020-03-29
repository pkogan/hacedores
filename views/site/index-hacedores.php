<?php

use yii\helpers\Html;
use app\assets\IntrojsAsset;

IntrojsAsset::register($this);

use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'Registro de Makers';

$entrega_grid_buttons = [
    'view' => function ($url, $model, $key) {
        return Html::a('<span class="glyphicon glyphicon-eye-open" />',
                 ['entrega/view', 'id' => $model->idEntrega]);
    },
];
?>
<div class="site-index">

  <?= $this->render('_carousel_modelos') ?>


  <div class="jumbotron">
    <h1>Bienvenido/a</h1>
    <h3>
      <span class="glyphicon glyphicon-cog" />
      <?= !is_null($hacedor) ? $hacedor->cant_productos() : 0 ?> En stock |

      <span class="glyphicon glyphicon-cog" />
      <?= !is_null($hacedor) ? $hacedor->cant_entregas() : 0 ?> Entregados 
    </h3>
    <h3>
      <span class="glyphicon glyphicon-user"></span>
      <?= $total['voluntarios'] ?> Voluntarios |
      <span class="glyphicon glyphicon-cog"> </span>
      <?= $total['impresoras'] ?> Impresoras
    </h3>
    <p>
      <?php
      echo Html::a('Modelos', ['modelo/index'], ['class' => 'btn btn-success']);
      echo " ";

      echo Html::a('Entregas', ['entrega/index'], ['class' => 'btn btn-success',
                                                  'data-hints' =>
                                                      'Vea o registre las entrega de los productos.'
      ]);
      echo " ";

      if ($puede['ver_productos']) {
          echo Html::a('Productos', ['producto/index'], ['class' => 'btn btn-success']);
      }
      ?> <?= Html::a('Actualizar Stock de Material', ['registro/update', 'id' => Yii::$app->user->identity->hacedors[0]->idHacedor    ], ['class' => 'btn btn-success'])
         ?>
    </p>
  </div>            

</div>




<!-- -------------------- -->
<div class="body-content">

  <div class="row">
    <div class="col-lg-6">
      <h1> Sus productos
        <?= Html::a('Agregar',
                    ['producto/create'],
                    ['class' => 'btn btn-sm btn-success']);
        ?>
      </h1>

      <?=
      ListView::widget([
          'dataProvider' => $productoProvider,
          // 'filterModel' => $productoSearch,
          'itemView' => '_producto_view',]);
      ?>

    </div>
    <div class="col-lg-6">
      <h1> Sus entregas
        <?= Html::a('Agregar', ['entrega/create'],
                  ['class' => 'btn btn-sm btn-success']) ?>
      </h1>

      <?=
      GridView::widget([
          'dataProvider' => $entregaProvider,
          // 'filterModel' => $entregaSearch,
          'rowOptions' => function ($model, $index, $widget, $grid) {

              return [
                  'id' => $model['idEntrega'],
                  'onclick' => 'location.href="'
                          . Yii::$app->urlManager->createUrl('entrega/view')
                          . '&id="+(this.id);'
              ];
          },
          'columns' => [
              'fecha',
              'producto.modelo.nombre',
              'cantidad',
              ['class' => 'yii\grid\ActionColumn',
               'template' => '{view}',
               'buttons' => $entrega_grid_buttons],
          ],
      ]);
      ?>

    </div>
  </div>

  <!-- -------------------- -->

  <div class="row">
    <div class="col-lg-4">
      <h2 id="modelo">Modelo Mascara MinSalud</h2>
      <p>Es un diseño que ha sido revisado y mejorado en función de lo solicitado por el Ministerio de Salud de Neuquén.

        Compartimos dos archivos STL para la fabricación de la Máscara de Protección Facial y un Manual con un plano y recomendaciones para la fabricación.
      </p>
      <ul>
        <li><a href="img/20200326-MascaraMinSalud.stl">20200326-MascaraMinSalud.stl</a> </li>
        <li><a href="img/20200326-MascaraMinSalud2.stl">20200326-MascaraMinSalud2.stl</a></li>
        <li><a href="img/Manual.pdf">Manual y Recomendaciones</a></li>
      </ul>
      <p>Este producto, tiene el objetivo de preservar y proteger a todas las personas del sistema de salud que ponen el cuerpo de manera directa las 24 h en este momento que nos toca vivir a todos/as. Y esto que hemos logrado entre todos, es el esfuerzo de muchas horas de trabajo de los equipos técnicos y de coordinación de las instituciones y de especialistas, emprendedores y empresas de toda la comunidad.
        Les pedimos, mientras tanto, se extremen las medidas de cuidado, en el sentido más amplio del término, durante el proceso de producción y entrega. Establezcan los cuidados necesarios de cada uno/a de ustedes. Cuidemos la manipulación y preservemos la higiene producto.

      </p>


    </div>
    <div class="col-lg-4">
      <h2>Registro de Makers</h2>

      <p> La fuente de datos de makers se obtiene de un registro realizado por tres entidades</p>
      <ul>
        <li>El Gobierno de la Provincia de Neuquén y Centro PyME-ADENEU en el siguiente <a class="btn btn-default" href="https://forms.gle/hEqG9YNnMjGduYEv6 ">Formulario &raquo;</a></li>
        <li>La red de makers de San Martín de Los Andes <a class="btn btn-default" href="https://web.facebook.com/impresoresneuquen/">Facebook &raquo;</a></li>
        <li>Universidad Nacional de Río Negro en el siguiente <a class="btn btn-default" href="https://forms.gle/Qzgt5qZaDxsjH7ML8">Formulario &raquo;</a></li>

      </ul>

    </div>
    <div class="col-lg-4">
      <h2>Otras fuentes</h2>


      <p> La fuente de datos de localidades y georreferenciamiento se obtiene de </p>
      <p><a class="btn btn-default" href="https://datos.gob.ar/">Datos Nacionales &raquo;</a></p>
      <p> Las imágenes se obtienen de</p>
      <p><a class="btn btn-default" href="https://www.openstreetmap.org/">OpenStreetMap &raquo;</a>

        <p> Las imágenes se obtienen de</p>
        <p><a class="btn btn-default" href="https://www.openstreetmap.org/">OpenStreetMap &raquo;</a>


    </div>

  </div>


</div>
</div>
<script>
 $('.counter-count').each(function () {
     $(this).prop('Counter', 0).animate(
         {
             Counter: $(this).text()
         },
         {
             duration: 5000,
             easing: 'swing',
             step: function (now) {
                 $(this).text(Math.ceil(now));
             }
     });
 });
</script>
