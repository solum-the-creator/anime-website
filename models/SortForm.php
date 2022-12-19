<?php


namespace app\models;


use yii\base\Model;

class SortForm extends Model
{
    public $str; //по чему сортировать

    public function rules()
    {
        return[
            ['str','trim'],
        ];
    }
}