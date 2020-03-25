<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $idProvincia
 * @property string $provincia
 *
 * @property Ciudad[] $ciudads
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProvincia', 'provincia'], 'required'],
            [['idProvincia'], 'integer'],
            [['provincia'], 'string', 'max' => 50],
            [['idProvincia'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProvincia' => 'Id Provincia',
            'provincia' => 'Provincia',
        ];
    }

    /**
     * Gets query for [[Ciudads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiudads()
    {
        return $this->hasMany(Ciudad::className(), ['idProvincia' => 'idProvincia']);
    }
}
