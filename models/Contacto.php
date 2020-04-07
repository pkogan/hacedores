<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacto".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $tel
 * @property int|null $idInstitucion
 * @property int|null $con_caso
 * @property string|null $mas_info
 *
 * @property Institucion $idInstitucion0
 */
class Contacto extends \yii\db\ActiveRecord
{

    public $captcha;
    public $idCiudad;
    public $idProvincia;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'tel', 'captcha', 'idInstitucion'], 'required'],
            [['captcha'], 'captcha'],
            [['idInstitucion', 'con_caso'], 'integer'],
            [['mas_info'], 'string'],
            [['nombre'], 'string', 'max' => 32],
            [['tel'], 'string', 'max' => 200],
            [['idInstitucion'], 'exist',
             'skipOnError' => true,
             'targetClass' => Institucion::className(),
             'targetAttribute' => ['idInstitucion' => 'idInstitucion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'tel' => 'Tel.',
            'idCiudad' => 'Ciudad de la institución',
            'idProvincia' => 'Provincia de la Institución',
            'idInstitucion' => 'Institución',
            'con_caso' => 'Con Caso Confirmado',
            'mas_info' => 'Más Info',
        ];
    }

    /**
     * Gets query for [[IdInstitucion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Institucion::className(),
                       ['idInstitucion' => 'idInstitucion']);
    }
}