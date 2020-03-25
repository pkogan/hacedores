<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Solicitante;

/**
 * SolicitanteSearch represents the model behind the search form of `app\models\Solicitante`.
 */
class SolicitanteSearch extends Solicitante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSolicitante', 'idUsuario'], 'integer'],
            [['Intitucion'], 'safe'],
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
        $query = Solicitante::find();

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
            'idSolicitante' => $this->idSolicitante,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'Intitucion', $this->Intitucion]);

        return $dataProvider;
    }
}
