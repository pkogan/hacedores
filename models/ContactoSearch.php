<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contacto;

/**
 * ContactoSearch represents the model behind the search form of `app\models\Contacto`.
 */
class ContactoSearch extends Contacto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idCiudad', 'idInstitucion', 'con_caso'], 'integer'],
            [[
                'nombre', 'email', 'tel', 'mas_info',
                'ciudad.ciudad', 'institucion.nombre'
            ], 'safe'],
        ];
    }

    /**
     */
    public function attributes(){
        return array_merge(parent::attributes(), [
            'institucion.nombre',
            'ciudad.ciudad'
        ]);
    } // attributes

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
        $query = Contacto::find();

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

        $query->join('LEFT JOIN', 'institucion',
                    'institucion.idInstitucion = contacto.idInstitucion');
        $query->join('LEFT JOIN', 'ciudad',
                    'ciudad.idCiudad = contacto.idCiudad');
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ciudad.idCiudad' => $this->idCiudad,
            'institucion.idInstitucion' => $this->idInstitucion,
            'con_caso' => $this->con_caso,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
             ->andFilterWhere(['like', 'email', $this->email])
             ->andFilterWhere(['like', 'tel', $this->tel])
             ->andFilterWhere(['like', 'mas_info', $this->mas_info])
             ->andFilterWhere(['like', 'institucion.nombre',
                              $this->getAttribute('institucion.nombre')])
             ->andFilterWhere(['like', 'ciudad.ciudad',
                              $this->getAttribute('ciudad.ciudad')]);

        $dataProvider->sort->attributes['institucion.nombre'] = [
            'asc' => ['institucion.nombre' => SORT_ASC],
            'desc' => ['institucion.nombre' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['ciudad.ciudad'] = [
            'asc' => ['ciudad.ciudad' => SORT_ASC],
            'desc' => ['ciudad.ciudad' => SORT_DESC],
        ];
        
        return $dataProvider;
    }
}
