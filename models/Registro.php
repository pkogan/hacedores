<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro".
 *
 * @property int $idRegistro
 * @property string|null $marca
 * @property string|null $mail
 * @property string|null $apellidoNombre
 * @property int|null $telefono
 * @property string|null $Localidad
 * @property int|null $impresores
 * @property string|null $modelos
 * @property string|null $tipoFilamento
 * @property string|null $stock
 * @property string|null $recursos
 * @property string|null $contacto
 * @property string|null $provincia
 * @property string|null $Comentario
 * @property string|null $impresoras
 * @property string|null $PLA
 * @property string|null $ABS
 * @property string|null $PETG
 * @property string|null $FLEX
 * @property string|null $HIPS
 * @property string|null $ciudad
 * @property int|null $idCiudad
 * @property Ciudad $idCiudad0
 * @property string|null $direccion
 * @property string|null $token
 */
class Registro extends \yii\db\ActiveRecord {
   
    public $captcha;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'registro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['telefono', 'impresores', 'idCiudad'], 'integer'],
                [['marca'], 'string', 'max' => 19],
                [['mail'], 'string', 'max' => 35],
                [['apellidoNombre', 'token'], 'string', 'max' => 32],
                [['Localidad', 'provincia', 'ciudad'], 'string', 'max' => 23],
                [['modelos'], 'string', 'max' => 58],
                [['tipoFilamento'], 'string', 'max' => 63],
                [['stock'], 'string', 'max' => 67],
                [['recursos'], 'string', 'max' => 165],
                [['contacto', 'PLA'], 'string', 'max' => 2],
                [['Comentario'], 'string', 'max' => 347],
                [['impresoras', 'ABS', 'PETG', 'FLEX', 'HIPS'], 'string', 'max' => 1],
                [['direccion'], 'string', 'max' => 300],
                [['captcha'], 'captcha']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'idRegistro' => 'Id Registro',
            'marca' => 'Marca',
            'mail' => 'Mail',
            'apellidoNombre' => 'Apellido Nombre',
            'telefono' => 'Telefono',
            'Localidad' => 'Localidad',
            'impresores' => 'Impresores',
            'modelos' => 'Modelos',
            'tipoFilamento' => 'Tipo Filamento',
            'stock' => 'Stock',
            'recursos' => 'Recursos',
            'contacto' => 'Contacto',
            'provincia' => 'Provincia',
            'Comentario' => 'Comentario',
            'impresoras' => 'Impresoras',
            'PLA' => 'Pla',
            'ABS' => 'Abs',
            'PETG' => 'Petg',
            'FLEX' => 'Flex',
            'HIPS' => 'Hips',
            'ciudad' => 'Ciudad',
            'idCiudad' => 'Id Ciudad',
            'direccion' => 'Direccion',
            'token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCiudad0() {
        return $this->hasOne(Ciudad::className(), ['idCiudad' => 'idCiudad']);
    }

}
