<?php


namespace app\models;


use yii\base\Model;

class FilterForm extends Model
{
    public $categoryStr; //по чему сортировать
    public $typeStr; //по чему сортировать
    public $ratingStr; //по чему сортироват



    public function rules()
    {
        return[
            [['categoryStr','typeStr','ratingStr'],'trim'],
        ];
    }
}