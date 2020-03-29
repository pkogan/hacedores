<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Entrega;

/**
 * EntregaSearch represents the model behind the search form of `app\models\Entrega`.
 */
class EntregaSearch extends Entrega
{

    public $idHacedor;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEntrega', 'cantidad', 'idProducto', 'idInstitucion',
              'idHacedor'], 'integer'],
            [['fecha', 'imagen'], 'safe'],
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
        $query = Entrega::find();

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

        $query->join('LEFT JOIN', 'producto',
                    'producto.idProducto = entrega.idProducto');
        $query->join('LEFT JOIN', 'hacedor',
                    'hacedor.idHacedor = producto.idHacedor');

        // grid filtering conditions
        $query->andFilterWhere([
            'idEntrega' => $this->idEntrega,
            'fecha' => $this->fecha,
            'cantidad' => $this->cantidad,
            'idProducto' => $this->idProducto,
            'idInstitucion' => $this->idInstitucion,
            'hacedor.idHacedor' => $this->idHacedor,
        ]);


        $query->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}
