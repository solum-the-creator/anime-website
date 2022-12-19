<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $idReview
 * @property int $idAnime
 * @property int $idUser
 * @property string $textReview
 * @property string $dateAdded
 *
 * @property User $idUser0
 * @property Anime $idAnime0
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAnime', 'idUser', 'textReview', 'dateAdded'], 'required'],
            [['idAnime', 'idUser'], 'integer'],
            [['dateAdded'], 'safe'],
            [['textReview'], 'string', 'max' => 1000],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'UserId']],
            [['idAnime'], 'exist', 'skipOnError' => true, 'targetClass' => Anime::className(), 'targetAttribute' => ['idAnime' => 'idAnime']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idReview' => 'Id Review',
            'idAnime' => 'Id Anime',
            'idUser' => 'Id User',
            'textReview' => 'Text Review',
            'dateAdded' => 'Date Added',
        ];
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['UserId' => 'idUser']);
    }



    /**
     * Gets query for [[IdAnime0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnime()
    {
        return $this->hasOne(Anime::className(), ['idAnime' => 'idAnime']);
    }


}
