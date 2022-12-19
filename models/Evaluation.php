<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluation".
 *
 * @property int $idEvaluation
 * @property int $idUser
 * @property int $idAnime
 * @property string $dateEdded
 * @property int $valueEvaluat
 *
 * @property User $idUser0
 * @property Anime $idAnime0
 */
class Evaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idAnime', 'dateEdded', 'valueEvaluat'], 'required'],
            [['idUser', 'idAnime', 'valueEvaluat'], 'integer'],
            [['dateEdded'], 'safe'],
            [['idAnime', 'idUser'], 'unique', 'targetAttribute' => ['idAnime', 'idUser']],
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
            'idEvaluation' => 'Id Evaluation',
            'idUser' => 'Id User',
            'idAnime' => 'Id Anime',
            'dateEdded' => 'Date Edded',
            'valueEvaluat' => 'Value Evaluat',
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
    public function getIdAnime0()
    {
        return $this->hasOne(Anime::className(), ['idAnime' => 'idAnime']);
    }
}
