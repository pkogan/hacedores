<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ciudad;

/**
 * CiudadSearch represents the model behind the search form of `app\models\Ciudad`.
 */
class CiudadSearch extends Ciudad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria', 'centroide_lat', 'centroide_lon', 'departamento_id', 'departamento_nombre', 'fuente', 'localidad_censal_nombre', 'municipio_id', 'municipio_nombre', 'ciudad', 'provincia_nombre'], 'safe'],
            [['idCiudad', 'localidad_censal_id', 'idProvincia'], 'integer'],
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
        $query = Ciudad::find();

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
            'idCiudad' => $this->idCiudad,
            'localidad_censal_id' => $this->localidad_censal_id,
            'idProvincia' => $this->idProvincia,
        ]);

        $query->andFilterWhere(['like', 'categoria', $this->categoria])
            ->andFilterWhere(['like', 'centroide_lat', $this->centroide_lat])
            ->andFilterWhere(['like', 'centroide_lon', $this->centroide_lon])
            ->andFilterWhere(['like', 'departamento_id', $this->departamento_id])
            ->andFilterWhere(['like', 'departamento_nombre', $this->departamento_nombre])
            ->andFilterWhere(['like', 'fuente', $this->fuente])
            ->andFilterWhere(['like', 'localidad_censal_nombre', $this->localidad_censal_nombre])
            ->andFilterWhere(['like', 'municipio_id', $this->municipio_id])
            ->andFilterWhere(['like', 'municipio_nombre', $this->municipio_nombre])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'provincia_nombre', $this->provincia_nombre]);

        return $dataProvider;
    }
}
