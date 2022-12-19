<?php


namespace app\models;


use yii\base\BaseObject;
use yii\base\Model;
use Yii;

class ListForm extends Model
{
    public $category;

    public function rules()
    {
        return [
            [['category'],'trim'],
        ];
    }

    public static function getCategoryList()
    {
     return ['Смотрю'=>'Смотрю','Отложено'=>'Отложено','Запланировано'=>'Запланировано','Просмотрено'=>'Просмотрено','Брошено'=>'Брошено','Пересматриваю'=>'Пересматриваю'];
    }

    public function saveList($id_anime){
        $list =UserList::findOne([
            'idAnime'=>$id_anime,
            'idUser'=>Yii::$app->user->id,
        ]);
        if($list!=null){
            $list->category = $this->category;
            $list->idAnime = $id_anime;
            $list->idUser = Yii::$app->user->id;
            $list->dateAdded = date('Y-m-d');

            return $list->save();
        }
        else{
            $list = new Userlist();
            $list->category = $this->category;
            $list->idAnime = $id_anime;
            $list->idUser = Yii::$app->user->id;
            $list->dateAdded = date('Y-m-d');

            return $list->save();
        }


    }

}