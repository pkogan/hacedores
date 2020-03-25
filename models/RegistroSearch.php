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
            [['idRegistro', 'telefono', 'impresores', 'idCiudad','idProvincia'], 'integer'],
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
        $query = Registro::find()->joinWith('idCiudad0.idProvincia0');

        // add conditions that should always apply here

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
            'idRegistro' => $this->idRegistro,
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



    public function searchResumen($params) {

        $query = Registro::find()->joinWith('idCiudad0.idProvincia0');
        $query->groupBy(['ciudad.idCiudad', 'provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad']);
        $query->select([ 'ciudad.idCiudad','provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad', 'Count(*) as voluntarios', 'Sum(impresores) as impresoras',
            'Sum(PLA) as PLA', 'Sum(ABS) as ABS','Sum(PETG) as PETG','Sum(FLEX) as FLEX','Sum(HIPS) as $HIPS' ]);
        
        // add conditions that should always apply here



        $this->load($params);

        /*if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $query->asArray()->all(),
            ]);
            return $dataProvider;
        }*/

        // grid filtering conditions
        $query->andFilterWhere([
            //'idAsistencia' => $this->idAsistencia,
            'provincia.idProvincia' => $this->idProvincia,
            //'Fecha' => $this->Fecha,
            //'Asistencia.idTipo' => $this->idTipo,
            //'idEstadoAsistencia' => $this->idEstadoAsistencia,
        ]);
        //$query->andFilterWhere(['like', 'modelos', $this->modelos]);
/*
        $query->andFilterWhere(['like', 'Puesto.Nombre', $this->puesto]);
        */

        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $query->asArray()->all(),
        ]);
        return $dataProvider;
    }



    public function totalResumen($params) {

        $query = Registro::find()->joinWith('idCiudad0.idProvincia0');
        //$query->groupBy(['ciudad.idCiudad', 'provincia.provincia','ciudad.departamento_nombre','ciudad.ciudad']);
        $query->select([  'Count(*) as voluntarios', 'Sum(impresores) as impresoras',
            'Sum(PLA) as PLA', 'Sum(ABS) as ABS','Sum(PETG) as PETG','Sum(FLEX) as FLEX','Sum(HIPS) as $HIPS' ]);

        $this->load($params);

        $query->andFilterWhere([
            //'idAsistencia' => $this->idAsistencia,
            'provincia.idProvincia' => $this->idProvincia,
            //'Fecha' => $this->Fecha,
            //'Asistencia.idTipo' => $this->idTipo,
            //'idEstadoAsistencia' => $this->idEstadoAsistencia,
        ]);

        
         
        
        return $query->asArray()->one();
    }



    
}
