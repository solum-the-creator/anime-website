<?php


namespace app\models;


use Yii;
use yii\base\BaseObject;
use yii\base\Model;

class RatingForm extends Model
{
    public $rating;

    public function rules()
    {
        return[
            ['rating','trim'],
        ];

    }

    public function saveRating($id_anime){
        $ratingUser =Evaluation::findOne([
            'idAnime'=>$id_anime,
            'idUser'=>Yii::$app->user->id,
        ]);
        if($ratingUser != null){
            $ratingUser->valueEvaluat = $this->rating;
            $ratingUser->idUser = Yii::$app->user->id;
            $ratingUser->idAnime = $id_anime;
            $ratingUser->dateEdded = date('Y-m-d');
            return $ratingUser->save();
        }
        else{
            $ratingUser = new Evaluation();
            $ratingUser->valueEvaluat = $this->rating;
            $ratingUser->idUser = Yii::$app->user->id;
            $ratingUser->idAnime = $id_anime;
            $ratingUser->dateEdded = date('Y-m-d');
            return $ratingUser->save();
        }



    }

}