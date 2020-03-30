<?php

use yii\helpers\Html;
use app\assets\IntrojsAsset;

IntrojsAsset::register($this);

use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $hacedor app\models\Hacedor */

$this->title = 'Registro de Makers';
?>
<div class="site-index">

    <?php //echo $this->render('_carousel_modelos')   ?>
    <div class="body-content" >
        <div class="row" id="produccion">

            <?php
            if (count($hacedor->productos) == 0) {
                ?><!--<div class="mastfoot alert-info">No ha cargado ningún producto todavía, para hacerlo debe seleccionar el paso 2.  </div> -->
                <?php
            } else {
                /* $this->title = 'Producción Personal';
                  $this->params['breadcrumbs'] = [['label' => 'Ver Ayuda', 'url' => "#ayuda"]];
                  $this->params['breadcrumbs'][] = $this->title; */
                ?>
                <a href="#ayuda" style="float: right">Ver Ayuda | </a>
                <?php
                foreach ($hacedor->productos as $producto) {
                    ?>
                    <!-- -------------------- -->

                    <hr/>

                    <h2 center>Su producción del modelo:#<?= $producto->idModelo . ' ' . $producto->modelo->nombre ?> | <a href="<?= $producto->modelo->link ?>" >Descargar Modelo</a></h2>

                    <div class="grey-bg c-no container-fluid">
                        <div class="container">
                            <div class="row" id="counter">
                                <div class="col-sm-4 counter-Txt"> <span class="glyphicon glyphicon-wrench" > </span> <span class="counter-value" data-count="10"><?= $producto->cantidad ?></span>
                                    Impresiones 3D <br/><?= Html::a('Actualizar <br/>Cantidad', ['producto/update', 'id' => $producto->idProducto], ['class' => 'btn btn-sm btn-primary']);
                    ?>
                                </div>
                                <div class="col-sm-4 counter-Txt"> <span class="glyphicon glyphicon-send"></span> <span class="counter-value" data-count="25"><?= $producto->cant_entregas() ?> </span> Entregadas<br/>
                                    <?= Html::a('3) Agregar</br>Entrega', ['entrega/create', 'idProducto' => $producto->idProducto], ['class' => 'btn btn-warning', 'data-hints' => 'Vea o registre las entrega de los productos.']) ?>
                                </div>
                                <div class="col-sm-4 counter-Txt margin-bot-35"> <span class="glyphicon glyphicon-tasks" ></span> <span class="counter-value" data-count="150"><?= $producto->stock ?></span> A Entregar<br/>
                                  <?php
                                  if ($producto->tiene_entregas()){
                                      $btn_class = 'btn btn-danger disabled';
                                  }else{
                                      $btn_class = 'btn btn-danger';
                                  }
                                  ?>
                                    <?=
                                    Html::a('Borrar<br/> Producto', ['producto/delete', 'id' => $producto->idProducto], [
                                        'class' => $btn_class,
                                        'data' => [
                                            'confirm' => 'Está seguro de Borrar el Producto?',
                                            'method' => 'post',
                                        ],
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>





                <?php } ?>
            </div>
            <div class="row">


                <h2> Sus entregas</h2>

                <?=
                //$entregaProvider->sort->sortParam = false;
                GridView::widget([
                    'dataProvider' => $entregaProvider,
                    // 'filterModel' => $entregaSearch,
                    'rowOptions' => function ($model, $index, $widget, $grid) {

                        return [
                            'id' => $model['idEntrega'],
                            'onclick' => 'location.href="'
                            . Yii::$app->urlManager->createUrl('entrega/update')
                            . '&id="+(this.id);'
                        ];
                    },
                    'columns' => [
                        'fecha',
                            ['label' => 'Modelo', 'value' => 'producto.modelo.nombre'],
                            ['label' => 'Institución', 'value' => 'institucion.nombre'],
                        'cantidad',
                    ],
                ]);
                ?>
                <h4 class="alert-info">Para agregar una Entrega debe hacer click en el botón 3) Agregar Entrega. Para actualizar o borrar las Entregas seleccionar la línea correspondiente.</h4>

            <?php } ?>
        </div>

        <!-- -------------------- -->





    </div>

    <div class="jumbotron" id="ayuda">
        <h2 >Hola Maker !!!</h2>
        <p>Gracias por ser parte de esta red colaborativa que trata de aportar un grano de arena frente a la crisis del COVID-19.
            El objetivo de esta aplicación es afrontar la demanda de máscaras e insumos impresos en 3d para combatir el COVID-19, de forma colaborativa, juntando fuerzas de grupos y redes de makers.</p>

        <p>Para poder medir y compartir los insumos impresos por usted, que pueden ayudar al personal de salud 
            u otros actores que necesiten protejerse del virus, es necesario que:</p>
        <hr/>
        <p><?= Html::a('1) Actualizar el Registro', ['registro/update', 'id' => Yii::$app->user->identity->hacedors[0]->idHacedor], ['class' => 'btn btn-success']) ?> Con información de contacto y Stock con el que cuenta, de Materiales para imprimir.</p>
        <hr/>
        <p><?= Html::a('2) Agregar Producto', ['producto/agregar'], ['class' => 'btn btn-sm btn-primary']); ?> Y tener actualizada la cantidad de máscaras que ha impreso</p>
        <hr/>
        <p>3) Luego de realizar cada entrega de máscaras, es importante que cargue los datos de Fecha, Institución u Organismo beneficiario y cantidad entregada de máscaras.</p>
    </div>

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
