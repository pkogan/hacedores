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
class RecuperarclaveForm extends Model
{
    public $mail;
    public $captcha;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['mail', 'captcha'], 'required'],
            // rememberMe must be a boolean value
    [['mail'], 'email'],
            // password is validated by validatePassword()
            [['captcha'], 'captcha'],
        ];
    }

     public function attributeLabels()
    {
        return [
            'mail' => 'Correo',
            'captcha' => 'Captcha',
        ];
    }
    
}
