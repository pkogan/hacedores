<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadoEntrega".
 *
 * @property int $idEstado
 * @property string $estado
 *
 * @property Entrega[] $entregas
 */
class EstadoEntrega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadoEntrega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstado', 'estado'], 'required'],
            [['idEstado'], 'integer'],
            [['estado'], 'string', 'max' => 100],
            [['idEstado'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstado' => 'Id Estado',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idEstado' => 'idEstado']);
    }
}
