<?php


namespace app\models;


use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            ['username','required','message' => 'Логин не введён'],
            ['password','required','message' => 'Пароль не введён'],
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params){
        if (!$this->hasErrors()){
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute,'Пароль или пользователь введены неверно');
            }
        }
    }

    public function getUser(){
        return User::findOne(['username'=>$this->username]);
    }
}