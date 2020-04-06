<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form of `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    public $usuarioFilter;
    public $institucionFilter;
    public $estadoFilter;
    /**
     * {@inheritdoc}
     */
    public function attributes(){
        return array_merge(parent::attributes(),
                      [
                'idCiudad0.ciudad'  ]);
    }
    
    
    public function rules()
    {
        return [
            [['idPedido', 'idInstitucion', 'idSolicitante', 'idModelo', 'cantidad', 'idEstado'], 'integer'],
            [['estadoFilter','idCiudad0.ciudad','usuarioFilter','institucionFilter','fecha', 'observacion', 'imagen'], 'safe'],
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
        $query = Pedido::find()->joinWith('idInstitucion0')->joinWith('idSolicitante0')->joinWith('idCiudad0');

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
            'idPedido' => $this->idPedido,
            'idInstitucion' => $this->idInstitucion,
            'idSolicitante' => $this->idSolicitante,
            'fecha' => $this->fecha,
            'idModelo' => $this->idModelo,
            'cantidad' => $this->cantidad,
            'idEstado' => $this->idEstado,
        ]);

        $query->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'imagen', $this->imagen])
            ->andFilterWhere(['like', 'institucion.nombre', $this->institucionFilter])
            ->andFilterWhere(['like', 'usuario.nombreUsuario', $this->usuarioFilter])
            ->andFilterWhere(['like', 'ciudad.ciudad', $this->getAttribute('idCiudad0.ciudad')])
                ->andFilterWhere(['like', 'estado.estado', $this->estadoFilter]);

        return $dataProvider;
    }
}
