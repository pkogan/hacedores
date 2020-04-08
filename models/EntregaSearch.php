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
     */
    public function attributes(){
        return array_merge(parent::attributes(),
                      ['institucion.nombre',
                       'producto.modelo.nombre',
                        'producto.hacedor.apellidoNombre',
                'ciudad.ciudad',
                          'usuarioValidador.nombreUsuario']);
    } // attributes
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEntrega', 'cantidad', 'idProducto', 'idInstitucion',
              'idHacedor', 'idEstado', 'idUsuarioValidador'
              ], 'integer'],
            [['fecha', 'observacion',
              'producto.modelo.nombre', 'institucion.nombre','receptor','producto.hacedor.apellidoNombre',
                'usuarioValidador.nombreUsuario','ciudad.ciudad'], 'safe'],
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
            // uncomment the following line if you do not want to
            // return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*$query->join('LEFT JOIN', 'producto',
                    'producto.idProducto = entrega.idProducto');*/
        $query->joinWith('producto.hacedor');
        $query->joinWith('ciudad');
        $query->joinWith('usuarioValidador');
        
        $query->join('LEFT Outer JOIN', 'institucion',
                    'institucion.idInstitucion = entrega.idInstitucion');
        $query->join('LEFT JOIN', 'modelo',
                    'producto.idModelo = modelo.idModelo');

        // grid filtering conditions
        $query->andFilterWhere([
            'idEntrega' => $this->idEntrega,
            'fecha' => $this->fecha,
            'cantidad' => $this->cantidad,
            'idProducto' => $this->idProducto,
            'idInstitucion' => $this->idInstitucion,
            'hacedor.idHacedor' => $this->idHacedor,
            'idUsuarioValidador' => $this->idUsuarioValidador,
            'idEstado' => $this->idEstado,
        ]);


        $query->andFilterWhere(['like', 'receptor',  $this->receptor]);
        $query->andFilterWhere(['like', 'observacion', $this->observacion]);

        $dataProvider->sort->attributes['institucion.nombre'] = [
            'asc' => ['institucion.nombre' => SORT_ASC],
            'desc' => ['institucion.nombre' => SORT_DESC],
        ];
        $query->andFilterWhere(['LIKE', 'institucion.nombre',
                               $this->getAttribute('institucion.nombre')]);

        $dataProvider->sort->attributes['producto.modelo.nombre'] = [
            'asc' => ['modelo.nombre' => SORT_ASC],
            'desc' => ['modelo.nombre' => SORT_DESC],
        ];
        $query->andFilterWhere(['LIKE', 'modelo.nombre',
                               $this->getAttribute('producto.modelo.nombre')]);
        $query->andFilterWhere(['LIKE', 'ciudad.ciudad',
                               $this->getAttribute('ciudad.ciudad')]);
        $query->andFilterWhere(['LIKE', 'hacedor.apellidoNombre',
                               $this->getAttribute('producto.hacedor.apellidoNombre')]);
        $query->andFilterWhere(['LIKE', 'usuario.nombreUsuario',
                               $this->getAttribute('usuarioValidador.nombreUsuario')]);

        return $dataProvider;
    }
}
