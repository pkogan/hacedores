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
    public $rol = null;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol', 'idHacedor', 'idUsuario'], 'integer'],
            [['rol'], 'safe'],
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
            // uncomment the following line if you do not want to return
            // any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('usuario');
        
        // grid filtering conditions
        $query->andFilterWhere([
            'idHacedor' => $this->idHacedor,
            'idUsuario' => $this->idUsuario,
            'usuario.idRol' => $this->rol,
        ]);


        return $dataProvider;
    }
}
