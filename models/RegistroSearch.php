<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registro;

/**
 * RegistroSearch represents the model behind the search form of `app\models\Registro`.
 */
class RegistroSearch extends Registro
{
    /**
     * {@inheritdoc}
     */
    public $idProvincia;
    public $provinciaFiltro;
    public $ciudadFiltro;
    
    
    public function rules()
    {
        return [
            [['idHacedor', 'telefono', 'impresores', 'idCiudad','idProvincia'], 'integer'],
            [['provinciaFiltro','ciudadFiltro', 'mail', 'apellidoNombre', 'modelos', 'tipoFilamento', 'stock', 'recursos', 'contacto',  'Comentario', 'impresoras'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Registro::find()->joinWith('idCiudad0.idProvincia0')->joinWith('productos.entregas');
        /*$query->groupBy(['idHacedor','ciudad.idCiudad', 'provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad']);
        $query->select([ 'ciudad.idCiudad','provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad', 'Count(*) as voluntarios', 'Sum(impresores) as impresoras',
            'Sum(PLA) as PLA', 'Sum(ABS) as ABS','Sum(PETG) as PETG','Sum(FLEX) as FLEX','Sum(HIPS) as HIPS', 'Sum(producto.cantidad) as productos1', 'Sum(entrega.cantidad) entregados' ]);
        */// add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idHacedor' => $this->idHacedor,
            'telefono' => $this->telefono,
            'impresores' => $this->impresores,
            'idCiudad' => $this->idCiudad,
        ]);

        $query->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'apellidoNombre', $this->apellidoNombre])
            ->andFilterWhere(['like', 'Localidad', $this->Localidad])
            ->andFilterWhere(['like', 'modelos', $this->modelos])
            ->andFilterWhere(['like', 'tipoFilamento', $this->tipoFilamento])
            ->andFilterWhere(['like', 'stock', $this->stock])
            ->andFilterWhere(['like', 'recursos', $this->recursos])
            ->andFilterWhere(['like', 'contacto', $this->contacto])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'Comentario', $this->Comentario])
            ->andFilterWhere(['like', 'impresoras', $this->impresoras])
            /*->andFilterWhere(['like', 'PLA', $this->PLA])
            ->andFilterWhere(['like', 'ABS', $this->ABS])
            ->andFilterWhere(['like', 'PETG', $this->PETG])
            ->andFilterWhere(['like', 'FLEX', $this->FLEX])
            ->andFilterWhere(['like', 'HIPS', $this->HIPS])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad]*/
            ->andFilterWhere(['like', 'ciudad.ciudad', $this->ciudadFiltro])
            ->andFilterWhere(['like', 'provincia.provincia', $this->provinciaFiltro]);

        return $dataProvider;
    }

    public static function searchQuery(){
        $query = Registro::find()->joinWith('idCiudad0.idProvincia0');//->joinWith('productos.entregas');
        $query->groupBy(['ciudad.idCiudad', 'provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad']);
        $query->select([ 'ciudad.idCiudad','provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad', 'Count(distinct hacedor.idHacedor) as voluntarios', 'Sum( impresores) as impresoras',
            'Sum( PLA) as PLA', 'Sum( ABS) as ABS','Sum( PETG) as PETG','Sum( FLEX) as FLEX','Sum( HIPS) as HIPS'])->orderBy('ciudad.idCiudad');
        //, 'Sum(distinct producto.cantidad) as productos1', 'Sum(entrega.cantidad) entregados',                       'Sum(distinct producto.cantidad)-Sum(distinct entrega.cantidad) as aentregar']);
        return $query;
    }

    public function searchResumen($params) {

        $query = RegistroSearch::searchQuery();
        
        // add conditions that should always apply here



        $this->load($params);


        // grid filtering conditions
        $query->andFilterWhere(['provincia.idProvincia' => $this->idProvincia,
          
        ]);
        
        $resultado=$query->asArray()->all();
        
        $query=Registro::find()->joinWith('idCiudad0.idProvincia0')->joinWith('productos',true,'LEFT OUTER JOIN');
        $query->select(['ciudad.idCiudad','Sum( producto.cantidad) as productos1']);//, 'Sum(entrega.cantidad) entregados', 'Sum(distinct producto.cantidad)-Sum(distinct entrega.cantidad) as aentregar']);
         $query->groupBy(['ciudad.idCiudad'])->orderBy('ciudad.idCiudad');
         
        $query->andFilterWhere(['provincia.idProvincia' => $this->idProvincia]);
        $resultado2= $query->asArray()->all();
        
        $query=Registro::find()->joinWith('idCiudad0.idProvincia0')->joinWith('productos.entregas',true,'LEFT OUTER JOIN');
        $query->select(['ciudad.idCiudad','Sum( entrega.cantidad) as entregados']);//, 'Sum(entrega.cantidad) entregados', 'Sum(distinct producto.cantidad)-Sum(distinct entrega.cantidad) as aentregar']);
         $query->groupBy(['ciudad.idCiudad'])->orderBy('ciudad.idCiudad');
        $query->andFilterWhere(['provincia.idProvincia' => $this->idProvincia]);
        $resultado3= $query->asArray()->all();
        
        //echo count($resultado). ' '. count($resultado2). ' '.count($resultado3);
        //exit;
        foreach ($resultado as $key => $value) {
            $resultado[$key]= array_merge($value, array_merge($resultado2[$key],$resultado3[$key]));
            $resultado[$key]['aentregar']=$resultado2[$key]['productos1']-$resultado3[$key]['entregados'];
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $resultado,
        ]);
        return $dataProvider;
    }



    public function totalResumen($params) {

        $query = Registro::find()->joinWith('idCiudad0.idProvincia0');//->joinWith('productos.entregas',true,'LEFT OUTER JOIN');
        //$query->groupBy(['ciudad.idCiudad', 'provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad']);
        $query->select([   'Count( hacedor.idHacedor) as voluntarios', 'Sum(impresores) as impresoras',
            'Sum( PLA) as PLA', 'Sum( ABS) as ABS','Sum( PETG) as PETG','Sum( FLEX) as FLEX','Sum( HIPS) as HIPS']);
            //, 'Sum(distinct producto.cantidad) as productos1', 'Sum(entrega.cantidad) entregados', 'Sum(distinct producto.cantidad)-Sum(distinct entrega.cantidad) as aentregar']);

        $this->load($params);

        $query->andFilterWhere([
            //'idAsistencia' => $this->idAsistencia,
            'provincia.idProvincia' => $this->idProvincia,
            //'Fecha' => $this->Fecha,
            //'Asistencia.idTipo' => $this->idTipo,
            //'idEstadoAsistencia' => $this->idEstadoAsistencia,
        ]);
        
          
         
        
        $resultado= $query->asArray()->one();
        
        $query=Registro::find()->joinWith('idCiudad0.idProvincia0')->joinWith('productos',true,'LEFT OUTER JOIN');
        $query->select(['Sum( producto.cantidad) as productos1']);//, 'Sum(entrega.cantidad) entregados', 'Sum(distinct producto.cantidad)-Sum(distinct entrega.cantidad) as aentregar']);
        $query->andFilterWhere(['provincia.idProvincia' => $this->idProvincia]);
        $resultado= array_merge($resultado,$query->asArray()->one());
        
        //$query->joinWith=[];
        $query=Registro::find()->joinWith('idCiudad0.idProvincia0')->joinWith('entregas',true,'LEFT OUTER JOIN');
        $query->select(['Sum(entrega.cantidad) entregados']);
        $query->andFilterWhere(['provincia.idProvincia' => $this->idProvincia]);
        $resultado= array_merge($resultado,$query->asArray()->one());
        $resultado['aentregar']=$resultado['productos1']-$resultado['entregados'];
        return $resultado;
        
        
    }



    
}
