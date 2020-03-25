<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hacedor;

/**
 * HacedorSearch represents the model behind the search form of `app\models\Hacedor`.
 */
class HacedorSearch extends Hacedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idHacedor', 'idUsuario', 'cantidadMaquinas'], 'integer'],
            [['institucion', 'materialImprimir', 'link'], 'safe'],
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
        $query = Hacedor::find();

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
            'idHacedor' => $this->idHacedor,
            'idUsuario' => $this->idUsuario,
            'cantidadMaquinas' => $this->cantidadMaquinas,
        ]);

        $query->andFilterWhere(['like', 'institucion', $this->institucion])
            ->andFilterWhere(['like', 'materialImprimir', $this->materialImprimir])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
