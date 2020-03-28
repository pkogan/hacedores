<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ActualizarclaveForm extends Model
{
    public $clave;
    public $reclave;
    public $direccion;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['clave', 'reclave', 'direccion'], 'required'],
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            [['reclave'], 'compare','compareAttribute'=>'clave'],
        ];
    }

     public function attributeLabels()
    {
        return [
            'clave' => 'Clave',
            'reclave' => 'Reingrese Clave',
            'direccion'=> 'Actualizar Dirección'
        ];
    }
    
}
