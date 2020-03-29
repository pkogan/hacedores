<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Institucion;

/**
 * InstitucionSearch represents the model behind the search form of `app\models\Institucion`.
 */
class InstitucionSearch extends Institucion {

    public $provinciaFiltro;
    public $ciudadFiltro;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['idInstitucion', 'idCiudad'], 'integer'],
                [['provinciaFiltro', 'ciudadFiltro', 'nombre', 'logo', 'direccion', 'tel'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Institucion::find()->joinWith('idCiudad0.idProvincia0')->joinWith('pedidos');//->joinWith('entregas')
/*        ->select(['institucion.idInstitucion','institucion.nombre','ciudad','provincia.provincia','sum(pedido.cantidad)  as pedidos1'])//,'sum(entrega.cantidad) as entregas1'])
        ->groupBy(['institucion.idInstitucion','nombre','ciudad','provincia']);*/

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
            'idInstitucion' => $this->idInstitucion,
            'idCiudad' => $this->idCiudad,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
                ->andFilterWhere(['like', 'logo', $this->logo])
                ->andFilterWhere(['like', 'direccion', $this->direccion])
                ->andFilterWhere(['like', 'tel', $this->tel])
                ->andFilterWhere(['like', 'ciudad.ciudad', $this->ciudadFiltro])
                ->andFilterWhere(['like', 'provincia.provincia', $this->provinciaFiltro]);
        ;
        
       $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $dataProvider;
    }

}
