<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institucion".
 *
 * @property int $idInstitucion
 * @property string|null $nombre
 * @property string|null $logo
 * @property string|null $direccion
 * @property string|null $tel
 *
 * @property Entrega[] $entregas
 */
class Institucion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institucion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'logo', 'direccion', 'tel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idInstitucion' => 'Id Institucion',
            'nombre' => 'Nombre',
            'logo' => 'Logo',
            'direccion' => 'Direccion',
            'tel' => 'Tel',
        ];
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idInstitucion' => 'idInstitucion']);
    }
}
