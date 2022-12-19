<?php


namespace app\models;
use Yii;

use yii\base\Model;

class CommentsForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
          [['comment'],'required'],
            [['comment'],'string','length' => [3,250]],
        ];
    }

    public function saveComment($anime_id)
    {
        $comment = new Reviews();
        $comment->textReview = $this->comment;
        $comment->idUser = Yii::$app->user->id;
        $comment->idAnime = $anime_id;
        $comment->dateAdded = date('Y-m-d');

        return $comment->save();

    }
}