<?php


namespace app\models;


use yii\base\BaseObject;
use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $password;
    public $fullName;
    public $email;

    public function rules()
    {
        return [
            ['username','required','message' => 'Логин не заполнен'],
            ['password','required','message' => 'Пароль не заполнен'],
            ['username','string','min'=>4,'max' => 30,'tooShort' => 'Поле должно содержать не менее 4 символов','tooLong' => 'Поле должно содержать не более 30 символов'],
            ['password','string','min'=>4,'max' => 20,'tooShort' => 'Поле должно содержать не менее 4 символов','tooLong' => 'Поле должно содержать не более 20 символов'],
            ['username','unique', 'targetClass' => 'app\models\User','message' => 'Данный логин уже занят'],
            ['fullName','required','message' => 'Имя пользователя не заполнено'],
            ['email','email','message' => 'Email введён не правильно'],
            ['email','required','message' => 'Email не заполнен']
        ];
    }

    public function signup(){

        if($this->validate()){
            $user = new User();
            $user->username = $this->username;
            $user->setPassword($this->password);
            $user->Fullname = $this->fullName;
            $user->Email = $this->email;
            $user->status = 'user';
            $user->regDate = date('Y-m-d');
            return $user->save();
        }

    }

}